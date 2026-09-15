@extends('layouts.app')

@section('title', 'Secretary Dashboard')

@section('content')

<div class="secretary-dashboard">

    <div class="dashboard-header">

        <div class="header-content">

            <div class="header-icon">
                <i class="bi bi-person-badge"></i>
            </div>

            <div>
                <span class="eyebrow">SECRETARY PORTAL</span>

                <h1>Secretary Dashboard</h1>

                <p>
                    Document issuance and business profile monitoring
                </p>
            </div>

        </div>

        <div class="location-badge">
            <i class="bi bi-geo-alt-fill"></i>
            San Bartolome, Santa Magdalena, Sorsogon
        </div>

    </div>
    <div class="dashboard-overview">

        <div class="map-dashboard-card">

            <div class="map-card-header">

                <div>
                    <span class="section-eyebrow">
                        BUSINESS LOCATION MONITORING
                    </span>

                    <h2>
                        Business Hotspot Map
                    </h2>
                </div>

                <div class="map-header-icon">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>

            </div>

            <div class="dashboard-map-container">

                @include('dashboard.business-map')

            </div>

        </div>

        <div class="statistics-card">

            <div class="statistics-header">

                <div>
                    <span class="section-eyebrow">
                        SYSTEM OVERVIEW
                    </span>

                    <h2>Statistics</h2>
                </div>

                <i class="bi bi-bar-chart-fill"></i>

            </div>


            <div class="stat-item">

                <div class="stat-icon blue">
                    <i class="bi bi-buildings"></i>
                </div>

                <div class="stat-content">
                    <strong>{{ $businessCount }}</strong>
                    <span>Total Businesses</span>
                </div>

            </div>


            <div class="stat-item">

                <div class="stat-icon yellow">
                    <i class="bi bi-hourglass-split"></i>
                </div>

                <div class="stat-content">
                    <strong>{{ $pendingBusinesses }}</strong>
                    <span>Pending Businesses</span>
                </div>

            </div>


            <div class="stat-item">

                <div class="stat-icon orange">
                    <i class="bi bi-file-earmark-text"></i>
                </div>

                <div class="stat-content">
                    <strong>{{ $pendingDocuments }}</strong>
                    <span>Pending Documents</span>
                </div>

            </div>


            <div class="stat-item">

                <div class="stat-icon green">
                    <i class="bi bi-file-earmark-check"></i>
                </div>

                <div class="stat-content">
                    <strong>{{ $issuedDocuments }}</strong>
                    <span>Issued Documents</span>
                </div>

            </div>

        </div>

    </div>

    <div class="summary-grid">

        <div class="summary-card">

            <div class="summary-icon">
                <i class="bi bi-buildings"></i>
            </div>

            <div class="summary-info">
                <span>Total Businesses</span>
                <strong>{{ $businessCount }}</strong>
            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon warning">
                <i class="bi bi-hourglass-split"></i>
            </div>

            <div class="summary-info">
                <span>Pending Businesses</span>
                <strong>{{ $pendingBusinesses }}</strong>
            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon orange">
                <i class="bi bi-file-earmark-text"></i>
            </div>

            <div class="summary-info">
                <span>Pending Documents</span>
                <strong>{{ $pendingDocuments }}</strong>
            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon success">
                <i class="bi bi-file-earmark-check"></i>
            </div>

            <div class="summary-info">
                <span>Issued Documents</span>
                <strong>{{ $issuedDocuments }}</strong>
            </div>

        </div>

    </div>

    <div class="dashboard-chart-section">
        <div class="dashboard-chart-grid">
            <div class="dashboard-chart-panel">
                <div class="dashboard-chart-header">
                    <div>
                        <span class="section-eyebrow">
                            BUSINESS ANALYTICS
                        </span>
                        <h2>Business Distribution by Category</h2>
                        <p>
                            Number of businesses by registered category.
                        </p>
                    </div>
                    <div class="dashboard-chart-icon">
                        <i class="bi bi-pie-chart-fill"></i>
                    </div>
                </div>
                <div class="dashboard-category-chart">
                    <canvas id="secretaryCategoryChart"></canvas>
                </div>
            </div>

            <div class="dashboard-chart-panel">

                <div class="dashboard-chart-header">

                    <div>
                        <span class="section-eyebrow">
                            PAYMENT ANALYTICS
                        </span>

                        <h2>Annual Payment Collection Trend</h2>

                        <p>
                            Monthly payment collections for
                            {{ $currentYear ?? now()->year }}.
                        </p>
                    </div>

                    <div class="dashboard-chart-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>

                </div>
                <div class="dashboard-payment-chart">
                    <canvas id="secretaryPaymentChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const businesses = @json($businesses ?? []);
        const monthlyCollections = @json($monthlyCollections ?? []);
        const currentYear = {{ $currentYear ?? now()->year }};


        /* =====================================================
           BUSINESS CATEGORY DOUGHNUT
        ===================================================== */

        const categoryCanvas =
            document.getElementById('secretaryCategoryChart');

        if (categoryCanvas) {

            const categoryCounts = {};

            businesses.forEach(function (business) {

                const category =
                    business.category || 'Uncategorized';

                categoryCounts[category] =
                    (categoryCounts[category] || 0) + 1;

            });

            const categoryLabels =
                Object.keys(categoryCounts);

            const categoryValues =
                categoryLabels.map(function (category) {
                    return categoryCounts[category];
                });

            const categoryColors = [
                '#075374',
                '#16829e',
                '#3ca6a3',
                '#66b447',
                '#a8c64e',
                '#f5c84c',
                '#f39a38',
                '#e76f51',
                '#d94f70',
                '#9b59b6',
                '#6c63a8',
                '#4f83cc',
                '#2f9eaa',
                '#5c8d89',
                '#7b8794'
            ];

            new Chart(categoryCanvas, {

                type: 'doughnut',

                data: {
                    labels: categoryLabels,

                    datasets: [{
                        data: categoryValues,

                        backgroundColor:
                            categoryLabels.map(function (_, index) {
                                return categoryColors[
                                    index % categoryColors.length
                                ];
                            }),

                        borderWidth: 2,
                        borderColor: '#ffffff',
                        hoverOffset: 5
                    }]
                },

                options: {

                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '64%',

                    plugins: {

                        legend: {
                            position: 'bottom',

                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                padding: 12,
                                color: '#587887',

                                font: {
                                    size: 11,
                                    weight: '600'
                                }
                            }
                        },

                        tooltip: {

                            callbacks: {

                                label: function (context) {

                                    const total =
                                        context.dataset.data.reduce(
                                            function (sum, value) {
                                                return sum + value;
                                            },
                                            0
                                        );

                                    const value =
                                        context.parsed;

                                    const percentage =
                                        total > 0
                                            ? (
                                                value / total * 100
                                            ).toFixed(1)
                                            : 0;

                                    return (
                                        ' ' +
                                        context.label +
                                        ': ' +
                                        value +
                                        ' (' +
                                        percentage +
                                        '%)'
                                    );
                                }
                            }
                        }
                    }
                }
            });
        }
        const paymentCanvas =
            document.getElementById('secretaryPaymentChart');

        if (paymentCanvas) {

            const monthNames = [
                'Jan', 'Feb', 'Mar', 'Apr',
                'May', 'Jun', 'Jul', 'Aug',
                'Sep', 'Oct', 'Nov', 'Dec'
            ];

            const yearlyCollections =
                Array(12).fill(0);

            monthlyCollections.forEach(function (item) {

                const monthNumber =
                    parseInt(item.month_number, 10);

                if (
                    monthNumber >= 1 &&
                    monthNumber <= 12
                ) {
                    yearlyCollections[monthNumber - 1] =
                        parseFloat(item.total || 0);
                }

            });

            const paymentLabels =
                monthNames.map(function (month) {
                    return month + ' ' + currentYear;
                });

            const paymentValues =
                yearlyCollections.map(function (value) {
                    return parseFloat(value || 0);
                });

            const ctx =
                paymentCanvas.getContext('2d');

            const gradient =
                ctx.createLinearGradient(
                    0,
                    0,
                    0,
                    330
                );

            gradient.addColorStop(
                0,
                'rgba(7, 83, 116, 0.28)'
            );

            gradient.addColorStop(
                1,
                'rgba(7, 83, 116, 0.02)'
            );

            new Chart(paymentCanvas, {

                type: 'line',

                data: {

                    labels: paymentLabels,

                    datasets: [{

                        label: 'Payment Collection',

                        data: paymentValues,

                        borderColor: '#075374',

                        backgroundColor: gradient,

                        borderWidth: 3,

                        fill: true,

                        tension: 0.42,

                        cubicInterpolationMode: 'monotone',

                        pointRadius: 4,

                        pointHoverRadius: 6,

                        pointBackgroundColor: '#ffffff',

                        pointBorderColor: '#075374',

                        pointBorderWidth: 2
                    }]
                },

                options: {

                    responsive: true,
                    maintainAspectRatio: false,

                    interaction: {
                        mode: 'index',
                        intersect: false
                    },

                    scales: {

                        x: {

                            grid: {
                                display: false
                            },

                            ticks: {

                                color: '#829ba5',

                                font: {
                                    size: 10
                                },

                                maxRotation: 0,

                                autoSkip: true,

                                maxTicksLimit: 6
                            }
                        },

                        y: {

                            beginAtZero: true,

                            grid: {
                                color:
                                    'rgba(100, 140, 150, 0.10)'
                            },

                            ticks: {

                                color: '#829ba5',

                                font: {
                                    size: 10
                                },

                                callback: function (value) {

                                    return '₱' +
                                        Number(value)
                                            .toLocaleString('en-PH');

                                }
                            }
                        }
                    },

                    plugins: {

                        legend: {
                            display: false
                        },

                        tooltip: {

                            backgroundColor: '#173f50',

                            padding: 11,

                            titleFont: {
                                size: 10,
                                weight: '700'
                            },

                            bodyFont: {
                                size: 11
                            },

                            callbacks: {

                                label: function (context) {

                                    return (
                                        ' Collection: ₱' +
                                        Number(
                                            context.parsed.y
                                        ).toLocaleString(
                                            'en-PH',
                                            {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }
                                        )
                                    );

                                }
                            }
                        }
                    }
                }
            });
        }

    });
    </script>

    <div class="dashboard-card">

        <div class="section-header">

            <div>
                <span class="section-eyebrow">
                    SYSTEM ACTIONS
                </span>

                <h2>Quick Actions</h2>
            </div>

            <div class="section-icon">
                <i class="bi bi-lightning-charge-fill"></i>
            </div>

        </div>


        <div class="quick-actions">

            <a href="{{ route('documents.index') }}"
               class="action-card primary-action">

                <div class="action-icon">
                    <i class="bi bi-file-earmark-text"></i>
                </div>

                <div>
                    <strong>Issue Document</strong>
                    <span>Manage and issue documents</span>
                </div>

                <i class="bi bi-arrow-right action-arrow"></i>

            </a>


            <a href="{{ route('documents.pending') }}"
               class="action-card warning-action">

                <div class="action-icon">
                    <i class="bi bi-hourglass-split"></i>
                </div>

                <div>
                    <strong>Pending Documents</strong>
                    <span>Review pending requests</span>
                </div>

                <i class="bi bi-arrow-right action-arrow"></i>

            </a>


            <a href="{{ route('businesses.index') }}"
               class="action-card secondary-action">

                <div class="action-icon">
                    <i class="bi bi-building"></i>
                </div>

                <div>
                    <strong>Business Profiles</strong>
                    <span>View registered businesses</span>
                </div>

                <i class="bi bi-arrow-right action-arrow"></i>

            </a>


            <a href="{{ route('map.index') }}"
               class="action-card success-action">

                <div class="action-icon">
                    <i class="bi bi-geo-alt"></i>
                </div>

                <div>
                    <strong>Hotspot Map</strong>
                    <span>View business locations</span>
                </div>

                <i class="bi bi-arrow-right action-arrow"></i>

            </a>

        </div>

    </div>

    <div class="dashboard-card recent-card">

        <div class="section-header">

            <div>
                <span class="section-eyebrow">
                    BUSINESS MONITORING
                </span>

                <h2>Recent Business Profiles</h2>
            </div>

            <div class="section-icon">
                <i class="bi bi-buildings"></i>
            </div>

        </div>


        <div class="table-location-bar">

            <div class="location-label">

                <i class="bi bi-geo-alt-fill"></i>

                <span>
                    Registered Businesses
                </span>

            </div>

            <span class="table-count">
                Recent Records
            </span>

        </div>


        <div class="table-wrapper">

            <table class="business-table">

                <thead>

                    <tr>
                        <th>Business</th>
                        <th>Owner</th>
                        <th>Category</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($recent as $business)

                        <tr>

                            <td>

                                <div class="business-name">

                                    <div class="business-mini-icon">
                                        <i class="bi bi-building"></i>
                                    </div>

                                    <span>
                                        {{ $business->business_name }}
                                    </span>

                                </div>

                            </td>


                            <td>
                                {{ $business->owner_name }}
                            </td>


                            <td>

                                <span class="category-badge">
                                    {{ $business->category }}
                                </span>

                            </td>


                            <td>

                                @if($business->registration_status === 'Active')

                                    <span class="status-badge active">
                                        <i class="bi bi-check-circle-fill"></i>
                                        Active
                                    </span>

                                @elseif($business->registration_status === 'Pending')

                                    <span class="status-badge pending">
                                        <i class="bi bi-clock-fill"></i>
                                        Pending
                                    </span>

                                @else

                                    <span class="status-badge inactive">
                                        <i class="bi bi-x-circle-fill"></i>
                                        {{ $business->registration_status }}
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        <i class="bi bi-building"></i>
                                    </div>

                                    <strong>
                                        No business profiles found
                                    </strong>

                                    <span>
                                        There are currently no registered business profiles to display.
                                    </span>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="card-footer-custom">

            <span>
                <i class="bi bi-info-circle"></i>
                Showing recently registered business profiles
            </span>

            <a href="{{ route('businesses.index') }}">
                View All Businesses
                <i class="bi bi-arrow-right"></i>
            </a>

        </div>

    </div>

