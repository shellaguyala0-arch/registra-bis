<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Barangay Clearance - San Bartolome</title>

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
    font-size: 10.5px;
}

table {
    border-collapse: collapse;
}

.header-table {
    width: 100%;
    margin-bottom: 8px;
}

.header-table td {
    vertical-align: middle;
}

.seal-cell {
    width: 70px;
    text-align: center;
}

.clearance-seal {
    width: 62px;
    height: 62px;
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
    font-size: 11px;
    line-height: 1.45;
    color: #222;
}

.heading-cell .barangay-name {
    font-size: 15px;
    font-weight: 800;
    margin-top: 3px;
    letter-spacing: .4px;
}

/* =====================================================
   TITLE
===================================================== */

.clearance-title-banner {
    background: #ffd400;
    text-align: center;

    padding: 10px 10mm;

    margin: 10px -10mm 18px -10mm;
}

.clearance-title-banner h1 {
    margin: 0;
    font-size: 21px;
    font-weight: 800;
    letter-spacing: 6px;
    color: #111;
}

/* =====================================================
   MAIN TWO-COLUMN AREA
===================================================== */

.body-table {
    width: 100%;
}

.body-table > tbody > tr > td {
    vertical-align: top;
}

.officials-col {
    width: 180px;
    padding-right: 18px;

    font-size: 8.1px;
    line-height: 1.3;
}

.form-col {
    font-size: 10.5px;
    padding-left: 5px;
}

/* =====================================================
   BARANGAY OFFICIALS
===================================================== */

.official {
    text-align: center;
    margin-bottom: 11px;
}

.official strong {
    display: block;
    font-size: 8.1px;
    line-height: 1.25;
}

.official span {
    display: block;
    color: #333;
    line-height: 1.28;
}

.official-note {
    margin-top: 15px;

    font-size: 7.8px;
    font-weight: 800;
    text-align: center;
    letter-spacing: .3px;
}

.official-validity {
    margin-top: 10px;

    font-size: 7.5px;
    text-align: center;
    color: #333;
    line-height: 1.4;
}

/* =====================================================
   MAIN TEXT
===================================================== */

.to-whom {
    font-weight: 700;
    margin-bottom: 8px;
    font-size: 10.8px;
}

.intro-text {
    margin: 0 0 15px;
    line-height: 1.5;
    text-align: justify;
}

/* =====================================================
   PERSONAL INFORMATION
===================================================== */

.form-grid-table {
    width: 100%;
    margin-bottom: 15px;
}

.form-grid-table td {
    padding: 4px 7px 7px 0;
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
    min-height: 18px;
}

.form-line.static {
    border-bottom: none;
    font-weight: 700;
}

.inline-label {
    font-weight: 600;
    white-space: nowrap;
    width: 45px;
    text-align: right;
    padding-right: 6px;
}

.sex-options {
    font-weight: 700;
}

.checkmark {
    font-family: "DejaVu Sans", sans-serif;
    font-size: 10px;
    font-weight: bold;
}

/* =====================================================
   PURPOSE
===================================================== */

.purpose-table {
    width: 100%;
    margin-bottom: 12px;
}

.purpose-table td {
    padding: 4px 7px 7px 0;
    vertical-align: bottom;
}

/* =====================================================
   REMARKS
===================================================== */

.remarks-row {
    margin-bottom: 17px;
    font-weight: 600;
    line-height: 1.4;
}

/* =====================================================
   CERTIFICATION
===================================================== */

.cert-text {
    margin: 0 0 23px;
    line-height: 1.5;
    text-align: justify;
}

/* =====================================================
   CLAIMANT SIGNATURE
===================================================== */

.signature-block {
    text-align: center;
    margin-bottom: 18px;
}

.signature-line {
    border-bottom: 1px solid #333;
    width: 280px;

    margin: 0 auto 7px;

    height: 25px;
}

.signature-caption {
    font-size: 9.8px;
}

/* =====================================================
   SECRETARY
===================================================== */

.secretary-block {
    text-align: center;
    margin-bottom: 17px;
}

.secretary-block strong {
    display: block;
    font-size: 11.5px;
}

.secretary-block span {
    font-size: 10px;
}

/* =====================================================
   SIGNED DATE
===================================================== */

.signed-date {
    text-align: center;

    font-size: 9.8px;
    font-weight: 700;

    margin-bottom: 22px;

    line-height: 1.55;
}

/* =====================================================
   APPROVAL / PAYMENT
===================================================== */

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
    font-size: 10px;
    font-weight: 700;

    margin-bottom: 21px;
}

.approval-block strong {
    display: block;
    font-size: 11.5px;
}

.approval-block span {
    display: block;
    font-size: 10px;
}

.payment-block {
    padding-left: 10px;
}

.payment-block .label {
    font-size: 10px;
    font-weight: 700;

    margin-bottom: 10px;

    text-align: left;
}

.payment-row-table {
    width: 100%;
}

.payment-row-table td {
    font-size: 9.8px;
    font-weight: 600;

    padding-bottom: 9px;
}

.payment-value {
    border-bottom: 1px solid #333;

    text-align: center;

    font-weight: 700;
}

/* =====================================================
   EXTRA BOTTOM SPACE / OFFICIAL FOOTER
===================================================== */

.clearance-bottom-space {
    height: 18px;
}

.document-footer {
    width: 100%;
    margin-top: 12px;
    padding-top: 7px;

    border-top: 1px solid #ddd;

    text-align: center;

    font-size: 7px;
    color: #777;
}

