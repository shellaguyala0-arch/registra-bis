@extends('layouts.app')

@section('title', 'Payments')

@section('content')

<div class="payment-page">


<div class="payment-header">

    <div class="payment-header-left">

        <div class="payment-header-icon">
            <i class="bi bi-credit-card-2-front"></i>
        </div>

        <div>

            <span class="payment-eyebrow">
                TREASURER
            </span>

            <h1>
                Payment Transactions
            </h1>

            <p>
                Record and monitor fee collections and payment
                transactions.
            </p>

        </div>

    </div>

    @if(auth()->user()->isTreasurer())

        <a href="{{ route('payments.create') }}"
           class="btn-new-payment">

            <i class="bi bi-plus-circle"></i>

            Record Payment

        </a>

    @endif

</div>

@if(session('success'))

    <div class="alert custom-success-alert">

        <i class="bi bi-check-circle-fill"></i>

        <span>
            {{ session('success') }}
        </span>

    </div>

@endif


<div class="payment-card">

    <div class="payment-card-header">

        <div class="section-icon">
            <i class="bi bi-wallet2"></i>
        </div>

        <div>

            <h3>
                Recent Transactions
            </h3>

            <p>
                View recorded payments, businesses,
                requesters, transaction types, and payment details.
            </p>

        </div>

        <div class="header-action">

            <a href="{{ route('payments.report') }}"
               class="btn-payment-report">

                <i class="bi bi-file-earmark-bar-graph"></i>

                Payment Report

            </a>

        </div>

    </div>
    <div class="payment-table-wrapper">

        <table class="payment-table">

            <thead>

                <tr>

                    <th>REFERENCE</th>

                    <th>BUSINESS / REQUESTER</th>

                    <th>TRANSACTION</th>

                    <th>AMOUNT</th>

                    <th>PAYMENT DATE</th>

                    <th>RECEIVED BY</th>

                </tr>

            </thead>


            <tbody>

                @forelse($payments as $p)
@php
   

    $requesterName = '—';
    $requesterLabel = 'Document Requester';

    if ($p->business) {

        $requesterName = $p->business->business_name ?? '—';

        $requesterLabel = $p->business->owner_name ?? '—';

    }

    elseif (
        $p->assessment &&
        $p->assessment->transaction_type === 'Filing Complaint' &&
        !empty($p->complainant_name)
    ) {

        $requesterName = $p->complainant_name;

        $requesterLabel = 'Complainant';

    }

    elseif ($p->document) {

        $nameParts = array_filter([
            trim($p->document->requester_first_name ?? ''),
            trim($p->document->requester_middle_name ?? ''),
            trim($p->document->requester_last_name ?? ''),
        ]);

        $requesterName = !empty($nameParts)
            ? implode(' ', $nameParts)
            : '—';

        $requesterLabel = $p->document->document_type
            ?? 'Document Requester';

    }
           else {
                    $requesterName = '—';
                    $requesterLabel = 'Document Requester';
                }
                @endphp
                    <tr>
                        <td>

                            <div class="reference-number">

                                <i class="bi bi-receipt"></i>

                                {{ $p->reference_no }}

                            </div>

                        </td>

<td>
    @if($p->business)

        <div class="business-name">
            <i class="bi bi-building"></i>
            {{ $p->business->business_name ?? '—' }}
        </div>

        <small class="owner-name">
            <i class="bi bi-person"></i>
            {{ $p->business->owner_name ?? '—' }}
        </small>

        @if($p->document && $p->document->document_type)
            <small class="document-subtype">
                <i class="bi bi-file-earmark-text"></i>
                {{ $p->document->document_type }}
            </small>
        @endif

    @else
        <div class="requester-name">
            <i class="bi bi-person-vcard"></i>
            {{ $requesterName }}
        </div>

        <small class="requester-type">
            <i class="bi bi-file-earmark-text"></i>
            {{ $requesterLabel }}
        </small>

    @endif
