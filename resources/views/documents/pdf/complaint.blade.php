
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page {
            size: A4;
            margin: 12mm 14mm 13mm 14mm;
        }
        * {
            box-sizing: border-box;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #222;
            font-size: 9px;
            line-height: 1.3;
            margin: 0;
        }
        .head {
            border-bottom: 2px solid #07536c;
            padding-bottom: 7px;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .header-table td {
            vertical-align: middle;
        }

        .header-logo-left {
            width: 18%;
            text-align: left;
        }

        .header-logo-right {
            width: 18%;
            text-align: right;
        }

        .header-center {
            width: 64%;
            text-align: center;
        }

        .header-logo-left img,
        .header-logo-right img {
            width: 68px;
            height: 68px;
            object-fit: contain;
            display: inline-block;
        }

        .head .republic {
            font-size: 8.5px;
            font-weight: bold;
        }

        .head .barangay {
            font-size: 9.5px;
            font-weight: bold;
            margin-top: 2px;
        }

        .head h1 {
            color: #07536c;
            margin: 5px 0 1px;
            font-size: 16px;
            letter-spacing: .4px;
        }

        .head .subtitle {
            font-size: 7.5px;
            color: #666;
        }

        .meta {
            width: 100%;
            margin: 7px 0 8px;
            text-align: right;
            font-size: 8px;
            line-height: 1.4;
        }

        .section {
            margin-top: 7px;
            page-break-inside: avoid;
        }

        .section-title {
            background: #07536c;
            color: #fff;
            padding: 4px 7px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: .3px;
        }

        .section-body {
            border: 1px solid #bbb;
            border-top: none;
            padding: 5px 7px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            width: 50%;
            vertical-align: top;
            padding: 2px 5px;
        }

        .label {
            font-size: 6.5px;
            color: #777;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 1px;
        }

        .value {
            font-size: 8.5px;
            color: #222;
            line-height: 1.3;
        }

        .statement {
            border: 1px solid #bbb;
            padding: 7px;
            min-height: 65px;
            line-height: 1.4;
            text-align: justify;
            white-space: pre-line;
            font-size: 8.5px;
        }

        .small-box {
            border: 1px solid #bbb;
            padding: 5px 7px;
            margin-top: 5px;
        }

        .status {
            display: inline-block;
            border: 1px solid #555;
            padding: 2px 7px;
            font-size: 7px;
            font-weight: bold;
        }

        .declaration {
            margin-top: 8px;
            text-align: justify;
            font-size: 7.5px;
            line-height: 1.4;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 13px;
        }

        .signature-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 0 18px;
        }

        .signature-space {
            height: 17px;
        }

        .signature-line {
            border-top: 1px solid #222;
            padding-top: 3px;
            font-weight: bold;
            font-size: 8px;
        }

        .signature-position {
            font-size: 6.5px;
            color: #666;
            margin-top: 1px;
        }

        .footer {
            position: fixed;
            bottom: -7mm;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 6.5px;
            color: #777;
        }

        .page-number:after {
            content: counter(page);
        }

        .muted {
            color: #777;
        }
    </style>
