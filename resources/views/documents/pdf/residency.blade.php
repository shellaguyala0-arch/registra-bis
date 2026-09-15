
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate of Residency - San Bartolome</title>
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
        .document-content {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        /* =========================================================
           HEADER
           ONLY LOGOS ADDED
        ========================================================== */

        .header-table {
            width: 100%;
            margin-bottom: 8px;
            table-layout: fixed;
        }

        .header-table td {
            vertical-align: middle;
        }

        .seal-cell {
            width: 85px;
            text-align: center;
        }

        .clearance-seal {
            width: 78px;
            height: 78px;
            overflow: hidden;
            background: transparent;
            border: none;
        }

        .clearance-seal img {
            width: 78px;
            height: 78px;
            object-fit: contain;
            display: block;
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

        /* Right logo */
        .right-logo-cell {
            width: 85px;
            text-align: center;
        }

        .right-logo {
            width: 78px;
            height: 78px;
            object-fit: contain;
            display: block;
        }

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

        .residency-content {
            width: 100%;
        }

        .to-whom {
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 10.8px;
        }

        .cert-text {
            margin: 0 0 18px;
            line-height: 1.6;
            text-align: justify;
            text-indent: 40px;
            font-size: 10.5px;
        }

        .cert-text strong {
            font-weight: 700;
        }

        .remarks-row {
            width: 100%;
            margin: 0 0 20px;
            font-weight: 600;
            line-height: 1.4;
            font-size: 10.5px;
            text-align: left;
        }

        .signed-date {
            width: 100%;
            text-align: left;
            font-size: 9.8px;
            font-weight: 700;
            margin-bottom: 40px;
            line-height: 1.55;
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

        .clearance-bottom-space {
            height: 18px;
        }

        .header-table,
        .clearance-title-banner,
        .footer-table {
            page-break-inside: avoid;
        }
    </style>
</head>

<body>

    <div class="document-content">


        <table class="header-table">
            <tr>
                <td class="seal-cell">

                    <div class="clearance-seal">
                        <img
                            src="{{ public_path('images/logo.png') }}"
                            alt="Barangay San Bartolome Logo"
                        >
                    </div>

                </td>
                <td class="heading-cell">
                    <p>
                        Republic of the Philippines
                    </p>
                    <p>
                        Province of Sorsogon
                    </p>
                    <p>
                        Municipality of Santa Magdalena
                    </p>
                    <p class="barangay-name">
                        BARANGAY SAN BARTOLOME
                    </p>
                </td>
                <td class="right-logo-cell">
                    <img
                        src="{{ public_path('images/Sta._Magdalena_logo.png') }}"
                        class="right-logo"
                        alt="Sta. Magdalena Logo"
                    >
                </td>

            </tr>
        </table>


        <div class="clearance-title-banner">
            <h1>
                CERTIFICATE OF RESIDENCY
            </h1>
        </div>


        <div class="residency-content">

            <div class="to-whom">
                TO WHOM IT MAY CONCERN:
            </div>

            <p class="cert-text">
                This is to <strong>CERTIFY</strong> that
                <strong>
                    {{ strtoupper($document->requester_first_name ?? '') }}
                    {{ $document->requester_middle_name
                        ? strtoupper(substr($document->requester_middle_name, 0, 1)) . '.'
                        : ''
                    }}
                    {{ strtoupper($document->requester_last_name ?? '') }},
                </strong>
                of legal age,
                {{ strtolower($document->requester_marital_status ?? '________') }},
                @if(!empty($document->requester_birthdate))
                    born on
                    {{ \Carbon\Carbon::parse($document->requester_birthdate)->format('F d, Y') }},
                @endif
                is a bonafide resident of
                <strong>
                    {{ $document->requester_address
                        ?? 'Barangay San Bartolome, Sta. Magdalena, Sorsogon'
                    }}
                </strong>.
            </p>

            <p class="cert-text">
                This is to certify further that the above-named person and his/her
                family have been residing in this barangay and are known to be of
                good moral character.
            </p>

            <p class="cert-text">
                This certification is being issued upon the request of the above-named
                person for
                <strong>
                    {{ $document->purpose
                        ?? 'whatever legal purpose it may serve'
                    }}
                </strong>
                and for whatever legal purpose/s it may serve him/her best.
            </p>

            <div class="remarks-row">
                <strong>
                    REMARKS:
                </strong>
                {{ $document->remarks ?: 'No Derogatory Record' }}
            </div>

            <div class="signed-date">

                ISSUED THIS

                @if($document->issued_date)

                    {{ \Carbon\Carbon::parse($document->issued_date)->format('jS') }}

                    DAY OF

                    {{ strtoupper(
                        \Carbon\Carbon::parse($document->issued_date)->format('F Y')
                    ) }}

                @else

                    _____ DAY OF __________ 2026

                @endif

                <br>

                AT BARANGAY SAN BARTOLOME,
                STA. MAGDALENA, SORSOGON, PHILIPPINES.

            </div>


            <table class="footer-table">

                <tr>

                    <td class="approval-block">

                        <div class="label">
                            Certified by:
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

                                        {{ \Carbon\Carbon::parse(
                                            $document->payment->payment_date
                                        )->format('F d, Y') }}

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

                                        Php{{ number_format(
                                            (float) $document->payment->amount,
                                            2
                                        ) }}

                                    @endif

                                </td>

                            </tr>

                        </table>

                    </td>

                </tr>

            </table>

            <div class="clearance-bottom-space"></div>

        </div>

    </div>

</body>
</html>