</div>


<style>

.secretary-dashboard {
    width: 100%;
    max-width: 1600px;
    margin: 0 auto;
    padding: 8px 0 35px;
    color: #172b4d;
}
.dashboard-header {
    min-height: 105px;
    background: #102a56;
    border-radius: 14px;
    padding: 24px 28px;
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    color: #fff;
    box-shadow:
        0 5px 18px rgba(16,42,86,.10);
}

.header-content {
    display: flex;
    align-items: center;
    gap: 15px;
}
.header-icon {
    width: 52px;
    height: 52px;
    flex-shrink: 0;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.17);
    font-size: 24px;
}
.eyebrow {
    display: block;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 1.4px;
    opacity: .72;
    margin-bottom: 3px;
}
.dashboard-header h1 {
    margin: 0;
    font-size: 25px;
    font-weight: 700;
}
.dashboard-header p {
    margin: 4px 0 0;
    color: rgba(255,255,255,.70);
    font-size: 14px;
}
.location-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 13px;
    background: rgba(255,255,255,.09);
    border: 1px solid rgba(255,255,255,.16);
    border-radius: 25px;
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
}
.location-badge i {
    font-size: 14px;
}
.dashboard-overview {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 270px;
    gap: 18px;
    margin-bottom: 18px;
}
.map-dashboard-card {
    min-width: 0;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    overflow: hidden;
    box-shadow:
        0 4px 16px rgba(16,42,86,.045);
}
.map-card-header {
    min-height: 65px;
    padding: 14px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #edf0f4;
}
.section-eyebrow {
    color: #7b8799;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 1.2px;
}
.map-card-header h2,
.statistics-header h2 {
    margin: 3px 0 0;
    color: #172b4d;
    font-size: 16px;
    font-weight: 700;
}
.map-header-icon {
    width: 36px;
    height: 36px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: #eef4fc;
    color: #1456a0;

    font-size: 16px;
}

