@extends('layouts.app')

@php
    $reportType = request('report_type', 'daily');
@endphp

@section('title', 'Collection Reports')

@section('content')

<div class="report-page">

    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div class="report-header">

        <div class="report-header-left">

            <div class="report-icon">
                <i class="bi bi-bar-chart-line"></i>
            </div>

            <div>

                <span class="report-eyebrow">
                    TREASURER
                </span>

                <h1>
                    Collection Reports
                </h1>

                <p>
                    View, sort, filter, print, and export
                    barangay collection reports.
                </p>

            </div>

        </div>


        <a
            href="{{ route('reports.payment.pdf', request()->query()) }}"
            class="btn-export-pdf"
            target="_blank"
        >
            <i class="bi bi-file-earmark-pdf"></i>
            Print / Export PDF
        </a>

    </div>


    {{-- =====================================================
         REPORT TYPE
    ====================================================== --}}

    <div class="report-selector">

        <div class="report-selector-title">

            <i class="bi bi-file-earmark-bar-graph"></i>

            <div>

                <span>
                    REPORT TYPE
                </span>

                <strong>
                    Select Collection Report
                </strong>

            </div>

        </div>


        <div class="report-type-buttons">

            {{-- DAILY --}}

            <a
                href="{{ route('payments.report', [
                    'report_type' => 'daily'
                ]) }}"
                class="report-type-btn
                {{ $reportType === 'daily' ? 'active' : '' }}"
            >

                <i class="bi bi-calendar-day"></i>

                <span>

                    <strong>
                        Daily Collection
                    </strong>

                    <small>
                        Collections by day
                    </small>

                </span>

            </a>


            {{-- MONTHLY --}}

            <a
                href="{{ route('payments.report', [
                    'report_type' => 'monthly'
                ]) }}"
                class="report-type-btn
                {{ $reportType === 'monthly' ? 'active' : '' }}"
            >

                <i class="bi bi-calendar-month"></i>

                <span>

                    <strong>
                        Monthly Collection
                    </strong>

                    <small>
                        Collections by month
                    </small>

                </span>

            </a>


            {{-- ANNUAL --}}

            <a
                href="{{ route('payments.report', [
                    'report_type' => 'annual'
                ]) }}"
                class="report-type-btn
                {{ $reportType === 'annual' ? 'active' : '' }}"
            >

                <i class="bi bi-calendar3"></i>

                <span>

                    <strong>
                        Annual Report
                    </strong>

                    <small>
                        Collections by year
                    </small>

                </span>

            </a>


            {{-- SUMMARY --}}

            <a
                href="{{ route('payments.report', [
                    'report_type' => 'summary'
                ]) }}"
                class="report-type-btn
                {{ $reportType === 'summary' ? 'active' : '' }}"
            >

                <i class="bi bi-pie-chart"></i>

                <span>

                    <strong>
                        Summary Report
                    </strong>

                    <small>
                        Overall collections
                    </small>

                </span>

            </a>

        </div>

    </div>


    {{-- =====================================================
         FILTER
    ====================================================== --}}

    <div class="report-filter-card">

        <form
            method="GET"
            action="{{ route('payments.report') }}"
        >

            <input
                type="hidden"
                name="report_type"
                value="{{ $reportType }}"
            >


            <div class="filter-grid">


                {{-- =================================================
                     DAILY DATE
                ================================================== --}}

                @if($reportType === 'daily')

                    <div class="filter-field">

                        <label>
                            <i class="bi bi-calendar-event"></i>
                            Date
                        </label>

                        <input
                            type="date"
                            name="date"
                            value="{{ request('date', now()->format('Y-m-d')) }}"
                            class="report-input"
                        >

                    </div>

                @endif


                {{-- =================================================
                     MONTHLY RANGE
                     ONLY MONTHLY PART CHANGED
                ================================================== --}}

                @if($reportType === 'monthly')

                    {{-- FROM MONTH --}}

                    <div class="filter-field">

                        <label>
                            <i class="bi bi-calendar-month"></i>
                            From Month
                        </label>

                        <input
                            type="month"
                            name="month_from"
                            value="{{ request('month_from', now()->subMonth()->format('Y-m')) }}"
                            class="report-input"
                        >

                    </div>


                    {{-- TO MONTH --}}

                    <div class="filter-field">

                        <label>
                            <i class="bi bi-calendar-month"></i>
                            To Month
                        </label>

                        <input
                            type="month"
                            name="month_to"
                            value="{{ request('month_to', now()->format('Y-m')) }}"
                            class="report-input"
                        >

                    </div>

                @endif


                {{-- =================================================
                     YEAR
                     NOTE:
                     MONTHLY WAS REMOVED FROM THIS CONDITION.
                     
                     YEAR REMAINS FOR ANNUAL AND SUMMARY ONLY.
                ================================================== --}}

                @if(
                    $reportType === 'annual' ||
                    $reportType === 'summary'
                )

                    <div class="filter-field">

                        <label>
                            <i class="bi bi-calendar3"></i>
                            Year
                        </label>

                        <select
                            name="year"
                            class="report-input"
                        >

                            <option value="">
                                All Years
                            </option>

                            @for(
                                $year = now()->year;
                                $year >= now()->year - 10;
                                $year--
                            )

                                <option
                                    value="{{ $year }}"
                                    {{ request('year') == $year ? 'selected' : '' }}
                                >
                                    {{ $year }}
                                </option>

                            @endfor

                        </select>

                    </div>

                @endif


                {{-- =================================================
                     SORT BY
                ================================================== --}}

                <div class="filter-field">

                    <label>
                        <i class="bi bi-sort-down"></i>
                        Sort By
                    </label>

                    <select
                        name="sort"
                        class="report-input"
                    >

                        <option
                            value="date"
                            {{ request('sort', 'date') === 'date' ? 'selected' : '' }}
                        >
                            Payment Date
                        </option>

                        <option
                            value="business"
                            {{ request('sort') === 'business' ? 'selected' : '' }}
                        >
                            Business Name
                        </option>

                        <option
                            value="amount"
                            {{ request('sort') === 'amount' ? 'selected' : '' }}
                        >
                            Amount
                        </option>

                        <option
                            value="reference"
                            {{ request('sort') === 'reference' ? 'selected' : '' }}
                        >
                            Reference Number
                        </option>

                    </select>

                </div>


                {{-- =================================================
                     ORDER
                ================================================== --}}

                <div class="filter-field">

                    <label>
                        <i class="bi bi-arrow-down-up"></i>
                        Order
                    </label>

                    <select
                        name="order"
                        class="report-input"
                    >

                        <option
                            value="desc"
                            {{ request('order', 'desc') === 'desc' ? 'selected' : '' }}
                        >
                            Descending
                        </option>

                        <option
                            value="asc"
                            {{ request('order') === 'asc' ? 'selected' : '' }}
                        >
                            Ascending
                        </option>

                    </select>

                </div>


                {{-- =================================================
                     ACTIONS
                ================================================== --}}

                <div class="filter-actions">

                    <button
                        type="submit"
                        class="btn-filter"
                    >

                        <i class="bi bi-funnel"></i>
                        Apply

                    </button>


                    <a
                        href="{{ route('payments.report') }}"
                        class="btn-reset"
                    >

                        <i class="bi bi-arrow-counterclockwise"></i>
                        Reset

                    </a>

                </div>

            </div>


            {{-- =================================================
                 MONTHLY RANGE INFORMATION
            ================================================== --}}

            @if($reportType === 'monthly')

                <div class="monthly-range-note">

                    <i class="bi bi-info-circle"></i>

                    <span>
                        Select the starting month and ending month
                        to view collections across the selected period.
                    </span>

                </div>

            @endif

        </form>

    </div>


    {{-- =====================================================
         SUMMARY CARDS
    ====================================================== --}}

    <div class="report-summary-grid">

        <div class="summary-card">

            <div class="summary-icon">
                <i class="bi bi-receipt"></i>
            </div>

            <div>

                <span>
                    TRANSACTIONS
                </span>

                <strong>
                    {{ number_format($totalTransactions) }}
                </strong>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon">
                <i class="bi bi-cash-stack"></i>
            </div>

            <div>

                <span>
                    TOTAL COLLECTION
                </span>

                <strong>
                    ₱{{ number_format($totalCollection, 2) }}
                </strong>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon">
                <i class="bi bi-calendar-check"></i>
            </div>

            <div>

                <span>
                    REPORT PERIOD
                </span>

                <strong class="summary-period">
                    {{ $reportPeriod }}
                </strong>

            </div>

        </div>

    </div>


    {{-- =====================================================
         REPORT TABLE
    ====================================================== --}}

    <div class="report-card">

        <div class="report-card-header">

            <div class="report-card-title">

                <div class="report-section-icon">

                    <i class="bi bi-receipt-cutoff"></i>

                </div>


                <div>

                    <span>
                        {{ strtoupper($reportType) }} REPORT
                    </span>

                    <h2>
                        {{ $reportTitle }}
                    </h2>

                    <p>
                        {{ $reportPeriod }}
                    </p>

                </div>

            </div>


            <div class="report-header-action">

                <i class="bi bi-table"></i>

            </div>

        </div>


        <div class="report-table-wrapper">

            <table class="payment-report-table">

                <thead>

                    <tr>

                        <th>
                            REFERENCE
                        </th>

                        <th>
                            DATE
                        </th>

                        <th>
                            BUSINESS
                        </th>

                        <th>
                            TRANSACTION
                        </th>

                        <th>
                            AMOUNT
                        </th>

                        <th>
                            RECEIVED BY
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($payments as $payment)

                        <tr>

                            {{-- REFERENCE --}}

                            <td>

                                <span class="reference-badge">
                                    {{ $payment->reference_no }}
                                </span>

                            </td>


                            {{-- DATE --}}

                            <td>

                                @if($payment->payment_date)

                                    @php
                                        $paymentDate = $payment->payment_date instanceof \Carbon\Carbon
                                            ? $payment->payment_date
                                            : \Carbon\Carbon::parse($payment->payment_date);
                                    @endphp

                                    {{ $paymentDate->format('M d, Y') }}

                                @else

                                    N/A

                                @endif

                            </td>


                            {{-- BUSINESS --}}

                            <td>

                                <div class="business-cell">

                                    <span class="business-icon">
                                        <i class="bi bi-shop"></i>
                                    </span>

                                    <span>
                                        {{ $payment->business->business_name ?? 'N/A' }}
                                    </span>

                                </div>

                            </td>


                            {{-- TRANSACTION --}}

                            <td>

                                <span class="transaction-badge">

                                    {{ $payment->assessment->transaction_type ?? 'N/A' }}

                                </span>

                            </td>


                            {{-- AMOUNT --}}

                            <td class="amount-cell">

                                ₱{{ number_format($payment->amount, 2) }}

                            </td>


                            {{-- RECEIVED BY --}}

                            <td>

                                <div class="received-cell">

                                    <span class="received-icon">
                                        <i class="bi bi-person"></i>
                                    </span>

                                    <span>
                                        {{ $payment->receivedBy->name ?? 'Barangay Treasurer' }}
                                    </span>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="empty-report"
                            >

                                <i class="bi bi-receipt"></i>

                                <strong>
                                    No payment transactions found.
                                </strong>

                                <span>
                                    No collection records match
                                    the selected report.
                                </span>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>



        <div class="report-card-footer">

            <span>

                Showing
                {{ number_format($totalTransactions) }}
                transaction{{ $totalTransactions == 1 ? '' : 's' }}

            </span>


            <span>

                Generated
                {{ now()->format('M d, Y') }}

            </span>

        </div>

    </div>

