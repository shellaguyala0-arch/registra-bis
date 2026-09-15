@extends('layouts.app')
@section('title', 'Issue Document')
@section('content')

<div class="issue-document-page">
    <div class="issue-header">
        <div class="header-left">
            <div class="header-icon">
                <i class="bi bi-file-earmark-plus"></i>
            </div>
            <div>
                <span class="eyebrow">SECRETARY</span>
                <h1>Issue Clearance / Certificate</h1>
                <p>
                    Generate a formal document for a fully paid business.
                </p>
            </div>
        </div>

        <div class="location-badge">
            <i class="bi bi-geo-alt-fill"></i>
            San Bartolome, Santa Magdalena, Sorsogon
        </div>
    </div>
    <form method="POST" action="{{ route('documents.store') }}">
        @csrf
        <div class="issue-panel">
            <div class="panel-header-custom">
                <div>
                    <span class="panel-eyebrow">
                        DOCUMENT MANAGEMENT
                    </span>
                    <h2>Document Information</h2>
                </div>
                <div class="panel-icon">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
            </div>

            <div class="document-info-bar">
                <div class="info-location">
                    <i class="bi bi-info-circle-fill"></i>
                    <span>
                        Complete the required information below
                    </span>
                </div>
                <span class="required-label">
                    * Required fields
                </span>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="business_id">
                            Business
                            <span>*</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-building input-icon"></i>
                                <select id="business_id" name="business_id" class="custom-input" required>
                                    <option value="">
                                        Select fully paid business
                                    </option>
                                        @foreach($businesses as $b)
                                            <option
                                                value="{{ $b->id }}"
                                                {{ old('business_id') == $b->id ? 'selected' : '' }}
                                            >
                                                {{ $b->business_name }} — {{ $b->owner_name }}
                                            </option>
                                        @endforeach

                                </select>
                            </div>
                            <small>
                                Only fully paid businesses should be selected.
                            </small>
                        </div>
                <div class="form-group">
                    <label for="document_type">
                        Document Type
                        <span>*</span>
                    </label>
                    <div class="input-wrapper">
                        <i class="bi bi-file-earmark-text input-icon"></i>
                        <select
                            id="document_type"
                            name="document_type"
                            class="custom-input"
                            required
                        >

                            <option value="">
                                Select document
                            </option>

                            @foreach($types as $t)

                                <option
                                    value="{{ $t }}"
                                    {{ old('document_type') == $t ? 'selected' : '' }}
                                >
                                    {{ $t }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="form-group">

                    <label for="purpose">
                        Purpose
                    </label>

                    <div class="input-wrapper">

                        <i class="bi bi-chat-left-text input-icon"></i>

                        <input
                            id="purpose"
                            name="purpose"
                            value="{{ old('purpose') }}"
                            class="custom-input"
                            placeholder="Purpose of issuance"
                        >

                    </div>

                </div>

                <div class="form-group">

                    <label for="issued_date">
                        Issued Date
                        <span>*</span>
                    </label>

                    <div class="input-wrapper">

                        <i class="bi bi-calendar3 input-icon"></i>

                        <input
                            type="date"
                            id="issued_date"
                            name="issued_date"
                            value="{{ old('issued_date', now()->toDateString()) }}"
                            class="custom-input"
                            required
                        >

                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="remarks">
                        Remarks
                    </label>
                    <div class="textarea-wrapper">
                        <i class="bi bi-pencil-square textarea-icon"></i>
                        <textarea
                            id="remarks"
                            name="remarks"
                            rows="5"
                            class="custom-textarea"
                            placeholder="Enter any additional remarks or notes..."
                        >{{ old('remarks') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-footer">
            <div class="footer-note">
                <i class="bi bi-shield-check"></i>
                <span>
                    Verify the information before generating the document.
                </span>
            </div>

            <div class="form-actions">
                <a
                    href="{{ route('documents.index') }}"
                    class="cancel-btn"
                >
                    Cancel
                </a>
                <button
                    type="submit"
                    class="generate-btn"
                >
                    <i class="bi bi-file-earmark-pdf"></i>
                    Issue & Generate PDF
                </button>
            </div>
        </div>
    </div>
</form>
</div>

<style>
.issue-document-page {
    width: 100%;
    padding-bottom: 30px;
}
.issue-header {
    background: #102a56;
    border-radius: 18px;
    padding: 27px 30px;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    color: #fff;
    box-shadow: 0 8px 25px rgba(16,42,86,.12);
}
.header-left {
    display: flex;
    align-items: center;
    gap: 17px;
}
.header-icon {
    width: 58px;
    height: 58px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.17);
    font-size: 26px;
}
.issue-header .eyebrow {
    display: block;
    margin-bottom: 4px;
    color: rgba(255,255,255,.68);
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1.5px;
}
.issue-header h1 {
    margin: 0;
    font-size: 27px;
    font-weight: 700;
}
.issue-header p {
    margin: 5px 0 0;
    color: rgba(255,255,255,.73);
    font-size: 13px;
}
.location-badge {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 9px 14px;
    border-radius: 30px;
    background: rgba(255,255,255,.09);
    border: 1px solid rgba(255,255,255,.16);
    color: #fff;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
}
.location-badge i {
    font-size: 13px;
}
.issue-panel {
    background: #fff;
    border: 1px solid #e1e7ef;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 18px rgba(16,42,86,.04);
}
.panel-header-custom {
    padding: 20px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #edf0f4;
}
.panel-eyebrow {
    display: block;
    color: #738096;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1.3px;
}
.panel-header-custom h2 {
    margin: 3px 0 0;
    color: #172b4d;
    font-size: 18px;
    font-weight: 700;
}
.panel-icon {
    width: 39px;
    height: 39px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: #eef4fc;
    color: #1456a0;
    font-size: 17px;
}
.document-info-bar {
    min-height: 51px;
    padding: 11px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #f8fafc;
    border-bottom: 1px solid #edf0f4;
}
.info-location {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #34445b;
    font-size: 12px;
    font-weight: 600;
}
.info-location i {
    color: #1456a0;
}
.required-label {
    color: #8994a5;
    font-size: 10px;
}
.form-body {
    padding: 25px 24px;
}
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 21px 22px;
}
.form-group {
    min-width: 0;
}
.form-group.full-width {
    grid-column: 1 / -1;
}
.form-group label {
    display: block;
    margin-bottom: 7px;
    color: #34445b;
    font-size: 12px;
    font-weight: 700;
}
.form-group label span {
    color: #d14c4c;
}
.form-group small {
    display: block;
    margin-top: 6px;
    color: #8a95a5;
    font-size: 10px;
}
.input-wrapper {
    position: relative;
}
.input-icon {
    position: absolute;
    left: 13px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 2;
    color: #8a97a9;
    font-size: 14px;
    pointer-events: none;
}
.custom-input {
    width: 100%;
    min-height: 43px;
    padding: 10px 13px 10px 39px;
    border: 1px solid #dce3ec;
    border-radius: 9px;
    background: #fff;
    color: #34445b;
    font-size: 12px;
    outline: none;
    transition: .2s ease;
}
.custom-input::placeholder {
    color: #a0aaba;
}
.custom-input:hover {
    border-color: #c9d3df;
}
.custom-input:focus {
    border-color: #4d83bd;
    box-shadow: 0 0 0 3px rgba(20,86,160,.08);
}
select.custom-input {
    cursor: pointer;
    appearance: auto;
}
.textarea-wrapper {
    position: relative;
}
.textarea-icon {
    position: absolute;
    left: 13px;
    top: 14px;
    color: #8a97a9;
    font-size: 14px;
    pointer-events: none;
}
.custom-textarea {
    width: 100%;
    min-height: 120px;
    padding: 11px 13px 11px 39px;
    resize: vertical;
    border: 1px solid #dce3ec;
    border-radius: 9px;
    background: #fff;
    color: #34445b;
    font-size: 12px;
    outline: none;
    transition: .2s ease;
}
.custom-textarea::placeholder {
    color: #a0aaba;
}
.custom-textarea:hover {
    border-color: #c9d3df;
}
.custom-textarea:focus {
    border-color: #4d83bd;
    box-shadow: 0 0 0 3px rgba(20,86,160,.08);
}
.form-footer {
    min-height: 68px;
    padding: 13px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    background: #fafbfd;
    border-top: 1px solid #edf0f4;
}
.footer-note {
    display: flex;
    align-items: center;
    gap: 7px;
    color: #8994a5;
    font-size: 10px;
}
.footer-note i {
    color: #20965a;
    font-size: 14px;
}
.form-actions {
    display: flex;
    align-items: center;
    gap: 9px;
}
.cancel-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 39px;
    padding: 8px 15px;
    border: 1px solid #dce3ec;
    border-radius: 8px;
    background: #fff;
    color: #667387;
    font-size: 11px;
    font-weight: 700;
    text-decoration: none;
    transition: .2s ease;
}
.cancel-btn:hover {
    background: #f3f6f9;
    color: #4c5b70;
}
.generate-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-height: 39px;
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    background: #1456a0;
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
    transition: .2s ease;
}
.generate-btn:hover {
    background: #0f4787;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(20,86,160,.18);
}
.generate-btn i {
    font-size: 13px;
}
@media (max-width: 900px) {
    .issue-header {
        align-items: flex-start;
    }
    .location-badge {
        white-space: normal;
    }
    .form-grid {
        grid-template-columns: 1fr;
    }
    .form-group.full-width {
        grid-column: auto;
    }
}
@media (max-width: 768px) {
    .issue-header {
        padding: 22px;
        flex-direction: column;
        align-items: flex-start;
    }
    .issue-header h1 {
        font-size: 23px;
    }
    .location-badge {
        width: 100%;
    }
    .panel-header-custom {
        padding: 18px;
    }
    .document-info-bar {
        padding: 11px 18px;
    }
    .form-body {
        padding: 20px 18px;
    }
    .form-footer {
        padding: 15px 18px;
        flex-direction: column;
        align-items: stretch;
    }
    .form-actions {
        width: 100%;
    }
    .cancel-btn,
    .generate-btn {
        flex: 1;
    }
}
</style>
@endsection