.dashboard-map-container {
    width: 100%;

    min-height: 330px;

    position: relative;

    overflow: hidden;

    background: #f3f6f9;
}


.dashboard-map-container > div {
    width: 100%;
    max-width: 100%;
}

.dashboard-map-container #map,
.dashboard-map-container .map,
.dashboard-map-container .business-map {
    width: 100% !important;
    max-width: 100%;
}

.statistics-card {
    background: #fff;

    border: 1px solid #e2e8f0;

    border-radius: 14px;

    overflow: hidden;

    box-shadow:
        0 4px 16px rgba(16,42,86,.045);
}

.statistics-header {
    min-height: 65px;

    padding: 14px 17px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    border-bottom: 1px solid #edf0f4;
}

.statistics-header > i {
    color: #9aa7b8;

    font-size: 17px;
}

.stat-item {
    min-height: 66px;

    padding: 10px 17px;

    display: flex;
    align-items: center;

    gap: 11px;

    border-bottom: 1px solid #f0f2f5;
}

.stat-item:last-child {
    border-bottom: none;
}

.stat-icon {
    width: 35px;
    height: 35px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 8px;

    font-size: 15px;
}

.stat-icon.blue {
    background: #eaf2ff;
    color: #1764b0;
}

.stat-icon.yellow {
    background: #fff6df;
    color: #d89614;
}

