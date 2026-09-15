@extends('layouts.app')

@section('title', 'Captain Dashboard')

@section('content')

<div class="captain-dashboard">

    {{-- =========================================================
         DASHBOARD HEADER
    ========================================================== --}}
    <div class="dashboard-header">

        <div class="header-content">

            <div class="header-icon">
                <i class="bi bi-person-badge-fill"></i>
            </div>

            <div>
                <span class="eyebrow">BARANGAY CAPTAIN</span>

                <h1>Captain Dashboard</h1>

                <p>Read-only monitoring and reports</p>
            </div>

        </div>

        <div class="location-badge">
            <i class="bi bi-geo-alt-fill"></i>
            San Bartolome, Santa Magdalena, Sorsogon
        </div>

    </div>


    {{-- =========================================================
         MAP + CURRENT OVERVIEW
    ========================================================== --}}
    <div class="map-overview-grid">

        {{-- =====================================================
             BUSINESS MAP
        ====================================================== --}}
        <div class="dashboard-map-card">

            <div class="map-card-header">

                <div class="map-title">

                    <div>
                        <span class="section-eyebrow">
                            BUSINESS LOCATIONS
                        </span>

                        <p>
                            Geographic distribution of registered businesses in San Bartolome.
                        </p>
                    </div>

                </div>

                <div class="map-location-count">
                    <i class="bi bi-geo-alt-fill"></i>
                    {{ $businessCount ?? $businesses ?? 0 }} Locations
                </div>

            </div>

            <div class="dashboard-map-body">

                {{--
                    IMPORTANT:
                    Pass the actual business COLLECTION to the map.
                    Do not pass the total count integer here.
                --}}
                @include('dashboard.business-map', [
                    'businesses' => $mapBusinesses ?? collect()
                ])

            </div>

        </div>


        {{-- =====================================================
             CURRENT OVERVIEW
        ====================================================== --}}
        <div class="current-overview-card">

            <div class="overview-header">
                <span class="overview-eyebrow">
                    CURRENT OVERVIEW
                </span>
            </div>


            {{-- TOTAL BUSINESSES --}}
            <div class="overview-item">

                <div class="overview-icon businesses">
                    <i class="bi bi-buildings"></i>
                </div>

                <div class="overview-content">

                    <strong>
                        {{ $businessCount ?? $businesses ?? 0 }}
                    </strong>

                    <span>
                        Total Businesses
                    </span>

                </div>

            </div>


            {{-- PENDING --}}
            <div class="overview-item">

                <div class="overview-icon pending">
                    <i class="bi bi-hourglass-split"></i>
                </div>

                <div class="overview-content">

                    <strong>
                        {{ $pending ?? 0 }}
                    </strong>

                    <span>
                        Pending
                    </span>

                </div>

            </div>


            {{-- UNPAID --}}
            <div class="overview-item">

                <div class="overview-icon unpaid">
                    <i class="bi bi-x-circle"></i>
                </div>

                <div class="overview-content">

                    <strong>
                        {{ $unpaid ?? 0 }}
                    </strong>

                    <span>
                        Unpaid
                    </span>

                </div>

            </div>


            {{-- FULLY PAID --}}
            <div class="overview-item">

                <div class="overview-icon paid">
                    <i class="bi bi-check-circle"></i>
                </div>

                <div class="overview-content">

                    <strong>
                        {{ $fullyPaid ?? 0 }}
                    </strong>

                    <span>
                        Fully Paid
                    </span>

                </div>

            </div>


            {{-- PARTIALLY PAID --}}
            <div class="overview-item">

                <div class="overview-icon partial">
                    <i class="bi bi-circle-half"></i>
                </div>

                <div class="overview-content">

                    <strong>
                        {{ $partiallyPaid ?? 0 }}
                    </strong>

                    <span>
                        Partially Paid
                    </span>

                </div>

            </div>


            {{-- TOTAL COLLECTIONS --}}
            <div class="overview-item overview-collection">

                <div class="overview-icon collection">
                    <i class="bi bi-cash-stack"></i>
                </div>

                <div class="overview-content">

                    <strong>
                        ₱{{ number_format($collections ?? 0, 2) }}
                    </strong>

                    <span>
                        Total Collections
                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         SUMMARY CARDS
    ========================================================== --}}
    <div class="summary-grid">

        <div class="summary-card">

            <div class="summary-icon">
                <i class="bi bi-buildings"></i>
            </div>

            <div class="summary-info">
                <span>Total Businesses</span>

                <strong>
                    {{ $businessCount ?? $businesses ?? 0 }}
                </strong>
            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon success">
                <i class="bi bi-check-circle"></i>
            </div>

            <div class="summary-info">
                <span>Active Businesses</span>

                <strong>
                    {{ $active ?? 0 }}
                </strong>
            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon warning">
                <i class="bi bi-hourglass-split"></i>
            </div>

            <div class="summary-info">
                <span>Pending Businesses</span>

                <strong>
                    {{ $pending ?? 0 }}
                </strong>
            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon collection">
                <i class="bi bi-cash-stack"></i>
            </div>

            <div class="summary-info">
                <span>Total Collections</span>

                <strong class="collection-value">
                    ₱{{ number_format($collections ?? 0, 2) }}
                </strong>
            </div>

        </div>

    </div>


    {{-- =========================================================
         DASHBOARD CHARTS
    ========================================================== --}}
    <div class="dashboard-charts-section">

        @include('dashboard.partials.dashboard-charts')

    </div>


    {{-- =========================================================
         QUICK ACCESS
    ========================================================== --}}
    <div class="dashboard-card actions-panel">

        <div class="section-header">

            <div>

                <span class="section-eyebrow">
                    QUICK ACCESS
                </span>

                <h2>
                    Monitoring Tools
                </h2>

            </div>

            <div class="section-icon">
                <i class="bi bi-grid"></i>
            </div>

        </div>


        <div class="quick-actions">

            <a href="{{ route('map.index') }}"
               class="action-card primary-action">

                <div class="action-icon">
                    <i class="bi bi-geo-alt"></i>
                </div>

                <div>
                    <strong>Business Hotspot Map</strong>

                    <span>
                        View registered business locations
                    </span>
                </div>

                <i class="bi bi-arrow-right action-arrow"></i>

            </a>


            <a href="{{ route('reports.index') }}"
               class="action-card secondary-action">

                <div class="action-icon">
                    <i class="bi bi-bar-chart"></i>
                </div>

                <div>
                    <strong>View Reports</strong>

                    <span>
                        Review business and financial reports
                    </span>
                </div>

                <i class="bi bi-arrow-right action-arrow"></i>

            </a>

        </div>

    </div>