</td>
                        <td>
                            <span class="transaction-text">
                                {{ $p->assessment->transaction_type ?? '—' }}
                            </span>
                            @if($p->document)
                                <small class="document-type">
                                    <i class="bi bi-file-earmark-text"></i>
                                    {{ $p->document->document_type }}
                                </small>
                            @endif

                        </td>
                        <td>
                            <span class="amount-text">
                                ₱{{ number_format($p->amount, 2) }}
                            </span>
                        </td>
                        <td>
                            <div class="date-text">
                                <i class="bi bi-calendar3"></i>
                                {{ $p->payment_date
                                    ? $p->payment_date->format('M d, Y')
                                    : '—'
                                }}
                            </div>
                        </td>
                        <td>
                            <div class="receiver-text">
                                <i class="bi bi-person-check"></i>
                                {{ $p->receivedBy->name ?? '—' }}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-payment">
                                <div class="empty-payment-icon">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </div>
                                <h4>
                                    No Payment Transactions Found
                                </h4>
                                <p>
                                    No payments have been recorded yet.
                                </p>
                                @if(auth()->user()->isTreasurer())
                                    <a href="{{ route('payments.create') }}"
                                       class="btn-empty-payment">

                                        <i class="bi bi-plus-circle"></i>

                                        Record First Payment

                                    </a>

                                @endif

                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($payments->hasPages())
        <div class="pagination-container">
            {{ $payments->links() }}
        </div>
    @endif

</div>

</div>

@endsection

@push('styles')
<style>
.payment-page {
    width: 100%;
    padding: 30px 28px 50px;
    background: #ffffff;
}
.payment-header {
    background: linear-gradient(
        135deg,
        #075374,
        #004b69
    );
    border-radius: 18px;
    padding: 28px 34px;
    min-height: 138px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 25px;
    color: white;
    box-shadow:
        0 8px 20px rgba(0, 70, 100, .12);
    margin-bottom: 30px;
}
.payment-header-left {
    display: flex;
    align-items: center;
    gap: 20px;
}
.payment-header-icon {
    width: 62px;
    height: 62px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 42px;
    color: white;
    flex-shrink: 0;
}
.payment-eyebrow {
    display: block;
    color: #bfe9f8;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 1.5px;
    margin-bottom: 3px;
}
.payment-header h1 {
    margin: 0;
    font-size: 38px;
    font-weight: 700;
    letter-spacing: -.5px;
}
.payment-header p {
    margin: 5px 0 0;
    color: #e3f5fc;
    font-size: 17px;
}
.btn-new-payment {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #ffffff;
    color: #005679;
    border-radius: 12px;
    padding: 13px 20px;
    text-decoration: none;
    font-size: 15px;
    font-weight: 700;
    border: 1px solid rgba(255,255,255,.5);
    transition: .2s ease;
    white-space: nowrap;
}
.btn-new-payment:hover {
    background: #e9f8fc;
    color: #004765;
    transform: translateY(-1px);
}
.custom-success-alert {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #eafaf2;
    border: 1px solid #bcebd0;
    color: #137a47;
    border-radius: 13px;
    padding: 14px 18px;
    margin-bottom: 25px;
}
.payment-card {
    background: #ffffff;
    border: 1px solid #9ee2fb;
    border-radius: 20px;
    overflow: hidden;
    box-shadow:
        0 8px 20px rgba(0, 70, 100, .06);
}
.payment-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 25px 32px;
    border-bottom: 1px solid #d8edf5;
    background: #ffffff;
}
.section-icon {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #005679;
    font-size: 27px;
    flex-shrink: 0;
}
.payment-card-header h3 {
    margin: 0;
    color: #004d70;
    font-size: 22px;
    font-weight: 700;
}
.payment-card-header p {
    margin: 3px 0 0;
    color: #6e91a3;
    font-size: 14px;
}
.header-action {
    margin-left: auto;
}
.btn-payment-report {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: #005679;
    background: #edf9fd;
    border: 1px solid #a9dff2;
    border-radius: 10px;
    padding: 10px 15px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: .2s ease;
}
.btn-payment-report:hover {
    background: #dff4fb;
    color: #004765;
}
.payment-table-wrapper {
    width: 100%;
    overflow-x: auto;
}
.payment-table {
    width: 100%;
    min-width: 1100px;
    border-collapse: collapse;
}
.payment-table thead {
    background: #f2faff;
}
.payment-table thead th {
    padding: 16px 18px;
    color: #3c7188;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: .8px;
    border-bottom: 1px solid #d7edf5;
    white-space: nowrap;
}
.payment-table tbody td {
    padding: 18px;
    border-bottom: 1px solid #e5f1f5;
    color: #174e67;
    font-size: 14px;
    vertical-align: middle;
}
.payment-table tbody tr {
    transition: background .15s ease;
}
.payment-table tbody tr:hover {
    background: #f8fcfe;
}
.payment-table tbody tr:last-child td {
    border-bottom: none;
}
.reference-number {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #005679;
    font-weight: 700;
    white-space: nowrap;
}
.reference-number i {
    color: #0084b7;
    font-size: 16px;
}
.business-name {
    color: #004d70;
    font-weight: 700;
    line-height: 1.4;
}
.owner-name {
    display: block;
    margin-top: 4px;
    color: #7c9baa;
    font-size: 14px;
}