.stat-icon.orange {
    background: #fff0e5;
    color: #e67e22;
}
.stat-icon.green {
    background: #e9f8ef;
    color: #20965a;
}
.stat-content strong {
    display: block;
    color: #172b4d;
    font-size: 19px;
    line-height: 1;
    font-weight: 700;
}
.stat-content span {
    display: block;
    margin-top: 3px;
    color: #7b8798;
    font-size: 14px;
}
.summary-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 18px;
}
.summary-card {
    min-width: 0;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    box-shadow:
        0 3px 12px rgba(16,42,86,.035);
    transition: .2s ease;
}
.summary-card:hover {
    transform: translateY(-2px);
    box-shadow:
        0 7px 18px rgba(16,42,86,.07);
}
.summary-icon {
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eaf2ff;
    color: #1456a0;
    font-size: 18px;
}
.summary-icon.warning {
    background: #fff6df;
    color: #d89614;
}
.summary-icon.orange {
    background: #fff0e5;
    color: #e67e22;
}
.summary-icon.success {
    background: #e9f8ef;
    color: #20965a;
}
.summary-info {
    min-width: 0;
}
.summary-info span {
    display: block;
    color: #748095;
    font-size: 14px;
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.summary-info strong {
    display: block;
    color: #172b4d;
    font-size: 22px;
    line-height: 1;
}
.dashboard-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    margin-bottom: 18px;
    overflow: hidden;
    box-shadow:
        0 4px 16px rgba(16,42,86,.04);
}
.section-header {
    min-height: 65px;
    padding: 14px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #edf0f4;
}
.section-header h2 {
    margin: 3px 0 0;
    font-size: 16px;
    font-weight: 700;
    color: #172b4d;
}
.section-icon {
    width: 35px;
    height: 35px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eef4fc;
    color: #1456a0;
    font-size: 15px;
}
.quick-actions {
    padding: 17px 20px;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 11px;
}
.action-card {
    min-width: 0;
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 13px;
    border-radius: 10px;
    border: 1px solid #e5eaf1;
    text-decoration: none;
    color: #172b4d;
    transition: .2s ease;
    background: #fff;
}
.action-card:hover {
    transform: translateY(-2px);
    border-color: #cbd7e7;
    box-shadow:
        0 5px 14px rgba(16,42,86,.06);
}
.action-icon {
    width: 37px;
    height: 37px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: #eef4fc;
    color: #1456a0;
    font-size: 16px;
}

