@extends('layouts.app')

@section('title', 'Treasurer Dashboard')

@section('content')

<div class="treasurer-dashboard">
    <div class="dashboard-heading">
        <div>
            <span class="dashboard-eyebrow">
                BARANGAY TREASURER
            </span>
            <h1>
                Treasurer Dashboard
            </h1>
        </div>

        <div class="dashboard-date">
            <i class="bi bi-calendar3"></i>
            {{ now()->format('F d, Y') }}
        </div>
    </div>

    <div class="overview-card">
        <div class="overview-map">
            @include('dashboard.business-map')
        </div>
        <div class="overview-stats">
            <span class="overview-stats-label">
                Current Overview
            </span>
            <div class="stat-row">
                <div class="stat-icon stat-blue">
                    <i class="bi bi-building"></i>
                </div>
                <div class="stat-text">
                    <strong>
                        {{ number_format($businessCount) }}
                    </strong>
                    <span>
                        Total Businesses
                    </span>
                </div>
            </div>


            <div class="stat-row">
                <div class="stat-icon stat-amber">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div class="stat-text">
                    <strong>
                        {{ number_format($pendingBusinesses) }}
                    </strong>
                    <span>
                        Pending
                    </span>
                </div>
            </div>

            <div class="stat-row">
                <div class="stat-icon stat-red">
                    <i class="bi bi-x-circle"></i>
                </div>
                <div class="stat-text">
                    <strong>
                        {{ number_format($unpaid) }}
                    </strong>
                    <span>
                        Unpaid
                    </span>
                </div>
            </div>

            <div class="stat-row">
                <div class="stat-icon stat-green">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-text">
                    <strong>
                        {{ number_format($fullyPaid) }}
                    </strong>
                    <span>
                        Fully Paid
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="section-heading">
        <div>
            <h2>
                Quick Actions
            </h2>
            <p>
                Frequently used Treasurer functions.
            </p>
        </div>
    </div>

    <div class="quick-actions">
        <a href="{{ route('businesses.create') }}"
           class="quick-action">
            <div class="quick-action-icon">
                <i class="bi bi-building-add"></i>
            </div>
            <div>
                <strong>
                    Register Business
                </strong>
                <span>
                    Add a new business profile
                </span>
            </div>
            <i class="bi bi-arrow-right action-arrow"></i>
        </a>
        <a href="{{ route('businesses.index') }}"
           class="quick-action">
            <div class="quick-action-icon">
                <i class="bi bi-building"></i>
            </div>
            <div>
                <strong>
                    Business Profiling
                </strong>
                <span>
                    View and manage business records
                </span>
            </div>

            <i class="bi bi-arrow-right action-arrow"></i>
        </a>

        <a href="{{ route('payments.create') }}"
           class="quick-action">
            <div class="quick-action-icon">
                <i class="bi bi-credit-card"></i>
            </div>
            <div>

                <strong>
                    Record Payment
                </strong>

                <span>
                    Record a new business payment
                </span>

            </div>

            <i class="bi bi-arrow-right action-arrow"></i>

        </a>


        <a href="{{ route('reports.index') }}"
           class="quick-action">

            <div class="quick-action-icon">
                <i class="bi bi-bar-chart"></i>
            </div>

            <div>

                <strong>
                    Financial Reports
                </strong>

                <span>
                    View financial summaries
                </span>

            </div>

            <i class="bi bi-arrow-right action-arrow"></i>

        </a>

    </div>

<div class="dashboard-grid">

    <div class="dashboard-panel">

        <div class="panel-heading">

            <div>

                <h3>
                    Business Distribution by Category
                </h3>

                <p>
                    Number of active businesses by category.
                </p>

            </div>

        </div>

        <div class="chart-container-small">
            <canvas id="categoryChart"></canvas>
        </div>

    </div>

    <div class="dashboard-panel">

        <div class="panel-heading">

            <div>

                <h3>
                    Annual Payment Collection Trend
                </h3>

                <p>
                    Monthly payment collections for {{ $currentYear ?? now()->year }}.
                </p>

            </div>

        </div>

        <div class="chart-container">
            <canvas id="paymentChart"></canvas>
        </div>

    </div>

