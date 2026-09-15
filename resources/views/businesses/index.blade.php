@extends('layouts.app')

@section('title', 'Business Profiling')

@section('content')

<div class="business-page">

    <div class="business-header">
        <div class="business-header-left">
            <div class="business-header-icon">
                <i class="bi bi-buildings"></i>
            </div>
            <div>
                <span class="business-eyebrow">
                    RECORDS
                </span>
                <h1>
                    Business Profiling
                </h1>
                <p>
                    Search, filter, and monitor business registration,
                    payment, location, and compliance details.
                </p>
            </div>
        </div>

        @if(auth()->user()->isTreasurer())
            <a href="{{ route('businesses.create') }}"
               class="btn-new-business">
                <i class="bi bi-plus-circle"></i>
                New Profile
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert custom-success-alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>
                {{ session('success') }}
            </span>
        </div>
    @endif


<div class="business-card filter-card">
    <div class="business-card-header">

        <div class="section-icon">
            <i class="bi bi-search"></i>
        </div>

        <div>
            <h3>Search Businesses</h3>

            <p>
                Search by business name, owner, category, permit number,
                landmark, address, contact, or status.
            </p>
        </div>

    </div>


    <div class="business-card-body">

        <form
            method="GET"
            action="{{ route('businesses.index') }}"
            class="business-search-form"
        >

            <div class="general-search-row">

                <div class="general-search-field">

                    <div class="search-wrapper">

                        <i class="bi bi-search"></i>

                        <input
                            type="search"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control business-input search-input"
                            placeholder="Search business, owner, category, permit, landmark..."
                            autocomplete="off"
                        >
                    </div>
                </div>
                <div class="search-action">
                    <button
                        type="submit"
                        class="btn-apply-filter"
                    >
                        <i class="bi bi-search"></i>
                        <span>Search</span>
                    </button>
                    @if(request()->filled('search'))
                        <a
                            href="{{ route('businesses.index') }}"
                            class="btn-clear-filter"
                        >
                            <i class="bi bi-x-circle"></i>
                            <span>Clear</span>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
    <div class="business-card profiles-card">
        <div class="business-card-header profiles-header">
            <div class="section-icon">
                <i class="bi bi-buildings"></i>
            </div>
            <div>
                <h3>
                    Business Profiles
                </h3>
                <p>
                 @if(request('search'))
                    {{ $businesses->total() }}
                    profile(s) found for
                    <strong>"{{ request('search') }}"</strong>.
                @else
                    {{ $businesses->total() }}
                    registered business profile(s).
                @endif
                </p>
            </div>
        </div>
        <div class="business-table-wrapper">
            <table class="business-table">
                <thead>
                    <tr>
                        <th>BUSINESS</th>
                        <th>OWNER</th>
                        <th>CATEGORY</th>
                        <th>LANDMARK AREA</th>
                        <th>PAYMENT STATUS</th>
                        <th>REGISTRATION</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($businesses as $business)
                        <tr>
                            <td>
                                <div class="business-name">
                                    {{ $business->business_name }}
                                </div>
                                <small class="permit-number">
                                    Permit:
                                    {{ $business->permit_number }}
                                </small>
                            </td>
                            <td>
                                <div class="owner-name">
                                    {{ $business->owner_name }}
                                </div>
                            </td>
                            <td>
                                <span class="category-text">
                                    {{ $business->category }}
                                </span>
                            </td>
                            <td>
                                <div class="landmark-text">
                                    <i class="bi bi-geo-alt"></i>
                                    {{ $business->landmark ?: '—' }}
                                </div>
                            </td>

                            <td>
                                @if($business->payment_status === 'Fully Paid')
                                    <span class="payment-badge payment-paid">
                                        <i class="bi bi-check-circle"></i>
                                        Fully Paid
                                    </span>
                                @elseif($business->payment_status === 'Partially Paid')
                                    <span class="payment-badge payment-partial">
                                        <i class="bi bi-clock"></i>
                                        Partially Paid
                                    </span>
                                @else
                                    <span class="payment-badge payment-unpaid">
                                        <i class="bi bi-exclamation-circle"></i>
                                        Unpaid
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if($business->registration_status === 'Approved')
                                    <span class="registration-badge approved">
                                        {{ $business->registration_status }}
                                    </span>
                                @elseif($business->registration_status === 'Pending')
                                    <span class="registration-badge pending">
                                        {{ $business->registration_status }}
                                    </span>
                                @else
                                    <span class="registration-badge inactive">
                                        {{ $business->registration_status }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a
                                    href="{{ route('businesses.show', $business) }}"
                                    class="btn-view-business"
                                >
                                    <i class="bi bi-eye"></i>
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-business">
                                    <div class="empty-icon">
                                        <i class="bi bi-building-x"></i>
                                    </div>
                                    <h4>
                                        No Business Profiles Found
                                    </h4>
                                    <p>
                                        No business records match your
                                        current search and filters.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($businesses->hasPages())
            <div class="pagination-container">
                {{ $businesses->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
.business-page {
    width: 100%;
    padding: 30px 28px 50px;
    background: #ffffff;
    box-sizing: border-box;
}
.business-header {
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
      0 8px 20px rgba(0, 70, 100, .12);
    margin-bottom: 30px;
}
.business-header-left {
    display: flex;
    align-items: center;
    gap: 20px;
}
.business-header-icon {
    width: 62px;
    height: 62px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 42px;
    color: white;
    flex-shrink: 0;
}
.business-eyebrow {
    display: block;
    color: #bfe9f8;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1.5px;
    margin-bottom: 3px;
}
.business-header h1 {
    margin: 0;
    font-size: 38px;
    font-weight: 700;
    letter-spacing: -.5px;
}
.business-header p {
    margin: 5px 0 0;
    color: #e3f5fc;
    font-size: 17px;
}
.btn-new-business {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #ffffff;
    color: #005679;
    border-radius: 12px;
    padding: 13px 20px;
    text-decoration: none;
    font-size: 15px;
    font-weight: 700;
    border: 1px solid rgba(255,255,255,.5);
    transition: .2s ease;
    white-space: nowrap;
}
.btn-new-business:hover {
    background: #e9f8fc;
    color: #004765;
    transform: translateY(-1px);
}
.custom-success-alert {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #eafaf2;
    border: 1px solid #bcebd0;
    color: #137a47;
    border-radius: 13px;
    padding: 14px 18px;
    margin-bottom: 25px;
}
.business-card {
    width: 100%;
    box-sizing: border-box;
    background: #ffffff;
    border: 1px solid #9ee2fb;
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 26px;
    box-shadow:
        0 8px 20px rgba(0, 70, 100, .06);
}
.business-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 25px 32px;
    border-bottom: 1px solid #d8edf5;
    background: #ffffff;
}
.section-icon {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #005679;
    font-size: 27px;
    flex-shrink: 0;
}
.business-card-header h3 {
    margin: 0;
    color: #004d70;
    font-size: 22px;
    font-weight: 700;
}
.business-card-header p {
    margin: 3px 0 0;
    color: #6e91a3;
    font-size: 14px;
}
.business-card-body {
    width: 100%;
    padding: 28px 32px 30px;
    box-sizing: border-box;
}
.profiles-header {
    padding: 24px 32px;
}
.business-table-wrapper {
    width: 100%;
    overflow-x: auto;
}
.business-table {
    width: 100%;
    min-width: 950px;
    border-collapse: collapse;
    background: #ffffff;
}
.business-table thead {
    background: #f5fbfe;
}
.business-table th {
    padding: 17px 18px;
    color: #315b70;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .5px;
    text-align: left;
    border-bottom: 1px solid #d8edf5;
    white-space: nowrap;
}
.business-table td {
    padding: 18px;
    color: #164c67;
    font-size: 14px;
    vertical-align: middle;
    border-bottom: 1px solid #e6f2f6;
}
.business-table tbody tr {
    transition: background .2s ease;
}
.business-table tbody tr:hover {
    background: #f4fbfe;
}
.business-name {
    color: #003f61;
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 4px;
}
.permit-number {
    color: #7a9bab;
    font-size: 11px;
}
.owner-name {
    color: #164c67;
    font-weight: 500;
}
.category-text {
    color: #164c67;
}
.landmark-text {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #164c67;
}
.landmark-text i {
    color: #0082ad;
}
.filter-card {
    margin-bottom: 26px;
}
.business-search-form {
    width: 100%;
}
.general-search-row {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 14px;
}
.general-search-field {
    flex: 1 1 auto;
    min-width: 0;
}
.search-wrapper {
    position: relative;
    width: 100%;
}
.search-wrapper > i {
    position: absolute;
    left: 17px;
    top: 50%;
    transform: translateY(-50%);
    color: #6da5ba;
    font-size: 17px;
    z-index: 2;
    pointer-events: none;
}
.search-wrapper .search-input {
    width: 100%;
    height: 48px;
    padding: 0 16px 0 46px !important;
    border: 1px solid #b8dfea;
    border-radius: 10px;
    background: #ffffff;
    color: #164c67;
    font-size: 14px;
    box-shadow: none;
    outline: none;
    transition:
        border-color .2s ease,
        box-shadow .2s ease,
        background .2s ease;
}
.search-wrapper .search-input::placeholder {
    color: #8aaebb;
}
.search-wrapper .search-input:hover {
    border-color: #8bcfe4;
}
.search-wrapper .search-input:focus {
    border-color: #00749c;
    background: #ffffff;
    box-shadow:
        0 0 0 3px rgba(0, 116, 156, .10);
}
.search-action {
    display: flex;
    align-items: center;
    gap: 9px;
    flex-shrink: 0;
}
.btn-apply-filter {
    height: 48px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 0 22px;
    border: none;
    border-radius: 10px;
    background: #005f86;
    color: #ffffff;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    white-space: nowrap;
    transition:
        background .2s ease,
        transform .2s ease,
        box-shadow .2s ease;
}
.btn-apply-filter:hover {
    background: #004b69;
    color: #ffffff;
    transform: translateY(-1px);
    box-shadow:
        0 5px 12px rgba(0, 75, 105, .15);
}
.btn-apply-filter:active {
    transform: translateY(0);
}
.btn-clear-filter {
    height: 48px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 0 17px;
    border: 1px solid #a9dff2;
    border-radius: 10px;
    background: #ffffff;
    color: #005679;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
    transition:
        background .2s ease,
        border-color .2s ease,
        color .2s ease;
}

.btn-clear-filter:hover {
    background: #eefaff;
    border-color: #82cde5;
    color: #004765;
}



.search-input:not(:placeholder-shown) {
    color: #003f61;
}



@media (max-width: 768px) {

    .general-search-row {
        flex-direction: column;
        align-items: stretch;
    }

    .general-search-field {
        width: 100%;
    }

    .search-action {
        width: 100%;
    }

    .btn-apply-filter,
    .btn-clear-filter {
        flex: 1;
    }

}
@media (max-width: 576px) {

    .search-action {
        flex-direction: column;
        width: 100%;
    }

    .btn-apply-filter,
    .btn-clear-filter {
        width: 100%;
        flex: none;
    }
}
.payment-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}
.payment-paid {
    background: #d9f8e7;
    color: #13834b;
}
.payment-partial {
    background: #fff0c9;
    color: #b46b00;
}
.payment-unpaid {
    background: #ffe0e0;
    color: #b63b3b;

}
.registration-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 7px 12px;
    border-radius: 20px;
    font-size: 12px
    font-weight: 700;
    white-space: nowrap;
}
.registration-badge.approved {
    background: #d9f8e7;
    color: #13834b;
}
.registration-badge.pending {
    background: #fff0c9;
    color: #b46b00;

}
.registration-badge.inactive {
    background: #eeeeee;
    color: #666666;

}
.btn-view-business {
    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 6px;

    padding: 8px 13px;

    border-radius: 9px;

    background: #eaf8fc;

    border: 1px solid #a8e2f5;

    color: #005c7e;

    text-decoration: none;

    font-size: 13px;

    font-weight: 600;

    transition: all .2s ease;

    white-space: nowrap;

}


