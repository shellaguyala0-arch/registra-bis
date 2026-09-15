@extends('layouts.app')

@section('title', 'Pending Documents')

@section('content')

<div class="pending-documents-page">

    <div class="pending-header">

        <div class="pending-header-left">

            <div class="pending-header-icon">
                <i class="bi bi-hourglass-split"></i>
            </div>

            <div>
                <div class="pending-eyebrow">
                    SECRETARY / PENDING DOCUMENTS
                </div>

                <h1>
                    Pending Documents
                </h1>

                <p>
                    Review document requests generated from confirmed payments.
                </p>
            </div>

        </div>

    </div>


    @if(session('success'))

        <div class="pending-alert pending-alert-success">

            <div class="pending-alert-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <div>
                {{ session('success') }}
            </div>

        </div>

    @endif


    @if(session('error'))

        <div class="pending-alert pending-alert-error">

            <div class="pending-alert-icon">
                <i class="bi bi-exclamation-circle-fill"></i>
            </div>

            <div>
                {{ session('error') }}
            </div>

        </div>

    @endif


    <div class="pending-panel">

        <div class="pending-panel-header">

            <div>

                <h2>
                    Documents Awaiting Review
                </h2>

                <p>
                    These requests were automatically created after payment confirmation.
                </p>

            </div>

            <div class="pending-count">

                <i class="bi bi-file-earmark-text"></i>

                {{ $documents->count() }}

                {{ Str::plural('Pending Request', $documents->count()) }}

            </div>

        </div>


        @if($documents->count())

            <div class="pending-table-wrapper">

                <table class="pending-table">

                    <thead>

                        <tr>

                            <th>
                                Request No.
                            </th>

                            <th>
                                Business / Applicant
                            </th>

                            <th>
                                Document Type
                            </th>

                            <th>
                                Payment
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Date Requested
                            </th>

                            <th class="text-center">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($documents as $document)

                            <tr>

                                <td>

                                    <div class="request-number">

                                        {{ $document->document_no }}

                                    </div>

                                </td>


                                <td>

                                    @if($document->business)

                                        <div class="business-name">

                                            {{ $document->business->business_name }}

                                        </div>

                                        <div class="business-owner">

                                            {{ $document->business->owner_name }}

                                        </div>

                                    @else

                                        <div class="business-name">
                                            General Request
                                        </div>

                                        <div class="business-owner">
                                            No business attached
                                        </div>

                                    @endif

                                </td>


                                <td>

                                    <div class="document-type">

                                        <i class="bi bi-file-earmark-text"></i>

                                        {{ $document->document_type }}

                                    </div>

                                </td>

                                <td>

                                    @if($document->payment)

                                        <div class="payment-reference">

                                            {{ $document->payment->reference_no }}

                                        </div>

                                        <div class="payment-amount">

                                            ₱{{ number_format($document->payment->amount, 2) }}

                                        </div>

                                        @if($document->payment->assessment)

                                            <div class="payment-type">

                                                {{ $document->payment->assessment->transaction_type }}

                                            </div>

                                        @endif

                                    @else

                                        <span class="text-muted">
                                            No payment linked
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <span class="status-badge">

                                        <i class="bi bi-clock-fill"></i>

                                        {{ $document->status }}

                                    </span>

                                </td>
                                <td>

                                    <div class="requested-date">

                                        {{ $document->created_at->format('M d, Y') }}

                                    </div>

                                    <div class="requested-time">

                                        {{ $document->created_at->format('h:i A') }}

                                    </div>

                                </td>


                                <td class="text-center">

                                    <form
                                        method="POST"
                                        action="{{ route('documents.issue', $document) }}"
                                        class="issue-form"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="btn-issue"
                                            onclick="return confirm('Are you sure you want to issue this document?');"
                                        >

                                            <i class="bi bi-check2-circle"></i>

                                            Issue

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="pending-empty">
                <div class="pending-empty-icon">
                    <i class="bi bi-check2-circle"></i>
                </div>
                <h3>
                    No pending documents
                </h3>

                <p>
                    All document requests have already been processed.
                </p>

            </div>

        @endif

    </div>

</div>



<style>

.pending-documents-page {
    width: 100%;
    padding: 10px 0 40px;
}

.pending-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.pending-header-left {
    display: flex;
    align-items: center;
    gap: 16px;
}