</div>


<style>

/* =========================================================
   CAPTAIN DASHBOARD
========================================================= */

.captain-dashboard {
    width: 100%;
    max-width: 1600px;
    margin: 0 auto;
    padding: 0 0 35px;
    color: #172b4d;
}


/* =========================================================
   HEADER
========================================================= */

.dashboard-header {
    background: #102a56;
    border-radius: 18px;
    padding: 27px 30px;
    margin-bottom: 22px;

    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;

    color: #fff;
    box-shadow: 0 8px 25px rgba(16, 42, 86, .12);
}

.header-content {
    display: flex;
    align-items: center;
    gap: 17px;
}

.header-icon {
    width: 58px;
    height: 58px;
    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 14px;
    background: rgba(255, 255, 255, .12);
    border: 1px solid rgba(255, 255, 255, .17);

    font-size: 26px;
}

.dashboard-header .eyebrow {
    display: block;
    margin-bottom: 4px;

    color: rgba(255, 255, 255, .68);
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1.5px;
}

.dashboard-header h1 {
    margin: 0;
    font-size: 27px;
    font-weight: 700;
}

.dashboard-header p {
    margin: 5px 0 0;
    color: rgba(255, 255, 255, .73);
    font-size: 13px;
}

.location-badge {
    display: flex;
    align-items: center;
    gap: 7px;

    padding: 9px 14px;

    border-radius: 30px;

    background: rgba(255, 255, 255, .09);
    border: 1px solid rgba(255, 255, 255, .16);

    font-size: 11px;
    font-weight: 600;

    white-space: nowrap;
}


/* =========================================================
   MAP + OVERVIEW LAYOUT
========================================================= */

.map-overview-grid {
    display: grid;
    grid-template-columns: minmax(0, 2.15fr) minmax(300px, 1fr);
    gap: 0;

    margin-bottom: 22px;

    background: #fff;
    border: 1px solid #dbe4ec;
    border-radius: 16px;

    overflow: hidden;

    box-shadow: 0 5px 20px rgba(16, 42, 86, .055);
}


/* =========================================================
   MAP
========================================================= */

.dashboard-map-card {
    min-width: 0;
    background: #fff;

    border-right: 1px solid #dbe4ec;
}

.map-card-header {
    min-height: 82px;

    padding: 16px 20px;

    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;

    border-bottom: 1px solid #e8edf2;
}

.map-title {
    min-width: 0;
}

.map-title .section-eyebrow {
    display: block;

    color: #1c405e;

    font-size: 11px;
    font-weight: 800;
    letter-spacing: .8px;
}

.map-title p {
    margin: 6px 0 0;

    color: #7b8797;

    font-size: 10px;
}