.btn-view-business:hover {

    background: #005f86;

    border-color: #005f86;

    color: #ffffff;

}


.empty-business {

    text-align: center;

    padding: 60px 20px;

}


.empty-icon {

    width: 65px;

    height: 65px;

    margin: 0 auto 15px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: #eaf8fc;

    color: #00749c;

    font-size: 28px;

}


.empty-business h4 {

    margin: 0 0 6px;

    color: #004d70;

    font-size: 18px;

}


.empty-business p {

    margin: 0;

    color: #789aaa;

    font-size: 14px;

}


.pagination-container {

    display: flex;

    justify-content: center;

    padding: 22px;

    border-top: 1px solid #e4f0f4;

}



.pagination-container .pagination {

    margin: 0;

    gap: 5px;

}


.pagination-container .page-link {

    border: 1px solid #a9dff2;

    border-radius: 8px !important;

    color: #005c7e;

    background: #ffffff;

    font-size: 13px;

}


.pagination-container .page-link:hover {

    background: #eaf8fc;

    color: #004765;

}


.pagination-container .page-item.active .page-link {

    background: #005f86;

    border-color: #005f86;

    color: #ffffff;

}


@media (max-width: 1200px) {

    .filter-row {

        grid-template-columns:
            minmax(220px, 1.5fr)
            minmax(150px, 1fr)
            minmax(170px, 1fr)
            minmax(150px, 1fr);

        gap: 12px;

    }

    .business-card-body {

        padding-left: 24px;

        padding-right: 24px;

    }

}


