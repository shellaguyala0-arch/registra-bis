<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Payment;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();


        $currentYear = now()->year;

        $businesses = Business::get([
            'id',
            'business_name',
            'owner_name',
            'category',
            'address',
            'latitude',
            'longitude',
            'registration_status',
            'payment_status',
        ]);



        $mapBusinesses = Business::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->whereBetween('latitude', [12.67, 12.70])
            ->whereBetween('longitude', [124.11, 124.14])
            ->get([
                'id',
                'business_name',
                'owner_name',
                'address',
                'latitude',
                'longitude',
                'registration_status',
                'payment_status',
                'category',
            ]);


        $monthlyCollections = Payment::select(
                DB::raw(
                    "CAST(strftime('%m', payment_date) AS INTEGER) as month_number"
                ),
                DB::raw('SUM(amount) as total')
            )
            ->whereNotNull('payment_date')
            ->whereYear('payment_date', $currentYear)
            ->groupBy(
                DB::raw(
                    "strftime('%m', payment_date)"
                )
            )
            ->orderBy(
                DB::raw(
                    "strftime('%m', payment_date)"
                )
            )
            ->get();


        if ($user->role === 'treasurer') {

            $businessCount = Business::count();

            $pendingBusinesses = Business::where(
                'registration_status',
                'Pending'
            )->count();

            $fullyPaid = Business::where(
                'payment_status',
                'Fully Paid'
            )->count();

            $partiallyPaid = Business::where(
                'payment_status',
                'Partially Paid'
            )->count();

            $unpaid = Business::where(
                'payment_status',
                'Unpaid'
            )->count();

            $paymentCount = Payment::count();

            $totalCollections = Payment::sum('amount');

            $recentPayments = Payment::with('business')
                ->latest()
                ->take(6)
                ->get();

            $recentBusinesses = Business::latest()
                ->take(6)
                ->get();

            $businessTrend = Business::where(
                'registration_status',
                'Active'
            )
                ->whereNotNull('created_at')
                ->orderBy('created_at')
                ->get([
                    'id',
                    'created_at',
                ]);


            return view(
                'dashboard.treasurer',
                compact(
                    'businessCount',
                    'pendingBusinesses',
                    'totalCollections',
                    'fullyPaid',
                    'partiallyPaid',
                    'unpaid',
                    'paymentCount',
                    'recentPayments',
                    'recentBusinesses',
                    'businessTrend',
                    'businesses',
                    'monthlyCollections',
                    'currentYear',
                    'mapBusinesses'
                )
            );
        }



        if ($user->role === 'secretary') {

            $businessCount = Business::count();

            $pendingBusinesses = Business::where(
                'registration_status',
                'Pending'
            )->count();

            $pendingDocuments = Document::where(
                'status',
                'Pending'
            )->count();

            $issuedDocuments = Document::where(
                'status',
                'Issued'
            )->count();

            $recent = Business::latest()
                ->take(6)
                ->get();


            return view(
                'dashboard.secretary',
                compact(
                    'businessCount',
                    'pendingBusinesses',
                    'pendingDocuments',
                    'issuedDocuments',
                    'recent',
                    'businesses',
                    'monthlyCollections',
                    'currentYear',

                    'mapBusinesses'
                )
            );
        }

        if ($user->role === 'captain') {

            $businessCount = Business::count();

            $active = Business::where(
                'registration_status',
                'Active'
            )->count();

            $pending = Business::where(
                'registration_status',
                'Pending'
            )->count();

            $inactive = Business::where(
                'registration_status',
                'Inactive'
            )->count();

            $collections = Payment::sum('amount');

            $fullyPaid = Business::where(
                'payment_status',
                'Fully Paid'
            )->count();

            $partiallyPaid = Business::where(
                'payment_status',
                'Partially Paid'
            )->count();

            $unpaid = Business::where(
                'payment_status',
                'Unpaid'
            )->count();

            $categoryResults = Business::select(
                    'category',
                    DB::raw('COUNT(*) as total')
                )
                ->whereNotNull('category')
                ->where('category', '!=', '')
                ->groupBy('category')
                ->orderByDesc('total')
                ->get();

            $categoryLabels = $categoryResults
                ->pluck('category')
                ->values()
                ->toArray();

            $categoryData = $categoryResults
                ->pluck('total')
                ->values()
                ->toArray();


            return view(
                'dashboard.captain',
                compact(
                    'businessCount',
                    'active',
                    'pending',
                    'inactive',
                    'collections',
                    'fullyPaid',
                    'partiallyPaid',
                    'unpaid',
                    'categoryLabels',
                    'categoryData',
                    'businesses',
                    'monthlyCollections',
                    'currentYear',
                    'mapBusinesses'
                )
            );
        }
        abort(403, 'Unauthorized access.');
    }
}