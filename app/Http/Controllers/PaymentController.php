<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Business;
use App\Models\FeeAssessment;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{

    public function index(Request $request)
    {
        $search = trim($request->search ?? '');

        $payments = Payment::with([
                'business',
                'assessment',
                'receivedBy',
                'document',
            ])
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {


                    $q->where(
                        'reference_no',
                        'like',
                        "%{$search}%"
                    )


                    ->orWhereHas('business', function ($businessQuery) use ($search) {

                        $businessQuery
                            ->where(
                                'business_name',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhere(
                                'owner_name',
                                'like',
                                "%{$search}%"
                            );
                    })

                    ->orWhereHas('assessment', function ($assessmentQuery) use ($search) {

                        $assessmentQuery
                            ->where(
                                'transaction_type',
                                'like',
                                "%{$search}%"
                            );
                    })

                   
                    ->orWhereHas('document', function ($documentQuery) use ($search) {

                        $documentQuery
                            ->where(
                                'document_type',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhere(
                                'requester_first_name',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhere(
                                'requester_middle_name',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhere(
                                'requester_last_name',
                                'like',
                                "%{$search}%"
                            );
                    })


                    ->orWhere(
                        'complainant_name',
                        'like',
                        "%{$search}%"
                    );
                });
            })
            ->latest('payment_date')
            ->paginate(15)
            ->withQueryString();

        return view(
            'payments.index',
            compact('payments')
        );
    }


    public function report()
    {
        $payments = Payment::with([
                'business',
                'assessment',
                'receivedBy',
                'document',
            ])
            ->latest('payment_date')
            ->get();

        return view(
            'reports.payments',
            compact('payments')
        );
    }

    public function reportPdf()
    {
        $payments = Payment::with([
                'business',
                'assessment',
                'receivedBy',
                'document',
            ])
            ->latest('payment_date')
            ->get();

        $pdf = Pdf::loadView(
            'payments.report-pdf',
            compact('payments')
        )->setPaper('a4', 'landscape');

        return $pdf->stream(
            'payment-transaction-report.pdf'
        );
    }


    public function create($business = null)
    {
        $selectedBusiness = null;

        if ($business) {
            $selectedBusiness = Business::findOrFail(
                $business
            );
        }

        $businesses = Business::orderBy(
            'business_name'
        )->get();

        $assessments = FeeAssessment::with(
            'business'
        )
            ->latest()
            ->get();

        return view(
            'payments.create',
            compact(
                'businesses',
                'assessments',
                'selectedBusiness'
            )
        );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            'transaction_type' => [
                'required',
                'string',
                'max:255',
            ],

            'certification_type' => [
                'nullable',
                'string',
                'max:255',
            ],

            'business_id' => [
                'nullable',
                'exists:businesses,id',
            ],

            'assessed_amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'paid_amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'payment_date' => [
                'required',
                'date',
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:1000',
            ],


            'last_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'first_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'middle_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'birthday' => [
                'nullable',
                'date',
            ],

            'age' => [
                'nullable',
                'integer',
                'min:0',
                'max:150',
            ],

            'sex' => [
                'nullable',
                'string',
                'max:50',
            ],

            'marital_status' => [
                'nullable',
                'string',
                'max:100',
            ],

            'birthplace' => [
                'nullable',
                'string',
                'max:255',
            ],

            'blood_type' => [
                'nullable',
                'string',
                'max:20',
            ],

            'citizenship' => [
                'nullable',
                'string',
                'max:100',
            ],

            'contact_no' => [
                'nullable',
                'string',
                'max:50',
            ],

            'personal_address' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'purpose' => [
                'nullable',
                'string',
                'max:1000',
            ],


            'complainant_name' => [
                'required_if:transaction_type,Filing Complaint',
                'nullable',
                'string',
                'max:255',
            ],

            'complainant_contact' => [
                'required_if:transaction_type,Filing Complaint',
                'nullable',
                'string',
                'max:50',
            ],

            'respondent_name' => [
                'required_if:transaction_type,Filing Complaint',
                'nullable',
                'string',
                'max:255',
            ],

            'respondent_contact' => [
                'nullable',
                'string',
                'max:50',
            ],

            'complaint_type' => [
                'required_if:transaction_type,Filing Complaint',
                'nullable',
                'string',
                'max:100',
            ],

            'incident_date' => [
                'nullable',
                'date',
            ],

            'incident_place' => [
                'nullable',
                'string',
                'max:255',
            ],

            'complaint_description' => [
                'required_if:transaction_type,Filing Complaint',
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        if (
            (float) $validated['paid_amount']
            >
            (float) $validated['assessed_amount']
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Payment was not recorded. Amount paid cannot be greater than the assessed amount.'
                );
        }



        if (
            $validated['transaction_type'] === 'Filing Complaint'
            &&
            (float) $validated['paid_amount'] !== 100.00
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Filing Complaint requires the fixed ₱100.00 fee.'
                );
        }


        if (
            $validated['transaction_type'] === 'Certification Fee'
            &&
            empty($validated['certification_type'])
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Please select a certification type.'
                );
        }

        $businessId =
            $validated['business_id'] ?? null;

        $noBusinessRequired = [
            'Certification Fee',
            'Filing Complaint',
        ];


        if (
            !in_array(
                $validated['transaction_type'],
                $noBusinessRequired
            )
            &&
            !$businessId
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Please select a business for this transaction.'
                );
        }

        $documentTypeMap = [

            'Business Clearance'
                => 'Business Clearance',

            'Signboard Tax'
                => 'Signboard Tax Certificate',

            'Covered Court Fee'
                => 'Covered Court Certification',

            'Commercial Breeding Tax'
                => 'Commercial Breeding Certificate',

            'Filing Complaint'
                => 'Filing Fee Certificate',
        ];
        $certificationDocumentMap = [

            'Barangay Clearance'
                => 'Barangay Clearance',

            'Barangay Certification'
                => 'Barangay Certification',

            'Filing Fee Certificate'
                => 'Filing Fee Certificate',

            'Residency'
                => 'Certificate of Residency',

            'Proof of Income'
                => 'Proof of Income Certificate',

            'Barangay ID'
                => 'Barangay ID',

            'Other Barangay Certification'
                => 'Barangay Certification',
        ];

        try {

            DB::beginTransaction();


            $business = null;

            if ($businessId) {

                $business = Business::findOrFail(
                    $businessId
                );
            }

            $assessment = FeeAssessment::create([

                'business_id'
                    => $businessId,

                'transaction_type'
                    => $validated['transaction_type'],

                'assessed_amount'
                    => $validated['assessed_amount'],

                'amount'
                    => $validated['assessed_amount'],

                'assessment_date'
                    => $validated['payment_date'],

                'status'
                    => 'Paid',

                'assessed_by'
                    => auth()->id(),

                'remarks'
                    => $validated['remarks']
                        ?? null,
            ]);


            $referenceNo =
                'PAY-'
                . now()->format('YmdHis')
                . '-'
                . strtoupper(
                    Str::random(4)
                );

            $payment = Payment::create([

                'business_id'
                    => $businessId,

                'assessment_id'
                    => $assessment->id,

                'reference_no'
                    => $referenceNo,

                'amount'
                    => $validated['paid_amount'],

                'payment_method'
                    => 'Cash',

                'payment_date'
                    => $validated['payment_date'],

                'remarks'
                    => $validated['remarks']
                        ?? null,


                'complainant_name'
                    => $validated['complainant_name']
                        ?? null,

                'complainant_contact'
                    => $validated['complainant_contact']
                        ?? null,

                'respondent_name'
                    => $validated['respondent_name']
                        ?? null,

                'respondent_contact'
                    => $validated['respondent_contact']
                        ?? null,

                'complaint_type'
                    => $validated['complaint_type']
                        ?? null,

                'incident_date'
                    => $validated['incident_date']
                        ?? null,

                'incident_place'
                    => $validated['incident_place']
                        ?? null,

                'complaint_description'
                    => $validated['complaint_description']
                        ?? null,


                'received_by'
                    => auth()->id(),
            ]);

            if ($businessId) {

                $this->updatePaymentStatus(
                    $businessId
                );
            }

            $document = null;

            $documentType = null;

            if (
                $validated['transaction_type']
                === 'Certification Fee'
            ) {

                $certificationType =
                    $validated['certification_type']
                    ?? null;

                if (
                    $certificationType
                    &&
                    isset(
                        $certificationDocumentMap[
                            $certificationType
                        ]
                    )
                ) {

                    $documentType =
                        $certificationDocumentMap[
                            $certificationType
                        ];
                }
            }

            if (
                !$documentType
                &&
                isset(
                    $documentTypeMap[
                        $validated['transaction_type']
                    ]
                )
            ) {

                $documentType =
                    $documentTypeMap[
                        $validated['transaction_type']
                    ];
            }


            if ($documentType) {

                $document = Document::create([

                    'business_id'
                        => $businessId,

                    'payment_id'
                        => $payment->id,

                    'document_no'
                        => 'REQ-'
                        . now()->format('YmdHis')
                        . '-'
                        . strtoupper(
                            Str::random(5)
                        ),

                    'document_type'
                        => $documentType,

                    'requester_last_name'
                        => $validated['last_name']
                            ?? null,

                    'requester_first_name'
                        => $validated['first_name']
                            ?? null,

                    'requester_middle_name'
                        => $validated['middle_name']
                            ?? null,

                    'requester_birthdate'
                        => $validated['birthday']
                            ?? null,

                    'requester_age'
                        => $validated['age']
                            ?? null,

                    'requester_sex'
                        => $validated['sex']
                            ?? null,

                    'requester_birthplace'
                        => $validated['birthplace']
                            ?? null,

                    'requester_marital_status'
                        => $validated['marital_status']
                            ?? null,

                    'requester_blood_type'
                        => $validated['blood_type']
                            ?? null,

                    'requester_citizenship'
                        => $validated['citizenship']
                            ?? 'FILIPINO',

                    'requester_contact'
                        => $validated['contact_no']
                            ?? null,

                    'requester_address'
                        => $validated['personal_address']
                            ?? 'Barangay San Bartolome, Santa Magdalena, Sorsogon',

                    'purpose'
                        => $validated['purpose']
                            ?? $validated['remarks']
                            ?? null,

                    
                    'issued_date'
                        => null,

                    'issued_by'
                        => null,

                    'status'
                        => 'Pending',

                    'remarks'
                        => $validated['remarks']
                            ?? 'No Derogatory Record',
                ]);
            }


            if ($business) {

                $description =
                    "Payment of ₱"
                    . number_format(
                        $payment->amount,
                        2
                    )
                    . " was recorded for business '"
                    . $business->business_name
                    . "'. Reference No: "
                    . $payment->reference_no
                    . ". Transaction Type: "
                    . $validated['transaction_type']
                    . ".";

            } else {

                $description =
                    "Payment of ₱"
                    . number_format(
                        $payment->amount,
                        2
                    )
                    . " was recorded for "
                    . $validated['transaction_type']
                    . ". Reference No: "
                    . $payment->reference_no
                    . ".";
            }


            ActivityLogger::log(

                'Payment Recorded',

                $description,

                'Payments',

                $payment->id
            );


            if ($document) {

                ActivityLogger::log(

                    'Document Request Created',

                    "A {$document->document_type} request "
                    . "was automatically created after payment "
                    . "{$payment->reference_no} and marked Pending.",

                    'Documents',

                    $document->id
                );
            }


            DB::commit();

            if ($document) {

                return redirect()
                    ->route('payments.index')
                    ->with(
                        'success',
                        'Payment recorded successfully. Reference No: '
                        . $referenceNo
                        . '. The '
                        . $document->document_type
                        . ' request has been sent to the Secretary for processing.'
                    );
            }

            return redirect()
                ->route('payments.index')
                ->with(
                    'success',
                    'Payment recorded successfully. Reference No: '
                    . $referenceNo
                );


        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Payment failed: '
                    . $e->getMessage()
                );
        }
    }


    private function updatePaymentStatus($businessId)
    {
        if (!$businessId) {
            return;
        }


        $business = Business::findOrFail(
            $businessId
        );

        $totalPaid = Payment::where(
            'business_id',
            $businessId
        )->sum('amount');



        $totalAssessed = FeeAssessment::where(
            'business_id',
            $businessId
        )->sum('assessed_amount');


        if ($totalPaid <= 0) {

            $business->payment_status =
                'Unpaid';

            $business->registration_status =
                'Pending';

        } elseif (
            $totalAssessed > 0
            &&
            $totalPaid >= $totalAssessed
        ) {

            $business->payment_status =
                'Fully Paid';

            $business->registration_status =
                'Active';

        } else {

            $business->payment_status =
                'Partially Paid';

            $business->registration_status =
                'Pending';
        }

        $business->save();
    }
}