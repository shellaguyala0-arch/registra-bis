<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        return $this->showReport($request);
    }

    public function financial(Request $request)
    {
        return $this->showReport($request);
    }

    public function payments(Request $request)
    {
        return $this->showReport($request);
    }


    private function showReport(Request $request)
    {
        $reportType = $request->get('report_type', 'daily');

        $sort = $request->get('sort', 'date');
        $order = $request->get('order', 'desc');

        $allowedSorts = [
            'date',
            'business',
            'amount',
            'reference',
        ];

        $allowedOrders = [
            'asc',
            'desc',
        ];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'date';
        }

        if (!in_array($order, $allowedOrders)) {
            $order = 'desc';
        }


        $query = Payment::with([
            'business',
            'assessment',
            'receivedBy',
        ]);


        if ($reportType === 'daily') {

            $date = $request->get(
                'date',
                now()->format('Y-m-d')
            );

            if ($date) {
                $query->whereDate('payment_date', $date);
            }
        }


        elseif ($reportType === 'monthly') {

            $monthFrom = $request->get(
                'month_from',
                now()->subMonth()->format('Y-m')
            );

            $monthTo = $request->get(
                'month_to',
                now()->format('Y-m')
            );

            try {

                $fromDate = Carbon::createFromFormat(
                    'Y-m',
                    $monthFrom
                )->startOfMonth();

                $toDate = Carbon::createFromFormat(
                    'Y-m',
                    $monthTo
                )->endOfMonth();

            } catch (\Exception $e) {

                $fromDate = now()
                    ->subMonth()
                    ->startOfMonth();

                $toDate = now()
                    ->endOfMonth();

                $monthFrom = $fromDate->format('Y-m');
                $monthTo = $toDate->format('Y-m');
            }


            if ($fromDate->greaterThan($toDate)) {

                $oldFrom = $fromDate->copy();
                $oldTo = $toDate->copy();

                $fromDate = $oldTo->startOfMonth();
                $toDate = $oldFrom->endOfMonth();

                $monthFrom = $fromDate->format('Y-m');
                $monthTo = $toDate->format('Y-m');
            }


            $query->whereBetween(
                'payment_date',
                [
                    $fromDate,
                    $toDate,
                ]
            );
        }


        elseif ($reportType === 'annual') {

            $year = $request->get('year');

            if ($year) {
                $query->whereYear('payment_date', $year);
            }
        }


        elseif ($reportType === 'summary') {

            $year = $request->get('year');

            if ($year) {
                $query->whereYear('payment_date', $year);
            }
        }


        switch ($sort) {

            case 'business':

                $query->orderBy(
                    Business::select('business_name')
                        ->whereColumn(
                            'businesses.id',
                            'payments.business_id'
                        ),
                    $order
                );

                break;


            case 'amount':

                $query->orderBy(
                    'amount',
                    $order
                );

                break;


            case 'reference':

                $query->orderBy(
                    'reference_no',
                    $order
                );

                break;


            case 'date':
            default:

                $query->orderBy(
                    'payment_date',
                    $order
                );

                break;
        }

        $payments = $query->get();

        $totalTransactions = $payments->count();

        $totalCollection = $payments->sum(function ($payment) {
            return (float) $payment->amount;
        });


        $reportTitle = match ($reportType) {

            'daily' => 'Daily Collection Report',

            'monthly' => 'Monthly Collection Report',

            'annual' => 'Annual Collection Report',

            'summary' => 'Collection Summary Report',

            default => 'Payment Transaction Report',
        };


        $reportPeriod = null;

        if ($reportType === 'daily') {

            $reportPeriod = !empty($request->date)
                ? date('F d, Y', strtotime($request->date))
                : date('F d, Y');

        } elseif ($reportType === 'monthly') {


            $monthFrom = $request->get(
                'month_from',
                now()->subMonth()->format('Y-m')
            );

            $monthTo = $request->get(
                'month_to',
                now()->format('Y-m')
            );

            try {

                $fromDate = Carbon::createFromFormat(
                    'Y-m',
                    $monthFrom
                )->startOfMonth();

                $toDate = Carbon::createFromFormat(
                    'Y-m',
                    $monthTo
                )->startOfMonth();

            } catch (\Exception $e) {

                $fromDate = now()
                    ->subMonth()
                    ->startOfMonth();

                $toDate = now()
                    ->startOfMonth();
            }

            if ($fromDate->greaterThan($toDate)) {

                $temporary = $fromDate->copy();

                $fromDate = $toDate->copy();
                $toDate = $temporary->copy();
            }

            if ($fromDate->isSameMonth($toDate)) {

                $reportPeriod = $fromDate->format('F Y');

            } else {

                $reportPeriod =
                    $fromDate->format('F Y')
                    . ' – '
                    . $toDate->format('F Y');
            }

        } elseif ($reportType === 'annual') {

            $reportPeriod = $request->year
                ? 'Year ' . $request->year
                : 'All Years';

        } elseif ($reportType === 'summary') {

            $reportPeriod = $request->year
                ? 'Year ' . $request->year
                : 'All Years';
        }

        ActivityLogger::log(
            'Report Viewed',
            "The {$reportTitle} was viewed. Period: {$reportPeriod}. " .
            "Transactions displayed: {$totalTransactions}. " .
            "Total collection: ₱" .
            number_format($totalCollection, 2) . ".",
            'Reports'
        );


        return view(
            'reports.payments',
            compact(
                'payments',
                'reportType',
                'sort',
                'order',
                'reportTitle',
                'reportPeriod',
                'totalTransactions',
                'totalCollection'
            )
        );
    }

    public function paymentsPdf(Request $request)
    {
        $reportType = $request->get('report_type', 'daily');

        $sort = $request->get('sort', 'date');
        $order = $request->get('order', 'desc');

        $allowedSorts = [
            'date',
            'business',
            'amount',
            'reference',
        ];

        $allowedOrders = [
            'asc',
            'desc',
        ];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'date';
        }

        if (!in_array($order, $allowedOrders)) {
            $order = 'desc';
        }

        $query = Payment::with([
            'business',
            'assessment',
            'receivedBy',
        ]);

        if ($reportType === 'daily') {

            $date = $request->get(
                'date',
                now()->format('Y-m-d')
            );

            if ($date) {
                $query->whereDate('payment_date', $date);
            }

        } elseif ($reportType === 'monthly') {

            $monthFrom = $request->get(
                'month_from',
                now()->subMonth()->format('Y-m')
            );

            $monthTo = $request->get(
                'month_to',
                now()->format('Y-m')
            );

            try {

                $fromDate = Carbon::createFromFormat(
                    'Y-m',
                    $monthFrom
                )->startOfMonth();

                $toDate = Carbon::createFromFormat(
                    'Y-m',
                    $monthTo
                )->endOfMonth();

            } catch (\Exception $e) {

                $fromDate = now()
                    ->subMonth()
                    ->startOfMonth();

                $toDate = now()
                    ->endOfMonth();
            }


            if ($fromDate->greaterThan($toDate)) {

                $oldFrom = $fromDate->copy();
                $oldTo = $toDate->copy();

                $fromDate = $oldTo->startOfMonth();
                $toDate = $oldFrom->endOfMonth();
            }

            $query->whereBetween(
                'payment_date',
                [
                    $fromDate,
                    $toDate,
                ]
            );

        } elseif ($reportType === 'annual') {

            if ($request->year) {

                $query->whereYear(
                    'payment_date',
                    $request->year
                );
            }

        } elseif ($reportType === 'summary') {

            if ($request->year) {

                $query->whereYear(
                    'payment_date',
                    $request->year
                );
            }
        }
        switch ($sort) {

            case 'business':

                $query->orderBy(
                    Business::select('business_name')
                        ->whereColumn(
                            'businesses.id',
                            'payments.business_id'
                        ),
                    $order
                );

                break;


            case 'amount':

                $query->orderBy(
                    'amount',
                    $order
                );

                break;


            case 'reference':

                $query->orderBy(
                    'reference_no',
                    $order
                );

                break;


            case 'date':
            default:

                $query->orderBy(
                    'payment_date',
                    $order
                );

                break;
        }


        $payments = $query->get();

        $totalTransactions = $payments->count();

        $totalCollection = $payments->sum(function ($payment) {
            return (float) $payment->amount;
        });



        $reportTitle = match ($reportType) {

            'daily' => 'Daily Collection Report',
            'monthly' => 'Monthly Collection Report',
            'annual' => 'Annual Collection Report',
            'summary' => 'Collection Summary Report',
            default => 'Payment Transaction Report',
        };

        $reportPeriod = null;

        if ($reportType === 'daily') {

            $date = $request->get(
                'date',
                now()->format('Y-m-d')
            );

            $reportPeriod = date(
                'F d, Y',
                strtotime($date)
            );

        } elseif ($reportType === 'monthly') {

            $monthFrom = $request->get(
                'month_from',
                now()->subMonth()->format('Y-m')
            );

            $monthTo = $request->get(
                'month_to',
                now()->format('Y-m')
            );

            try {

                $fromDate = Carbon::createFromFormat(
                    'Y-m',
                    $monthFrom
                )->startOfMonth();

                $toDate = Carbon::createFromFormat(
                    'Y-m',
                    $monthTo
                )->startOfMonth();

            } catch (\Exception $e) {

                $fromDate = now()
                    ->subMonth()
                    ->startOfMonth();

                $toDate = now()
                    ->startOfMonth();
            }

            if ($fromDate->greaterThan($toDate)) {

                $temporary = $fromDate->copy();

                $fromDate = $toDate->copy();
                $toDate = $temporary->copy();
            }


            if ($fromDate->isSameMonth($toDate)) {

                $reportPeriod = $fromDate->format(
                    'F Y'
                );

            } else {

                $reportPeriod =
                    $fromDate->format('F Y')
                    . ' – '
                    . $toDate->format('F Y');
            }

        } elseif ($reportType === 'annual') {

            $reportPeriod = $request->year
                ? 'Year ' . $request->year
                : 'All Years';

        } else {

            $reportPeriod = $request->year
                ? 'Year ' . $request->year
                : 'All Years';
        }


        $logoPath = public_path(
            'images/barangay-logo.png'
        );

        $logo = null;

        if (file_exists($logoPath)) {

            $logo = 'data:image/png;base64,' .
                base64_encode(
                    file_get_contents($logoPath)
                );
        }

        ActivityLogger::log(
            'Report Exported',
            "The {$reportTitle} was exported as a PDF. " .
            "Period: {$reportPeriod}. " .
            "Transactions included: {$totalTransactions}. " .
            "Total collection: ₱" .
            number_format($totalCollection, 2) . ".",
            'Reports'
        );

        $pdf = Pdf::loadView(
            'reports.payment-pdf',
            compact(
                'payments',
                'reportTitle',
                'reportPeriod',
                'totalTransactions',
                'totalCollection',
                'logo',
                'sort',
                'order'
            )
        );

        $pdf->setPaper(
            'A4',
            'portrait'
        );

        return $pdf->stream(
            strtolower(
                str_replace(
                    ' ',
                    '-',
                    $reportTitle
                )
            ) . '.pdf'
        );
    }
}