</div>

@endsection


@push('styles')

<style>


.report-page {
    width: 100%;
    padding: 28px 28px 45px;
    background: #ffffff;
}
.report-header {
    background: linear-gradient(
        135deg,
        #075374,
        #004b69
    );

    border-radius: 18px;

    padding: 25px 30px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 20px;

    margin-bottom: 20px;

    color: #ffffff;

    box-shadow:
        0 8px 22px rgba(0, 70, 100, .12);
}


.report-header-left {
    display: flex;
    align-items: center;
    gap: 17px;
}


.report-icon {
    width: 56px;
    height: 56px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 29px;
    color: #ffffff;
}


.report-eyebrow {
    display: block;

    margin-bottom: 3px;

    font-size: 11px;
    font-weight: 700;

    letter-spacing: .8px;

    color: #bfe8f5;
}


.report-header h1 {
    margin: 0;

    font-size: 28px;
    font-weight: 700;
}


.report-header p {
    margin: 5px 0 0;

    font-size: 13px;

    color: #d9f1f8;
}
.btn-export-pdf {
    display: inline-flex;
    align-items: center;

    gap: 7px;

    min-height: 42px;

    padding: 0 16px;

    border-radius: 10px;

    background: #ffffff;

    color: #005676;

    text-decoration: none;

    font-size: 13px;
    font-weight: 600;

    white-space: nowrap;

    transition: .2s ease;
}