.warning-action .action-icon {
    background: #fff6df;
    color: #d89614;
}

.secondary-action .action-icon {
    background: #f0f2f5;
    color: #5e6878;
}

.success-action .action-icon {
    background: #e9f8ef;
    color: #20965a;
}

.action-card strong {
    display: block;

    font-size: 14px;

    margin-bottom: 2px;
}

.action-card span {
    display: block;

    font-size: 10px;

    color: #7a8596;
}

.action-arrow {
    margin-left: auto;

    flex-shrink: 0;

    color: #a1abba;

    font-size: 14px;
}


.table-location-bar {
    min-height: 47px;

    padding: 10px 20px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    background: #f8fafc;

    border-bottom: 1px solid #edf0f4;
}

.location-label {
    display: flex;
    align-items: center;

    gap: 7px;

    color: #34445b;

    font-size: 11px;

    font-weight: 600;
}

.location-label i {
    color: #1456a0;
}

.table-count {
    font-size: 14px;

    color: #8994a5;
}

.table-wrapper {
    width: 100%;

    overflow-x: auto;

    -webkit-overflow-scrolling: touch;
}

.business-table {
    width: 100%;

    min-width: 650px;

    border-collapse: collapse;
}

.business-table thead th {
    padding: 11px 20px;

    background: #fbfcfe;

    color: #738096;

    font-size: 9px;

    font-weight: 700;

    letter-spacing: .6px;

    text-transform: uppercase;

    border-bottom: 1px solid #e9edf2;

    text-align: left;
}