.pending-header-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #075374;
    color: #fff;
    font-size: 23px;
    flex-shrink: 0;
}

.pending-eyebrow {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .12em;
    color: #0784a8;
    margin-bottom: 4px;
}

.pending-header h1 {
    margin: 0;
    font-size: 28px;
    font-weight: 750;
    color: #12344d;
}

.pending-header p {
    margin: 4px 0 0;
    color: #718096;
    font-size: 14px;
}


.pending-alert {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 17px;
    border-radius: 12px;
    margin-bottom: 20px;
    font-size: 14px;
    font-weight: 600;
}

.pending-alert-success {
    background: #ecfdf3;
    border: 1px solid #bbf7d0;
    color: #166534;
}

.pending-alert-error {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #991b1b;
}

.pending-alert-icon {
    font-size: 18px;
}
.pending-panel {
    background: #fff;
    border: 1px solid #e5edf3;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(25, 55, 75, .06);
}

.pending-panel-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 22px 24px;
    border-bottom: 1px solid #e8eef3;
}

.pending-panel-header h2 {
    margin: 0;
    color: #12344d;
    font-size: 18px;
    font-weight: 750;
}

.pending-panel-header p {
    margin: 5px 0 0;
    color: #7a8b98;
    font-size: 13px;
}

.pending-count {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: #eef8fb;
    color: #075374;
    border: 1px solid #d6edf3;
    padding: 9px 13px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
}

.pending-table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.pending-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 1050px;
}

.pending-table thead th {
    background: #f7fafc;
    color: #536b7a;
    font-size: 12px;
    font-weight: 750;
    text-transform: uppercase;
    letter-spacing: .04em;
    padding: 14px 18px;
    border-bottom: 1px solid #e5edf3;
    white-space: nowrap;
}

.pending-table tbody td {
    padding: 17px 18px;
    border-bottom: 1px solid #edf2f5;
    vertical-align: middle;
    color: #334e5f;
    font-size: 14px;
}

.pending-table tbody tr:last-child td {
    border-bottom: 0;
}

.pending-table tbody tr:hover {
    background: #fbfdfe;
}

.request-number {
    color: #075374;
    font-weight: 750;
    font-size: 13px;
}

.business-name {
    font-weight: 700;
    color: #183b50;
    margin-bottom: 3px;
}

.business-owner {
    color: #7a8b98;
    font-size: 12px;
}
.document-type {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: #31566c;
    font-weight: 600;
}

.document-type i {
    color: #0784a8;
    font-size: 16px;
}


.payment-reference {
    font-weight: 700;
    color: #075374;
    font-size: 13px;
}

.payment-amount {
    color: #1f7a4d;
    font-weight: 750;
    margin-top: 3px;
}

.payment-type {
    color: #7a8b98;
    font-size: 11px;
    margin-top: 3px;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 10px;
    border-radius: 20px;
    background: #fff7e6;
    color: #a15c00;
    border: 1px solid #ffe2a9;
    font-size: 12px;
    font-weight: 700;
}

.status-badge i {
    font-size: 10px;
}

.requested-date {
    color: #405b6b;
    font-weight: 600;
    font-size: 13px;
}

.requested-time {
    color: #8998a2;
    font-size: 11px;
    margin-top: 3px;
}

.btn-issue {
    border: 0;
    border-radius: 9px;
    background: #075374;
    color: #fff;
    padding: 9px 14px;
    font-size: 13px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
    transition: .2s ease;
}

.btn-issue:hover {
    background: #063f59;
    transform: translateY(-1px);
}

.btn-issue i {
    font-size: 15px;
}



.pending-empty {
    padding: 65px 20px;
    text-align: center;
}

.pending-empty-icon {
    width: 65px;
    height: 65px;
    margin: 0 auto 15px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eef8fb;
    color: #0784a8;
    font-size: 28px;
}

.pending-empty h3 {
    margin: 0;
    color: #23475b;
    font-size: 18px;
    font-weight: 750;
}

.pending-empty p {
    margin: 7px 0 0;
    color: #82929c;
    font-size: 13px;
}

@media (max-width: 768px) {

    .pending-header {
        align-items: flex-start;
    }

    .pending-header-left {
        align-items: flex-start;
    }

    .pending-header h1 {
        font-size: 23px;
    }

    .pending-panel-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .pending-count {
        align-self: flex-start;
    }

    .pending-table {
        min-width: 950px;
    }
}

</style>

@endsection