.btn-export-pdf:hover {
    background: #eff9fc;
    color: #003f59;

    transform: translateY(-1px);
}

.report-selector {
    background: #ffffff;

    border: 1px solid #cdeaf4;

    border-radius: 16px;

    padding: 18px;

    margin-bottom: 18px;

    box-shadow:
        0 6px 18px rgba(0,70,100,.05);
}


.report-selector-title {
    display: flex;
    align-items: center;

    gap: 11px;

    margin-bottom: 15px;
}


.report-selector-title > i {
    width: 35px;
    height: 35px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: #eff9fc;

    color: #00739a;
}


.report-selector-title span {
    display: block;

    font-size: 9px;
    font-weight: 700;

    letter-spacing: .7px;

    color: #00739a;
}


.report-selector-title strong {
    display: block;

    margin-top: 2px;

    color: #004d70;

    font-size: 14px;
}
.report-type-buttons {
    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 10px;
}


.report-type-btn {
    display: flex;
    align-items: center;

    gap: 10px;

    padding: 13px;

    border: 1px solid #d9edf4;

    border-radius: 11px;

    background: #fbfdfe;

    color: #527585;

    text-decoration: none;

    transition: .2s ease;
}


.report-type-btn > i {
    font-size: 19px;
    color: #00739a;
}