.business-table tbody td {
    padding: 12px 20px;

    font-size: 14px;

    color: #46546a;

    border-bottom: 1px solid #edf0f4;

    vertical-align: middle;
}

.business-table tbody tr:last-child td {
    border-bottom: none;
}

.business-table tbody tr {
    transition: .15s ease;
}

.business-table tbody tr:hover {
    background: #fafcff;
}

.business-name {
    display: flex;
    align-items: center;

    gap: 9px;

    font-weight: 600;

    color: #263852;
}

.business-mini-icon {
    width: 29px;
    height: 29px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 7px;

    background: #eef4fc;

    color: #1456a0;

    font-size: 14px;
}

.category-badge {
    display: inline-block;

    padding: 4px 8px;

    background: #f1f4f8;

    border-radius: 5px;

    color: #59677b;

    font-size: 14px;
    font-weight: 600;
}
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 8px;
    border-radius: 18px;
    font-size: 14px;
    font-weight: 700;
}
.status-badge.active {
    background: #e9f8ef;
    color: #20965a;
}
.status-badge.pending {
    background: #fff6df;
    color: #c9870c;
}
.status-badge.inactive {
    background: #fcecec;
    color: #c74a4a;
}
.empty-state {
    min-height: 160px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #738096;
}

.empty-icon {
    width: 43px;
    height: 43px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 9px;
    border-radius: 10px;
    background: #f1f4f8;
    color: #8995a6;
    font-size: 18px;
}

.empty-state strong {
    color: #4c5b70;
    font-size: 14px;
}

.empty-state span {
    margin-top: 4px;

    font-size: 14px;
}

.card-footer-custom {
    padding: 11px 20px;

    display: flex;

    justify-content: space-between;
    align-items: center;

    background: #fafbfd;

    border-top: 1px solid #edf0f4;

    color: #8a95a5;

    font-size: 14px;
}

.card-footer-custom span {
    display: flex;
    align-items: center;

    gap: 5px;
}

.card-footer-custom a {
    display: flex;
    align-items: center;

    gap: 5px;

    color: #1456a0;

    text-decoration: none;

    font-weight: 600;
}

.card-footer-custom a:hover {
    color: #0d3f79;
}


@media (max-width: 1200px) {

    .dashboard-overview {
        grid-template-columns: minmax(0, 1fr) 230px;
    }

    .summary-grid {
        grid-template-columns: repeat(2, 1fr);
    }

}


@media (max-width: 900px) {

    .dashboard-overview {
        grid-template-columns: 1fr;
    }

    .statistics-card {
        display: grid;

        grid-template-columns: repeat(2, 1fr);
    }

    .statistics-header {
        grid-column: 1 / -1;
    }

    .stat-item {
        border-bottom: none;
    }

    .stat-item:nth-child(3),
    .stat-item:nth-child(5) {
        border-left: 1px solid #f0f2f5;
    }

}



