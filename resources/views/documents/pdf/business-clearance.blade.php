<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        * {
            box-sizing: border-box;
        }
        @page {
            size: A4;
            margin: 6mm 0mm 6mm 0mm;
        }
        html,
        body {
            margin: 0 !important;
            padding: 0 10mm !important;
            background: #ffffff !important;
            font-family: "DejaVu Sans", Arial, sans-serif;
            color: #111;
            font-size: 10px;
        }
        table {
            border-collapse: collapse;
        }
        .header-table {
            width: 100%;
            margin-bottom: 7px;
        }
        .header-table td {
            vertical-align: middle;
        }
        .seal-cell {
            width: 68px;
            text-align: center;
        }
        .clearance-seal {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid #0b5e8a;
            overflow: hidden;
            background: #eef7fb;
        }
        .clearance-seal img {
            width: 100%;
            height: 100%;
        }
        .heading-cell {
            text-align: center;
        }
        .heading-cell p {
            margin: 0;
            font-size: 10.5px;
            line-height: 1.4;
            color: #222;
        }
        .heading-cell .barangay-name {
            font-size: 15px;
            font-weight: 800;
            margin-top: 3px;
            letter-spacing: .4px;
        }
        .clearance-title-banner {
            background: #ffd400;
            text-align: center;
            padding: 9px 10mm;
            margin: 9px -10mm 16px -10mm;
        }
        .clearance-title-banner h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 5px;
            color: #111;
        }
        .body-table {
            width: 100%;
        }
        .body-table > tbody > tr > td {
            vertical-align: top;
        }
        .officials-col {
            width: 178px;
            padding-right: 17px;
            font-size: 8px;
            line-height: 1.3;
        }
        .form-col {
            font-size: 10px;
            padding-left: 5px;
        }
        .official {
            text-align: center;
            margin-bottom: 10px;
        }
        .official strong {
            display: block;
            font-size: 8px;
            line-height: 1.25;
        }
        .official span {
            display: block;
            color: #333;
            line-height: 1.25;
        }
        .official-note {
            margin-top: 13px;
            font-size: 7.8px;
            font-weight: 800;
            text-align: center;
            letter-spacing: .3px;
        }
        .official-validity {
            margin-top: 9px;
            font-size: 7.5px;
            text-align: center;
            color: #333;
            line-height: 1.35;
        }
        .to-whom {
            font-weight: 700;
            margin-bottom: 7px;
            font-size: 10.5px;
        }
        .intro-text {
            margin: 0 0 13px;
            line-height: 1.45;
            text-align: justify;
        }
        .form-grid-table {
            width: 100%;
            margin-bottom: 13px;
        }
        .form-grid-table td {
            padding: 4px 6px 6px 0;
            vertical-align: bottom;
        }
        .form-label {
            font-weight: 600;
            white-space: nowrap;
            width: 110px;
        }
        .form-line {
            border-bottom: 1px solid #333;
            font-weight: 600;
            padding-bottom: 2px;
            min-height: 17px;
        }
        .form-line.static {
            border-bottom: none;
            font-weight: 700;
        }
        .inline-label {
            font-weight: 600;
            white-space: nowrap;
            width: 44px;
            text-align: right;
            padding-right: 5px;
        }
        .sex-options {
            font-weight: 700;
        }
        .checkmark {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 10px;
            font-weight: bold;
        }
        .purpose-table {
            width: 100%;
            margin-bottom: 10px;
        }
        .purpose-table td {
            padding: 4px 6px 6px 0;
            vertical-align: bottom;
        }
        .remarks-row {
            margin-bottom: 14px;
            font-weight: 600;
            line-height: 1.35;
        }
        .cert-text {
            margin: 0 0 20px;
            line-height: 1.45;
            text-align: justify;
        }
        .signature-block {
            text-align: center;
            margin-bottom: 15px;
        }
        .signature-line {
            border-bottom: 1px solid #333;
            width: 280px;
            margin: 0 auto 6px;
            height: 23px;
        }
        .signature-caption {
            font-size: 9.5px;
        }
        .secretary-block {
            text-align: center;
            margin-bottom: 14px;
        }
        .secretary-block strong {
            display: block;
            font-size: 11px;
        }
        .secretary-block span {
            font-size: 9.5px;
        }
        .signed-date {
            text-align: center;
            font-size: 9.5px;
            font-weight: 700;
            margin-bottom: 18px;
            line-height: 1.5;
        }
        .footer-table {
            width: 100%;
        }
        .footer-table > tbody > tr > td {
            vertical-align: top;
            width: 50%;
        }
        .approval-block {
            text-align: center;
        }
        .approval-block .label {
            font-size: 9.5px;
            font-weight: 700;
            margin-bottom: 17px;
        }
        .approval-block strong {
            display: block;
            font-size: 11px;
        }
        .approval-block span {
            display: block;
            font-size: 9.5px;
        }
        .payment-block .label {
            font-size: 9.5px;
            font-weight: 700;
            margin-bottom: 9px;
            text-align: left;
        }
        .payment-row-table {
            width: 100%;
        }
        .payment-row-table td {
            font-size: 9.5px;
            font-weight: 600;
            padding-bottom: 8px;
        }
        .payment-value {
            border-bottom: 1px solid #333;
            text-align: center;
            font-weight: 700;
        }
        .document-info {
            width: 100%;
            margin-bottom: 10px;
        }
        .document-info td {
            font-size: 9px;
            padding: 2px 4px;
        }
        .document-info .label {
            font-weight: 700;
            width: 100px;
        }
        .document-info .value {
            border-bottom: 1px solid #333;
            font-weight: 600;
        }
        .business-info-title {
            font-size: 11px;
            font-weight: 800;
            margin: 12px 0 6px;
        }
        .business-info-table {
            width: 100%;
            margin-bottom: 13px;
        }
        .business-info-table td {
            padding: 4px 5px 6px 0;
            vertical-align: bottom;
            font-size: 9.8px;
        }
        .business-info-table .label {
            width: 105px;
            font-weight: 700;
            white-space: nowrap;
        }
        .business-info-table .value {
            border-bottom: 1px solid #333;
            font-weight: 600;
            min-height: 17px;
        }
        .conditions {
            margin-top: 12px;
            font-size: 8.5px;
            line-height: 1.4;
            text-align: justify;
        }
        .conditions p {
            margin: 0 0 5px;
        }
        .system-footer {
            margin-top: 12px;
            text-align: center;
            font-size: 6.5px;
            color: #777;
        }
    </style>