.report-type-btn strong,
.report-type-btn small {
    display: block;
}


.report-type-btn strong {
    color: #285b70;
    font-size: 11px;
}


.report-type-btn small {
    margin-top: 2px;

    color: #8aa2ad;

    font-size: 9px;
}


.report-type-btn:hover,
.report-type-btn.active {
    background: #eff9fc;

    border-color: #73c9df;

    transform: translateY(-1px);
}


.report-type-btn.active {
    box-shadow:
        inset 3px 0 #00739a;
}


.report-filter-card {
    background: #ffffff;

    border: 1px solid #cdeaf4;

    border-radius: 16px;

    padding: 17px;

    margin-bottom: 20px;

    box-shadow:
        0 6px 18px rgba(0,70,100,.05);
}


.filter-grid {
    display: grid;

    grid-template-columns:
        repeat(5, 1fr)
        auto;

    gap: 12px;

    align-items: end;
}


.filter-field label {
    display: block;

    margin-bottom: 6px;

    color: #527585;

    font-size: 9px;

    font-weight: 700;

    text-transform: uppercase;
}


.filter-field label i {
    margin-right: 3px;

    color: #00739a;
}


.report-input {
    width: 100%;

    height: 39px;

    padding: 0 10px;

    border: 1px solid #cfe5ec;

    border-radius: 9px;

    background: #ffffff;

    color: #315f72;

    font-size: 11px;

    outline: none;
}


.report-input:focus {
    border-color: #55b8d2;

    box-shadow:
        0 0 0 3px rgba(0,115,154,.08);
}


.monthly-range-note {
    display: flex;
    align-items: center;

    gap: 7px;

    margin-top: 12px;

    padding: 9px 11px;

    border-radius: 8px;

    background: #eff9fc;

    color: #527585;

    font-size: 10px;
}


.monthly-range-note i {
    color: #00739a;
}


.filter-actions {
    display: flex;

    gap: 7px;
}


.btn-filter,
.btn-reset {
    height: 39px;

    padding: 0 13px;

    border-radius: 9px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 6px;

    font-size: 10px;

    font-weight: 700;

    text-decoration: none;

    white-space: nowrap;
}


.btn-filter {
    border: none;

    background: #075374;

    color: #ffffff;
}


.btn-filter:hover {
    background: #004b69;
}


.btn-reset {
    border: 1px solid #cfe5ec;

    background: #ffffff;

    color: #587b89;
}


.btn-reset:hover {
    background: #f5fafc;
}

.report-summary-grid {
    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 14px;

    margin-bottom: 20px;
}


.summary-card {
    display: flex;
    align-items: center;

    gap: 12px;

    padding: 15px;

    background: #ffffff;

    border: 1px solid #cdeaf4;

    border-radius: 14px;

    box-shadow:
        0 5px 15px rgba(0,70,100,.04);
}


.summary-icon {
    width: 38px;
    height: 38px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #eff9fc;

    color: #00739a;

    font-size: 17px;
}


.summary-card span {
    display: block;

    color: #8aa2ad;

    font-size: 8px;

    font-weight: 700;

    letter-spacing: .5px;
}


.summary-card strong {
    display: block;

    margin-top: 2px;

    color: #075374;

    font-size: 17px;
}