@media (max-width: 768px) {

    .secretary-dashboard {
        padding-top: 3px;
    }

    .dashboard-header {
        padding: 20px;

        flex-direction: column;

        align-items: flex-start;

        border-radius: 12px;
    }

    .header-content {
        width: 100%;
    }

    .dashboard-header h1 {
        font-size: 22px;
    }

    .dashboard-header p {
        font-size: 11px;
    }

    .location-badge {
        width: 100%;

        white-space: normal;

        justify-content: flex-start;
    }

    .dashboard-overview {
        gap: 14px;
    }

    .map-dashboard-card {
        border-radius: 12px;
    }

    .dashboard-map-container {
        min-height: 280px;
    }

    .statistics-card {
        display: block;
    }

    .statistics-header {
        min-height: 60px;
    }

    .stat-item {
        min-height: 58px;

        border-bottom: 1px solid #f0f2f5 !important;

        border-left: none !important;
    }

    .stat-item:last-child {
        border-bottom: none !important;
    }

    .summary-grid {
        grid-template-columns: 1fr 1fr;

        gap: 10px;
    }

    .summary-card {
        padding: 13px;

        gap: 9px;
    }

    .summary-icon {
        width: 37px;
        height: 37px;

        font-size: 16px;
    }

    .summary-info span {
        font-size: 9px;
    }

    .summary-info strong {
        font-size: 19px;
    }

    .quick-actions {
        grid-template-columns: 1fr;

        padding: 15px;
    }

    .section-header {
        padding: 14px 16px;
    }

    .table-location-bar {
        padding: 10px 16px;
    }

    .business-table thead th,
    .business-table tbody td {
        padding-left: 16px;
        padding-right: 16px;
    }

    .card-footer-custom {
        padding: 11px 16px;

        flex-direction: column;

        align-items: flex-start;

        gap: 7px;
    }

}



@media (max-width: 480px) {

    .dashboard-header {
        padding: 17px;
    }

    .header-icon {
        width: 44px;
        height: 44px;

        font-size: 20px;
    }

    .dashboard-header h1 {
        font-size: 19px;
    }

    .dashboard-header p {
        font-size: 10px;
    }

    .summary-grid {
        grid-template-columns: 1fr;
    }

    .summary-card {
        min-height: 64px;
    }

    .dashboard-map-container {
        min-height: 250px;
    }

    .map-card-header h2,
    .statistics-header h2,
    .section-header h2 {
        font-size: 14px;
    }

    .section-eyebrow {
        font-size: 8px;
    }

}

.dashboard-chart-section {
    width: 100%;
    margin-top: 20px;
}

.dashboard-chart-grid {
    width: 100%;

    display: grid;

    grid-template-columns:
        minmax(0, 1fr)
        minmax(0, 1fr);

    gap: 18px;
}

.dashboard-chart-panel {
    width: 100%;
    min-width: 0;

    background: #ffffff;

    border: 1px solid #d9e8ed;

    border-radius: 18px;

    padding: 24px;

    box-shadow:
        0 8px 24px
        rgba(7, 83, 116, 0.06);
}

.dashboard-chart-header {
    display: flex;
    align-items: flex-start;
    justfy-content: space-between;

    gap: 15px;

    margin-bottom: 15px;
}

.dashboard-chart-header h2 {
    margin: 5px 0 0;

    color: #075374;

    font-size: 18px;

    font-weight: 800;

    line-height: 1.3;
}

.dashboard-chart-header p {
    margin: 7px 0 0;

    color: #72909c;

    font-size: 14px;

    line-height: 1.5;
}

.dashboard-chart-icon {
    width: 40px;
    height: 40px;

    flex: 0 0 40px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 11px;

    background: #e8f6fa;

    color: #075374;

    font-size: 18px;
}

.dashboard-category-chart,
.dashboard-payment-chart {
    position: relative;

    width: 100%;

    height: 315px;
}

@media (max-width: 1000px) {

    .dashboard-chart-grid {
        grid-template-columns: 1fr;
    }

}

@media (max-width: 576px) {

    .dashboard-chart-panel {
        padding: 18px;
        border-radius: 14px;
    }

    .dashboard-chart-header h2 {
        font-size: 16px;
    }

    .dashboard-chart-header p {
        font-size: 14px;
    }

    .dashboard-category-chart,
    .dashboard-payment-chart {
        height: 280px;
    }
}
</style>
@endsection