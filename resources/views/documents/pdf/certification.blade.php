```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #222;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        /* =========================================================
           OFFICIAL BARANGAY CERTIFICATE HEADER
        ========================================================== */

        .head {
            width: 100%;
            padding-bottom: 10px;
            border-bottom: 3px solid #07536c;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .header-left,
        .header-center,
        .header-right {
            vertical-align: middle;
        }

        /* ---------------------------------------------------------
           LEFT LOGO
        ---------------------------------------------------------- */

        .header-left {
            width: 20%;
            text-align: left;
            padding-left: 5px;
        }

        /* ---------------------------------------------------------
           CENTER HEADER
        ---------------------------------------------------------- */

        .header-center {
            width: 60%;
            text-align: center;
            padding: 0 5px;
        }

        /* ---------------------------------------------------------
           RIGHT LOGO
        ---------------------------------------------------------- */

        .header-right {
            width: 20%;
            text-align: right;
            padding-right: 5px;
        }

        /* ---------------------------------------------------------
           LOGOS
        ---------------------------------------------------------- */

        .header-logo {
            width: 95px;
            height: 95px;
            object-fit: contain;
        }

        /* ---------------------------------------------------------
           GOVERNMENT HEADER TEXT
        ---------------------------------------------------------- */

        .republic {
            font-size: 11px;
            font-weight: normal;
            letter-spacing: 0.3px;
            margin-bottom: 3px;
        }

        .province {
            font-size: 11px;
            font-weight: normal;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .municipality {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .barangay {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .office {
            font-size: 10px;
            font-weight: normal;
            text-transform: uppercase;
            margin-top: 5px;
        }

        /* ---------------------------------------------------------
           DOCUMENT TITLE
        ---------------------------------------------------------- */

        .document-title {
            margin-top: 12px;
            color: #07536c;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ---------------------------------------------------------
           SMALL DOUBLE DIVIDER
        ---------------------------------------------------------- */

        .header-divider {
            width: 100%;
            border-top: 1px solid #07536c;
            margin-top: 4px;
        }

        /* =========================================================
           DOCUMENT META
        ========================================================== */

        .meta {
            text-align: right;
            margin: 20px 0;
            line-height: 1.6;
        }

        /* =========================================================
           CONTENT
        ========================================================== */

        .content {
            line-height: 1.8;
            margin-top: 30px;
        }

        .cert-text {
            text-align: justify;
            line-height: 1.9;
        }

        .box {
            border: 1px solid #bbb;
            padding: 18px;
            margin-top: 25px;
        }

        /* =========================================================
           SIGNATURE
        ========================================================== */

        .signature {
            margin-top: 70px;
            text-align: center;
        }

        /* =========================================================
           FOOTER
        ========================================================== */

        .footer {
            margin-top: 80px;
            font-size: 9px;
            color: #777;
            text-align: center;
        }

    </style>
</head>

<body>

    <!-- =========================================================
         OFFICIAL BARANGAY HEADER
    ========================================================== -->

    <div class="head">

        <table class="header-table">
            <tr>

                <td class="header-left">

                    <img
                        src="{{ public_path('images/logo.png') }}"
                        class="header-logo"
                        alt="Barangay San Bartolome Logo"
                    >

                </td>
                <td class="header-center">

                    <div class="republic">
                        REPUBLIC OF THE PHILIPPINES
                    </div>

                    <div class="province">
                        PROVINCE OF SORSOGON
                    </div>

                    <div class="municipality">
                        MUNICIPALITY OF SANTA MAGDALENA
                    </div>

                    <div class="barangay">
                        BARANGAY SAN BARTOLOME
                    </div>

                    <div class="office">
                        OFFICE OF THE PUNONG BARANGAY
                    </div>
                    <div class="document-title">
                        {{ strtoupper($document->document_type) }}
                    </div>
                </td>
                <td class="header-right">

                    <img
                        src="{{ public_path('images/Sta._Magdalena_logo.png') }}"
                        class="header-logo"
                        alt="Sta. Magdalena Logo"
                    >

                </td>

            </tr>
        </table>

        <div class="header-divider"></div>

    </div>

    <div class="meta">

        Document No.:
        <strong>{{ $document->document_no }}</strong>

        <br>

        Date Issued:
        {{ $document->issued_date->format('F d, Y') }}

    </div>

    <div class="content">

        TO WHOM IT MAY CONCERN:

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

    </div>
    <div class="signature">
        <strong>
            {{ $document->issuer->name ?? 'NIKKO G. DE VERA' }}
        </strong>

        <br>

        Barangay Secretary

    </div>

    <div class="footer">
        Generated by REGISTRA — Barangay Management System
    </div>

</body>
</html>