/* =====================================================
   PREVENT DOMPDF BREAKS
===================================================== */

.header-table,
.clearance-title-banner,
.body-table,
.form-grid-table,
.purpose-table,
.footer-table,
.official,
.signature-block,
.secretary-block {
    page-break-inside: avoid;
}
</style>
</head>

<body>
<table class="header-table">
    <tr>
        <td class="seal-cell">
            <div class="clearance-seal">
                <img
                    src="{{ public_path('images/logo.png') }}"
                    alt="Barangay San Bartolome Seal"
                >
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
    <h1>BARANGAY CLEARANCE</h1>
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
        <span>Committee on Womens and Family, Welfare/Human Rights/ Cooperatives Development</span>
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
        This Barangay Clearance is valid for a
        period of 6 months from the date of signing.
    </div>
</td>

<td class="form-col">
    <div class="to-whom">
        TO WHOM IT MAY CONCERN:
    </div>
    <p class="intro-text">
        This is to certify that as per record, the person whose name,
        photo, signature appearing herein has requested a CLEARANCE
        from this office with the following detail/s;
    </p>
    <table class="form-grid-table">
        <tr>
            <td class="form-label">
                Last Name:
            </td>
            <td class="form-line" colspan="3">
                {{ $document->requester_last_name ?? '' }}
            </td>
        </tr>
        <tr>
            <td class="form-label">
                First Name:
            </td>
            <td class="form-line" colspan="3">
                {{ $document->requester_first_name ?? '' }}
            </td>
        </tr>
        <tr>
            <td class="form-label">
                Middle Name:
            </td>
            <td class="form-line" colspan="3">
                {{ $document->requester_middle_name ?? '' }}
            </td>
        </tr>
        <tr>
            <td class="form-label">
                Birthday:
            </td>
            <td class="form-line">
                @if(!empty($document->requester_birthdate))
                    {{ \Carbon\Carbon::parse($document->requester_birthdate)->format('F d, Y') }}
                @endif
            </td>
            <td class="inline-label">
                Age:
            </td>
            <td
                class="form-line"
                style="width:60px;"
            >
                {{ $document->requester_age ?? '' }}
            </td>
        </tr>
        <tr>
            <td class="form-label">
                Sex:
            </td>
            <td class="sex-options" colspan="3">
                (
                @if(strtoupper(trim($document->requester_sex ?? '')) === 'MALE')
                    <span class="checkmark">&#10003;</span>
                @else
                    &nbsp;
                @endif
                )
                MALE
                &nbsp;&nbsp;&nbsp;&nbsp;
                (
                @if(strtoupper(trim($document->requester_sex ?? '')) === 'FEMALE')
                    <span class="checkmark">&#10003;</span>
                @else
                    &nbsp;
                @endif

                )
                FEMALE
            </td>
        </tr>
        <tr>
            <td class="form-label">
                Birthplace:
            </td>
            <td class="form-line" colspan="3">
                {{ $document->requester_birthplace ?? '' }}
            </td>
        </tr>
        <tr>
            <td class="form-label">
                Marital Status:
            </td>
            <td class="form-line">
                {{ $document->requester_marital_status ?? '' }}
            </td>
            <td class="inline-label">
                Blood Type:
            </td>
            <td
                class="form-line"
                style="width:60px;"
            >
                {{ $document->requester_blood_type ?? '' }}
            </td>
        </tr>
        <tr>
            <td class="form-label">
                Citizenship:
            </td>
            <td class="form-line static" colspan="3">
                {{ $document->requester_citizenship ?? 'FILIPINO' }}
            </td>
        </tr>
        <tr>
            <td class="form-label">
                Contact No:
            </td>
            <td class="form-line" colspan="3">
                {{ $document->requester_contact ?? '' }}
            </td>
        </tr>
        <tr>
            <td class="form-label">
                Address:
            </td>
            <td class="form-line static" colspan="3">
                {{ $document->requester_address ?? 'Barangay San Bartolome, Sta. Magdalena, Sorsogon' }}
            </td>
        </tr>
    </table>

    <table class="purpose-table">
        <tr>
            <td class="form-label">
                PURPOSE:
            </td>
            <td class="form-line">
                {{ $document->purpose ?? '' }}
            </td>
        </tr>
    </table>

    <div class="remarks-row">
        <strong>REMARKS:</strong>
        {{ $document->remarks ?: 'No Derogatory Record' }}
    </div>

    <p class="cert-text">
        This certification is issued upon the request of the above
        subject for the purpose stated.
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

            <td class="payment-block">
                <div class="label">
                    Paid under the following
                </div>
                <table class="payment-row-table">

                    <tr>
                        <td>
                            Official Receipt No.:
                        </td>
                        <td
                            class="payment-value"
                            style="width:110px;"
                        >
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            O.R. Date Issued:
                        </td>
                        <td
                            class="payment-value"
                            style="width:110px;"
                        >
                            @if($document->payment?->payment_date)
                                {{ \Carbon\Carbon::parse($document->payment->payment_date)->format('F d, Y') }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Amount Paid:
                        </td>
                        <td
                            class="payment-value"
                            style="width:110px;"
                        >
                            @if(
                                $document->payment &&
                                $document->payment->amount !== null
                            )
                                Php{{ number_format((float) $document->payment->amount, 2) }}
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</td>
</tr>
</table>
<div class="clearance-bottom-space"></div>
</body>
</html>