</head>
<body>

    @php
        $payment = $document->payment ?? null;

        $complainantName =
            $payment->complainant_name
            ?? $document->complainant_name
            ?? $document->requester_name
            ?? 'N/A';
            
        $complainantContact =
            $payment->complainant_contact
            ?? $document->complainant_contact
            ?? 'N/A';

        $respondentName =
            $payment->respondent_name
            ?? $document->respondent_name
            ?? 'N/A';

        $respondentContact =
            $payment->respondent_contact
            ?? $document->respondent_contact
            ?? 'N/A';

        $complaintType =
            $payment->complaint_type
            ?? $document->complaint_type
            ?? 'General Complaint';

        $incidentDate =
            $payment->incident_date
            ?? $document->incident_date
            ?? null;

        $incidentPlace =
            $payment->incident_place
            ?? $document->incident_place
            ?? 'N/A';

        $complaintDescription =
            $payment->complaint_description
            ?? $document->complaint_description
            ?? $document->purpose
            ?? 'No complaint statement provided.';

        $dateFiled =
            $payment->payment_date
            ?? $document->issued_date
            ?? $document->created_at
            ?? now();

        $complaintStatus =
            $document->status
            ?? 'Pending';

        $remarks =
            $payment->remarks
            ?? $document->remarks
            ?? null;

    @endphp

    <div class="head">
        <table class="header-table">
            <tr>
                <td class="header-logo-left">
                    <img
                        src="{{ public_path('images/logo.png') }}"
                        alt="Barangay San Bartolome Logo"
                    >
                </td>
                <td class="header-center">
                    <div class="republic">
                        REPUBLIC OF THE PHILIPPINES
                    </div>
                    <div class="barangay">
                        BARANGAY SAN BARTOLOME • STA. MAGDALENA, SORSOGON
                    </div>

                    <h1>
                        FILING COMPLAINT
                    </h1>

                    <div class="subtitle">
                        OFFICIAL BARANGAY COMPLAINT RECORD
                    </div>

                </td>
                <td class="header-logo-right">

                    <img
                        src="{{ public_path('images/Sta._Magdalena_logo.png') }}"
                        alt="Sta. Magdalena Logo"
                    >

                </td>

            </tr>

        </table>

    </div>


    <div class="meta">
        Document No.:
        <strong>
            {{ $document->document_no ?? 'N/A' }}
        </strong>
        &nbsp;&nbsp; | &nbsp;&nbsp;
        Date Filed:
        <strong>
            {{ \Carbon\Carbon::parse($dateFiled)->format('F d, Y') }}
        </strong>
        &nbsp;&nbsp; | &nbsp;&nbsp;
        Payment Reference:
        <strong>
            {{ $payment->reference_no ?? 'N/A' }}
        </strong>
    </div>

    <div class="section">
        <div class="section-title">
            I. COMPLAINANT INFORMATION
        </div>
        <div class="section-body">
            <table class="info-table">
                <tr>
                    <td>
                        <div class="label">
                            Full Name
                        </div>
                        <div class="value">
                            {{ $complainantName }}
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Contact Number
                        </div>
                        <div class="value">
                            {{ $complainantContact }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="label">
                            Complete Address
                        </div>
                        <div class="value">
                            Barangay San Bartolome, Sta. Magdalena, Sorsogon
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">
            II. RESPONDENT INFORMATION
        </div>
        <div class="section-body">
            <table class="info-table">
                <tr>
                    <td>
                        <div class="label">
                            Name / Business Name
                        </div>
                        <div class="value">
                            {{ $respondentName }}
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Contact Number
                        </div>
                        <div class="value">
                            {{ $respondentContact }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="label">
                            Complete Address
                        </div>
                        <div class="value">
                            N/A
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">
            IV. STATEMENT OF COMPLAINT
        </div>
        <div class="section-body">

            <div class="statement">
                {{ $complaintDescription }}
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">
            V. BARANGAY ACTION / DISPOSITION
        </div>
        <div class="section-body">
            <table class="info-table">
                <tr>
                    <td>
                        <div class="label">
                            Action Taken
                        </div>
                        <div class="value">
                            <span class="muted">
                                No action recorded at the time of filing.
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Remarks
                        </div>
                        <div class="value">
                            @if($remarks)
                                {{ $remarks }}
                            @else
                                <span class="muted">
                                    No additional remarks.
                                </span>
                            @endif
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="declaration">
        I hereby certify that the information contained in this complaint
        record is based on the statement and information provided to the
        Barangay San Bartolome. This document is prepared and maintained
        for official barangay documentation, processing, mediation, and
        case-management purposes.
    </div>

    <table class="signature-table">
        <tr>
            <td>
                <div class="signature-space"></div>
                <div class="signature-line">
                    {{ strtoupper($complainantName) }}
                </div>
                <div class="signature-position">
                    COMPLAINANT
                </div>
            </td>
            <td>
                <div class="signature-space"></div>
                <div class="signature-line">
                    {{ strtoupper($respondentName) }}
                </div>
                <div class="signature-position">
                    RESPONDENT
                </div>
            </td>
        </tr>
    </table>

    <table class="signature-table" style="margin-top: 11px;">
        <tr>
            <td>
                <div class="signature-space"></div>
                <div class="signature-line">
                    {{ $document->issuer->name ?? 'NIKKO G. DE VERA' }}
                </div>
                <div class="signature-position">
                    BARANGAY SECRETARY
                </div>
            </td>
            <td>
                <div class="signature-space"></div>
                <div class="signature-line">
                HON. ARTURO F. FRAYRES
                </div>
                <div class="signature-position">
                    PUNONG BARANGAY
                </div>
            </td>
        </tr>
    </table>

    <div class="footer">
        Generated by REGISTRA — Barangay Management System
        &nbsp; | &nbsp;
        Document No. {{ $document->document_no ?? 'N/A' }}
        &nbsp; | &nbsp;
        Page <span class="page-number"></span>
    </div>

</body>
</html>