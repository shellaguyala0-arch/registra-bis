@extends('layouts.app')

@section('title', 'Business Closure')

@section('content')

<div class="closure-page">
    @if(session('success'))

        <div class="closure-alert closure-alert-success">

            <div class="alert-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <div>
                <strong>Closure Successful</strong>

                <p>
                    {{ session('success') }}
                </p>
            </div>

        </div>

    @endif


    @if(session('error'))

        <div class="closure-alert closure-alert-error">

            <div class="alert-icon">
                <i class="bi bi-exclamation-circle-fill"></i>
            </div>

            <div>
                <strong>Unable to Close Business</strong>

                <p>
                    {{ session('error') }}
                </p>
            </div>

        </div>

    @endif



    @if($errors->any())

        <div class="closure-alert closure-alert-error">

            <div class="alert-icon">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>

            <div>

                <strong>
                    Please check the following:
                </strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    @endif

    <div class="closure-header">

        <div class="closure-header-left">

            <div class="closure-header-icon">
                <i class="bi bi-building-x"></i>
            </div>

            <div>

                <span class="closure-eyebrow">
                    ACCOUNTABILITY
                </span>

                <h1>
                    Business Closure
                </h1>

                <p>
                    Select an active business record and submit
                    the required closure information.
                </p>

            </div>

        </div>


        <div class="closure-badge">

            <i class="bi bi-shield-check"></i>

            Accountability & Transparency

        </div>

    </div>



    <div class="closure-notice">
        <div class="notice-icon">
            <i class="bi bi-info-circle-fill"></i>
        </div>
        <div>

            <strong>
                Closure Notice
            </strong>

            <p>
                Only active business records can be closed.
                Select a business from the records below.
                The selected business information will be loaded
                automatically and cannot be manually changed.
            </p>

        </div>

    </div>


    <div class="closure-layout">
        <div class="closure-left-column">
            <div class="closure-business-card">
                <div class="closure-card-header">

                    <div class="closure-section-icon">

                        <i class="bi bi-buildings"></i>

                    </div>

                    <div>

                        <h3>
                            Active Business Records
                        </h3>

                        <p>
                            Select the business you want to close.
                        </p>

                    </div>

                    <div class="business-count">

                        {{ $businesses->count() }}

                        <span>
                            Active
                        </span>

                    </div>

                </div>

                <div class="business-record-search">

                    <div class="record-search-box">

                        <i class="bi bi-search"></i>

                        <input
                            type="text"
                            id="businessRecordSearch"
                            placeholder="Search business name, owner, or permit number..."
                        >

                    </div>

                </div>

                <div class="business-record-list" id="businessRecordList">

                    @forelse($businesses as $business)

                        <div
                            class="business-record"
                            data-id="{{ $business->id }}"
                            data-name="{{ $business->business_name }}"
                            data-owner="{{ $business->owner_name }}"
                            data-permit="{{ $business->permit_number }}"
                        >

                            <div class="business-record-icon">

                                <i class="bi bi-building"></i>

                            </div>


                            <div class="business-record-info">

                                <h4>
                                    {{ $business->business_name }}
                                </h4>

                                <div class="business-record-meta">

                                    <span>
                                        <i class="bi bi-person"></i>

                                        {{ $business->owner_name }}
                                    </span>

                                    <span>
                                        <i class="bi bi-card-text"></i>

                                        {{ $business->permit_number }}
                                    </span>

                                </div>


                                @if($business->address)

                                    <div class="business-record-address">

                                        <i class="bi bi-geo-alt"></i>

                                        {{ $business->address }}

                                    </div>

                                @endif

                            </div>


                            <div class="business-record-status">

                                <span>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Active
                                </span>

                                <i class="bi bi-chevron-right record-arrow"></i>

                            </div>

                        </div>

                    @empty

                        <div class="no-business-records">

                            <div class="no-business-icon">

                                <i class="bi bi-building-x"></i>

                            </div>

                            <h4>
                                No Active Businesses
                            </h4>

                            <p>
                                There are currently no active business
                                records available for closure.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>



            <div class="closure-form-card">

                <div class="closure-card-header">

                    <div class="closure-section-icon">

                        <i class="bi bi-building-x"></i>

                    </div>

                    <div>

                        <h3>
                            Close Selected Business
                        </h3>

                        <p>
                            Review the selected business information
                            and provide the reason for closure.
                        </p>

                    </div>

                </div>


                <div class="closure-card-body">

                   <form
    method="POST"
    action="{{ route('closures.store') }}"
    id="closureForm"
    enctype="multipart/form-data"