.map-location-count {
    flex-shrink: 0;

    display: flex;
    align-items: center;
    gap: 6px;

    padding: 8px 13px;

    border-radius: 22px;

    background: #edf7fc;
    color: #0f638b;

    font-size: 10px;
    font-weight: 700;
}

.map-location-count i {
    font-size: 11px;
}

.dashboard-map-body {
    width: 100%;
    height: 440px;
    min-height: 440px;

    position: relative;
    overflow: hidden;

    background: #eef2f6;
}

.dashboard-map-body > div,
.dashboard-map-body .container,
.dashboard-map-body .container-fluid {
    width: 100% !important;
    max-width: none !important;
    height: 100% !important;

    padding: 0 !important;
    margin: 0 !important;
}

.dashboard-map-body #map,
.dashboard-map-body .map,
.dashboard-map-body .business-map,
.dashboard-map-body .map-container,
.dashboard-map-body .business-map-container {
    width: 100% !important;
    height: 100% !important;
    min-height: 440px !important;
}


/* =========================================================
   CURRENT OVERVIEW
========================================================= */

.current-overview-card {
    min-width: 0;
    background: #fbfcfd;

    padding: 18px 20px;
}

.overview-header {
    margin-bottom: 17px;
}

.overview-eyebrow {
    display: block;

    color: #60738a;

    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.5px;
}

.overview-item {
    display: flex;
    align-items: center;

    gap: 12px;

    padding: 10px 0;
}

.overview-icon {
    width: 34px;
    height: 34px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    font-size: 15px;
}

.overview-icon.businesses {
    background: #eaf4fb;
    color: #19739c;
}

.overview-icon.pending {
    background: #fff5dc;
    color: #c88b10;
}

.overview-icon.unpaid {
    background: #fff0eb;
    color: #dc7255;
}

.overview-icon.paid {
    background: #e8f7f0;
    color: #249369;
}

.overview-icon.partial {
    background: #f3edff;
    color: #7656b5;
}

.overview-icon.collection {
    background: #e9f3ff;
    color: #176fb0;
}

.overview-content {
    min-width: 0;
}

.overview-content strong {
    display: block;

    color: #183d5a;

    font-size: 18px;
    font-weight: 800;

    line-height: 1.1;
}

.overview-content span {
    display: block;

    margin-top: 3px;

    color: #718096;

    font-size: 9px;
}

.overview-collection {
    margin-top: 4px;
    padding-top: 14px;

    border-top: 1px solid #e5ebf0;
}


/* =========================================================
   SUMMARY CARDS
========================================================= */

.summary-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);

    gap: 16px;
    margin-bottom: 22px;
}

.summary-card {
    min-width: 0;
    min-height: 104px;

    padding: 18px;

    display: flex;
    align-items: center;
    gap: 14px;

    background: #fff;

    border: 1px solid #e5eaf1;
    border-radius: 14px;

    box-shadow: 0 3px 13px rgba(16, 42, 86, .035);

    transition: .2s ease;
}

.summary-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 7px 20px rgba(16, 42, 86, .075);
}

.summary-icon {
    width: 46px;
    height: 46px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background: #eaf2ff;
    color: #1456a0;

    font-size: 20px;
}

.summary-icon.success {
    background: #e9f8ef;
    color: #20965a;
}

.summary-icon.warning {
    background: #fff6df;
    color: #d89614;
}

.summary-icon.collection {
    background: #f0ebff;
    color: #6952b8;
}

.summary-info {
    min-width: 0;
}

.summary-info span {
    display: block;

    margin-bottom: 5px;

    color: #7a8596;

    font-size: 11px;
}

.summary-info strong {
    display: block;

    color: #172b4d;

    font-size: 24px;
    line-height: 1;

    white-space: nowrap;
}

.collection-value {
    font-size: 19px !important;
}


/* =========================================================
   SHARED DASHBOARD CHARTS
========================================================= */

.dashboard-charts-section {
    width: 100%;
    min-width: 0;

    margin-bottom: 22px;
}

.dashboard-charts-section > * {
    width: 100%;
    max-width: 100%;
}


/* =========================================================
   COMMON CARD
========================================================= */

.dashboard-card {
    background: #fff;

    border: 1px solid #e1e7ef;
    border-radius: 15px;

    overflow: hidden;

    box-shadow: 0 4px 17px rgba(16, 42, 86, .04);
}

.section-header {
    min-height: 68px;

    padding: 15px 20px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    border-bottom: 1px solid #edf0f4;
}

.section-eyebrow {
    display: block;

    color: #738096;

    font-size: 9px;
    font-weight: 700;
    letter-spacing: 1.3px;
}

