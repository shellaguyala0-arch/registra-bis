<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class MapController
{
    public function index()
    {
        abort_unless(
            auth()->check() &&
            in_array(auth()->user()->role, [
                'treasurer',
                'secretary',
                'captain'
            ]),
            403
        );

        $businesses = Business::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('closure_status', 'Active')
            ->get();

        $monthlyCollections = Payment::select(
                DB::raw("strftime('%Y', payment_date) as year_number"),
                DB::raw("strftime('%m', payment_date) as month_number"),
                DB::raw("SUM(amount) as total")
            )
            ->whereNotNull('payment_date')
            ->groupBy(
                DB::raw("strftime('%Y', payment_date)"),
                DB::raw("strftime('%m', payment_date)")
            )
            ->orderBy(
                DB::raw("strftime('%Y', payment_date)")
            )
            ->orderBy(
                DB::raw("strftime('%m', payment_date)")
            )
            ->get();

        return view(
            'maps.index',
            compact(
                'businesses',
                'monthlyCollections'
            )
        );
    }

    public function publicMap()
    {

        $businesses = Business::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('closure_status', 'Active')
            ->get();

        $monthlyCollections = Payment::select(
                DB::raw("strftime('%Y', payment_date) as year_number"),
                DB::raw("strftime('%m', payment_date) as month_number"),
                DB::raw("SUM(amount) as total")
            )
            ->whereNotNull('payment_date')
            ->groupBy(
                DB::raw("strftime('%Y', payment_date)"),
                DB::raw("strftime('%m', payment_date)")
            )
            ->orderBy(
                DB::raw("strftime('%Y', payment_date)")
            )
            ->orderBy(
                DB::raw("strftime('%m', payment_date)")
            )
            ->get();

        return view(
            'maps.public',
            compact(
                'businesses',
                'monthlyCollections'
            )
        );
    }
}