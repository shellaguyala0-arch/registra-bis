<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>
        {{ $reportTitle }}
    </title>
    <style>
        @page {
            margin: 35px 35px 40px;
        }

        body {
            font-family:
                DejaVu Sans,
                sans-serif;
            color: #222;
            font-size: 10px;
        }
        .header {
            width: 100%;
            text-align: center;
            border-bottom:
                2px solid #075374;
            padding-bottom: 12px;
            margin-bottom: 15px;
        }
        .logo {
            width: 70px;
            height: 70px;
            object-fit: contain;
            margin-bottom: 5px;
        }
        .republic {
            font-size: 9px;
            line-height: 1.5;
        }
        .province {
            font-size: 9px;
            line-height: 1.5;
        }
        .municipality {
            font-size: 9px;
            line-height: 1.5;
        }
        .barangay {
            font-size: 14px;
            font-weight: bold;
            color: #075374;
            margin-top: 2px;
        }
        .address {
            margin-top: 4px;
            font-size: 8.5px;
            color: #555;
        }
        .report-title {
            text-align: center;
            margin: 15px 0;
        }
        .report-title h1 {
            margin: 0;
            font-size: 17px;
            color: #075374;
        }
        .report-title p {
            margin: 4px 0 0;
            font-size: 10px;
            color: #555;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .summary-box {
            width: 50%;
            border:
                1px solid #d5e8ee;
            padding: 8px;
            text-align: center;
            background: #f7fbfc;
        }
        .summary-label {
            display: block;
            font-size: 8px;
            color: #7898a7;
            text-transform: uppercase;
            margin-bottom: 3px;
        }
        .summary-value {
            font-size: 13px;
            font-weight: bold;
            color: #075374;
        }
        .payment-table {
            width: 100%;
            border-collapse: collapse;
        }
        .payment-table th {
            padding: 7px 6px;
            background: #075374;
            color: #ffffff;
            font-size: 8px;
            text-align: left;
            border:
                1px solid #075374;
        }
        .payment-table td {
            padding: 7px 6px;
            border:
                1px solid #dce9ed;
            font-size: 8.5px;
            vertical-align: middle;
        }
        .payment-table tr:nth-child(even) td {
            background: #f8fbfc;
        }
        .amount {
            text-align: right;
            font-weight: bold;
            color: #075374;
        }
        .footer {
            margin-top: 20px;
            padding-top: 8px;
            border-top:
                1px solid #dce9ed;
            text-align: center;
            font-size: 7.5px;
            color: #7898a7;
        }
        .signature-area {
            margin-top: 35px;
            width: 100%;
        }
        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }
        .signature-cell {
            width: 50%;
            text-align: center;
            padding: 10px;
        }
        .signature-line {
            border-bottom:
                1px solid #222;
            width: 160px;
            margin:
                25px auto 5px;
        }
        .signature-label {
            font-size: 8px;
            color: #555;
        }
    </style>
</head>
<body>
<div class="header">

    @php
        $logoPath =
            public_path(
                'images/logo.png'
            );
    @endphp

    @if(file_exists($logoPath))
        <img src="{{ $logoPath }}" class="logo">
    @endif

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
    <div class="address">
        Laboy, San Bartolome,
        Santa Magdalena, Sorsogon, Philippines
    </div>
</div>

<div class="report-title">

    <h1>
        {{ $reportTitle }}
    </h1>
    <p>
        {{ $reportPeriod }}
    </p>
</div>

<table class="summary-table">
    <tr>
        <td class="summary-box">
            <span class="summary-label">
                Total Transactions
            </span>
            <span class="summary-value">
                {{ number_format($totalTransactions) }}
            </span>
        </td>

        <td class="summary-box">
            <span class="summary-label">
                Total Collection
            </span>
            <span class="summary-value">
                ₱{{ number_format($totalCollection, 2) }}
            </span>
        </td>
    </tr>
</table>

<table class="payment-table">
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
                <td>
                    {{ $payment->reference_no }}
                </td>
                <td>
                    {{ $payment->payment_date?->format('M d, Y') }}
                </td>
                <td>
                    {{ $payment->business->business_name ?? 'N/A' }}
                </td>
                <td>
                    {{ $payment->assessment->transaction_type ?? 'N/A' }}
                </td>
                <td class="amount">
                    ₱{{ number_format($payment->amount, 2) }}
                </td>
                <td>
                    {{ $payment->receivedBy->name ?? 'Barangay Treasurer' }}
                </td>
            </tr>
        @empty
            <tr>
                <td
                    colspan="6"
                    style="text-align:center;padding:20px;"
                >
                    No payment transactions found.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="signature-area">
    <table class="signature-table">
        <tr>
            <td class="signature-cell">
                <div class="signature-line"></div>
                <div class="signature-label">
                    Prepared by
                </div>
                <strong>
                    Barangay Treasurer
                </strong>
            </td>
            <td class="signature-cell">
                <div class="signature-line"></div>
                <div class="signature-label">
                    Certified Correct
                </div>
                <strong>
                    Punong Barangay
                </strong>
            </td>
        </tr>
    </table>
</div>

<div class="footer">
    Generated by REGISTRA Barangay Management System
    &nbsp; | &nbsp;
    {{ now()->format('F d, Y h:i A') }}
</div>

</body>
</html>