.section-header h2 {
    margin: 3px 0 0;

    color: #172b4d;

    font-size: 17px;
    font-weight: 700;
}

.section-icon {
    width: 37px;
    height: 37px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: #eef4fc;
    color: #1456a0;

    font-size: 16px;
}


/* =========================================================
   QUICK ACTIONS
========================================================= */

.actions-panel {
    margin-bottom: 0;
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(2, 1fr);

    gap: 13px;

    padding: 18px 20px;
}

.action-card {
    min-width: 0;

    display: flex;
    align-items: center;

    gap: 12px;

    padding: 14px;

    border: 1px solid #e5eaf1;
    border-radius: 11px;

    color: #172b4d;
    text-decoration: none;

    transition: .2s ease;

    background: #fff;
}

.action-card:hover {
    transform: translateY(-2px);

    border-color: #cdd8e8;

    box-shadow: 0 5px 15px rgba(16, 42, 86, .07);

    color: #172b4d;
}

.action-icon {
    width: 41px;
    height: 41px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: #eef4fc;
    color: #1456a0;

    font-size: 18px;
}

.secondary-action .action-icon {
    background: #f0f2f5;
    color: #5e6878;
}

.action-card strong {
    display: block;

    margin-bottom: 2px;

    font-size: 12px;
}

.action-card span {
    display: block;

    color: #7a8596;

    font-size: 10px;
}

.action-arrow {
    margin-left: auto;

    color: #9aa5b5;

    font-size: 13px;
}


/* =========================================================
   LARGE DESKTOP
========================================================= */

@media (min-width: 1400px) {

    .dashboard-map-body {
        height: 470px;
        min-height: 470px;
    }

    .dashboard-map-body #map,
    .dashboard-map-body .map,
    .dashboard-map-body .business-map,
    .dashboard-map-body .map-container,
    .dashboard-map-body .business-map-container {
        min-height: 470px !important;
    }

}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 1100px) {

    .map-overview-grid {
        grid-template-columns: 1fr;
    }

    .dashboard-map-card {
        border-right: 0;
        border-bottom: 1px solid #dbe4ec;
    }

    .current-overview-card {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 5px 25px;
    }

    .overview-header {
        grid-column: 1 / -1;
        margin-bottom: 8px;
    }

    .summary-grid {
        grid-template-columns: repeat(2, 1fr);
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 768px) {

    .captain-dashboard {
        padding-bottom: 25px;
    }

    .dashboard-header {
        padding: 22px;

        flex-direction: column;
        align-items: flex-start;

        border-radius: 15px;
    }

    .dashboard-header h1 {
        font-size: 23px;
    }

    .location-badge {
        width: 100%;

        white-space: normal;
    }

    .map-card-header {
        padding: 14px 16px;
    }

    .dashboard-map-body {
        height: 390px;
        min-height: 390px;
    }

    .dashboard-map-body #map,
    .dashboard-map-body .map,
    .dashboard-map-body .business-map,
    .dashboard-map-body .map-container,
    .dashboard-map-body .business-map-container {
        min-height: 390px !important;
    }

    .current-overview-card {
        grid-template-columns: repeat(2, 1fr);
        padding: 16px;
    }

    .summary-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .summary-card {
        padding: 15px;
        min-height: 92px;
    }

    .quick-actions {
        grid-template-columns: 1fr;
        padding: 16px;
    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 520px) {

    .dashboard-header {
        padding: 18px;
    }

    .header-content {
        gap: 12px;
    }

    .header-icon {
        width: 48px;
        height: 48px;

        font-size: 21px;
    }

    .dashboard-header h1 {
        font-size: 20px;
    }

    .dashboard-header p {
        font-size: 11px;
    }

    .map-overview-grid {
        border-radius: 13px;
    }

    .map-card-header {
        padding: 13px;
    }

    .map-title .section-eyebrow {
        font-size: 9px;
    }

    .map-title p {
        font-size: 9px;
    }

    .map-location-count {
        padding: 7px 10px;
        font-size: 9px;
    }

    .dashboard-map-body {
        height: 340px;
        min-height: 340px;
    }

    .dashboard-map-body #map,
    .dashboard-map-body .map,
    .dashboard-map-body .business-map,
    .dashboard-map-body .map-container,
    .dashboard-map-body .business-map-container {
        min-height: 340px !important;
    }

    .current-overview-card {
        grid-template-columns: 1fr;
    }

    .overview-item {
        padding: 9px 0;
    }

    .summary-grid {
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .summary-card {
        min-height: 82px;
        padding: 14px;
    }

    .section-header {
        padding: 14px 16px;
    }

    .section-header h2 {
        font-size: 15px;
    }

    .quick-actions {
        padding: 14px;
    }

}

</style>

@endsection