</div>

    <div class="dashboard-panel recent-panel" style="margin-bottom: 20px;">

        <div class="panel-heading">

            <div>

                <h3>
                    Recent Payments
                </h3>

                <p>
                    Latest recorded transactions.
                </p>

            </div>

            <a href="{{ route('payments.index') }}"
               class="view-all">

                View All

            </a>

        </div>


        @if($recentPayments->count())

            <div class="payment-table-wrapper">

                <table class="payment-table">

                    <thead>

                        <tr>

                            <th>
                                Business
                            </th>

                            <th>
                                Reference
                            </th>

                            <th>
                                Amount
                            </th>

                            <th>
                                Method
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($recentPayments as $payment)

                            <tr>

                                <td>

                                    <strong>
                                        {{ $payment->business->business_name ?? 'N/A' }}
                                    </strong>

                                    <small>
                                        {{ $payment->business->owner_name ?? '' }}
                                    </small>

                                </td>

                                <td>

                                    <span class="reference-number">
                                        {{ $payment->reference_no }}
                                    </span>

                                </td>

                                <td>

                                    <strong class="payment-amount">
                                        ₱{{ number_format($payment->amount, 2) }}
                                    </strong>

                                </td>

                                <td>

                                    <span class="method-badge">
                                        {{ $payment->payment_method }}
                                    </span>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty-state">

                <i class="bi bi-credit-card"></i>

                <strong>
                    No payments recorded yet
                </strong>

                <span>
                    Payment transactions will appear here.
                </span>

            </div>

        @endif

    </div>
    <div class="dashboard-grid bottom-grid">
        <div class="dashboard-panel">
            <div class="panel-heading">
                <div>
                    <h3>
                        Recent Business Registrations
                    </h3>
                    <p>
                        Recently added business profiles.
                    </p>

                </div>

                <a href="{{ route('businesses.index') }}"
                   class="view-all">

                    View All

                </a>

            </div>


            <div class="business-list">

                @forelse($recentBusinesses as $business)

                    <div class="business-item">

                        <div class="business-avatar">

                            {{ strtoupper(substr($business->business_name, 0, 1)) }}

                        </div>

                        <div class="business-info">

                            <strong>
                                {{ $business->business_name }}
                            </strong>

                            <span>
                                {{ $business->owner_name }}
                            </span>

                        </div>

                        <div class="business-status">

                            @if($business->payment_status === 'Fully Paid')

                                <span class="status-badge paid">
                                    Fully Paid
                                </span>

                            @elseif($business->payment_status === 'Partially Paid')

                                <span class="status-badge partial">
                                    Partially Paid
                                </span>

                            @else
                                <span class="status-badge unpaid">Unpaid </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="bi bi-building"></i>
                        <strong>No businesses yet</strong>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="dashboard-panel financial-summary">
            <div class="panel-heading">
                <div>
                    <h3>Financial Summary</h3>
                    <p>Current collection overview.</p>
                </div>
                <i class="bi bi-currency-dollar panel-heading-icon"></i>
            </div>

            <div class="financial-number">
                <span>Total Collections </span>
                <strong>₱{{ number_format($totalCollections, 2) }}</strong>
            </div>

            <div class="financial-row">
                <span>Total Payments</span>
                <strong>{{ $paymentCount }}</strong>
            </div>

            <div class="financial-row">
                <span> Fully Paid Businesses</span>
                <strong>{{ $fullyPaid }}</strong>
            </div>

            <div class="financial-row">
                <span>Partially Paid Businesses</span>
                <strong>{{ $partiallyPaid }}</strong>
            </div>


            <a href="{{ route('reports.financial') }}" class="financial-button">
                <i class="bi bi-bar-chart-line"></i>
                    View Financial Report
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