.owner-name i {
    margin-right: 3px;
}
.requester-name {
    display: flex;
    align-items: center;
    gap: 7px;
    color: #004d70;
    font-weight: 700;
    line-height: 1.4;
}
.requester-name i {
    color: #0084b7;
    font-size: 16px;
    flex-shrink: 0;
}
.requester-type {
    display: block;
    margin-top: 4px;
    color: #7c9baa;
    font-size: 14px;
}
.requester-type i {
    margin-right: 3px;
    color: #0084b7;
}
.transaction-text {
    display: block;
    color: #476f80;
    font-weight: 500;
    line-height: 1.4;
}
.document-type {
    display: block;
    margin-top: 5px;
    color: #7c9baa;
    font-size: 14px;
    white-space: nowrap;
}
.document-type i {
    color: #0084b7;
    margin-right: 3px;
}
.amount-text {
    color: #007a65;
    font-size: 16px;
    font-weight: 700;
    white-space: nowrap;
}
.date-text {
    display: flex;
    align-items: center;
    gap: 7px;
    color: #567c8b;
    white-space: nowrap;
}
.date-text i {
    color: #0084b7;
}
.receiver-text {
    display: flex;
    align-items: center;
    gap: 7px;
    color: #476f80;
    white-space: nowrap;
}
.receiver-text i {
    color: #0084b7;
}
.empty-payment {
    text-align: center;
    padding: 65px 20px;
}
.empty-payment-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #edf9fd;
    color: #00749b;
    font-size: 30px;
}
.empty-payment h4 {
    margin: 0;
    color: #004d70;
    font-size: 20px;
    font-weight: 700;
}
.empty-payment p {
    margin: 8px 0 20px;
    color: #7895a2;
    font-size: 14px;
}
.btn-empty-payment {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: #075374;
    color: #ffffff;
    padding: 11px 17px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
}
.btn-empty-payment:hover {
    background: #004b69;
    color: #ffffff;
}
.pagination-container {
    padding: 18px 25px;
    border-top: 1px solid #d8edf5;
    display: flex;
    justify-content: flex-end;
}
@media (max-width: 900px) {
    .payment-header {
        flex-direction: column;
        align-items: flex-start;
    }
    .btn-new-payment {
        width: 100%;
        justify-content: center;
    }
    .payment-card-header {
        flex-wrap: wrap;
    }
    .header-action {
        width: 100%;
        margin-left: 56px;
    }
    .btn-payment-report {
        width: fit-content;
    }
}
@media (max-width: 600px) {
    .payment-page {
        padding: 20px 15px 40px;
    }
    .payment-header {
        padding: 23px;
    }
    .payment-header h1 {
        font-size: 28px;
    }
    .payment-header p {
        font-size: 14px;
    }
    .payment-card-header {
        padding: 20px;
    }
}
</style>

@endpush