>
                        @csrf
                        <input
                            type="hidden"
                            name="business_id"
                            id="closureBusinessId"
                            value="{{ old('business_id') }}"
                        >

                        <div
                            class="selected-business-notice"
                            id="selectedBusinessNotice"
                        >

                            <i class="bi bi-check-circle-fill"></i>

                            <span>
                                Business record selected
                            </span>

                        </div>



                        <div class="closure-fields-grid">


                            <div class="closure-field">

                                <label class="closure-label">

                                    <i class="bi bi-building"></i>

                                    Business Name

                                </label>

                                <input
                                    id="closureName"
                                    type="text"
                                    name="business_name"
                                    class="form-control closure-input"
                                    value="{{ old('business_name') }}"
                                    placeholder="Select a business record"
                                    readonly
                                >

                            </div>

                            <div class="closure-field">
                                <label class="closure-label">
                                    <i class="bi bi-person"></i>

                                    Owner Name

                                </label>

                                <input
                                    id="closureOwner"
                                    type="text"
                                    name="owner_name"
                                    class="form-control closure-input"
                                    value="{{ old('owner_name') }}"
                                    placeholder="Select a business record"
                                    readonly
                                >

                            </div>


                            <div class="closure-field">

                                <label class="closure-label">

                                    <i class="bi bi-card-text"></i>

                                    Business Permit Number

                                </label>

                                <input
                                    id="closurePermit"
                                    type="text"
                                    name="permit_number"
                                    class="form-control closure-input"
                                    value="{{ old('permit_number') }}"
                                    placeholder="Select a business record"
                                    readonly
                                >

                            </div>

                            <div class="closure-field">

                                <label class="closure-label">

                                    <i class="bi bi-activity"></i>

                                    Current Status

                                </label>

                                <div class="current-status-box">

                                    <span>
                                        <i class="bi bi-check-circle-fill"></i>
                                        Active
                                    </span>

                                </div>

                            </div>


                            <div class="closure-field closure-field-full">

                                <label class="closure-label">

                                    <i class="bi bi-paperclip"></i>

                                    Reason for Closure

                                    <span class="required">
                                        *
                                    </span>

                                </label>

                                <div class="closure-file-upload">
                                    <input
                                        type="file"
                                        name="reason"
                                        id="closureReasonFile"
                                        class="closure-file-input"
                                        accept=".pdf,.jpg,.jpeg,.png"
                                        required
                                    >

                                    <label for="closureReasonFile" class="closure-file-label">
                                        <div class="closure-file-icon">
                                            <i class="bi bi-cloud-arrow-up"></i>
                                        </div>

                                        <div class="closure-file-content">
                                            <strong id="closureFileName">
                                                Upload closure document
                                            </strong>

                                            <span>
                                                PDF, JPG, JPEG, or PNG • Maximum 5 MB
                                            </span>
                                        </div>

                                        <div class="closure-file-button">
                                            Browse
                                        </div>
                                    </label>

                                    <div class="closure-file-selected" id="closureFileSelected">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span id="closureSelectedFileName"></span>
                                    </div>
                                </div>
                            </div>

                            </div>

                        </div>

                        <div class="closure-form-actions">

                            <button
                                type="reset"
                                class="btn-closure-clear"
                                id="clearClosure"
                            >

                                <i class="bi bi-arrow-counterclockwise"></i>

                                Clear

                            </button>


                            <button
                                type="submit"
                                class="btn-closure-submit"
                                id="submitClosure"
                                disabled
                            >

                                <i class="bi bi-building-x"></i>

                                Close Business

                            </button>

                        </div>

                </form>

            </div>

        </div>

        <div class="closure-reviewed-card">

            <div class="closure-card-header">

                <div class="closure-section-icon">

                    <i class="bi bi-archive"></i>

                </div>

                <div>

                    <h3>
                        Closure History / Archive
                    </h3>

                    <p>
                        Previously closed businesses and their
                        recorded closure information.
                    </p>

                </div>

            </div>


            <div class="closure-card-body reviewed-body">

                @forelse(
                    $applications->where('status', 'Approved')
                    as $a
                )

                    <div class="reviewed-item">

                        <div class="reviewed-left">

                            <div class="reviewed-icon">

                                <i class="bi bi-check-lg"></i>

                            </div>


                            <div>

                                <h4>
                                    {{ $a->business_name }}
                                </h4>


                                <p>

                                    <i class="bi bi-person"></i>

                                    {{ $a->owner_name }}

                                    <span class="separator">
                                        •
                                    </span>

                                    <i class="bi bi-card-text"></i>

                                    {{ $a->permit_number }}

                                    <span class="separator">
                                        •
                                    </span>

                                    <i class="bi bi-clock"></i>

                                    {{ $a->reviewed_at?->format('M d, Y h:i A') }}

                                </p>


                                <div class="history-reason">
                                    <strong>
                                        Closure Document:
                                    </strong>

                                    @if($a->reason)
                                        <a
                                            href="{{ asset($a->reason) }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="closure-document-link"
                                        >
                                            <i class="bi bi-file-earmark-arrow-up"></i>
                                            View Uploaded Document
                                        </a>
                                    @else
                                        <span class="text-muted">
                                            No document uploaded.
                                        </span>
                                    @endif
                                </div>

                            </div>

                        </div>


                        <span class="closure-status approved">

                            <i class="bi bi-check-circle"></i>

                            Closed

                        </span>

                    </div>

                @empty

                    <div class="closure-empty">

                        <div class="empty-icon">

                            <i class="bi bi-archive"></i>

                        </div>

                        <h4>
                            No Closure History
                        </h4>

                        <p>
                            Closed businesses will appear here
                            after a closure is submitted.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

<div
    id="closureConfirmModal"
    class="closure-confirm-overlay"
>

    <div class="closure-confirm-modal">

        <div class="closure-confirm-icon">
            !
        </div>

        <h2>
            Are you sure?
        </h2>

        <p>
            Once confirmed, this business will be closed
            and moved to the closure history/archive.
        </p>

        <div class="closure-selected-summary">

            <strong id="confirmBusinessName">
                Business
            </strong>

            <span id="confirmBusinessOwner">
                Owner
            </span>

        </div>

        <div class="closure-confirm-actions">

            <button
                type="button"
                id="closureCancelBtn"
                class="closure-confirm-cancel"
            >
                Cancel
            </button>

            <button
                type="button"
                id="closureConfirmBtn"
                class="closure-confirm-delete"
            >
                Yes, close it!
            </button>

        </div>

    </div>

</div>


@endsection

@push('styles')

<style>

