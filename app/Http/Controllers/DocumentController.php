<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Business;
use App\Helpers\ActivityLogger;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DocumentController extends Controller
{

    private function secretary()
    {
        abort_unless(
            auth()->user()->isSecretary(),
            403,
            'Secretary access required.'
        );
    }
    public function index()
    {
        abort_unless(
            in_array(
                auth()->user()->role,
                ['secretary', 'captain']
            ),
            403
        );

        $documents = Document::with([
            'business',
            'issuer',
            'payment',
            'payment.assessment'
        ])
        ->where('status', 'Issued')
        ->latest()
        ->paginate(15);

        return view(
            'documents.index',
            compact('documents')
        );
    }

    public function create()
    {
        $this->secretary();

        $businesses = Business::where(
            'payment_status',
            'Fully Paid'
        )
        ->orderBy('business_name')
        ->get();

     

        $types = [
            'Barangay Clearance',
            'Business Clearance',
            'Certificate of Residency',
            'Signboard Tax Certificate',
            'Commercial Breeding Certificate',
            'Covered Court Certification',
            'Filing Fee Certificate',
            'Barangay Certification'
        ];

        return view(
            'documents.create',
            compact(
                'businesses',
                'types'
            )
        );
    }

    /**
     * Store and issue a new document.
     */
    public function store(Request $r)
    {
        $this->secretary();

        $d = $r->validate([
            'business_id' => 'required|exists:businesses,id',

            'document_type' => [
                'required',
                'string'
            ],

            'purpose' => 'nullable|string',

            'issued_date' => 'required|date',

            'remarks' => 'nullable|string'
        ]);

        $d['document_no'] =
            'DOC-'
            . now()->format('Ymd')
            . '-'
            . strtoupper(Str::random(5));

        $d['issued_by'] = auth()->id();

        $d['status'] = 'Issued';

        $doc = Document::create($d);

        $business = Business::find(
            $d['business_id']
        );

        ActivityLogger::log(
            'Document Issued',

            "A {$doc->document_type} was issued for business '"
            . ($business?->business_name ?? 'Unknown Business')
            . "'. Document No: {$doc->document_no}.",

            'Documents',

            $doc->id
        );
        return redirect()
            ->route('documents.pdf', $doc);
    }

    public function pending()
    {
        $this->secretary();

        $documents = Document::with([
            'business',
            'payment',
            'payment.assessment'
        ])
        ->where('status', 'Pending')
        ->latest()
        ->get();

        return view(
            'documents.pending',
            compact('documents')
        );
    }

    public function issue(Document $document)
    {
        $this->secretary();

        abort_unless(
            $document->status === 'Pending',
            422,
            'This document has already been processed.'
        );

        $document->status = 'Issued';

        $document->issued_by = auth()->id();

        $document->issued_date = now()->toDateString();

        $document->save();

        ActivityLogger::log(
            'Document Issued',

            "The {$document->document_type} "
            . "request {$document->document_no} was reviewed "
            . "and issued by the Secretary.",

            'Documents',

            $document->id
        );

        return redirect()
            ->route('documents.pdf', $document)
            ->with(
                'success',
                'Document issued successfully.'
            );
    }

    public function pdf(Document $document)
    {
        $document->load([
            'business',
            'issuer',
            'payment',
            'payment.assessment',
        ]);

        switch (trim($document->document_type)) {

            case 'Barangay Clearance':
                $view = 'documents.pdf.barangay-clearance';
                break;

            case 'Business Clearance':
                $view = 'documents.pdf.business-clearance';
                break;

            case 'Certificate of Residency':
                $view = 'documents.pdf.residency';
                break;
            
            case 'Residency': 
                $view = 'documents.pdf.residency';
                break;

            case 'Filing Fee Certificate':
                $view = 'documents.pdf.complaint';
                break;

            case 'Barangay Certification':
                $view = 'documents.pdf.certification';
                break;

            default:
                $view = 'documents.pdf';
                break;
        }

        $pdf = Pdf::loadView(
            $view,
            compact('document')
        )
        ->setPaper('a4', 'portrait');

        return $pdf->stream(
            $document->document_no . '.pdf'
        );
    }
}