@media (max-width: 992px) {

    .filter-row {

        grid-template-columns: repeat(2, 1fr);

        gap: 18px;

    }


    .business-header {

        flex-direction: column;

        align-items: flex-start;

    }


    .btn-new-business {

        align-self: flex-start;

    }

}

@media (max-width: 768px) {

    .business-page {

        padding: 20px 15px 40px;

    }


    .business-header {

        padding: 24px;

        min-height: auto;

    }


    .business-header h1 {

        font-size: 30px;

    }


    .business-header p {

        font-size: 15px;

    }


    .business-card-header {

        padding: 20px;

    }


    .business-card-body {

        padding: 22px;

    }


    .filter-row {

        grid-template-columns: 1fr;

    }


    .filter-actions {

        justify-content: stretch;

    }


    .btn-apply-filter,
    .btn-clear-filter {

        flex: 1;

    }

}
.general-search-row {
    display: flex;
    align-items: flex-end;
    gap: 15px;
    width: 100%;
}

.general-search-field {
    flex: 1;
    min-width: 0;
}

.search-action {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
}

.search-wrapper {
    position: relative;
    width: 100%;
}

.search-wrapper > i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #6da5ba;
    font-size: 16px;
    z-index: 2;
    pointer-events: none;
}

.search-wrapper .search-input {
    padding-left: 43px !important;
}