.closure-page {
    width: 100%;
    padding: 30px 28px 50px;
    background: #ffffff;
    box-sizing: border-box;
}
.closure-alert {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 16px 20px;
    border-radius: 13px;
    margin-bottom: 20px;
}
.closure-alert-success {
    background: #edf9f4;
    border: 1px solid #c9eadc;
    color: #176b4a;
}
.closure-alert-error {
    background: #fff3f3;
    border: 1px solid #f0cccc;
    color: #8b3030;
}
.alert-icon {
    font-size: 22px;
    flex-shrink: 0;
}
.closure-alert strong {
    font-size: 15px;
    line-height: 1.4;
}
.closure-alert p {
    margin: 4px 0 0;
    font-size: 14px;
    line-height: 1.5;
}
.closure-alert ul {
    margin: 7px 0 0;
    padding-left: 20px;
    font-size: 14px;
    line-height: 1.6;
}
.closure-header {
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
        0 8px 20px rgba(0,70,100,.12);
    margin-bottom: 25px;
    box-sizing: border-box;
}
.closure-header-left {
    display: flex;
    align-items: center;
    gap: 20px;
    min-width: 0;
}
.closure-header-icon {
    width: 62px;
    height: 62px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    flex-shrink: 0;
}
.closure-eyebrow {
    display: block;
    color: #bfe9f8;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 1.5px;
    margin-bottom: 4px;
}

.closure-header h1 {
    margin: 0;
    font-size: 36px;
    font-weight: 700;
    letter-spacing: -.5px;
    line-height: 1.2;
}

.closure-header p {
    margin: 7px 0 0;
    color: #e3f5fc;
    font-size: 16px;
    line-height: 1.5;
}

.closure-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: rgba(255,255,255,.10);
    border: 1px solid rgba(255,255,255,.12);
    padding: 13px 20px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
    flex-shrink: 0;
}
.closure-notice {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    background: #eef9fc;
    border: 1px solid #c7eaf5;
    border-radius: 15px;
    padding: 17px 20px;
    margin-bottom: 26px;
    color: #315f72;
    box-sizing: border-box;
}
.notice-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #d9f1f8;
    border-radius: 10px;
    color: #087594;
    flex-shrink: 0;
    font-size: 18px;
}
.closure-notice strong {
    display: block;
    font-size: 15px;
    margin-bottom: 4px;
}

.closure-notice p {
    margin: 0;
    font-size: 14px;
    line-height: 1.65;
}


.closure-layout {
    display: grid;
    grid-template-columns:
        minmax(0, 1.05fr)
        minmax(0, .95fr);

    gap: 22px;
    align-items: start;
}
.closure-left-column {
    display: flex;
    flex-direction: column;
    gap: 22px;
    min-width: 0;
}
.closure-business-card,
.closure-form-card,
.closure-reviewed-card {
    width: 100%;
    min-width: 0;
    background: #ffffff;
    border: 1px solid #e2e9ec;
    border-radius: 15px;
    box-shadow:
        0 3px 12px rgba(20,50,60,.035);
    overflow: hidden;
    box-sizing: border-box;
}
.closure-card-header {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 20px 21px;
    border-bottom: 1px solid #edf1f3;
    box-sizing: border-box;
}
.closure-card-header > div:nth-child(2) {
    flex: 1;
    min-width: 0;
}

.closure-section-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: #edf8f7;
    color: #0b8f86;
    font-size: 19px;
}
.closure-card-header h3 {
    margin: 0;
    color: #24444f;
    font-size: 17px;
    font-weight: 700;
    line-height: 1.35;
}
.closure-card-header p {
    margin: 4px 0 0;
    color: #87979d;
    font-size: 14px;
    line-height: 1.5;
}
.business-count {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 7px 11px;
    border-radius: 20px;
    background: #edf8f7;
    color: #087594;
    font-size: 14px;
    font-weight: 700;
    flex-shrink: 0;
}
.business-count span {
    font-size: 14px;
    color: #789198;
    font-weight: 600;
}


.business-record-search {
    padding: 15px 18px;
    background: #fafcfc;
    border-bottom: 1px solid #edf1f3;
    box-sizing: border-box;
}
.record-search-box {
    position: relative;
    width: 100%;
}

.record-search-box i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #91a1a8;
    font-size: 16px;
}
.record-search-box input {
    width: 100%;
    height: 44px;
    border: 1px solid #dce6e9;
    border-radius: 9px;
    padding: 0 14px 0 40px;
    outline: none;
    font-size: 14px;
    color: #344b55;
    background: #ffffff;
    box-sizing: border-box;
}
.record-search-box input::placeholder {
    color: #9aa9ae;
}
.record-search-box input:focus {
    border-color: #75bdb8;
    box-shadow:
        0 0 0 3px rgba(11,143,134,.07);
}



.business-record-list {
    max-height: 425px;
    overflow-y: auto;
}

.business-record {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 16px 18px;
    border-bottom: 1px solid #edf1f3;
    cursor: pointer;
    transition:
        background .18s ease,
        border-color .18s ease;
    box-sizing: border-box;
}

.business-record:last-child {
    border-bottom: 0;
}

.business-record:hover {
    background: #f5fbfc;
}

.business-record.selected {
    background: #edf8f7;
    border-left: 4px solid #0b8f86;
    padding-left: 14px;
}

.business-record-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    border-radius: 10px;
    background: #edf8f7;
    color: #087594;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
}