.summary-period {
    font-size: 13px !important;
}

.report-card {
    background: #ffffff;

    border: 1px solid #cdeaf4;

    border-radius: 16px;

    overflow: hidden;

    box-shadow:
        0 6px 18px rgba(0, 70, 100, .07);
}


.report-card-header {
    padding: 18px 20px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    border-bottom: 1px solid #d8edf5;

    background: #ffffff;
}


.report-card-title {
    display: flex;
    align-items: center;

    gap: 11px;
}


.report-section-icon {
    width: 34px;
    height: 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: #eff9fc;

    color: #00739a;

    font-size: 16px;
}


.report-card-title > div:last-child > span {
    display: block;

    font-size: 9px;

    font-weight: 700;

    letter-spacing: .7px;

    color: #00739a;
}


.report-card-title h2 {
    margin: 2px 0 0;

    font-size: 16px;

    font-weight: 700;

    color: #004d70;
}


.report-card-title p {
    margin: 2px 0 0;

    font-size: 10px;

    color: #7898a7;
}


.report-header-action {
    width: 30px;
    height: 30px;

    border-radius: 8px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #eff9fc;

    color: #00739a;

    font-size: 14px;
}

.report-table-wrapper {
    width: 100%;

    overflow-x: auto;
}


.payment-report-table {
    width: 100%;

    border-collapse: collapse;

    table-layout: fixed;
}


.payment-report-table thead th {
    padding: 10px 13px;

    background: #f5fafc;

    border-bottom: 1px solid #d8edf5;

    color: #315f72;

    font-size: 9px;

    font-weight: 700;

    text-align: left;

    white-space: nowrap;
}


.payment-report-table tbody td {
    padding: 12px 13px;

    border-bottom: 1px solid #edf4f6;

    color: #335d6f;

    font-size: 11px;

    vertical-align: middle;
}


.payment-report-table tbody tr:last-child td {
    border-bottom: none;
}


.payment-report-table tbody tr:hover {
    background: #fbfeff;
}

.reference-badge {
    display: inline-block;

    padding: 4px 7px;

    border-radius: 6px;

    background: #eaf8fb;

    color: #00739a;

    font-size: 9px;

    font-weight: 700;
}


.business-cell {
    display: flex;
    align-items: center;

    gap: 8px;

    font-weight: 600;

    color: #174f66;
}


.business-icon {
    width: 28px;
    height: 28px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 7px;

    background: #eff9fc;

    color: #00739a;

    font-size: 12px;
}
.transaction-badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 15px;
    background: #eef8fb;
    color: #21657b;
    font-size: 9px;
    font-weight: 600;
}
.amount-cell {
    color: #005676 !important;
    font-weight: 700;
    white-space: nowrap;
}
.received-cell {
    display: flex;
    align-items: center;
    gap: 7px;
    white-space: nowrap;
}
.received-icon {
    width: 26px;
    height: 26px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #f2f7f9;
    color: #7293a1;
    font-size: 11px;
}
.empty-report {
    padding: 50px 15px !important;
    text-align: center;
    color: #8aa5b1 !important;
}
.empty-report i {
    display: block;
    margin-bottom: 8px;
    font-size: 27px;
    color: #94cfe1;
}

.empty-report strong,
.empty-report span {
    display: block;
}
.empty-report strong {
    margin-bottom: 3px;
    color: #537788;
    font-size: 12px;
}

.empty-report span {
    font-size: 10px;
}
.report-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 9px 13px;
    background: #fbfdfe;
    border-top: 1px solid #edf4f6;
    color: #7898a7;
    font-size: 12px;
}
@media (max-width: 1100px) {

    .filter-grid {
        grid-template-columns:
            repeat(3, 1fr);
    }

    .filter-actions {
        grid-column: span 3;
    }

    .report-type-buttons {
        grid-template-columns:
            repeat(2, 1fr);
    }

}


@media (max-width: 700px) {

    .report-page {
        padding: 20px 15px 40px;
    }

    .report-header {
        align-items: flex-start;
        flex-direction: column;
    }
    .btn-export-pdf {
        width: 100%;
        justify-content: center;
    }
    .report-type-buttons,
    .report-summary-grid,
    .filter-grid {
        grid-template-columns: 1fr;
    }
    .filter-actions {
        grid-column: auto;
    }
    .filter-actions > * {
        flex: 1;
    }
}
</style>

@endpush