.btn-apply-filter {
    height: 48px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 0 22px;
    border: none;
    border-radius: 10px;
    background: #005f86;
    color: #ffffff;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all .2s ease;
    white-space: nowrap;
}

.btn-apply-filter:hover {
    background: #004b69;
    color: #ffffff;
}

.btn-clear-filter {
    height: 48px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 0 17px;
    border: 1px solid #9cdef7;
    border-radius: 10px;
    background: #ffffff;
    color: #005679;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: all .2s ease;
    white-space: nowrap;
}

.btn-clear-filter:hover {
    background: #eefaff;
    color: #004765;
}

@media (max-width: 768px) {

    .general-search-row {
        flex-direction: column;
        align-items: stretch;
    }

    .search-action {
        width: 100%;
    }

    .btn-apply-filter,
    .btn-clear-filter {
        flex: 1;
    }
}

@media (max-width: 576px) {

    .search-action {
        flex-direction: column;
    }

    .btn-apply-filter,
    .btn-clear-filter {
        width: 100%;
    }
}
@media (max-width: 576px) {

    .business-header-left {

        align-items: flex-start;

        gap: 12px;

    }


    .business-header-icon {

        width: 45px;

        height: 45px;

        font-size: 30px;

    }


    .business-header h1 {

        font-size: 25px;

    }


    .business-header p {

        font-size: 14px;

    }


    .business-header {

        border-radius: 14px;

    }


    .business-card {

        border-radius: 15px;

    }


    .filter-actions {

        flex-direction: column;

    }


    .btn-apply-filter,
    .btn-clear-filter {

        width: 100%;

    }

}

</style>

@endpush