.business-record.selected .business-record-icon {
    background: #0b8f86;
    color: #ffffff;
}
.business-record-info {
    flex: 1;
    min-width: 0;
}
.business-record-info h4 {
    margin: 0;
    color: #294650;
    font-size: 14px;
    font-weight: 700;
    line-height: 1.4;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.business-record-meta {
    display: flex;
    flex-wrap: wrap;

    gap: 12px;

    margin-top: 6px;
}

.business-record-meta span {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    color: #84969d;
    font-size: 14px;
    line-height: 1.4;
}
.business-record-meta i {
    color: #0b8f86;
    font-size: 14px;
}
.business-record-address {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: 6px;
    color: #98a7ac;
    font-size: 14px;
    line-height: 1.4;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.business-record-address i {
    color: #8aa3ab;
    font-size: 14px;
}

.business-record-status {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 8px;
    flex-shrink: 0;
}
.business-record-status span {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 8px;
    border-radius: 20px;
    background: #eaf8f2;
    color: #168052;
    font-size: 14px;
    font-weight: 700;
}
.business-record-status span i {
    font-size: 14px;
}
.record-arrow {
    color: #a4b4b9;
    font-size: 14px;
}
.business-record.selected .record-arrow {
    color: #0b8f86;
}
.no-business-records {
    padding: 55px 25px;
    text-align: center;
}
.no-business-icon {
    width: 58px;
    height: 58px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 14px;
    border-radius: 50%;
    background: #f0f7f8;
    color: #7b969f;
    font-size: 24px;
}
.no-business-records h4 {
    margin: 0;
    color: #526770;
    font-size: 16px;
    font-weight: 700;
}
.no-business-records p {
    max-width: 320px;
    margin: 7px auto 0;
    color: #9aa8ad;
    font-size: 14px;
    line-height: 1.6;
}
.closure-card-body {
    padding: 24px;
    box-sizing: border-box;
}
.selected-business-notice {
    display: none;
    align-items: center;
    gap: 8px;
    padding: 11px 13px;
    margin-bottom: 18px;
    border-radius: 8px;
    background: #edf8f7;
    border: 1px solid #d2ece9;
    color: #0b8179;
    font-size: 14px;
    font-weight: 600;
    line-height: 1.4;
}
.selected-business-notice.show {
    display: flex;
}


.closure-fields-grid {
    width: 100%;

    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 18px;

    align-items: start;
}

.closure-field {
    width: 100%;
    min-width: 0;
    margin: 0;
}

.closure-field-full {
    grid-column: 1 / -1;
}

.closure-label {
    display: flex;
    align-items: center;

    flex-wrap: wrap;

    gap: 6px;

    width: 100%;

    min-height: 20px;

    margin-bottom: 8px;

    color: #415861;

    font-size: 14px;
    font-weight: 700;

    line-height: 1.4;
}

.closure-label i {
    flex-shrink: 0;

    color: #0b8f86;

    font-size: 14px;
}

.required {
    color: #d64b4b;
    margin-left: 2px;
}



.closure-input,
.current-status-box,
.closure-textarea {
    width: 100% !important;
    box-sizing: border-box;
}

.closure-input {
    height: 45px;
    min-height: 45px;

    padding: 0 13px;

    border: 1px solid #dce5e8;
    border-radius: 9px;

    color: #344b55;

    font-size: 14px;

    box-shadow: none;

    background: #f7f9fa;
}

.closure-input:focus {
    border-color: #dce5e8;

    box-shadow: none;

    background: #f7f9fa;
}

.current-status-box {
    height: 45px;
    min-height: 45px;

    display: flex;
    align-items: center;

    padding: 0 13px;

    border: 1px solid #dce5e8;
    border-radius: 9px;

    background: #f7f9fa;

    box-sizing: border-box;
}

.current-status-box span {
    display: inline-flex;
    align-items: center;

    gap: 6px;

    color: #168052;

    font-size: 13px;
    font-weight: 700;
}

.current-status-box i {
    font-size: 14px;
}


.closure-file-upload {
    width: 100%;
}

.closure-file-input {
    display: none;
}

.closure-file-label {
    width: 100%;
    min-height: 125px;

    display: flex;
    align-items: center;

    gap: 16px;

    padding: 18px;

    box-sizing: border-box;

    border: 1px dashed #b9d5da;
    border-radius: 10px;

    background: #f8fbfc;

    cursor: pointer;

    transition:
        border-color .2s ease,
        background .2s ease,
        box-shadow .2s ease;
}

.closure-file-label:hover {
    border-color: #0b8f86;

    background: #f2faf9;

    box-shadow:
        0 0 0 3px rgba(11,143,134,.05);
}

.closure-file-icon {
    width: 50px;
    height: 50px;

    min-width: 50px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background: #e8f6f5;
    color: #0b8f86;

    font-size: 23px;
}

.closure-file-content {
    flex: 1;
    min-width: 0;

    display: flex;
    flex-direction: column;

    gap: 6px;
}

.closure-file-content strong {
    color: #294650;

    font-size: 14px;
    font-weight: 700;

    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.closure-file-content span {
    color: #8a9ca2;

    font-size: 12px;

    line-height: 1.5;
}

.closure-file-button {
    flex-shrink: 0;

    padding: 10px 16px;

    border-radius: 8px;

    background: #087594;
    color: #ffffff;

    font-size: 12px;
    font-weight: 700;

    transition: background .2s ease;
}

.closure-file-label:hover .closure-file-button {
    background: #075f79;
}

.closure-file-selected {
    display: none;

    align-items: center;

    gap: 7px;

    margin-top: 8px;

    padding: 9px 12px;

    border-radius: 8px;

    background: #edf8f7;

    border: 1px solid #d2ece9;

    color: #168052;

    font-size: 12px;
    font-weight: 600;

    line-height: 1.5;
}

.closure-file-selected.show {
    display: flex;
}

.closure-file-selected i {
    font-size: 14px;
}


.closure-textarea {
    min-height: 125px;

    padding: 12px 13px;

    border: 1px solid #dce5e8;
    border-radius: 9px;

    color: #344b55;

    font-size: 14px;

    line-height: 1.6;

    resize: vertical;

    box-shadow: none;
}

.closure-textarea:focus {
    border-color: #75bdb8;

    box-shadow:
        0 0 0 3px rgba(11,143,134,.08);
}



.closure-form-actions {
    width: 100%;

    display: flex;

    align-items: center;
    justify-content: flex-end;

    gap: 10px;

    margin-top: 20px;

    padding-top: 18px;

    border-top: 1px solid #edf1f3;

    box-sizing: border-box;
}

.btn-closure-clear,
.btn-closure-submit {
    min-height: 43px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 7px;

    border-radius: 9px;

    font-size: 13px;
    font-weight: 600;

    cursor: pointer;

    transition: all .2s ease;
}

.btn-closure-clear {
    padding: 10px 16px;

    border: 1px solid #d9e3e7;

    background: #ffffff;
    color: #667980;
}

.btn-closure-clear:hover {
    background: #f5f8f9;
}

.btn-closure-submit {
    padding: 10px 18px;

    border: 0;

    background: #087594;
    color: #ffffff;
}

.btn-closure-submit:hover:not(:disabled) {
    background: #075f79;

    transform: translateY(-1px);
}

.btn-closure-submit:disabled {
    background: #b8c9ce;

    cursor: not-allowed;

    opacity: .8;
}


.closure-reviewed-card {
    position: sticky;
    top: 20px;
}

.reviewed-body {
    padding: 0;

    max-height: 720px;

    overflow-y: auto;
}


.reviewed-item {
    display: flex;

    align-items: flex-start;
    justify-content: space-between;

    gap: 18px;

    padding: 20px 22px;

    border-bottom: 1px solid #edf1f3;

    background: #ffffff;

    transition: background .18s ease;

    box-sizing: border-box;
}

.reviewed-item:hover {
    background: #f9fcfc;
}

.reviewed-item:last-child {
    border-bottom: 0;
}

.reviewed-left {
    display: flex;
    align-items: flex-start;

    gap: 14px;

    min-width: 0;

    flex: 1;
}

.reviewed-icon {
    width: 42px;
    height: 42px;

    min-width: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #edf8f7;
    color: #0b8f86;

    font-size: 18px;
}


.reviewed-left h4 {
    margin: 0;

    color: #294650;

    font-size: 16px;
    font-weight: 700;

    line-height: 1.4;

    word-break: break-word;
}

.reviewed-left p {
    margin: 7px 0 0;

    color: #687c84;

    font-size: 13px;

    line-height: 1.7;

    word-break: break-word;
}

.reviewed-left p i {
    color: #0b8f86;

    margin-right: 3px;

    font-size: 13px;
}

.separator {
    margin: 0 7px;
    color: #b8c4c8;
}
.history-reason {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 5px;
    margin-top: 11px;
    padding: 11px 13px;
    background: #f6f9fa;
    border: 1px solid #e7edef;
    border-radius: 9px;
    color: #667a82;
    font-size: 13px;
    line-height: 1.6;
}
.history-reason strong {
    color: #425a63;
    font-size: 13px;
    font-weight: 700;
}

.closure-document-link {
    display: inline-flex;

    align-items: center;

    gap: 6px;

    margin-left: 3px;

    color: #087594;

    font-size: 13px;
    font-weight: 700;

    text-decoration: none;

    transition: color .2s ease;
}

.closure-document-link:hover {
    color: #075f79;
    text-decoration: underline;
}

.closure-document-link i {
    font-size: 15px;
}

.closure-status {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 6px;

    flex-shrink: 0;

    padding: 7px 11px;

    border-radius: 20px;

    font-size: 12px;
    font-weight: 700;

    white-space: nowrap;
}

.closure-status.approved {
    background: #eaf8f2;
    color: #168052;
}

.closure-empty {
    padding: 65px 30px;

    text-align: center;
}

.empty-icon {
    width: 60px;
    height: 60px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin: 0 auto 15px;

    border-radius: 50%;

    background: #f0f7f8;
    color: #7b969f;

    font-size: 25px;
}

.closure-empty h4 {
    margin: 0;

    color: #526770;

    font-size: 17px;
    font-weight: 700;
}

.closure-empty p {
    max-width: 320px;

    margin: 7px auto 0;

    color: #87999f;

    font-size: 13px;

    line-height: 1.6;
}

.reviewed-body::-webkit-scrollbar,
.business-record-list::-webkit-scrollbar {
    width: 6px;
}

.reviewed-body::-webkit-scrollbar-track,
.business-record-list::-webkit-scrollbar-track {
    background: #f4f7f8;
}

.reviewed-body::-webkit-scrollbar-thumb,
.business-record-list::-webkit-scrollbar-thumb {
    background: #c5d5d9;

    border-radius: 10px;
}

.reviewed-body::-webkit-scrollbar-thumb:hover,
.business-record-list::-webkit-scrollbar-thumb:hover {
    background: #9eb5bb;
}

.closure-confirm-overlay {
    position: fixed;

    inset: 0;

    z-index: 9999;

    display: none;

    align-items: center;
    justify-content: center;

    background: rgba(0, 0, 0, .35);

    padding: 20px;

    opacity: 0;

    transition: opacity .2s ease;

    box-sizing: border-box;
}

.closure-confirm-overlay.show {
    display: flex;
    opacity: 1;
}
.closure-confirm-modal {
    width: 100%;
    max-width: 560px;
    background: #ffffff;
    border: 1px solid #e3e3e3;
    border-radius: 8px;
    padding: 42px 45px 30px;
    text-align: center;
    box-shadow:
        0 10px 35px rgba(0, 0, 0, .18);
    transform: scale(.92);
    transition: transform .2s ease;
    box-sizing: border-box;
}
.closure-confirm-overlay.show .closure-confirm-modal {
    transform: scale(1);
}
.closure-confirm-icon {
    width: 130px;
    height: 130px;
    margin: 0 auto 32px;
    border: 7px solid #f9b36c;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #f5aa63;
    font-size: 90px;
    font-family: Arial, sans-serif;
    font-weight: 400;
    line-height: 1;
}
.closure-confirm-modal h2 {
    margin: 0 0 15px;
    color: #444444;
    font-size: 36px;
    font-weight: 600;
}
.closure-confirm-modal p {
    margin: 0 auto 20px;
    max-width: 470px;
    color: #777777;
    font-size: 15px;
    line-height: 1.6;
}
.closure-selected-summary {
    display: flex;
    flex-direction: column;
    gap: 5px;
    margin: 0 auto 30px;
    padding: 14px 18px;
    max-width: 390px;
    background: #f5f9fa;
    border-radius: 9px;
    box-sizing: border-box;
}

.closure-selected-summary strong {
    color: #294650;
    font-size: 14px;
}

.closure-selected-summary span {
    color: #87979d;
    font-size: 12px;
}

.closure-confirm-actions {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
}

.closure-confirm-actions button {
    min-width: 170px;
    height: 50px;

    border: 0;

    border-radius: 7px;

    font-size: 14px;
    font-weight: 600;

    cursor: pointer;

    transition: all .15s ease;
}

.closure-confirm-cancel {
    background: #bdbdbd;
    color: #ffffff;
}

.closure-confirm-cancel:hover {
    background: #a9a9a9;
}

.closure-confirm-delete {
    background: #ed604e;
    color: #ffffff;
}

.closure-confirm-delete:hover {
    background: #dc5140;
}

.closure-confirm-actions button:active {
    transform: scale(.97);
}
@media (max-width: 1200px) {
    .closure-page {
        padding: 25px 22px 45px;
    }
    .closure-header {
        padding: 25px 28px;
    }
    .closure-header h1 {
        font-size: 32px;
    }
    .closure-header p {
        font-size: 15px;
    }
    .closure-layout {
        grid-template-columns:
            minmax(0, 1fr)
            minmax(0, .85fr);
    }
    .closure-fields-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }
}
@media (max-width: 992px) {
    .closure-page {
        padding: 22px 18px 40px;
    }
    .closure-header {
        padding: 24px;
    }
    .closure-header-left {
        gap: 15px;
    }
    .closure-header-icon {
        width: 55px;
        height: 55px;
        font-size: 34px;
    }
    .closure-header h1 {
        font-size: 30px;
    }
    .closure-header p {
        font-size: 14px;
    }
    .closure-badge {
        padding: 11px 15px;
        font-size: 13px;
    }
    .closure-layout {
        grid-template-columns: 1fr;
    }
    .closure-reviewed-card {
        position: static;
    }
    .reviewed-body {
        max-height: 600px;
    }
}
@media (max-width: 768px) {
    .closure-page {
        padding: 18px 14px 35px;
    }
    .closure-header {
        padding: 22px;
        flex-direction: column;
        align-items: flex-start;
        gap: 18px;
        border-radius: 15px;
    }
    .closure-header-left {
        width: 100%;
        align-items: flex-start;
    }
    .closure-header-icon {
        width: 48px;
        height: 48px;
        font-size: 30px;
    }
    .closure-eyebrow {
        font-size: 12px;
    }
    .closure-header h1 {
        font-size: 27px;
    }
    .closure-header p {
        font-size: 14px;
        line-height: 1.5;
    }
    .closure-badge {
        width: 100%;
        box-sizing: border-box;
        justify-content: center;
        font-size: 12px;
    }
    .closure-notice {
        padding: 15px;
        gap: 11px;
    }
    .notice-icon {
        width: 36px;
        height: 36px;
        min-width: 36px;
        font-size: 16px;
    }
    .closure-notice strong {
        font-size: 14px;
    }
    .closure-notice p {
        font-size: 13px;
        line-height: 1.6;
    }
    .closure-card-header {
        padding: 17px;
        gap: 10px;
        align-items: flex-start;
    }
    .closure-section-icon {
        width: 38px;
        height: 38px;
        min-width: 38px;
        font-size: 17px;
    }
    .closure-card-header h3 {
        font-size: 16px;
    }
    .closure-card-header p {
        font-size: 12px;
    }
    .business-count {
        font-size: 13px;
        padding: 6px 9px;
    }
    .business-count span {
        font-size: 10px;
    }
    .business-record-search {
        padding: 13px 15px;
    }
    .record-search-box input {
        height: 44px;
        font-size: 13px;
    }
    .business-record {
        padding: 15px;
        gap: 10px;
        align-items: flex-start;
    }
    .business-record.selected {
        padding-left: 11px;
    }
    .business-record-icon {
        width: 40px;
        height: 40px;
        min-width: 40px;
        font-size: 17px;
    }
    .business-record-info h4 {
        font-size: 14px;
        white-space: normal;
    }
    .business-record-meta {
        gap: 7px;
    }
    .business-record-meta span {
        font-size: 11px;
    }
    .business-record-address {
        font-size: 11px;
        white-space: normal;
    }
    .business-record-status {
        display: none;
    }
    .closure-card-body {
        padding: 18px;
    }
    .closure-fields-grid {
        grid-template-columns: 1fr;
        gap: 17px;
    }
    .closure-field-full {
        grid-column: auto;
    }
    .closure-label {
        font-size: 13px;
    }
    .closure-input,
    .current-status-box {
        height: 45px;
        min-height: 45px;
        font-size: 13px;
    }
    .current-status-box span {
        font-size: 13px;
    }
    .closure-file-label {
        align-items: flex-start;
        flex-wrap: wrap;
        min-height: auto;
        padding: 16px;
    }
    .closure-file-content {
        padding-top: 3px;
    }
    .closure-file-content strong {
        font-size: 13px;
        white-space: normal;
        word-break: break-word;
    }
    .closure-file-content span {
        font-size: 11px;
    }
    .closure-file-button {
        width: 100%;
        text-align: center;
        margin-top: 3px;
        font-size: 12px;
    }
    .closure-form-actions {
        flex-direction: column-reverse;
        align-items: stretch;
        gap: 9px;
    }
    .btn-closure-clear,
    .btn-closure-submit {
        width: 100%;
        min-height: 45px;
        font-size: 13px;
    }
    .reviewed-body {
        max-height: none;
        overflow-y: visible;
    }
    .reviewed-item {
        flex-direction: column;
        gap: 13px;
        padding: 18px;
    }
    .reviewed-left {
        width: 100%;
    }
    .reviewed-left h4 {
        font-size: 15px;
    }
    .reviewed-left p {
        font-size: 12px;
        line-height: 1.7;
    }
    .history-reason {
        font-size: 12px;
    }
    .history-reason strong {
        font-size: 12px;
    }
    .closure-document-link {
        font-size: 12px;
    }
    .closure-status {
        align-self: flex-start;
        font-size: 11px;
    }
    .closure-confirm-overlay {
        padding: 15px;
    }
    .closure-confirm-modal {
        max-width: 100%;
        padding: 30px 22px 25px;
    }
    .closure-confirm-icon {
        width: 95px;
        height: 95px;
        border-width: 5px;
        font-size: 65px;
        margin-bottom: 25px;
    }
    .closure-confirm-modal h2 {
        font-size: 28px;
    }
    .closure-confirm-modal p {
        font-size: 14px;
    }
    .closure-confirm-actions {
        flex-direction: column;
        gap: 10px;
    }
    .closure-confirm-actions button {
        width: 100%;
        min-width: 0;
        height: 48px;
    }
}
@media (max-width: 480px) {
    .closure-page {
        padding: 15px 10px 30px;
    }
    .closure-header {
        padding: 18px;
        gap: 15px;
    }
    .closure-header-left {
        gap: 11px;
    }
    .closure-header-icon {
        width: 42px;
        height: 42px;
        font-size: 27px;
    }
    .closure-eyebrow {
        font-size: 11px;
        letter-spacing: 1.2px;
    }
    .closure-header h1 {
        font-size: 24px;
    }
    .closure-header p {
        font-size: 13px;
    }
    .closure-badge {
        font-size: 11px;
        padding: 10px 12px;
    }
    .closure-notice {
        padding: 13px;
    }
    .closure-notice strong {
        font-size: 13px;
    }
    .closure-notice p {
        font-size: 12px;
    }
    .closure-card-header {
        padding: 15px;
    }
    .closure-section-icon {
        width: 35px;
        height: 35px;
        min-width: 35px;
        font-size: 15px;
    }
    .closure-card-header h3 {
        font-size: 14px;
    }
    .closure-card-header p {
        font-size: 11px;
    }
    .business-count {
        padding: 5px 7px;
        font-size: 12px;
    }
    .business-count span {
        display: none;
    }
    .business-record {
        padding: 13px;
    }
    .business-record-icon {
        width: 37px;
        height: 37px;
        min-width: 37px;
        font-size: 16px;
    }
    .business-record-info h4 {
        font-size: 13px;
    }
    .business-record-meta span {
        font-size: 10px;
    }
    .business-record-address {
        font-size: 10px;
    }
    .closure-card-body {
        padding: 15px;
    }
    .closure-label {
        font-size: 12px;
    }
    .closure-input,
    .current-status-box {
        height: 44px;
        min-height: 44px;
        font-size: 12px;
    }
    .current-status-box span {
        font-size: 12px;
    }
    .selected-business-notice {
        font-size: 12px;
    }
    .closure-file-icon {
        width: 44px;
        height: 44px;
        min-width: 44px;
        font-size: 20px;
    }
    .closure-file-content strong {
        font-size: 12px;
    }
    .closure-file-content span {
        font-size: 10px;
    }
    .reviewed-item {
        padding: 15px;
    }
    .reviewed-icon {
        width: 38px;
        height: 38px;
        min-width: 38px;
        font-size: 16px;
    }
    .reviewed-left {
        gap: 10px;
    }
    .reviewed-left h4 {
        font-size: 14px;
    }
    .reviewed-left p {
        font-size: 11px;
    }
    .history-reason {
        font-size: 11px;
    }
    .closure-document-link {
        font-size: 11px;
    }
    .closure-confirm-modal {
        padding: 25px 17px 20px;
    }
    .closure-confirm-icon {
        width: 82px;
        height: 82px;
        font-size: 55px;
        margin-bottom: 20px;
    }
    .closure-confirm-modal h2 {
        font-size: 25px;
    }
    .closure-confirm-modal p {
        font-size: 13px;
    }
    .closure-selected-summary strong {
        font-size: 13px;
    }
    .closure-selected-summary span {
        font-size: 11px;
    }

}

</style>

@endpush

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const businessRecords =
        document.querySelectorAll('.business-record');

    const searchInput =
        document.getElementById('businessRecordSearch');

    const businessId =
        document.getElementById('closureBusinessId');

    const businessName =
        document.getElementById('closureName');

    const ownerName =
        document.getElementById('closureOwner');

    const permitNumber =
        document.getElementById('closurePermit');

    const selectedNotice =
        document.getElementById('selectedBusinessNotice');

    const submitButton =
        document.getElementById('submitClosure');

    const closureForm =
        document.getElementById('closureForm');

    const closureReasonFile = document.getElementById('closureReasonFile');
    const closureFileName = document.getElementById('closureFileName');
    const closureFileSelected = document.getElementById('closureFileSelected');
    const closureSelectedFileName = document.getElementById('closureSelectedFileName');

    const clearButton =
        document.getElementById('clearClosure');

    const closureConfirmModal =
        document.getElementById('closureConfirmModal');

    const closureCancelBtn =
        document.getElementById('closureCancelBtn');

    const closureConfirmBtn =
        document.getElementById('closureConfirmBtn');

    const confirmBusinessName =
        document.getElementById('confirmBusinessName');

    const confirmBusinessOwner =
        document.getElementById('confirmBusinessOwner');

    businessRecords.forEach(function (record) {

        record.addEventListener('click', function () {

            businessRecords.forEach(function (item) {

                item.classList.remove('selected');

            });

            this.classList.add('selected');

            const id =
                this.dataset.id || '';

            const name =
                this.dataset.name || '';

            const owner =
                this.dataset.owner || '';

            const permit =
                this.dataset.permit || '';

            businessId.value = id;

            businessName.value = name;

            ownerName.value = owner;

            permitNumber.value = permit;

            selectedNotice.classList.add('show');

            submitButton.disabled = false;

            document.querySelector('.closure-form-card')
                ?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });

        });

    });

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const search =
                this.value.toLowerCase().trim();
            businessRecords.forEach(function (record) {
                const name =
                    (record.dataset.name || '').toLowerCase();
                const owner =
                    (record.dataset.owner || '').toLowerCase();
                const permit =
                    (record.dataset.permit || '').toLowerCase();
                const matches =
                    name.includes(search) ||
                    owner.includes(search) ||
                    permit.includes(search);

                record.style.display =
                    matches ? 'flex' : 'none';
            });
        });
    }

    if (closureReasonFile) {
        closureReasonFile.addEventListener('change', function () {
            if (this.files && this.files.length > 0) {
                const file = this.files[0];
                const maxSize = 5 * 1024 * 1024;
                const allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];
                const extension = file.name.split('.').pop().toLowerCase();

                if (file.size > maxSize) {
                    alert('The selected file is larger than 5 MB. Please choose a smaller file.');
                    this.value = '';
                    closureFileName.textContent = 'Upload closure document';
                    closureFileSelected.classList.remove('show');
                    closureSelectedFileName.textContent = '';
                    return;
                }

                if (!allowedExtensions.includes(extension)) {
                    alert('Invalid file type. Please upload a PDF, JPG, JPEG, or PNG file.');
                    this.value = '';
                    closureFileName.textContent = 'Upload closure document';
                    closureFileSelected.classList.remove('show');
                    closureSelectedFileName.textContent = '';
                    return;
                }

                closureFileName.textContent = file.name;
                closureSelectedFileName.textContent = file.name;
                closureFileSelected.classList.add('show');
            }
        });
    }

    if (clearButton) {
        clearButton.addEventListener('click', function () {
            setTimeout(function () {
                businessRecords.forEach(function (record) {
                    record.classList.remove('selected');
                });

                businessId.value = '';

                if (closureReasonFile) closureReasonFile.value = '';
                if (closureFileName) closureFileName.textContent = 'Upload closure document';
                if (closureFileSelected) closureFileSelected.classList.remove('show');
                if (closureSelectedFileName) closureSelectedFileName.textContent = '';

                businessName.value = '';

                ownerName.value = '';

                permitNumber.value = '';

                selectedNotice.classList.remove('show');

                submitButton.disabled = true;

            }, 10);

        });

    }

    if (
        closureForm &&
        closureConfirmModal &&
        closureCancelBtn &&
        closureConfirmBtn
    ) {

        closureForm.addEventListener(
            'submit',
            function (event) {

                if (!businessId.value) {

                    event.preventDefault();

                    alert(
                        'Please select an active business record first.'
                    );

                    return;

                }

                event.preventDefault();

                confirmBusinessName.textContent =
                    businessName.value || 'Selected Business';

                confirmBusinessOwner.textContent =
                    ownerName.value || 'Business Owner';


                closureConfirmModal.classList.add('show');

            }
        );
        closureCancelBtn.addEventListener(
            'click',
            function () {

                closureConfirmModal.classList.remove('show');

            }
        );

        closureConfirmBtn.addEventListener(
            'click',
            function () {
                closureConfirmBtn.disabled = true;
                closureConfirmBtn.textContent =
                    'Processing...';
                closureForm.submit();
            }
        );

        closureConfirmModal.addEventListener(
            'click',
            function (event) {
                if (
                    event.target === closureConfirmModal
                ) {
                    closureConfirmModal.classList.remove('show');

                }

            }
        );

        document.addEventListener(
            'keydown',
            function (event) {
                if (
                    event.key === 'Escape' &&
                    closureConfirmModal.classList.contains('show')
                ) {

                    closureConfirmModal.classList.remove('show');

                }
            }
        );
    }
});
</script>

@endpush