</head>

<body>
    <table class="header-table">
        <tr>
            <td class="seal-cell">
                <div class="clearance-seal">
                    <img src="{{ public_path('images/logo.png') }}" alt="Barangay San Bartolome Seal">
                </div>
            </td>
            <td class="heading-cell">
                <p>Republic of the Philippines</p>
                <p>Province of Sorsogon</p>
                <p>Municipality of Santa Magdalena</p>
                <p class="barangay-name">
                    BARANGAY SAN BARTOLOME
                </p>
            </td>
            <td class="seal-cell"></td>
        </tr>
    </table>

    <div class="clearance-title-banner">
        <h1>BARANGAY BUSINESS CLEARANCE</h1>
    </div>

    <table class="body-table">
        <tr>
            <td class="officials-col">
                <div class="official">
                    <strong>HON. ARTURO F. FRAYRES</strong>
                    <span>Punong Barangay</span>
                </div>

                <div class="official">
                    <strong>KGD. ARNEL F. FUENTES JR.</strong>
                    <span>Barangay Kagawad</span>
                    <span>Committee on Public Works and Infrastructure</span>
                </div>

                <div class="official">
                    <strong>KGD. ELENA F. NIEMO</strong>
                    <span>Barangay Kagawad</span>
                    <span>Committee on Appropriations &amp; Ways and Means</span>
                </div>

                <div class="official">
                    <strong>KGD. ALBINO C. FRADES</strong>
                    <span>Barangay Kagawad</span>
                    <span>Committee on Education</span>
                </div>

                <div class="official">
                    <strong>KGD. RITA F. GABION</strong>
                    <span>Barangay Kagawad</span>
                    <span>Committee on Health &amp; Sanitation</span>
                </div>

                <div class="official">
                    <strong>KGD. EMIL B. NAIRA</strong>
                    <span>Barangay Kagawad</span>
                    <span>Committee on Peace and Order &amp; Public Safety</span>
                </div>

                <div class="official">
                    <strong>KGD. REYNALDO F. FRAYRES</strong>
                    <span>Barangay Kagawad</span>
                    <span>Committee on Agriculture &amp; Environmental Protection</span>
                </div>

                <div class="official">
                    <strong>KGD. GINA R. FUENTES</strong>
                    <span>Barangay Kagawad</span>
                    <span>
                        Committee on Womens and Family,
                        Welfare/Human Rights/Cooperatives Development
                    </span>
                </div>

                <div class="official">
                    <strong>CHRISTIAN DAVE F. NAPOLES</strong>
                    <span>SK Chairman</span>
                    <span>Committee on Youth and Sports Development</span>
                </div>

                <div class="official">
                    <strong>NIKKO G. DE VERA</strong>
                    <span>Barangay Secretary</span>
                </div>

                <div class="official">
                    <strong>FLORA G. FRADES</strong>
                    <span>Barangay Treasurer</span>
                </div>

                <div class="official-note">
                    NOT VALID WITHOUT OFFICIAL SEAL
                </div>

                <div class="official-validity">
                    This Barangay Business Clearance is valid
                    for a period of 6 months from the date of signing.
                </div>
            </td>
            <td class="form-col">
                <div class="to-whom">
                    TO WHOM IT MAY CONCERN:
                </div>
                <p class="intro-text">
                    This is to certify that the
                    <strong>BUSINESS OWNER/OPERATOR / PROPRIETOR</strong>
                    has been cleared of any liabilities and obligations
                    and is granted/permitted to operate business in this barangay.
                </p>
                <p class="intro-text">
                    That the business as applied will not pollute the environment
                    nor affect the health, convenience and safety of our residents.
                </p>
            <p class="intro-text">
                That the Barangay Council has no objection in the proposed
                operation of the said business provided that the applicant
                will follow all Barangay and Municipal laws and Ordinances
                concerning the proper operation of their business.
            </p>
            <p class="cert-text">
                This <strong>BUSINESS CLEARANCE</strong> is issued upon request
                of the interested party in applying or renewing his/her
                business clearance to operate said establishment in compliance
                of Article (4) Section (152) of the 1991 Local Government Code
                of the Philippines and whatever legal purpose this official
                clearance may serve.
            </p>

            <table class="form-grid-table">
                <tr>
                    <td class="form-label">
                        Business Name:
                    </td>
                    <td class="form-line">
                        {{ $document->business->business_name ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="form-label">
                        Business Address:
                    </td>
                    <td class="form-line">
                        {{ $document->business->address ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="form-label">
                        Owner's Name:
                    </td>
                    <td class="form-line">
                        {{ $document->business->owner_name ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="form-label">
                        Owner's Home Address:
                    </td>
                    <td class="form-line">
                        {{ $document->owner_home_address ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="form-label">
                        Business Permit No.:
                    </td>
                    <td class="form-line">
                        {{ $document->business->permit_number ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="form-label">
                        Business Category:
                    </td>
                    <td class="form-line">
                        {{ $document->business->category ?? '' }}
                    </td>
                </tr>
            </table>

            <p class="cert-text">
                <strong>
                    BARANGAY BUSINESS CLEARANCE IS HEREBY GRANTED TO:
                </strong>
            </p>

            <div class="payment-heading">
                Paid under the following:
            </div>

            <table class="payment-table">
                <tr>
                    <td class="payment-label">
                        Official Receipt No.:
                    </td>
                    <td class="payment-value">
                        {{ $document->official_receipt_no ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="payment-label">
                        O.R. Date Issued:
                    </td>
                    <td class="payment-value">
                        @if(!empty($document->or_date_issued))
                            {{ \Carbon\Carbon::parse($document->or_date_issued)->format('F d, Y') }}
                        @elseif($document->payment?->payment_date)
                            {{ \Carbon\Carbon::parse($document->payment->payment_date)->format('F d, Y') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="payment-label">
                        Amount Paid:
                    </td>
                    <td class="payment-value">
                        @if($document->payment && $document->payment->amount !== null)
                            Php{{ number_format((float) $document->payment->amount, 2) }}
                        @elseif(isset($document->amount_paid) && $document->amount_paid !== null)
                            Php{{ number_format((float) $document->amount_paid, 2) }}
                        @endif
                    </td>
                </tr>
            </table>
        
            <p class="cert-text">
                This clearance shall be posted conspicuously at the place
                where the business is/are being conducted and shall be
                presented and/or surrendered to competent authorities upon
                demand.
                <br>
                <strong>
                    NOT TRANSFERABLE AND NOT VALID WITHOUT OFFICIAL SEAL
                    AND BUSINESS CLEARANCE PAYMENT.
                </strong>
                <br>
                In case of closure of business, please notify this barangay
                for further clearance and certification.
                <br>
                <strong>
                    ERASURE AND/OR ALTERATION WILL INVALIDATE THIS CLEARANCE.
                </strong>
            </p>
            <div class="signature-block">
                <div class="signature-line"></div>
                <div class="signature-caption">
                    Signature over Printed Name of Claimant
                </div>
            </div>

            <div class="secretary-block">
                @php
                    $secretaryName = optional($document->issuer)->name
                        ?? 'NIKKO G. DE VERA';
                @endphp
                <strong>
                    {{ strtoupper($secretaryName) }}
                </strong>
                <span>
                    Barangay Secretary
                </span>
            </div>

            <div class="signed-date">
                SIGNED AND SEALED THIS
                @if($document->issued_date)
                    {{ \Carbon\Carbon::parse($document->issued_date)->format('jS') }}
                    DAY OF
                    {{ strtoupper(\Carbon\Carbon::parse($document->issued_date)->format('F Y')) }}
                @else
                    _____ DAY OF __________ 2026
                @endif
                <br>
                AT BARANGAY SAN BARTOLOME,
                STA. MAGDALENA, SORSOGON
            </div>

            <table class="footer-table">
                <tr>
                    <td class="approval-block">
                        <div class="label">
                            Approved by:
                        </div>
                        <strong>
                            HON. ARTURO F. FRAYRES
                        </strong>
                        <span>
                            Punong Barangay
                        </span>
                        <span>
                            Barangay San Bartolome
                        </span>
                    </td>
                    <td class="footer-payment-block">
                        <div class="label">
                            Paid under the following
                        </div>
                        <table class="payment-row-table">
                            <tr>
                                <td>
                                    Official Receipt No.:
                                </td>
                                <td class="payment-value">
                                    {{ $document->official_receipt_no ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    O.R. Date Issued:
                                </td>
                                <td class="payment-value">
                                    @if($document->payment?->payment_date)
                                        {{ \Carbon\Carbon::parse($document->payment->payment_date)->format('F d, Y') }}
                                    @elseif(!empty($document->or_date_issued))
                                        {{ \Carbon\Carbon::parse($document->or_date_issued)->format('F d, Y') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Amount Paid:
                                </td>
                                <td class="payment-value">
                                    @if($document->payment && $document->payment->amount !== null)
                                        Php{{ number_format((float) $document->payment->amount, 2) }}
                                    @elseif(isset($document->amount_paid) && $document->amount_paid !== null)
                                        Php{{ number_format((float) $document->amount_paid, 2) }}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>

                <div class="validity">
                    <strong>BARANGAY BUSINESS CLEARANCE</strong>
                    <br>
                    VALID UNTIL
                    @if($document->valid_until)
                        {{ \Carbon\Carbon::parse($document->valid_until)->format('F d, Y') }}
                    @else
                        DECEMBER 31, 2026
                    @endif
                </div>
            </td>
        </tr>
    </table>
    <div class="system-footer">
        Generated by REGISTRA — Barangay Management System
    </div>
</body>
</html>
