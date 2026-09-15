<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ClosureController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\BusinessCategoryController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ProfileController; 

Route::get('/geocode', function (\Illuminate\Http\Request $request) {
    $query = trim($request->query('q'));
    if ($query === '') {
        return response()->json([
            'success' => false,
            'message' => 'Search query is required.'
        ], 422);
    }
    $response = Http::withHeaders([
        'User-Agent' => 'REGISTRA Barangay Management System/1.0'
    ])->get(
        'https://nominatim.openstreetmap.org/search',
        [
            'q' => $query,
            'format' => 'json',
            'limit' => 1,
            'countrycodes' => 'ph',
            'addressdetails' => 1,
        ]
    );
    if (!$response->successful()) {
        return response()->json([
            'success' => false,
            'message' => 'Location search failed.'
        ], 500);
    }
    $results = $response->json();

    if (empty($results)) {
        return response()->json([
            'success' => false,
            'message' => 'Location not found.'
        ]);
    }
    $result = $results[0];

    return response()->json([
        'success' => true,
        'latitude' => (float) $result['lat'],
        'longitude' => (float) $result['lon'],
        'display_name' => $result['display_name'] ?? '',
        'type' => $result['type'] ?? null,
        'name' => $result['name'] ?? null,
    ]);

})->name('geocode');

Route::get('/', fn () => view('welcome'))
    ->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/hotspot-map', [MapController::class, 'publicMap'])
    ->name('map.public');

    Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

    Route::get(
    '/profile',
    [ProfileController::class, 'edit']
)->name('profile.edit');

Route::put(
    '/profile',
    [ProfileController::class, 'update']
)->name('profile.update');

Route::delete(
    '/profile/photo',
    [ProfileController::class, 'removePhoto']
)->name('profile.photo.remove');

Route::put(
    '/profile/password',
    [ProfileController::class, 'updatePassword']
)->name('profile.password.update');

    Route::get('/treasurer/dashboard', [DashboardController::class, 'treasurer'])
    ->name('treasurer.dashboard');


    /*
    |--------------------------------------------------------------------------
    | SECRETARY DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/secretary/dashboard',
        [DashboardController::class, 'secretary']
    )->name('secretary.dashboard');


    /*
    |--------------------------------------------------------------------------
    | CAPTAIN DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/captain/dashboard',
        [DashboardController::class, 'captain']
    )->name('captain.dashboard');


    /*
    |--------------------------------------------------------------------------
    | BUSINESS MANAGEMENT
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/businesses',
        [BusinessController::class, 'index']
    )->name('businesses.index');


    Route::get(
        '/businesses/create',
        [BusinessController::class, 'create']
    )->name('businesses.create');


    Route::post(
        '/businesses',
        [BusinessController::class, 'store']
    )->name('businesses.store');


    Route::get(
        '/businesses/{business}',
        [BusinessController::class, 'show']
    )->name('businesses.show');


    Route::get(
        '/businesses/{business}/edit',
        [BusinessController::class, 'edit']
    )->name('businesses.edit');


    Route::put(
        '/businesses/{business}',
        [BusinessController::class, 'update']
    )->name('businesses.update');


    /*
    |--------------------------------------------------------------------------
    | BUSINESS CATEGORIES
    |--------------------------------------------------------------------------
    */
Route::get('/settings/business-categories',
        [BusinessCategoryController::class, 'index']
    )->name('settings.business-categories.index');

    Route::post('/settings/business-categories',
        [BusinessCategoryController::class, 'store']
    )->name('settings.business-categories.store');

    Route::delete('/settings/business-categories/{category}',
        [BusinessCategoryController::class, 'destroy']
    )->name('settings.business-categories.destroy');

    /*
    |--------------------------------------------------------------------------
    | PAYMENTS / FEE ASSESSMENTS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/payments',
        [PaymentController::class, 'index']
    )->name('payments.index');


    Route::get(
        '/payments/create/{business?}',
        [PaymentController::class, 'create']
    )->name('payments.create');


    Route::post(
        '/payments',
        [PaymentController::class, 'store']
    )->name('payments.store');



    Route::get(
        '/payments/report',
        [ReportController::class, 'payments']
    )->name('payments.report');


    Route::get(
        '/payments/report/pdf',
        [ReportController::class, 'paymentsPdf']
    )->name('reports.payment.pdf');

    Route::get(
        '/documents',
        [DocumentController::class, 'index']
    )->name('documents.index');


    /*
     * Create/Issue Document manually
     */
    Route::get(
        '/documents/create',
        [DocumentController::class, 'create']
    )->name('documents.create');


    Route::post(
        '/documents',
        [DocumentController::class, 'store']
    )->name('documents.store');

    Route::get(
        '/documents/pending',
        [DocumentController::class, 'pending']
    )->name('documents.pending');

    Route::post(
        '/documents/{document}/issue',
        [DocumentController::class, 'issue']
    )->name('documents.issue');

    Route::get(
        '/documents/{document}/pdf',
        [DocumentController::class, 'pdf']
    )->name('documents.pdf');


    Route::get(
        '/closures',
        [ClosureController::class, 'index']
    )->name('closures.index');


    Route::post(
        '/closures',
        [ClosureController::class, 'store']
    )->name('closures.store');


    Route::patch(
        '/closures/{closure}',
        [ClosureController::class, 'update']
    )->name('closures.update');


    /*
    |--------------------------------------------------------------------------
    | REPORTS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/reports',
        [ReportController::class, 'index']
    )->name('reports.index');


    Route::get(
        '/reports/financial',
        [ReportController::class, 'financial']
    )->name('reports.financial');


    /*
    |--------------------------------------------------------------------------
    | ACTIVITY / HISTORY LOGS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/history-logs',
        [ActivityLogController::class, 'index']
    )->name('activity-logs.index');


    /*
    |--------------------------------------------------------------------------
    | HOTSPOT MAP
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/map',
        [MapController::class, 'index']
    )->name('map.index');

});

