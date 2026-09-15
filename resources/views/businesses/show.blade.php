@extends('layouts.app')

@section('title', $business->business_name)

@section('content')

<div class="business-profile-page">
    <div class="profile-header">
        <div class="profile-header-left">

            <div class="profile-header-icon">

                @if($business->owner_photo)
                    <img
                        src="{{ asset($business->owner_photo) }}"
                        alt="Owner Photo"
                        class="header-owner-photo"
                        onclick="openImageModal(
                            '{{ asset($business->owner_photo) }}',
                            'Owner Photo'
                        )"
                    >
                @else
                    <i class="bi bi-person-circle"></i>
                @endif
            </div>
            <div>
                <div class="profile-eyebrow">
                    BUSINESS PROFILE
                </div>
                <h1>
                    {{ $business->owner_name }}
                </h1>
                <p>
                    <i class="bi bi-building"></i>
                    {{ $business->business_name }}
                    <span class="header-divider">•</span>

                    <i class="bi bi-card-text"></i>
                    {{ $business->permit_number }}
                </p>
            </div>
        </div>
        <div class="profile-header-actions">
            @if(auth()->user()->isTreasurer())
                <a
                    href="{{ route('businesses.edit', $business) }}"
                    class="profile-btn profile-btn-light"
                >
                    <i class="bi bi-pencil-square"></i>
                    Edit Profile
                </a>

                <a
                    href="{{ route('payments.create', $business) }}"
                    class="profile-btn profile-btn-primary"
                >
                    <i class="bi bi-credit-card"></i>
                    Record Payment
                </a>
            @endif
        </div>
    </div>
    <div class="profile-status-bar">

        <dv class="status-item">
            <span class="status-label">
                Registration Status
            </span>
            <span class="profile-status
                {{ strtolower($business->registration_status) === 'approved'
                    ? 'status-approved'
                    : 'status-pending' }}">
                {{ $business->registration_status }}
            </span>

        </div>
        <div class="status-item">
            <span class="status-label">
                Payment Status
            </span>
            <span class="profile-status
                @if($business->payment_status === 'Fully Paid')
                    status-paid
                @elseif($business->payment_status === 'Partially Paid')
                    status-partial
                @else
                    status-unpaid
                @endif
            ">
                {{ $business->payment_status }}
            </span>
        </div>
        <div class="status-item">
            <span class="status-label">
                Closure Status
            </span>
            <span class="profile-status status-active">
                {{ $business->closure_status }}
            </span>
        </div>
        <div class="status-item">
            <span class="status-label">
                Registered
            </span>
            <strong class="status-value">
                {{ $business->created_at?->format('M d, Y') ?? '—' }}
            </strong>
        </div>
    </div>
    <div class="profile-layout">
        <div class="profile-main">
            <div class="profile-card">
                <div class="profile-card-header">
                    <div class="profile-section-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>
                    <div>
                        <h3>
                            Business Information
                        </h3>
                        <p>
                            Basic information and registration details.
                        </p>
                    </div>
                </div>
                <div class="profile-card-body">
                    <div class="profile-info-grid">
                        <div class="profile-info-item">

                            <div class="profile-info-label">
                                <i class="bi bi-building"></i>
                                Business Name
                            </div>

                            <div class="profile-info-value">
                                {{ $business->business_name }}
                            </div>

                        </div>

                        <div class="profile-info-item">
                            <div class="profile-info-label">
                                <i class="bi bi-person"></i>
                                Owner Name
                            </div>
                            <div class="profile-info-value">
                                {{ $business->owner_name }}
                            </div>
                        </div>
                        <div class="profile-info-item">
                            <div class="profile-info-label">
                                <i class="bi bi-shop"></i>
                                Business Category
                            </div>
                            <div class="profile-info-value">
                                {{ $business->category }}
                            </div>
                        </div>
                        <div class="profile-info-item">
                            <div class="profile-info-label">
                                <i class="bi bi-telephone"></i>
                                Contact Number
                            </div>
                            <div class="profile-info-value">
                                {{ $business->contact_number ?: '—' }}
                            </div>
                        </div>
                    
                        <div class="profile-info-item">
                            <div class="profile-info-label">
                                <i class="bi bi-envelope"></i>
                                Business Email
                            </div>
                            <div class="profile-info-value">
                                {{ $business->email ?: '—' }}
                            </div>
                        </div>
                        <div class="profile-info-item">
                            <div class="profile-info-label">
                                <i class="bi bi-card-text"></i>
                                Permit Number
                            </div>
                            <div class="profile-info-value">
                                {{ $business->permit_number }}
                            </div>
                        </div>

                        <div class="profile-info-item profile-info-full">
                            <div class="profile-info-label">
                                <i class="bi bi-geo-alt"></i>
                                Business Address
                            </div>
                            <div class="profile-info-value">
                                {{ $business->address }}
                            </div>
                        </div>
                        <div class="profile-info-item profile-info-full">
                            <div class="profile-info-label">
                                <i class="bi bi-person-vcard"></i>
                                Valid ID Type
                            </div>
                            <div class="profile-info-value">
                                {{ $business->valid_id_type ?: '—' }}
                            </div>
                        </div>
                        <div class="profile-info-item profile-info-full">
                            <div class="profile-info-label">
                                <i class="bi bi-person-vcard"></i>
                                Valid ID Number
                            </div>
                            <div class="profile-info-value">
                                {{ $business->valid_id_number ?: '—' }}
                            </div>
                        </div>
                        <div class="profile-info-item profile-info-full">
                            <div class="profile-info-label">
                                <i class="bi bi-card-image"></i>
                                Valid ID Picture
                            </div>
                        @if($business->valid_id_file)
                            <div class="valid-id-display">
                                <img
                                    src="{{ asset($business->valid_id_file) }}"
                                    alt="Valid ID"
                                    onclick="openImageModal(
                                        '{{ asset($business->valid_id_file) }}',
                                        'Valid ID'
                                    )"
                                >
                                <div class="valid-id-caption">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Valid ID uploaded
                                </div>
                            </div>
                        @else
                        <div class="attachment-not-uploaded">
                            <i class="bi bi-card-image"></i>
                            <span>
                                No valid ID picture uploaded.
                            </span>
                            </div>
                        @endif
                        </div>
                        <div class="profile-info-item">
                            <div class="profile-info-label">
                                <i class="bi bi-pin-map"></i>
                                Landmark Reference
                            </div>
                            <div class="profile-info-value">
                                {{ $business->landmark ?: '—' }}
                            </div>
                        </div>
                        <div class="profile-info-item">
                            <div class="profile-info-label">
                                <i class="bi bi-signpost"></i>
                                Location Description
                            </div>
                            <div class="profile-info-value">
                                {{ $business->location_description ?: '—' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-card">
                <div class="profile-card-header">
                    <div class="profile-section-icon financial-icon">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <div>
                        <h3>
                            Fee Assessments & Payments
                        </h3>
                        <p>
                            Financial transactions associated with this business.
                        </p>
                    </div>
                </div>
                <div class="profile-card-body p-0">
                    <div class="table-responsive">
                        <table class="profile-table">
                            <thead>
                                <tr>
                                    <th>
                                        Transaction
                                    </th>
                                    <th>
                                        Assessed
                                    </th>
                                    <th>
                                        Paid
                                    </th>
                                    <th>
                                        Balance
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($business->assessments as $assessment)
                                    <tr>
                                        <td>
                                            <strong>
                                                {{ $assessment->transaction_type }}
                                            </strong>
                                        </td>
                                        <td>
                                            ₱{{ number_format($assessment->assessed_amount, 2) }}
                                        </td>
                                        <td>
                                            ₱{{ number_format($assessment->paid, 2) }}
                                        </td>
                                        <td>
                                            <strong>
                                                ₱{{ number_format($assessment->balance, 2) }}
                                            </strong>
                                        </td>
                                        <td>
                                            @if($assessment->status === 'Fully Paid')
                                                <span class="profile-status status-paid">
                                                    Fully Paid
                                                </span>
                                            @elseif($assessment->status === 'Partially Paid')
                                                <span class="profile-status status-partial">
                                                    Partially Paid
                                                </span>
                                            @else
                                                <span class="profile-status status-unpaid">
                                                    Unpaid
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"  class="profile-empty">
                                            <i class="bi bi-receipt"></i>
                                            <span>
                                                No fee assessments yet.
                                            </span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-sidebar">
            <div class="profile-card financial-card">
                <div class="profile-card-header">
                    <div class="profile-section-icon financial-icon">
                        <i class="bi bi-wallet2"></i>
                    </div>
                    <div>
                        <h3>
                            Financial Profile
                        </h3>
                        <p>
                            Payment summary.
                        </p>
                    </div>
                </div>

                <div class="financial-body">
                    @php
                        $totalAssessed = $business->assessments->sum('assessed_amount');
                        $totalPaid = $business->assessments->sum('paid');
                        $totalBalance = $totalAssessed - $totalPaid;
                        $percentage = $totalAssessed > 0
                            ? min(100, ($totalPaid / $totalAssessed) * 100)
                            : 0;
                    @endphp
                    <div class="financial-item">
                        <span>
                            Total Assessed
                        </span>
                        <strong>
                            ₱{{ number_format($totalAssessed, 2) }}
                        </strong>
                    </div>
                    <div class="financial-item">
                        <span>
                            Total Paid
                        </span>
                        <strong class="paid-value">
                            ₱{{ number_format($totalPaid, 2) }}
                        </strong>
                    </div>
                    <div class="financial-item">
                        <span>
                            Remaining Balance
                        </span>
                        <strong class="balance-value">
                            ₱{{ number_format(max(0, $totalBalance), 2) }}
                        </strong>
                    </div>

                    <div class="payment-progress">
                        <div class="progress-header">
                            <span>
                                Payment Progress
                            </span>
                            <strong>
                                {{ number_format($percentage, 0) }}%
                            </strong>
                        </div>
                        <div class="progress-track">
                            <div
                                class="progress-bar-custom"
                                style="width: {{ $percentage }}%"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile-card">
                <div class="profile-card-header">
                    <div class="profile-section-icon">
                        <i class="bi bi-map"></i>
                    </div>
                    <div>
                        <h3>
                            Location Profile
                        </h3>
                        <p>
                            Business location on the map.
                        </p>
                    </div>
                </div>
                <div class="profile-map-container">
                    <div
                        id="businessMap"
                        class="profile-map"
                    ></div>
                </div>

                <div class="coordinates-box">
                    <div>
                        <span>
                            Latitude
                        </span>
                        <strong>
                            {{ $business->latitude ?? '12.6463' }}
                        </strong>
                    </div>

                    <div>
                        <span>
                            Longitude
                        </span>
                        <strong>
                            {{ $business->longitude ?? '124.1079' }}
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('styles')

<style>
.business-profile-page {
    width: 100%;
    padding: 30px 28px 50px;
    background: #ffffff;
}
.profile-header {
    background: linear-gradient(
        135deg,
        #075374,
        #004b69
    );
    border-radius: 18px;
    padding: 25px 32px;
    min-height: 135px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 25px;
    color: white;
    box-shadow:
        0 8px 20px rgba(0,70,100,.12);
    margin-bottom: 18px;
}
.profile-header-left {
    display: flex;
    align-items: center;
    gap: 18px;
}
.profile-header-icon {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 80px;
    flex-shrink: 0;
    border-radius: 50%;
    overflow: hidden;
}
.profile-eyebrow {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1.5px;
    color: #a9e6fa;
    margin-bottom: 3px;
}
.profile-header h1 {
    margin: 0;
    font-size: 31px;
    font-weight: 700;
}
.profile-header p {
    margin: 5px 0 0;
    color: #dceff6;
    font-size: 15px;
}
.profile-header p i {
    margin-right: 4px;
}
.header-divider {
    margin: 0 8px;
    color: #9bd9ec;
}
.profile-header-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.profile-btn {
    height: 46px;
    padding: 0 18px;
    border-radius: 11px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: .2s ease;
}
.profile-btn-light {
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.25);
    color: white;
}
.profile-btn-light:hover {
    background: rgba(255,255,255,.2);
    color: white;
}
.profile-btn-primary {
    background: #ffffff;
    color: #005679;
}
.profile-btn-primary:hover {
    background: #eaf8fc;
    color: #004b69;
}
.profile-status-bar {
    display: grid;
    grid-template-columns:
        repeat(4, 1fr);
    gap: 15px;
    margin-bottom: 22px;
}
.status-item {
    background: #ffffff;
    border: 1px solid #c9edf8
    border-radius: 13px;
    padding: 15px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}
.status-label {
    color: #6e91a3;
    font-size: 13px;
}
.status-value {
    color: #003f61;
    font-size: 14px;
}
.profile-status {
    display: inline-flex;
    align-items: center;
    padding: 6px 12px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}
.status-approved,
.status-paid {
    background: #d9f8e8;
    color: #087542;
}
.status-partial {
    background: #fff0bd;
    color: #a66500;
}
.status-unpaid {
    background: #ffe1e1;
    color: #a32929;
}
.status-pending {
    background: #fff0bd;
    color: #9a6100;
}
.status-active {
    background: #e0f2fb;
    color: #00658b;
}
.profile-layout {
    display: grid;
    grid-template-columns:
        minmax(0, 1fr)
        390px;
    gap: 24px;
    align-items: start;
}
.profile-main {
    min-width: 0;
}
.profile-sidebar {
    min-width: 0;
}
.profile-card {
    background: #ffffff;
    border: 1px solid #9ee2fb;
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 24px;
    box-shadow:
        0 8px 20px rgba(0,70,100,.06);
}
.profile-card-header {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 21px 25px;
    border-bottom: 1px solid #d8edf5;
}
.profile-section-icon {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #005679;
    font-size: 25px;
}
.financial-icon {
    color: #a86600;
}
.profile-card-header h3 {
    margin: 0;
    color: #004d70;
    font-size: 20px;
    font-weight: 700;
}
.profile-card-header p {
    margin: 3px 0 0;
    color: #6e91a3;
    font-size: 13px;
}
.profile-card-body {
    padding: 26px;
}
.profile-info-grid {
    display: grid;
    grid-template-columns:
        repeat(2, minmax(0, 1fr));
    gap: 18px 25px;
}
.profile-info-item {
    padding: 16px;
    background: #f8fcfe;
    border: 1px solid #dceff6;
    border-radius: 12px;
    min-width: 0;
}
.profile-info-full {
    grid-column: 1 / -1;
}
.profile-info-label {
    color: #6e91a3;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 7px;
}
.profile-info-label i {
    color: #00658b;
    margin-right: 5px;
}
.profile-info-value {
    color: #003f61;
    font-size: 16px;
    font-weight: 600;
    word-break: break-word;
}
.financial-card {
    background: #fffef0;
    border-color: #f0df93;
}
.financial-card .profile-card-header {
    background: #fffdf0;
    border-color: #f3e7a8;
}
.financial-body {
    padding: 22px 24px;
}
.financial-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 13px 0;
    border-bottom: 1px solid #eee6bb;
}
.financial-item:last-of-type {
    border-bottom: 0;
}
.financial-item span {
    color: #745f27;
    font-size: 14px;
}
.financial-item strong {
    color: #594700;
    font-size: 17px;
}
.financial-item .paid-value {
    color: #087542;
}
.financial-item .balance-value {
    color: #a32929;
}
.payment-progress {
    margin-top: 18px;
}
.progress-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    color: #745f27;
    font-size: 13px;
}
.progress-track {
    width: 100%;
    height: 10px;
    background: #eee7b8;
    border-radius: 20px;
    overflow: hidden;
}
.header-owner-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid rgba(255,255,255,.85);
    box-shadow:
        0 5px 15px rgba(0,0,0,.18);
    cursor: pointer;
    transition: .2s ease;
}
.header-owner-photo:hover {
    transform: scale(1.04);
}
.valid-id-display {
    width: 100%;
    margin-top: 5px;
    padding: 15px;
    background: #f5fbfd;
    border: 1px solid #c9e8f2;
    border-radius: 14px;
    text-align: center;
}
.valid-id-display img {
    display: block;
    width: 100%;
    max-width: 650px;
    max-height: 360px;
    margin: 0 auto;
    object-fit: contain;
    border-radius: 9px;
    border: 1px solid #d6eaf1;
    background: white;
    cursor: pointer;
    transition: .2s ease;
}
.valid-id-display img:hover {
    opacity: .9;
    transform: scale(1.01);
}
.valid-id-caption {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    margin-top: 10px;
    color: #087542;
    font-size: 12px;
    font-weight: 600;
}
.valid-id-caption i {
    font-size: 13px;
}
.attachment-not-uploaded {
    min-height: 110px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 7px;
    background: #f8fcfe;
    border: 1px dashed #b9dce8;
    border-radius: 12px;
    color: #7c9aaa;
    font-size: 13px;
}
.attachment-not-uploaded i {
    font-size: 30px;
    color: #a8ccd9;
}
.progress-bar-custom {
    height: 100%;
    background: #18a85b;
    border-radius: 20px;
    transition: width .4s ease;
}
.profile-table {
    width: 100%;
    border-collapse: collapse;
}
.profile-table th {
    padding: 15px 20px;
    background: #f5fbfd;
    color: #426579;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .4px;
    border-bottom: 1px solid #dceff6;
}
.profile-table td {
    padding: 16px 20px;
    color: #164d68;
    font-size: 14px;
    border-bottom: 1px solid #e7f2f6;
}
.profile-table tbody tr:hover {
    background: #f5fbfd;
}
.profile-table td strong {
    color: #003f61;
}
.profile-empty {
    height: 150px;
    text-align: center;
    color: #7c9aaa !important;
}
.profile-empty i {
    display: block;
    font-size: 30px;
    margin-bottom: 8px;
    color: #9bc8d9;
}
.profile-map-container {
    padding: 18px;
}
.profile-map {
    width: 100%;
    height: 330px;
    border-radius: 14px;
    overflow: hidden;
    border: 1px solid #bfe5f2;
}
.coordinates-box {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    padding: 0 18px 18px;
}
.coordinates-box > div {
    padding: 12px;
    background: #f5fbfd;
    border: 1px solid #d8edf5;
    border-radius: 10px;
}
.coordinates-box span {
    display: block;
    color: #6e91a3;
    font-size: 11px;
    margin-bottom: 4px;
}
.coordinates-box strong {
    color: #004d70;
    font-size: 13px;
}
@media (max-width: 1100px) {
    .profile-layout {
        grid-template-columns: 1fr;
    }
    .profile-sidebar {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    .profile-sidebar .profile-card {
        margin-bottom: 0;
    }
}

@media (max-width: 900px) {
    .profile-status-bar {
        grid-template-columns: 1fr 1fr;
    }
    .profile-header {
        align-items: flex-start;
        flex-direction: column;
    }
}
@media (max-width: 700px) {
    .business-profile-page {
        padding: 20px 15px 35px;
    }
    .profile-info-grid {
        grid-template-columns: 1fr;
    }
    .profile-info-full {
        grid-column: auto;
    }
    .profile-sidebar {
        grid-template-columns: 1fr;
    }
    .profile-status-bar {
        grid-template-columns: 1fr;
    }
    .profile-header h1 {
        font-size: 24px;
    }
    .profile-header-actions {
        width: 100%;
    }
    .profile-btn {
        flex: 1;
    }
    .profile-table {
        min-width: 700px;
    }

}

</style>

@endpush
@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const mapElement = document.getElementById('businessMap');

    if (!mapElement) {
        return;
    }

    const businessLat =
        {{ $business->latitude ?? 12.6463 }};

    const businessLng =
        {{ $business->longitude ?? 124.1079 }};

    const map = L.map('businessMap').setView(
        [businessLat, businessLng],
        16
    );

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom: 19,

            attribution:
                '&copy; OpenStreetMap contributors'
        }
    ).addTo(map);


    const marker = L.marker(
        [businessLat, businessLng]
    ).addTo(map);

    marker.bindPopup(`
        <div class="map-popup">
            <div class="map-popup-title">
                {{ addslashes($business->business_name) }}
            </div>

            <div>
                {{ addslashes($business->address) }}
            </div>
        </div>
    `).openPopup();


});

</script>

@endpush