</div>


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const businesses = @json($businesses ?? []);
    const monthlyCollections = @json($monthlyCollections ?? []);
    const currentYear = {{ $currentYear ?? now()->year }};

    const categoryCanvas = document.getElementById('categoryChart');

    if (categoryCanvas) {

        const categoryCounts = {};

        businesses.forEach(function (business) {

            const category =
                business.category ||
                'Uncategorized';

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

                    backgroundColor: categoryLabels.map(
                        function (_, index) {
                            return categoryColors[
                                index % categoryColors.length
                            ];
                        }
                    ),

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
                            padding: 13,
                            color: '#587887',

                            font: {
                                size: 12,
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
                                            value /
                                            total *
                                            100
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
        document.getElementById('paymentChart');

    if (paymentCanvas) {

        const monthNames = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];

        const yearlyCollections =
            Array(12).fill(0);

        monthlyCollections.forEach(function (item) {

            const monthNumber =
                parseInt(
                    item.month_number,
                    10
                );

            if (
                monthNumber >= 1 &&
                monthNumber <= 12
            ) {

                yearlyCollections[
                    monthNumber - 1
                ] =
                    parseFloat(
                        item.total || 0
                    );
            }
        });

        const paymentLabels =
            monthNames.map(function (month) {

                return (
                    month +
                    ' ' +
                    currentYear
                );
            });

        const paymentValues =
            yearlyCollections.map(function (value) {

                return parseFloat(
                    value || 0
                );
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
                    label:
                        'Payment Collection',

                    data:
                        paymentValues,

                    borderColor:
                        '#075374',

                    backgroundColor:
                        gradient,

                    borderWidth: 3,

                    fill: true,

                    tension: 0.42,

                    cubicInterpolationMode:
                        'monotone',

                    pointRadius: 4,

                    pointHoverRadius: 6,

                    pointBackgroundColor:
                        '#ffffff',

                    pointBorderColor:
                        '#075374',

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
                                size: 9
                            },

                            maxRotation: 0,
                            autoSkip: false
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

                            callback:
                                function (value) {

                                    return '₱' +
                                        Number(value)
                                            .toLocaleString(
                                                'en-PH'
                                            );
                                }
                        }
                    }
                },

                plugins: {

                    legend: {
                        display: false
                    },

                    tooltip: {

                        backgroundColor:
                            '#173f50',

                        padding: 11,

                        titleFont: {
                            size: 10,
                            weight: '700'
                        },

                        bodyFont: {
                            size: 11
                        },

                        callbacks: {

                            label:
                                function (context) {

                                    return (
                                        ' Collection: ₱' +
                                        Number(
                                            context.parsed.y
                                        ).toLocaleString(
                                            'en-PH',
                                            {
                                                minimumFractionDigits:
                                                    2,

                                                maximumFractionDigits:
                                                    2
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
@endpush

@endsection


@push('styles')

<style>

.treasurer-dashboard {
    padding: 4px 0 40px;
    color: #073f5d;
}

.dashboard-heading {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
}

.dashboard-eyebrow {
    display: inline-block;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1.6px;
    color: #0b8f86;
    margin-bottom: 5px;
}

.dashboard-heading h1 {
    margin: 0;
    font-size: 32px;
    font-weight: 800;
    color: #064a6d;
}

.dashboard-heading p {
    margin: 7px 0 0;
    color: #4d7892;
    font-size: 15px;
}

.dashboard-date {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 11px 16px;
    border: 1px solid #bde8f6;
    border-radius: 12px;
    background: #ffffff;
    color: #176786;
    font-size: 13px;
    font-weight: 600;
}

.overview-card {
    display: grid;
    grid-template-columns: 1.7fr 0.9fr;
    gap: 0;
    background: #ffffff;
    border: 1px solid #dbeaf0;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 22px rgba(15, 71, 91, 0.08);
    margin-bottom: 32px;
}

.overview-map {
    min-height: 340px;
}

.overview-map .business-map {
    height: 100%;
    border-radius: 0;
    border: none;
}

.overview-stats {
    padding: 22px;
    border-left: 1px solid #edf3f5;
    background: #fbfdfe;
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.overview-stats-label {
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1px;
    color: #7591a1;
    text-transform: uppercase;
}

.stat-row {
    display: flex;
    align-items: center;
    gap: 13px;
}

.stat-icon {
    width: 40px;
    height: 40px;
    flex: 0 0 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
}

.stat-blue {
    background: #e5f5fd;
    color: #08709a;
}

.stat-amber {
    background: #fff4d2;
    color: #c58200;
}

.stat-red {
    background: #ffe2df;
    color: #c9483d;
}

.stat-green {
    background: #e5f8ed;
    color: #15915d;
}

.stat-text {
    display: flex;
    flex-direction: column;
}

.stat-text strong {
    font-size: 21px;
    font-weight: 800;
    color: #064a6d;
    line-height: 1.2;
}

.stat-text span {
    font-size: 11px;
    color: #7591a1;
    margin-top: 2px;
}

@media (max-width: 900px) {

    .overview-card {
        grid-template-columns: 1fr;
    }

    .overview-map {
        min-height: 280px;
    }

    .overview-stats {
        border-left: none;
        border-top: 1px solid #edf3f5;
        flex-direction: row;
        flex-wrap: wrap;
    }

    .overview-stats-label {
        width: 100%;
    }

    .stat-row {
        flex: 1 1 45%;
    }

}


.trend-legend-dot {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 11px;
    font-weight: 700;
    color: #4e7181;
}

.trend-legend-dot .dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #0b8f86;
    display: inline-block;
}

.trend-svg {
    width: 100%;
    height: 160px;
}


.donut-wrapper {
    display: flex;
    align-items: center;
    gap: 24px;
}

.donut-chart {
    width: 140px;
    height: 140px;
    flex: 0 0 140px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.donut-center {
    width: 96px;
    height: 96px;
    border-radius: 50%;
    background: #ffffff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    box-shadow: inset 0 0 0 1px #edf3f5;
}

.donut-center strong {
    font-size: 20px;
    font-weight: 800;
    color: #064a6d;
    line-height: 1.1;
}

.donut-center span {
    font-size: 9px;
    color: #8a9ba5;
    margin-top: 2px;
}

.donut-legend {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.donut-legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    color: #4e7181;
}

.donut-legend-item strong {
    margin-left: auto;
    color: #064a6d;
    font-size: 13px;
}

.donut-legend-item .dot {
    width: 9px;
    height: 9px;
    border-radius: 50%;
    display: inline-block;
    flex: 0 0 9px;
}

@media (max-width: 500px) {

    .donut-wrapper {
        flex-direction: column;
        align-items: flex-start;
    }

}



.section-heading {
    margin-bottom: 15px;
}

.section-heading h2 {
    margin: 0;
    color: #064a6d;
    font-size: 20px;
    font-weight: 800;
}

.section-heading p {
    margin: 4px 0 0;
    color: #7591a1;
    font-size: 13px;
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin-bottom: 32px;
}

.quick-action {
    display: flex;
    align-items: center;
    gap: 12px;
    min-height: 82px;
    padding: 15px;
    background: #ffffff;
    border: 1px solid #d9ebf2;
    border-radius: 15px;
    text-decoration: none;
    box-shadow: 0 5px 17px rgba(15, 71, 91, 0.06);
    transition: all .2s ease;
}

.quick-action:hover {
    transform: translateY(-2px);
    border-color: #72d4ec;
    box-shadow: 0 9px 23px rgba(15, 71, 91, 0.11);
}

.quick-action-icon {
    width: 43px;
    height: 43px;
    flex: 0 0 43px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    background: #e7f6fc;
    color: #07638b;
    font-size: 18px;
}

.quick-action strong {
    display: block;
    color: #074c6d;
    font-size: 13px;
}

.quick-action span {
    display: block;
    margin-top: 3px;
    color: #8095a0;
    font-size: 10px;
}

.action-arrow {
    margin-left: auto;
    color: #72a0b4;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.bottom-grid {
    grid-template-columns: 1.5fr 0.85fr;
}

.dashboard-panel {
    background: #ffffff;
    border: 1px solid #dbeaf0;
    border-radius: 20px;
    padding: 23px;
    box-shadow: 0 8px 22px rgba(15, 71, 91, 0.07);
    min-width: 0;
}

.panel-heading {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 20px;
}

.panel-heading h3 {
    margin: 0;
    color: #064a6d;
    font-size: 18px;
    font-weight: 800;
}

.panel-heading p {
    margin: 5px 0 0;
    color: #7b94a2;
    font-size: 11px;
}

.panel-heading-icon {
    color: #08759d;
    font-size: 22px;
}

.view-all {
    color: #08749b;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
}

.view-all:hover {
    text-decoration: underline;
}


.payment-table-wrapper {
    overflow-x: auto;
}

.payment-table {
    width: 100%;
    border-collapse: collapse;
}

.payment-table th {
    padding: 10px 8px;
    text-align: left;
    border-bottom: 1px solid #e4eef2;
    color: #73909f;
    font-size: 10px;
    font-weight: 800;
    text-transform: uppercase;
}

.payment-table td {
    padding: 13px 8px;
    border-bottom: 1px solid #edf3f5;
    vertical-align: middle;
    color: #315d72;
    font-size: 12px;
}

.payment-table td strong {
    display: block;
    color: #084b6b;
    font-size: 12px;
}

.payment-table td small {
    display: block;
    margin-top: 3px;
    color: #91a1aa;
    font-size: 9px;
}

.reference-number {
    font-size: 10px;
    color: #668697;
}

.payment-amount {
    color: #0b8b62 !important;
}

.method-badge {
    display: inline-block;
    padding: 5px 9px;
    border-radius: 20px;
    background: #edf7fa;
    color: #39768c;
    font-size: 9px;
    font-weight: 700;
}

.business-list {
    display: flex;
    flex-direction: column;
}

.business-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #edf3f5;
}

.business-item:last-child {
    border-bottom: 0;
}

.business-avatar {
    width: 40px;
    height: 40px;
    flex: 0 0 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: #e6f5fb;
    color: #08698e;
    font-weight: 800;
}

.business-info {
    min-width: 0;
    flex: 1;
}

.business-info strong {
    display: block;
    color: #084c6c;
    font-size: 12px;
}

.business-info span {
    display: block;
    margin-top: 3px;
    color: #8b9da6;
    font-size: 10px;
}

.status-badge {
    display: inline-block;
    padding: 6px 10px;
    border-radius: 20px;
    font-size: 9px;
    font-weight: 700;
}

.status-badge.paid {
    background: #d9f7e8;
    color: #138253;
}

.status-badge.partial {
    background: #fff0c7;
    color: #a76d00;
}

.status-badge.unpaid {
    background: #ffe2df;
    color: #b64b43;
}


.financial-number {
    padding: 16px;
    margin-bottom: 12px;
    border-radius: 14px;
    background: #fff8cc;
}

.financial-number span {
    display: block;
    color: #896d19;
    font-size: 10px;
    font-weight: 600;
}

.financial-number strong {
    display: block;
    margin-top: 4px;
    color: #8a5b00;
    font-size: 26px;
    font-weight: 800;
}

.financial-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 2px;
    border-bottom: 1px solid #edf3f5;
}

.financial-row span {
    color: #607e8d;
    font-size: 11px;
}

.financial-row strong {
    color: #064a6d;
    font-size: 13px;
}

.financial-button {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 18px;
    padding: 11px;
    border-radius: 11px;
    background: #075273;
    color: #ffffff;
    text-decoration: none;
    font-size: 11px;
    font-weight: 700;
}

.financial-button:hover {
    background: #063f59;
    color: #ffffff;
}

.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 150px;
    text-align: center;
    color: #8ca0aa;
}

.empty-state i {
    margin-bottom: 9px;
    font-size: 30px;
    color: #a7c9d6;
}

.empty-state strong {
    color: #527383;
    font-size: 13px;
}

.empty-state span {
    margin-top: 4px;
    font-size: 10px;
}

.chart-container {
    position: relative;
    width: 100%;
    height: 315px;
}

.chart-container-small {
    position: relative;
    width: 100%;
    height: 315px;
}

@media (max-width: 1200px) {

    .quick-actions {
        grid-template-columns: repeat(2, 1fr);
    }

}

@media (max-width: 900px) {

    .dashboard-grid,
    .bottom-grid {
        grid-template-columns: 1fr;
    }

    .dashboard-heading {
        flex-direction: column;
        gap: 15px;
    }

}

@media (max-width: 600px) {

    .quick-actions {
        grid-template-columns: 1fr;
    }

    .dashboard-heading h1 {
        font-size: 25px;
    }

    .dashboard-panel {
        padding: 17px;
    }

    .business-status {
        display: none;
    }

}

</style>

@endpush
