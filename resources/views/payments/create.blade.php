@extends('layouts.app')

@section('title', 'Fee Assessment & Registration')

@section('content')

@if(session('success'))
    <div class="payment-alert payment-alert-success">
        <div class="payment-alert-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="payment-alert-content">
            <strong>Payment recorded successfully!</strong>
            <span>
                {{ session('success') }}
            </span>
        </div>
        <button
            type="button"
            class="payment-alert-close"
            onclick="this.parentElement.remove()"
        >
            ×
        </button>

    </div>
@endif
@if(session('error'))
    <div class="payment-alert payment-alert-error">
        <div class="payment-alert-icon">
            <i class="bi bi-x-circle-fill"></i>
        </div>
        <div class="payment-alert-content">
            <strong>Payment was not recorded.</strong>
            <span>
                {{ session('error') }}
            </span>
        </div>
        <button
            type="button"
            class="payment-alert-close"
            onclick="this.parentElement.remove()"
        >
            ×
        </button>

    </div>
@endif


@if($errors->any())
    <div class="payment-alert payment-alert-error">
        <div class="payment-alert-icon">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div class="payment-alert-content">
            <strong>Please correct the following:</strong>
            @foreach($errors->all() as $error)
                <span>{{ $error }}</span>
            @endforeach
        </div>
        <button
            type="button"
            class="payment-alert-close"
            onclick="this.parentElement.remove()"
        >
            ×
        </button>
    </div>
@endif

<div class="fee-page">
    <div class="page-header">
        <div class="header-icon">
            <i class="bi bi-receipt-cutoff"></i>
        </div>
        <div class="header-text">
            <h1>Fee Assessment & Registration</h1>
            <p>
                Select a transaction type and record the applicable barangay fee.
            </p>
        </div>

        <div class="header-badge">
            <i class="bi bi-shield-check"></i>
            <span>Treasurer Transaction</span>
        </div>
    </div>
    <div class="stepper-card">
        <div class="step active">
            <div class="step-circle">1</div>
            <div class="step-text">
                <strong>Select Transaction</strong>
                <small>Transaction type</small>
            </div>
        </div>

        <div class="step-line"></div>
        <div class="step">
            <div class="step-circle">2</div>
            <div class="step-text">
                <strong>Input Information</strong>
                <small>Business & details</small>
            </div>
        </div>

        <div class="step-line"></div>
        <div class="step">
            <div class="step-circle">3</div>
            <div class="step-text">
                <strong>Fee Assessment</strong>
                <small>Automatic amount</small>
            </div>
        </div>

        <div class="step-line"></div>
        <div class="step">
            <div class="step-circle">4</div>
            <div class="step-text">
                <strong>Payment Processing</strong>
                <small>Record payment</small>
            </div>
        </div>
        <div class="step-line"></div>
        <div class="step">
            <div class="step-circle">5</div>
            <div class="step-text">
                <strong>Confirmation</strong>
                <small>Transaction complete</small>
            </div>
        </div>
    </div>

    <form
        method="POST"
        action="{{ route('payments.store') }}"
        id="paymentForm"
    >

        @csrf

        <div class="content-card">
            <div class="card-heading">
                <div class="heading-icon">
                    <i class="bi bi-list-check"></i>
                </div>
                <div>
                    <h3>Step 1: Select Transaction Type</h3>
                    <p>
                        Choose the type of transaction to determine the applicable fee.
                    </p>
                </div>
            </div>

            <div class="transaction-grid">
                <label class="transaction-card">
                    <input
                        type="radio"
                        name="transaction_type"
                        value="Business Clearance"
                        @checked(old('transaction_type') === 'Business Clearance')
                    >
                    <div class="transaction-icon">
                        <i class="bi bi-building-check"></i>
                    </div>
                    <div class="transaction-content">
                        <strong>Business Clearance</strong>
                        <span>
                            Business registration and clearance
                        </span>
                    </div>

                    <div class="transaction-check">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>

                </label>

                <label class="transaction-card">
                    <input
                        type="radio"
                        name="transaction_type"
                        value="Signboard Tax"
                        @checked(old('transaction_type') === 'Signboard Tax')
                    >

                    <div class="transaction-icon">
                        <i class="bi bi-tag"></i>
                    </div>

                    <div class="transaction-content">

                        <strong>Signboard Tax</strong>

                        <span>
                            Tax on signs, signboards and billboards
                        </span>

                    </div>

                    <div class="transaction-check">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>

                </label>

                <label class="transaction-card">

                    <input
                        type="radio"
                        name="transaction_type"
                        value="Commercial Breeding Tax"
                        @checked(old('transaction_type') === 'Commercial Breeding Tax')
                    >

                    <div class="transaction-icon">
                        <i class="bi bi-activity"></i>
                    </div>
                    <div class="transaction-content">
                        <strong>Commercial Breeding Tax</strong>
                        <span>
                            Tax on commercial breeding
                        </span>
                    </div>
                    <div class="transaction-check">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </label>
                <label class="transaction-card">
                    <input
                        type="radio"
                        name="transaction_type"
                        value="Covered Court Fee"
                        @checked(old('transaction_type') === 'Covered Court Fee')
                    >
                    <div class="transaction-icon">
                        <i class="bi bi-calendar-event"></i>
                    </div>

                    <div class="transaction-content">
                        <strong>Covered Court Fee</strong>
                        <span>
                            Court usage for events
                        </span>
                    </div>
                    <div class="transaction-check">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </label>
                <label class="transaction-card">

                    <input
                        type="radio"
                        name="transaction_type"
                        value="Filing Complaint"
                        @checked(old('transaction_type') === 'Filing Complaint')
                    >

                    <div class="transaction-icon">
                        <i class="bi bi-file-text"></i>
                    </div>

                    <div class="transaction-content">

                        <strong>Filing Complaint</strong>

                        <span>
                            Fee for filing a formal complaint
                        </span>

                    </div>

                    <div class="transaction-check">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>

                </label>

                <label class="transaction-card">

                    <input
                        type="radio"
                        name="transaction_type"
                        value="Certification Fee"
                        @checked(old('transaction_type') === 'Certification Fee')
                    >

                    <div class="transaction-icon">
                        <i class="bi bi-award"></i>
                    </div>

                    <div class="transaction-content">

                        <strong>Certification Fee</strong>

                        <span>
                            Barangay clearances and certifications
                        </span>

                    </div>

                    <div class="transaction-check">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>

                </label>

            </div>

        </div>

        <div
            class="content-card"
            id="detailsCard"
            style="display:none;"
        >

            <div class="card-heading">

                <div class="heading-icon">
                    <i class="bi bi-ui-checks"></i>
                </div>

                <div>

                    <h3>Step 2: Transaction Details</h3>

                    <p>
                        Select the specific transaction or fee category.
                    </p>

                </div>

            </div>


            <div class="details-body">
                <div
                    class="transaction-details"
                    id="businessClearanceDetails"
                >

                    <label class="form-label">

                        <i class="bi bi-building"></i>

                        Business Clearance Type <span>*</span>

                    </label>

                    <select
                        id="business_clearance_type"
                        class="form-select fee-selector"
                    >

                        <option value="">
                            Select business clearance type
                        </option>

                        <option value="200">Sari-sari Store — ₱200.00</option>
                        <option value="500">Videoke / Resto Bar — ₱500.00</option>
                        <option value="300">Videoke for Rent — ₱300.00</option>
                        <option value="200">Tricycle Operator — ₱200.00</option>
                        <option value="200">Vulcanizing Shop — ₱200.00</option>
                        <option value="1000">Copra Dealer / Buyer — ₱1,000.00</option>
                        <option value="500">Fill Buyer — ₱500.00</option>
                        <option value="1000">General Merchandise / Enterprise — ₱1,000.00</option>
                        <option value="1000">Hardware — ₱1,000.00</option>
                        <option value="500">Bakery — ₱500.00</option>
                        <option value="200">Eatery — ₱200.00</option>
                        <option value="1000">Resort — ₱1,000.00</option>
                        <option value="300">Fish / Vegetables Vendors — ₱300.00</option>
                        <option value="500">Meat Vendor — ₱500.00</option>
                        <option value="500">Auto Supply / Motorcycle Supply — ₱500.00</option>
                        <option value="1000">Gasoline Station — ₱1,000.00</option>
                        <option value="500">LPG Refilling Station — ₱500.00</option>
                        <option value="100">Livestock Buyer — ₱100.00</option>
                        <option value="500">Computer Shop — ₱500.00</option>
                        <option value="200">Pisonet — ₱200.00</option>
                        <option value="1000">Rizemil — ₱1,000.00</option>
                        <option value="300">Barber Shop — ₱300.00</option>
                        <option value="300">Funeral Parlor — ₱300.00</option>
                        <option value="300">Beauty Parlor — ₱300.00</option>
                        <option value="300">Tailoring Shop — ₱300.00</option>
                        <option value="1000">Private Hospital — ₱1,000.00</option>
                        <option value="1000">Private Cemetery — ₱1,000.00</option>
                        <option value="1000">Lying-in — ₱1,000.00</option>
                        <option value="1000">Cockpit — ₱1,000.00</option>
                        <option value="1000">Furniture — ₱1,000.00</option>
                        <option value="1000">Boarding House / Transient House — ₱1,000.00</option>
                        <option value="1000">Restaurant — ₱1,000.00</option>
                        <option value="1000">Fastfood Chain — ₱1,000.00</option>
                        <option value="1000">Lending Institution — ₱1,000.00</option>
                        <option value="300">Petshop — ₱300.00</option>
                        <option value="200">Junk Shop — ₱200.00</option>
                        <option value="300">Photo Shop — ₱300.00</option>
                        <option value="1000">Private School — ₱1,000.00</option>
                        <option value="1000">Water Refilling Station — ₱1,000.00</option>
                        <option value="1000">Printing Shop — ₱1,000.00</option>
                        <option value="1000">Cell Site — ₱1,000.00</option>
                        <option value="500">Pharmacy — ₱500.00</option>
                        <option value="1000">Fish Trader — ₱1,000.00</option>
                        <option value="1000">Fish Broker — ₱1,000.00</option>
                        <option value="500">Function Hall — ₱500.00</option>
                        <option value="500">Money Transfer — ₱500.00</option>
                        <option value="500">Poultry Supply — ₱500.00</option>
                        <option value="1000">Poultry Farm — ₱1,000.00</option>
                        <option value="300">Ticketing Office for Transport — ₱300.00</option>
                        <option value="500">Laundry Shop — ₱500.00</option>
                        <option value="300">Boutique — ₱300.00</option>
                        <option value="500">Carwash — ₱500.00</option>
                        <option value="500">Massage Parlor — ₱500.00</option>
                        <option value="500">Beerhall — ₱500.00</option>
                        <option value="500">Pawnshop — ₱500.00</option>
                        <option value="1000">Bank — ₱1,000.00</option>
                        <option value="500">Sound System — ₱500.00</option>
                        <option value="300">Welding Shop — ₱300.00</option>
                        <option value="500">Glass / Aluminum Installer — ₱500.00</option>
                        <option value="500">Rent a Car — ₱500.00</option>
                        <option value="1000">Internet Provider — ₱1,000.00</option>
                        <option value="500">Ukay-ukay — ₱500.00</option>
                        <option value="100">STL (Kabo) — ₱100.00</option>
                        <option value="100">Food Vendor / Stalls — ₱100.00</option>

                    </select>

                </div>

                <div
                    class="transaction-details"
                    id="certificationDetails"
                >
                    <label class="form-label">
                        <i class="bi bi-award"></i>
                        Certification / Clearance Type <span>*</span>
                    </label>
                    <select
                        id="certification_type_select"
                        class="form-select fee-selector"
                    >
                        <option value="">
                            Select certification / clearance type
                        </option>
                        <option
                            value="100"
                            data-label="Barangay Clearance"
                        >
                            Barangay Clearance — ₱100.00
                        </option>

                        <option
                            value="100"
                            data-label="Barangay Certification"
                        >
                            Barangay Certification — ₱100.00
                        </option>

                        <option
                            value="100"
                            data-label="Filing Fee Certificate"
                        >
                            Filing Fee Certificate — ₱100.00
                        </option>

                        <option
                            value="100"
                            data-label="Residency"
                        >
                            Residency — ₱100.00
                        </option>

                        <option
                            value="200"
                            data-label="Proof of Income"
                        >
                            Proof of Income — ₱200.00
                        </option>

                        <option
                            value="50"
                            data-label="Barangay ID"
                        >
                            Barangay ID — ₱50.00
                        </option>

                        <option
                            value="100"
                            data-label="Other Barangay Certification"
                        >
                            Other Barangay Certification — ₱100.00
                        </option>

                    </select>


                    <input
                        type="hidden"
                        name="certification_type"
                        id="certification_type"
                        value="{{ old('certification_type') }}"
                    >

                </div>

                <div
                    class="transaction-details"
                    id="complaintDetails"
                >

                    <div class="fixed-fee-box">

                        <div class="fixed-fee-icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>

                        <div>

                            <strong>Filing Complaint</strong>

                            <span>
                                Filing fee per case
                            </span>

                        </div>

                        <b>₱100.00</b>

                    </div>

                </div>



                <div
                    class="transaction-details"
                    id="signboardDetails"
                >

                    <label class="form-label">

                        <i class="bi bi-signpost-2"></i>

                        Sign / Billboard Type <span>*</span>

                    </label>

                    <select
                        id="signboard_type"
                        class="form-select"
                    >

                        <option value="">
                            Select sign / billboard type
                        </option>

                        <option value="200">
                            Single Face — ₱200.00
                        </option>

                        <option value="300">
                            Double Face — ₱300.00
                        </option>

                        <option value="200">
                            Signs / Advertisement — ₱200.00 per square meter
                        </option>

                        <option value="25">
                            Billboard / Professional Sign — ₱25.00 per square meter
                        </option>

                        <option value="200">
                            Advertisement by Vehicle — ₱200.00
                        </option>

                    </select>


                    <div
                        class="mt-3"
                        id="signboardQuantity"
                        style="display:none;"
                    >

                        <label class="form-label">

                            <i class="bi bi-rulers"></i>

                            Number of Square Meters

                        </label>

                        <input
                            type="number"
                            id="signboard_sqm"
                            class="form-control"
                            min="1"
                            step="0.01"
                            placeholder="Enter square meters"
                        >

                        <div class="form-hint">
                            Required for fees charged per square meter.
                        </div>

                    </div>

                </div>
                <div
                    class="transaction-details"
                    id="courtDetails"
                >

                    <label class="form-label">

                        <i class="bi bi-calendar-event"></i>

                        Covered Court Activity <span>*</span>

                    </label>

                    <select
                        id="court_type"
                        class="form-select"
                    >

                        <option value="">
                            Select activity
                        </option>

                        <option value="600">
                            Benefit Dance — ₱600.00
                        </option>

                        <option value="500">
                            Beauty Contest — ₱500.00
                        </option>

                        <option value="1000">
                            Birthday / Wedding / Baptismal — ₱1,000.00
                        </option>

                        <option value="1000">
                            Political Rally — ₱1,000.00
                        </option>

                        <option value="500">
                            Religious Rally — ₱500.00
                        </option>

                        <option value="500">
                            Bingo Social — ₱500.00
                        </option>

                        <option value="hourly">
                            Ball Games — Hourly Rate
                        </option>

                    </select>


                    <div
                        id="courtHourly"
                        class="mt-3"
                        style="display:none;"
                    >

                        <div class="court-hourly-grid">

                            <div>

                                <label class="form-label">
                                    Time
                                </label>

                                <select
                                    id="court_time"
                                    class="form-select"
                                >

                                    <option value="">
                                        Select time
                                    </option>

                                    <option value="500">
                                        Day Time — ₱500.00/hour
                                    </option>

                                    <option value="100">
                                        Night Time — ₱100.00/hour
                                    </option>

                                </select>

                            </div>

                            <div>

                                <label class="form-label">
                                    Number of Hours
                                </label>

                                <input
                                    type="number"
                                    id="court_hours"
                                    class="form-control"
                                    min="1"
                                    step="1"
                                    placeholder="Enter hours"
                                >

                            </div>

                        </div>

                    </div>

                </div>

                {{-- =================================================
     COMMERCIAL BREEDING DETAILS
================================================== --}}

<div
    class="transaction-details"
    id="breedingDetails"
>

    <div class="fixed-fee-box">

        <div class="fixed-fee-icon">
            <i class="bi bi-activity"></i>
        </div>

        <div>

            <strong>Commercial Breeding Tax</strong>

            <span>
                Fixed tax for commercial breeding
            </span>

        </div>

        <b>₱50.00</b>
    </div>
</div>


        <div class="content-card">
            <div class="card-heading">
                <div class="heading-icon">
                    <i class="bi bi-credit-card"></i>
                </div>
                <div>
                    <h3>Step 3: Payment Information</h3>
                    <p>
                        Enter the business and payment information.
                    </p>
                </div>
            </div>


            <div class="payment-body">



                <div
                    class="payment-field"
                    id="businessFieldWrapper"
                >

                    <label class="form-label">

                        <i class="bi bi-building"></i>

                        Business <span>*</span>

                    </label>


                    <div class="business-search-wrapper">

                        <input
                            type="hidden"
                            name="business_id"
                            id="business_id"
                            value="{{ old('business_id') }}"
                        >

                        <div class="business-search-input-wrapper">

                            <i class="bi bi-search business-search-icon"></i>

                            <input
                                type="text"
                                id="businessSearch"
                                class="form-control business-search-input"
                                placeholder="Search business or owner..."
                                autocomplete="off"
                                value=""
                            >

                            <i
                                class="bi bi-chevron-down business-search-arrow"
                                id="businessSearchArrow"
                            ></i>

                        </div>


                        <div
                            class="business-suggestions"
                            id="businessSuggestions"
                        >

                            @foreach($businesses as $b)

                                <div
                                    class="business-suggestion"
                                    data-id="{{ $b->id }}"
                                    data-business="{{ strtolower($b->business_name) }}"
                                    data-owner="{{ strtolower($b->owner_name) }}"
                                    data-label="{{ $b->business_name }} — {{ $b->owner_name }}"
                                >

                                    <div class="business-suggestion-icon">
                                        <i class="bi bi-building"></i>
                                    </div>

                                    <div class="business-suggestion-content">

                                        <strong>
                                            {{ $b->business_name }}
                                        </strong>

                                        <span>
                                            <i class="bi bi-person"></i>
                                            {{ $b->owner_name }}
                                        </span>

                                    </div>

                                    <i class="bi bi-check-circle-fill business-suggestion-check"></i>

                                </div>

                            @endforeach


                            <div
                                class="business-no-results"
                                id="businessNoResults"
                                style="display:none;"
                            >

                                <i class="bi bi-search"></i>

                                <span>
                                    No business found.
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                 <div
                    class="personal-information-wrapper"
                    id="personalInformationCard"
                    style="display:none;"
                >

                    <div class="personal-information-inner">

                        <div class="personal-information-heading">

                            <div class="personal-information-icon">
                                <i class="bi bi-person-vcard"></i>
                            </div>

                            <div>

                                <h4>Personal Information</h4>

                                <p>
                                    Enter the information required for this transaction.
                                </p>

                            </div>

                        </div>


                        <div class="personal-info-grid">

                            <div class="personal-field-wrapper">

                                <label class="form-label">
                                    Last Name <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    name="last_name"
                                    id="last_name"
                                    class="form-control personal-field"
                                    value="{{ old('last_name') }}"
                                    placeholder="Enter last name"
                                >

                            </div>


                            <div class="personal-field-wrapper">

                                <label class="form-label">
                                    First Name <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    name="first_name"
                                    id="first_name"
                                    class="form-control personal-field"
                                    value="{{ old('first_name') }}"
                                    placeholder="Enter first name"
                                >

                            </div>


                            <div class="personal-field-wrapper">

                                <label class="form-label">
                                    Middle Name
                                </label>

                                <input
                                    type="text"
                                    name="middle_name"
                                    id="middle_name"
                                    class="form-control personal-field"
                                    value="{{ old('middle_name') }}"
                                    placeholder="Enter middle name"
                                >

                            </div>


                            <div class="personal-field-wrapper">

                                <label class="form-label">
                                    Birthday <span>*</span>
                                </label>

                                <input
                                    type="date"
                                    name="birthday"
                                    id="birthday"
                                    class="form-control personal-field"
                                    value="{{ old('birthday') }}"
                                >

                            </div>


                            <div class="personal-field-wrapper">

                                <label class="form-label">
                                    Age <span>*</span>
                                </label>

                                <input
                                    type="number"
                                    name="age"
                                    id="age"
                                    class="form-control personal-field"
                                    value="{{ old('age') }}"
                                    min="0"
                                    max="150"
                                    placeholder="Enter age"
                                >

                            </div>


                            <div class="personal-field-wrapper">

                                <label class="form-label">
                                    Sex <span>*</span>
                                </label>

                                <select
                                    name="sex"
                                    id="sex"
                                    class="form-select personal-field"
                                >

                                    <option value="">
                                        Select sex
                                    </option>

                                    <option
                                        value="Male"
                                        @selected(old('sex') === 'Male')
                                    >
                                        Male
                                    </option>

                                    <option
                                        value="Female"
                                        @selected(old('sex') === 'Female')
                                    >
                                        Female
                                    </option>

                                </select>

                            </div>


                            <div class="personal-field-wrapper">

                                <label class="form-label">
                                    Marital Status <span>*</span>
                                </label>

                                <select
                                    name="marital_status"
                                    id="marital_status"
                                    class="form-select personal-field"
                                >

                                    <option value="">
                                        Select marital status
                                    </option>

                                    <option
                                        value="Single"
                                        @selected(old('marital_status') === 'Single')
                                    >
                                        Single
                                    </option>

                                    <option
                                        value="Married"
                                        @selected(old('marital_status') === 'Married')
                                    >
                                        Married
                                    </option>

                                    <option
                                        value="Widowed"
                                        @selected(old('marital_status') === 'Widowed')
                                    >
                                        Widowed
                                    </option>

                                    <option
                                        value="Separated"
                                        @selected(old('marital_status') === 'Separated')
                                    >
                                        Separated
                                    </option>

                                </select>

                            </div>


                            <div class="personal-field-wrapper">

                                <label class="form-label">
                                    Birthplace <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    name="birthplace"
                                    id="birthplace"
                                    class="form-control personal-field"
                                    value="{{ old('birthplace') }}"
                                    placeholder="Enter birthplace"
                                >

                            </div>


                            <div class="personal-field-wrapper">

                                <label class="form-label">
                                    Blood Type
                                </label>

                                <select
                                    name="blood_type"
                                    id="blood_type"
                                    class="form-select"
                                >

                                    <option value="">
                                        Select blood type
                                    </option>

                                    <option value="A+" @selected(old('blood_type') === 'A+')>A+</option>
                                    <option value="A-" @selected(old('blood_type') === 'A-')>A-</option>
                                    <option value="B+" @selected(old('blood_type') === 'B+')>B+</option>
                                    <option value="B-" @selected(old('blood_type') === 'B-')>B-</option>
                                    <option value="AB+" @selected(old('blood_type') === 'AB+')>AB+</option>
                                    <option value="AB-" @selected(old('blood_type') === 'AB-')>AB-</option>
                                    <option value="O+" @selected(old('blood_type') === 'O+')>O+</option>
                                    <option value="O-" @selected(old('blood_type') === 'O-')>O-</option>
                                    <option value="Unknown" @selected(old('blood_type') === 'Unknown')>Unknown</option>

                                </select>

                            </div>


                            <div class="personal-field-wrapper">

                                <label class="form-label">
                                    Citizenship <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    name="citizenship"
                                    id="citizenship"
                                    class="form-control personal-field"
                                    value="{{ old('citizenship', 'FILIPINO') }}"
                                    placeholder="Enter citizenship"
                                >

                            </div>


                            <div class="personal-field-wrapper">

                                <label class="form-label">
                                    Contact No. <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    name="contact_no"
                                    id="contact_no"
                                    class="form-control personal-field"
                                    value="{{ old('contact_no') }}"
                                    placeholder="09XXXXXXXXX"
                                >

                            </div>


                            <div class="personal-field-wrapper">

                                <label class="form-label">
                                    Address <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    name="personal_address"
                                    id="personal_address"
                                    class="form-control personal-field"
                                    value="{{ old('personal_address', 'Barangay San Bartolome, Sta. Magdalena, Sorsogon') }}"
                                    placeholder="Enter complete address"
                                >

                            </div>


                            <div class="personal-field-wrapper personal-field-full">

                                <label class="form-label">
                                    Purpose <span>*</span>
                                </label>

                                <textarea
                                    name="purpose"
                                    id="purpose"
                                    class="form-control personal-field"
                                    rows="3"
                                    placeholder="Enter purpose of certification"
                                >{{ old('purpose') }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>

                <div
                    class="complaint-information-wrapper"
                    id="complaintInformationCard"
                    style="display:none;"
                >

                    <div class="complaint-information-inner">

                        <div class="complaint-information-heading">

                            <div class="complaint-information-icon">
                                <i class="bi bi-chat-left-text"></i>
                            </div>

                            <div>

                                <h4>Complaint Information</h4>

                                <p>
                                    Enter the information required for filing the complaint.
                                </p>

                            </div>

                        </div>


                        <div class="complaint-info-grid">

                            <div class="form-group">

                                <label for="complainant_name">
                                    Complainant Name
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="complainant_name"
                                    id="complainant_name"
                                    class="form-control"
                                    value="{{ old('complainant_name') }}"
                                    placeholder="Enter complainant name"
                                >

                            </div>


                            <div class="form-group">

                                <label for="complainant_contact">
                                    Complainant Contact
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="complainant_contact"
                                    id="complainant_contact"
                                    class="form-control"
                                    value="{{ old('complainant_contact') }}"
                                    placeholder="Enter contact number"
                                >

                            </div>


                            <div class="form-group">

                                <label for="respondent_name">
                                    Respondent Name
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="respondent_name"
                                    id="respondent_name"
                                    class="form-control"
                                    value="{{ old('respondent_name') }}"
                                    placeholder="Enter respondent name"
                                >

                            </div>


                            <div class="form-group">

                                <label for="respondent_contact">
                                    Respondent Contact
                                    <span class="optional">
                                        Optional
                                    </span>
                                </label>

                                <input
                                    type="text"
                                    name="respondent_contact"
                                    id="respondent_contact"
                                    class="form-control"
                                    value="{{ old('respondent_contact') }}"
                                    placeholder="Enter respondent contact number"
                                >

                            </div>


                            <div class="form-group">

                                <label for="complaint_type">
                                    Complaint Type
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="complaint_type"
                                    id="complaint_type"
                                    class="form-control"
                                    value="{{ old('complaint_type') }}"
                                    placeholder="Enter complaint type"
                                >

                            </div>


                            <div class="form-group">

                                <label for="incident_date">
                                    Incident Date
                                    <span class="optional">
                                        Optional
                                    </span>
                                </label>

                                <input
                                    type="date"
                                    name="incident_date"
                                    id="incident_date"
                                    class="form-control"
                                    value="{{ old('incident_date') }}"
                                >

                            </div>


                            <div class="form-group complaint-full-width">

                                <label for="incident_place">
                                    Place of Incident
                                    <span class="optional">
                                        Optional
                                    </span>
                                </label>

                                <input
                                    type="text"
                                    name="incident_place"
                                    id="incident_place"
                                    class="form-control"
                                    value="{{ old('incident_place') }}"
                                    placeholder="Enter where the incident happened"
                                >

                            </div>


                            <div class="form-group complaint-full-width">

                                <label for="complaint_description">
                                    Statement / Description of Complaint
                                    <span class="required">*</span>
                                </label>

                                <textarea
                                    name="complaint_description"
                                    id="complaint_description"
                                    class="form-control"
                                    rows="6"
                                    placeholder="Provide a detailed description of the complaint..."
                                >{{ old('complaint_description') }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="payment-fields-grid">

                    <div class="payment-field">

                        <label class="form-label">

                            <i class="bi bi-cash-stack"></i>

                            Assessed Amount <span>*</span>

                        </label>

                        <div class="money-input">

                            <span>₱</span>

                            <input
                                type="number"
                                id="assessed_amount"
                                name="assessed_amount"
                                min="0.01"
                                step="0.01"
                                value="{{ old('assessed_amount') }}"
                                class="form-control"
                                placeholder="0.00"
                                required
                                readonly
                            >

                        </div>

                        <div class="form-hint">
                            Automatically calculated from the selected fee.
                        </div>

                    </div>


                    <div class="payment-field">

                        <label class="form-label">

                            <i class="bi bi-wallet2"></i>

                            Amount Paid <span>*</span>

                        </label>

                        <div class="money-input">

                            <span>₱</span>

                            <input
                                type="number"
                                min="0"
                                step="0.01"
                                name="paid_amount"
                                id="paid_amount"
                                value="{{ old('paid_amount', 0) }}"
                                class="form-control"
                                placeholder="0.00"
                                required
                            >

                        </div>

                    </div>


                    <div class="payment-field">

                        <label class="form-label">

                            <i class="bi bi-calendar3"></i>

                            Payment Date <span>*</span>

                        </label>

                        <input
                            type="date"
                            name="payment_date"
                            value="{{ old('payment_date', now()->toDateString()) }}"
                            class="form-control"
                            required
                        >

                    </div>


                    <div class="payment-field payment-field-full">

                        <label class="form-label">

                            <i class="bi bi-chat-left-text"></i>

                            Remarks

                        </label>

                        <input
                            type="text"
                            name="remarks"
                            value="{{ old('remarks') }}"
                            class="form-control"
                            placeholder="Optional transaction notes"
                        >

                    </div>

                </div>

            </div>

        </div>


       
        <div class="fee-summary">

            <div class="summary-icon">
                <i class="bi bi-check-circle"></i>
            </div>

            <div class="summary-content">

                <span>
                    Selected Transaction
                </span>

                <strong id="selectedTransaction">
                    No transaction selected
                </strong>

            </div>

            <div class="summary-amount">

                <small>
                    Assessed Fee
                </small>

                <strong id="displayAmount">
                    ₱0.00
                </strong>

            </div>

        </div>


      
        <div class="form-actions">

            <a
                href="{{ route('payments.index') }}"
                class="btn btn-cancel"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="btn btn-record"
            >

                <i class="bi bi-check2-circle"></i>

                Record Payment

            </button>

        </div>

    </form>

</div>

@endsection


@push('styles')

<style>

.fee-page {
    width: 100%;
    max-width: 1600px;
    margin: 0 auto;
    padding: 24px 30px 45px;
    background: #f7fafb;
    min-height: calc(100vh - 70px);
    box-sizing: border-box;
}

.fee-page *,
.fee-page *::before,
.fee-page *::after {
    box-sizing: border-box;
}

.page-header {
    background: linear-gradient(
        135deg,
        #005b87,
        #006d98
    );

    border-radius: 15px;

    padding: 28px 32px;

    display: flex;
    align-items: center;

    gap: 20px;

    color: white;

    box-shadow:
        0 8px 20px rgba(0,77,115,.15);

    margin-bottom: 22px;
}

.header-icon {
    width: 56px;
    height: 56px;

    min-width: 56px;

    border: 1px solid rgba(255,255,255,.35);

    border-radius: 13px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 27px;

    background:
        rgba(255,255,255,.08);
}

.header-text {
    min-width: 0;
}

.page-header h1 {
    font-size: 28px;
    font-weight: 700;

    margin: 0;

    line-height: 1.3;
}

.page-header p {
    margin: 6px 0 0;

    font-size: 15px;

    opacity: .90;

    line-height: 1.5;
}

.header-badge {
    margin-left: auto;

    padding: 11px 18px;

    border-radius: 30px;

    background:
        rgba(255,255,255,.10);

    border:
        1px solid rgba(255,255,255,.2);

    font-size: 14px;

    white-space: nowrap;

    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.stepper-card {
    background: white;

    border: 1px solid #e4ecef;

    border-radius: 15px;

    padding: 20px 27px;

    display: flex;
    align-items: center;

    margin-bottom: 22px;

    box-shadow:
        0 3px 10px rgba(0,0,0,.03);

    width: 100%;
}

.step {
    display: flex;
    align-items: center;

    gap: 11px;

    flex: 1;

    min-width: 0;
}

.step-circle {
    width: 35px;
    height: 35px;

    min-width: 35px;

    border-radius: 50%;

    background: #eef2f4;

    color: #829198;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 14px;

    font-weight: 700;
}

.step.active .step-circle {
    background: #007b83;
    color: white;
}

.step-text {
    min-width: 0;
}

.step strong {
    display: block;

    font-size: 13px;

    color: #344b55;

    white-space: nowrap;
}

.step small {
    display: block;

    color: #9aa8ad;

    font-size: 11px;

    margin-top: 3px;

    white-space: nowrap;
}

.step-line {
    height: 1px;

    background: #dce5e8;

    flex: .25;

    margin: 0 14px;

    min-width: 15px;
}

.content-card {
    background: white;

    border: 1px solid #e2eaed;

    border-radius: 15px;

    margin-bottom: 22px;

    box-shadow:
        0 4px 12px rgba(0,0,0,.025);

    overflow: visible;

    width: 100%;
}

.card-heading {
    display: flex;
    align-items: center;

    gap: 15px;

    padding: 21px 25px;

    border-bottom:
        1px solid #edf1f3;
}

.heading-icon {
    width: 42px;
    height: 42px;

    min-width: 42px;

    border-radius: 11px;

    background: #eaf7f7;

    color: #007f84;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 20px;
}

.card-heading h3 {
    margin: 0;

    font-size: 18px;

    color: #17333f;

    font-weight: 700;

    line-height: 1.3;
}

.card-heading p {
    margin: 4px 0 0;

    font-size: 13px;

    color: #819198;

    line-height: 1.5;
}

.transaction-grid {
    padding: 25px;

    display: grid;

    grid-template-columns:
        repeat(3, minmax(0, 1fr));

    gap: 16px;

    width: 100%;
}

.transaction-card {
    position: relative;

    display: flex;
    align-items: center;

    gap: 14px;

    padding: 18px;

    min-height: 88px;

    border: 1px solid #dce6e9;

    border-radius: 11px;

    cursor: pointer;

    background: #fff;

    transition:
        border-color .18s ease,
        background .18s ease,
        transform .18s ease,
        box-shadow .18s ease;

    min-width: 0;
}

.transaction-card:hover {
    border-color: #35b8b5;

    background: #fbffff;

    transform: translateY(-1px);

    box-shadow:
        0 4px 12px rgba(0,126,132,.08);
}

.transaction-card input {
    position: absolute;

    opacity: 0;

    pointer-events: none;
}

.transaction-card:has(input:checked) {
    border:
        2px solid #008b87;

    background:
        #edfafa;

    box-shadow:
        0 4px 12px rgba(0,139,135,.10);
}

.transaction-icon {
    width: 44px;
    height: 44px;

    min-width: 44px;

    border-radius: 10px;

    background: #eef8f8;

    color: #00878a;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 19px;
}

.transaction-content {
    min-width: 0;

    flex: 1;

    padding-right: 22px;
}

.transaction-content strong {
    display: block;

    color: #1c343e;

    font-size: 14px;

    line-height: 1.35;
}

.transaction-content span {
    display: block;

    color: #84949a;

    font-size: 14px;

    margin-top: 5px;

    line-height: 1.4;
}

.transaction-check {
    position: absolute;

    right: 14px;
    top: 14px;

    color: #008b87;

    opacity: 0;

    font-size: 17px;
}

.transaction-card:has(input:checked)
.transaction-check {
    opacity: 1;
}

.details-body {
    padding: 25px;
}

.transaction-details {
    display: none;

    width: 100%;
}

.transaction-details.active {
    display: block;
}

.form-label {
    display: block;

    font-size: 14px;

    font-weight: 600;

    color: #25434f;

    margin-bottom: 8px;

    line-height: 1.45;
}

.form-label i {
    color: #00868b;

    margin-right: 6px;
}

.form-label span {
    color: #e34b4b;
}

.form-control,
.form-select {
    width: 100%;

    height: 47px;

    border:
        1px solid #cfe0e5;

    border-radius: 9px;

    font-size: 14px;

    color: #29434d;

    padding: 11px 14px;

    box-shadow: none;

    min-width: 0;
}

.form-control:focus,
.form-select:focus {
    border-color: #20aeb0;

    box-shadow:
        0 0 0 3px
        rgba(32,174,176,.08);
}

.form-control::placeholder {
    color: #89979c;
    opacity: 1;
}

.form-hint {
    color: #7d8d93;

    font-size: 11px;

    margin-top: 6px;

    line-height: 1.5;
}

.fixed-fee-box {
    display: flex;

    align-items: center;

    padding: 20px;

    background: #edf9f7;

    border:
        1px solid #c8ece6;

    border-radius: 11px;

    width: 100%;
}

.fixed-fee-icon {
    width: 44px;
    height: 44px;

    min-width: 44px;

    border-radius: 10px;

    background: #d8f1ec;

    color: #00877f;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-right: 14px;

    font-size: 19px;
}

.fixed-fee-box div:nth-child(2) {
    flex: 1;

    min-width: 0;
}

.fixed-fee-box strong {
    display: block;

    color: #244d4a;

    font-size: 15px;
}

.fixed-fee-box span {
    display: block;

    color: #77928f;

    font-size: 12px;

    margin-top: 4px;
}

.fixed-fee-box b {
    font-size: 22px;

    color: #007c78;

    white-space: nowrap;
}

.notice-box {
    display: flex;
    gap: 14px;
    padding: 18px;
    border-radius: 11px;
    background: #fff8e8;
    border:
        1px solid #f0dfb0;

    color: #765f25;

    width: 100%;
}

.notice-box > i {
    font-size: 20px;

    flex-shrink: 0;
}

.notice-box strong {
    display: block;

    font-size: 14px;
}

.notice-box span {
    display: block;

    font-size: 12px;

    margin-top: 5px;

    line-height: 1.6;
}

.court-hourly-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 20px;
}

.payment-body {
    padding: 25px;

    width: 100%;
}

#businessFieldWrapper {
    width: 100%;
    margin-bottom: 25px;
}

#businessFieldWrapper.hidden-business {
    display: none !important;
}

.complaint-information-wrapper {
    width: 100%;
    margin-bottom: 20px;
}

.complaint-information-inner {
    background: #ffffff;
    border: 1px solid #e0e9ed;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 5px 18px rgba(0, 75, 105, 0.055);
}

.complaint-information-heading {
    display: flex;
    align-items: center;
    gap: 13px;
    margin-bottom: 22px;
}

.complaint-information-icon {
    width: 42px;
    height: 42px;
    border-radius: 11px;
    background: #eaf5f8;
    color: #075374;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.complaint-information-icon i {
    font-size: 19px;
}

.complaint-information-heading h4 {
    margin: 0;
    color: #173f50;
    font-size: 17px;
    font-weight: 750;
}

.complaint-information-heading p {
    margin: 3px 0 0;
    color: #71838b;
    font-size: 12.5px;
}

.complaint-info-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 19px;
}

.complaint-full-width {
    grid-column: 1 / -1;
}

@media (max-width: 768px) {

    .complaint-info-grid {
        grid-template-columns: 1fr;
    }

    .complaint-full-width {
        grid-column: auto;
    }

    .complaint-information-inner {
        padding: 19px;
    }

}

.payment-fields-grid {
    display: grid;

    grid-template-columns:
        repeat(3, minmax(0, 1fr));

    gap: 22px;

    width: 100%;

    align-items: start;
}

.payment-field {
    min-width: 0;

    width: 100%;
}

.payment-field-full {
    grid-column: 1 / -1;
}

.business-search-wrapper {
    position: relative;

    width: 100%;
}

.business-search-input-wrapper {
    position: relative;

    width: 100%;
}

.business-search-input {
    height: 47px !important;

    padding-left: 42px !important;

    padding-right: 42px !important;

    cursor: text;

    background: #fff;
}

.business-search-icon {
    position: absolute;

    left: 15px;

    top: 50%;

    transform: translateY(-50%);

    color: #00868b;

    font-size: 17px;

    z-index: 2;

    pointer-events: none;
}

.business-search-arrow {
    position: absolute;

    right: 15px;

    top: 50%;

    transform: translateY(-50%);

    color: #809197;

    font-size: 14px;

    pointer-events: none;

    transition: transform .18s ease;
}

.business-search-wrapper.open
.business-search-arrow {
    transform:
        translateY(-50%)
        rotate(180deg);
}

.business-suggestions {
    position: absolute;

    left: 0;
    right: 0;

    top: calc(100% + 6px);

    background: white;

    border:
        1px solid #cfe0e5;

    border-radius: 11px;

    box-shadow:
        0 8px 20px rgba(0,0,0,.10);

    max-height: 300px;

    overflow-y: auto;

    z-index: 1000;

    display: none;

    padding: 6px;
}

.business-search-wrapper.open
.business-suggestions {
    display: block;
}

.business-suggestion {
    display: flex;

    align-items: center;

    gap: 12px;

    padding: 13px;

    border-radius: 9px;

    cursor: pointer;

    transition:
        background .15s ease;
}

.business-suggestion:hover {
    background: #eef8f8;
}

.business-suggestion.selected {
    background: #eaf7f7;
}

.business-suggestion-icon {
    width: 38px;
    height: 38px;

    min-width: 38px;

    border-radius: 9px;

    background: #eaf7f7;

    color: #00868b;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 16px;
}

.business-suggestion-content {
    min-width: 0;

    flex: 1;
}

.business-suggestion-content strong {
    display: block;

    color: #25434f;

    font-size: 14px;

    font-weight: 600;

    line-height: 1.4;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;
}

.business-suggestion-content span {
    display: block;

    margin-top: 4px;

    color: #84949a;

    font-size: 12px;

    line-height: 1.4;
}

.business-suggestion-content span i {
    margin-right: 3px;

    color: #00868b;
}

.business-suggestion-check {
    color: #008b87;

    font-size: 16px;

    opacity: 0;
}

.business-suggestion.selected
.business-suggestion-check {
    opacity: 1;
}

.business-no-results {
    padding: 20px 12px;

    text-align: center;

    color: #8a999f;

    font-size: 13px;
}

.business-no-results i {
    display: block;

    font-size: 22px;

    margin-bottom: 7px;

    color: #a6b3b8;
}

#businessFieldWrapper.hidden-business
.business-search-input {
    background: #f3f6f7;

    cursor: not-allowed;
}

.money-input {
    display: flex;

    width: 100%;
}

.money-input > span {
    width: 46px;

    min-width: 46px;

    display: flex;

    align-items: center;

    justify-content: center;

    background: #f0f6f7;

    border:
        1px solid #cfe0e5;

    border-right: 0;

    border-radius: 9px 0 0 9px;

    color: #007c80;

    font-size: 16px;

    font-weight: 700;
}

.money-input .form-control {
    border-radius: 0 9px 9px 0;
}

.money-input .form-control[readonly] {
    background: #f7fbfb;

    color: #006e72;

    font-weight: 700;
}

.personal-information-wrapper {
    width: 100%;

    margin-bottom: 25px;
}

.personal-information-inner {
    background: #f9fcfc;

    border:
        1px solid #e1ecee;

    border-radius: 12px;

    padding: 23px;

    width: 100%;
}

.personal-information-heading {
    display: flex;

    align-items: center;

    gap: 12px;

    margin-bottom: 22px;

    padding-bottom: 16px;

    border-bottom:
        1px solid #e7eff1;
}

.personal-information-icon {
    width: 40px;
    height: 40px;

    min-width: 40px;

    border-radius: 10px;

    background: #eaf7f7;

    color: #007f84;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 19px;
}

.personal-information-heading h4 {
    margin: 0;

    color: #17333f;

    font-size: 19px;

    font-weight: 700;

    line-height: 1.3;
}

.personal-information-heading p {
    margin: 4px 0 0;

    color: #687b83;

    font-size: 13px;

    line-height: 1.5;
}

.personal-info-grid {
    width: 100%;

    display: grid;

    grid-template-columns:
        repeat(3, minmax(0, 1fr));

    gap: 20px;

    align-items: start;
}

.personal-field-wrapper {
    min-width: 0;

    width: 100%;
}

.personal-field-full {
    grid-column: 1 / -1;
}

.personal-info-grid .form-label {
    display: block;

    font-size: 14px;

    font-weight: 600;

    color: #25434f;

    margin-bottom: 8px;

    line-height: 1.45;
}

.personal-info-grid .form-control,
.personal-info-grid .form-select {
    width: 100%;

    min-height: 47px;

    height: 47px;

    font-size: 14px;

    line-height: 1.4;

    padding: 10px 13px;

    color: #243b44;
}

.personal-info-grid
.form-control::placeholder {
    color: #89979c;

    opacity: 1;
}

.personal-info-grid textarea.form-control {
    height: auto;

    min-height: 105px;

    resize: vertical;

    line-height: 1.5;
}

.personal-info-grid
.form-label span {
    color: #e34b4b;
}

.payment-alert {
    display: flex;

    align-items: flex-start;

    gap: 13px;

    padding: 17px 20px;

    margin: 20px 30px;

    border-radius: 11px;

    font-size: 14px;

    width: auto;
}

.payment-alert-success {
    background: #edf9f4;

    border: 1px solid #bce5d0;

    color: #216b49;
}

.payment-alert-error {
    background: #fff1f1;

    border: 1px solid #efc4c4;

    color: #963b3b;
}

.payment-alert-icon {
    font-size: 20px;

    flex-shrink: 0;
}

.payment-alert-content {
    flex: 1;

    min-width: 0;
}

.payment-alert-content strong {
    display: block;

    font-size: 14px;

    margin-bottom: 5px;
}

.payment-alert-content span {
    display: block;

    font-size: 13px;

    line-height: 1.6;
}

.payment-alert-close {
    border: 0;

    background: transparent;

    font-size: 23px;

    cursor: pointer;

    opacity: .6;

    flex-shrink: 0;
}

.fee-summary {
    display: flex;

    align-items: center;

    padding: 20px 23px;

    background: #edf9f7;

    border:
        1px solid #c8ece6;

    border-radius: 12px;

    margin-bottom: 20px;

    width: 100%;
}

.summary-icon {
    width: 43px;
    height: 43px;

    min-width: 43px;

    border-radius: 50%;

    background: #d6f2ed;

    color: #00877f;

    display: flex;

    align-items: center;

    justify-content: center;

    margin-right: 14px;

    font-size: 18px;
}

.summary-content {
    min-width: 0;
}

.summary-content span {
    display: block;

    font-size: 11px;

    color: #77928f;

    text-transform: uppercase;

    letter-spacing: .6px;
}

.summary-content strong {
    display: block;

    color: #244d4a;

    font-size: 15px;

    margin-top: 3px;

    overflow: hidden;

    text-overflow: ellipsis;
}

.summary-amount {
    margin-left: auto;

    text-align: right;

    flex-shrink: 0;
}

.summary-amount small {
    display: block;

    color: #77928f;

    font-size: 11px;
}

.summary-amount strong {
    color: #007c78;

    font-size: 24px;

    display: block;

    margin-top: 2px;
}

.form-actions {
    display: flex;

    justify-content: flex-end;

    align-items: center;

    gap: 12px;

    margin-top: 6px;

    width: 100%;
}

.btn-cancel {
    height: 45px;

    padding: 0 25px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    border:
        1px solid #d7e1e4;

    border-radius: 9px;

    color: #65777e;

    background: white;

    font-size: 14px;

    text-decoration: none;

    white-space: nowrap;
}

.btn-cancel:hover {
    background: #f7fafb;

    color: #455960;
}

.btn-record {
    height: 45px;

    padding: 0 27px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    border: 0;

    border-radius: 9px;

    background: #006b8f;

    color: white;

    font-size: 14px;

    font-weight: 600;

    white-space: nowrap;
}

.btn-record:hover {
    background: #005d7d;

    color: white;
}

.business-suggestions::-webkit-scrollbar {
    width: 7px;
}

.business-suggestions::-webkit-scrollbar-track {
    background: transparent;
}

.business-suggestions::-webkit-scrollbar-thumb {
    background: #ccd9dc;

    border-radius: 10px;
}

@media (max-width: 1200px) {

    .transaction-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .personal-info-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .payment-fields-grid {
        grid-template-columns:
            repeat(3, minmax(0, 1fr));
    }

}

@media (max-width: 900px) {

    .fee-page {
        padding:
            20px
            20px
            35px;
    }

    .payment-alert {
        margin-left: 20px;
        margin-right: 20px;
    }

    .page-header {
        padding: 23px;
    }

    .page-header h1 {
        font-size: 24px;
    }

    .page-header p {
        font-size: 13px;
    }

    .stepper-card {
        padding: 17px 18px;
    }

    .step {
        gap: 8px;
    }

    .step-line {
        margin-left: 8px;
        margin-right: 8px;
    }

    .step strong {
        font-size: 11px;
    }

    .step small {
        font-size: 9px;
    }

    .personal-info-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .payment-fields-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .payment-field-full {
        grid-column: 1 / -1;
    }

}

@media (max-width: 700px) {

    .fee-page {
        padding:
            16px
            15px
            30px;
    }

    .payment-alert {
        margin:
            15px;
    }

    .page-header {
        padding: 20px;

        align-items: flex-start;

        flex-wrap: wrap;

        gap: 14px;
    }

    .header-icon {
        width: 47px;
        height: 47px;

        min-width: 47px;

        font-size: 22px;
    }

    .page-header h1 {
        font-size: 21px;
    }

    .page-header p {
        font-size: 12px;
    }

    .header-badge {
        margin-left: 0;

        width: 100%;

        justify-content: center;

        padding: 10px 12px;

        font-size: 13px;
    }

    .stepper-card {
        display: none;
    }

    .card-heading {
        padding:
            18px 18px;
    }

    .card-heading h3 {
        font-size: 16px;
    }

    .card-heading p {
        font-size: 12px;
    }

    .heading-icon {
        width: 37px;
        height: 37px;

        min-width: 37px;

        font-size: 17px;
    }

    .transaction-grid {
        grid-template-columns: 1fr;

        padding: 18px;

        gap: 11px;
    }

    .transaction-card {
        min-height: 76px;

        padding: 15px;
    }

    .transaction-content strong {
        font-size: 14px;
    }

    .transaction-content span {
        font-size: 11px;
    }

    .details-body {
        padding: 18px;
    }

    .payment-body {
        padding: 18px;
    }

    .payment-fields-grid {
        grid-template-columns: 1fr;

        gap: 17px;
    }

    .payment-field-full {
        grid-column: auto;
    }

    #businessFieldWrapper {
        margin-bottom: 19px;
    }

    .personal-information-wrapper {
        margin-bottom: 19px;
    }

    .personal-information-inner {
        padding: 17px;
    }

    .personal-info-grid {
        grid-template-columns: 1fr;

        gap: 16px;
    }

    .personal-field-full {
        grid-column: auto;
    }

    .personal-information-heading {
        align-items: flex-start;
    }

    .personal-information-heading h4 {
        font-size: 17px;
    }

    .personal-information-heading p {
        font-size: 12px;
    }

    .court-hourly-grid {
        grid-template-columns: 1fr;

        gap: 16px;
    }

    .fee-summary {
        padding: 17px;

        align-items: flex-start;
    }

    .summary-icon {
        margin-right: 11px;
    }

    .summary-content strong {
        font-size: 14px;
    }

    .summary-amount strong {
        font-size: 20px;
    }

    .form-actions {
        flex-direction: column-reverse;

        width: 100%;
    }

    .btn-cancel,
    .btn-record {
        width: 100%;
    }

}

@media (max-width: 420px) {

    .fee-page {
        padding:
            13px
            10px
            25px;
    }

    .payment-alert {
        margin:
            12px
            10px;
    }

    .page-header {
        border-radius: 11px;

        padding: 17px;
    }

    .page-header h1 {
        font-size: 19px;
    }

    .page-header p {
        font-size: 11px;
    }

    .content-card {
        border-radius: 11px;
    }

    .transaction-grid,
    .details-body,
    .payment-body {
        padding: 14px;
    }

    .transaction-content strong {
        font-size: 13px;
    }

    .transaction-content span {
        font-size: 10px;
    }

    .personal-information-inner {
        padding: 14px;
    }

    .form-label {
        font-size: 13px;
    }

    .form-control,
    .form-select {
        font-size: 13px;
    }

    .fee-summary {
        flex-wrap: wrap;

        gap: 10px;
    }

    .summary-amount {
        width: 100%;

        margin-left: 51px;

        text-align: left;
    }

    .summary-amount strong {
        font-size: 20px;
    }

    .fixed-fee-box {
        padding: 14px;
    }

    .fixed-fee-box b {
        font-size: 18px;
    }

}

@media (
    max-width: 700px
) and (
    orientation: landscape
) {

    .transaction-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .payment-fields-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .personal-info-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .personal-field-full {
        grid-column: 1 / -1;
    }

}

.form-control:disabled,
.form-select:disabled {
    cursor: not-allowed;

    background-color: #f3f6f7;
}

button,
a,
.transaction-card,
.business-suggestion {
    -webkit-tap-highlight-color: transparent;
}

</style>

@endpush


@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {


    const paymentForm =
        document.getElementById('paymentForm');

    const transactionInputs =
        document.querySelectorAll(
            'input[name="transaction_type"]'
        );

    const detailsCard =
        document.getElementById('detailsCard');

    const details =
        document.querySelectorAll('.transaction-details');

    const businessFieldWrapper =
        document.getElementById('businessFieldWrapper');

    const businessSelect =
        document.getElementById('business_id');

    const businessSearch =
        document.getElementById('businessSearch');

    const personalInformationCard =
        document.getElementById('personalInformationCard');

    const complaintInformationCard =
        document.getElementById('complaintInformationCard');

    const assessedAmount =
        document.getElementById('assessed_amount');

    const paidAmount =
        document.getElementById('paid_amount');

    const selectedTransaction =
        document.getElementById('selectedTransaction');

    const displayAmount =
        document.getElementById('displayAmount');


    const businessClearanceType =
        document.getElementById('business_clearance_type');

    const certificationTypeSelect =
        document.getElementById('certification_type_select');

    const certificationTypeInput =
        document.getElementById('certification_type');

    const signboardType =
        document.getElementById('signboard_type');

    const signboardSqm =
        document.getElementById('signboard_sqm');

    const signboardQuantity =
        document.getElementById('signboardQuantity');

    const courtType =
        document.getElementById('court_type');

    const courtHourly =
        document.getElementById('courtHourly');

    const courtTime =
        document.getElementById('court_time');

    const courtHours =
        document.getElementById('court_hours');

    const businessSuggestionsBox =
        document.getElementById('businessSuggestions');

    const businessNoResults =
        document.getElementById('businessNoResults');

    const businessSearchWrapper =
        document.querySelector('.business-search-wrapper');

    const businessSuggestionItems =
        document.querySelectorAll('.business-suggestion');


    const personalFields =
        document.querySelectorAll('.personal-field');

    const complaintRequiredFields =
        document.querySelectorAll(
            '#complaintInformationCard [data-required]'
        );

    function setAmount(amount) {

        const value =
            Number(amount) || 0;

        assessedAmount.value =
            value > 0
                ? value.toFixed(2)
                : '';

        displayAmount.textContent =
            '₱' +
            value.toLocaleString(
                'en-PH',
                {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }
            );

    }

    function setPersonalFieldsRequired(required) {
        personalFields.forEach(function (field) {

          
            if (
                field.id === 'middle_name'
            ) {
                field.required = false;
                return;
            }

            if (
                field.id === 'blood_type'
            ) {
                field.required = false;
                return;
            }

            field.required = required;

        });

    }


   
    function resetPersonalInformation() {

        setPersonalFieldsRequired(false);

    }


    
    function showDetails(type) {

        details.forEach(function (detail) {

            detail.classList.remove('active');

        });


        personalInformationCard.style.display =
            'none';

        if (complaintInformationCard) {

            complaintInformationCard.style.display =
                'none';

        }


        businessFieldWrapper.classList.remove(
            'hidden-business'
        );

        businessSelect.disabled = false;

        setPersonalFieldsRequired(false);

        if (type === 'Business Clearance') {

            document
                .getElementById(
                    'businessClearanceDetails'
                )
                .classList.add('active');

            businessFieldWrapper.classList.remove(
                'hidden-business'
            );

            businessSelect.disabled = false;

            setPersonalFieldsRequired(false);

        }

        if (type === 'Certification Fee') {

            document
                .getElementById(
                    'certificationDetails'
                )
                .classList.add('active');


            personalInformationCard.style.display =
                'block';


            businessFieldWrapper.classList.add(
                'hidden-business'
            );


            businessSelect.disabled = true;

            businessSelect.value = '';

            if (businessSearch) {
                businessSearch.value = '';
            }


            setPersonalFieldsRequired(true);

        }


        if (type === 'Filing Complaint') {

            document
                .getElementById('complaintDetails')
                .classList.add('active');


            businessFieldWrapper.classList.add(
                'hidden-business'
            );


            businessSelect.disabled = true;

            businessSelect.value = '';

            if (businessSearch) {
                businessSearch.value = '';
            }


            personalInformationCard.style.display =
                'none';


            setPersonalFieldsRequired(false);


            if (complaintInformationCard) {

                complaintInformationCard.style.display =
                    'block';

            }


            setAmount(100);

            paidAmount.value = '100.00';

            paidAmount.readOnly = true;

            updateFee();

            detailsCard.style.display =
                'block';

            return;

        }



        if (type === 'Signboard Tax') {

            document
                .getElementById(
                    'signboardDetails'
                )
                .classList.add('active');

        }


        if (type === 'Covered Court Fee') {

            document
                .getElementById(
                    'courtDetails'
                )
                .classList.add('active');

        }

        if (type === 'Commercial Breeding Tax') {

            document
                .getElementById(
                    'breedingDetails'
                )
                .classList.add('active');


            setAmount(50);

        }


        detailsCard.style.display =
            'block';


        updateFee();

    }


    function updateFee() {

        const selected =
            document.querySelector(
                'input[name="transaction_type"]:checked'
            );


        if (!selected) {

            setAmount(0);

            return;

        }


        const type =
            selected.value;


       
        if (type === 'Business Clearance') {

            setAmount(
                businessClearanceType
                    ? businessClearanceType.value
                    : 0
            );

            return;

        }

        if (type === 'Certification Fee') {

            setAmount(
                certificationTypeSelect
                    ? certificationTypeSelect.value
                    : 0
            );

            return;

        }

        if (type === 'Filing Complaint') {

            setAmount(100);

            return;

        }


        if (type === 'Signboard Tax') {

            const base =
                signboardType
                    ? Number(signboardType.value) || 0
                    : 0;


            const perSquareMeter =
                signboardType &&
                (
                    signboardType.value === '200' ||
                    signboardType.value === '25'
                );


            if (
                perSquareMeter &&
                signboardSqm
            ) {

                const sqm =
                    Number(signboardSqm.value) || 0;

                setAmount(
                    base * sqm
                );

            } else {

                setAmount(base);

            }

            return;

        }


        if (type === 'Covered Court Fee') {

            if (
                courtType &&
                courtType.value === 'hourly'
            ) {

                const rate =
                    courtTime
                        ? Number(courtTime.value) || 0
                        : 0;

                const hours =
                    courtHours
                        ? Number(courtHours.value) || 0
                        : 0;

                setAmount(
                    rate * hours
                );

            } else {

                setAmount(
                    courtType
                        ? courtType.value
                        : 0
                );

            }

            return;

        }


        if (type === 'Commercial Breeding Tax') {

            setAmount(
                breedingAmount
                    ? breedingAmount.value
                    : 0
            );

            return;

        }


        setAmount(0);

    }


    transactionInputs.forEach(function (input) {

        input.addEventListener(
            'change',
            function () {

                const type =
                    this.value;


                selectedTransaction.textContent =
                    type;


                showDetails(type);


                if (
                    type !==
                    'Filing Complaint'
                ) {

                    paidAmount.value = '';

                    paidAmount.readOnly = false;

                } else {

                    paidAmount.value = '100';

                    paidAmount.readOnly = true;

                }

            }
        );

    });



    [

        businessClearanceType,
        certificationTypeSelect,
        signboardType,
        signboardSqm,
        courtType,
        courtTime,
        courtHours,

    ].forEach(function (element) {

        if (!element) {
            return;
        }


        element.addEventListener(
            'change',
            updateFee
        );


        element.addEventListener(
            'input',
            updateFee
        );

    });

    if (certificationTypeSelect) {

        certificationTypeSelect.addEventListener(
            'change',
            function () {

                const selectedOption =
                    this.options[this.selectedIndex];


                certificationTypeInput.value =
                    selectedOption
                        ? (
                            selectedOption.dataset.label ||
                            ''
                        )
                        : '';


                updateFee();

            }
        );

    }



    if (signboardType) {

        signboardType.addEventListener(
            'change',
            function () {

                const sqmFee =
                    this.value === '200' ||
                    this.value === '25';


                if (signboardQuantity) {

                    signboardQuantity.style.display =
                        sqmFee
                            ? 'block'
                            : 'none';

                }


                if (
                    !sqmFee &&
                    signboardSqm
                ) {

                    signboardSqm.value = '';

                }


                updateFee();

            }
        );

    }

    if (courtType) {

        courtType.addEventListener(
            'change',
            function () {

                if (courtHourly) {

                    courtHourly.style.display =
                        this.value === 'hourly'
                            ? 'block'
                            : 'none';

                }


                if (
                    this.value !==
                    'hourly'
                ) {

                    if (courtTime) {
                        courtTime.value = '';
                    }

                    if (courtHours) {
                        courtHours.value = '';
                    }

                }


                updateFee();

            }
        );

    }





    if (paymentForm) {

        paymentForm.addEventListener(
            'submit',
            function (event) {

                const selected =
                    document.querySelector(
                        'input[name="transaction_type"]:checked'
                    );


                if (!selected) {

                    event.preventDefault();

                    alert(
                        'Please select a transaction type.'
                    );

                    return;

                }


                const type =
                    selected.value;


                if (
                    type === 'Business Clearance'
                ) {

                    if (
                        !businessSelect.value
                    ) {

                        event.preventDefault();

                        businessFieldWrapper.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });

                        businessSearch.focus();

                        alert(
                            'Please select a business for Business Clearance.'
                        );

                        return;

                    }


                    if (
                        !businessClearanceType ||
                        !businessClearanceType.value
                    ) {

                        event.preventDefault();

                        document
                            .getElementById(
                                'businessClearanceDetails'
                            )
                            .scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });

                        alert(
                            'Please select a Business Clearance Type.'
                        );

                        return;

                    }

                }


                if (
                    type === 'Certification Fee'
                ) {

                    if (
                        !certificationTypeSelect ||
                        !certificationTypeSelect.value
                    ) {

                        event.preventDefault();

                        certificationTypeSelect.focus();

                        alert(
                            'Please select a certification or clearance type.'
                        );

                        return;

                    }


                    const selectedOption =
                        certificationTypeSelect.options[
                            certificationTypeSelect.selectedIndex
                        ];


                    certificationTypeInput.value =
                        selectedOption
                            ? (
                                selectedOption.dataset.label ||
                                ''
                            )
                            : '';


                    let missingPersonalInformation =
                        false;


                    personalFields.forEach(
                        function (field) {


                            if (
                                field.id === 'middle_name' ||
                                field.id === 'blood_type'
                            ) {
                                return;
                            }


                            if (
                                !field.value.trim()
                            ) {

                                missingPersonalInformation =
                                    true;

                                field.classList.add(
                                    'is-invalid'
                                );

                            } else {

                                field.classList.remove(
                                    'is-invalid'
                                );

                            }

                        }
                    );


                    if (
                        missingPersonalInformation
                    ) {

                        event.preventDefault();

                        personalInformationCard.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });

                        alert(
                            'Please complete all required personal information.'
                        );

                        return;

                    }

                }


                if (
                    type === 'Filing Complaint'
                ) {

                    const requiredComplaintFields = [
                        'complainant_name',
                        'complainant_contact',
                        'respondent_name',
                        'complaint_type',
                        'complaint_description'
                    ];


                    let missingComplaint =
                        false;


                    requiredComplaintFields.forEach(
                        function (id) {

                            const field =
                                document.getElementById(id);


                            if (
                                field &&
                                !field.value.trim()
                            ) {

                                missingComplaint =
                                    true;

                                field.classList.add(
                                    'is-invalid'
                                );

                            } else if (field) {

                                field.classList.remove(
                                    'is-invalid'
                                );

                            }

                        }
                    );


                    if (
                        missingComplaint
                    ) {

                        event.preventDefault();

                        complaintInformationCard.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });

                        alert(
                            'Please complete all required complaint information.'
                        );

                        return;

                    }

                }


                const amount =
                    Number(
                        assessedAmount.value
                    ) || 0;


                if (
                    amount <= 0
                ) {

                    event.preventDefault();

                    alert(
                        'Please select a valid fee before recording the payment.'
                    );

                    return;

                }

            }
        );

    }


    personalFields.forEach(function (field) {

        field.addEventListener(
            'input',
            function () {

                if (
                    this.value.trim()
                ) {

                    this.classList.remove(
                        'is-invalid'
                    );

                }

            }
        );

    });


    const oldTransaction =
        document.querySelector(
            'input[name="transaction_type"]:checked'
        );


    if (oldTransaction) {

        selectedTransaction.textContent =
            oldTransaction.value;


        showDetails(
            oldTransaction.value
        );

    }


    
    if (
        certificationTypeInput &&
        certificationTypeInput.value &&
        certificationTypeSelect
    ) {

        const oldCertification =
            certificationTypeInput.value;


        Array.from(
            certificationTypeSelect.options
        ).forEach(function (option) {

            if (
                option.dataset.label ===
                oldCertification
            ) {

                option.selected = true;

            }

        });


        updateFee();

    }


    if (
        businessSearch &&
        businessSearchWrapper
    ) {


        function filterBusinessSuggestions() {

            const query =
                businessSearch.value
                    .trim()
                    .toLowerCase();


            let visibleCount = 0;


            businessSuggestionItems.forEach(
                function (item) {

                    const business =
                        item.dataset.business || '';

                    const owner =
                        item.dataset.owner || '';


                    const matches =
                        business.includes(query) ||
                        owner.includes(query);


                    item.style.display =
                        matches
                            ? 'flex'
                            : 'none';


                    if (matches) {
                        visibleCount++;
                    }

                }
            );


            if (businessNoResults) {

                businessNoResults.style.display =
                    visibleCount === 0
                        ? 'block'
                        : 'none';

            }

        }


        businessSearch.addEventListener(
            'focus',
            function () {


                if (
                    businessSelect.disabled
                ) {
                    return;
                }


                businessSearchWrapper.classList.add(
                    'open'
                );


                filterBusinessSuggestions();

            }
        );


        businessSearch.addEventListener(
            'input',
            function () {

                if (
                    businessSelect.disabled
                ) {
                    return;
                }


                businessSearchWrapper.classList.add(
                    'open'
                );


                businessSelect.value = '';


                businessSuggestionItems.forEach(
                    function (item) {

                        item.classList.remove(
                            'selected'
                        );

                    }
                );


                filterBusinessSuggestions();

            }
        );


        businessSuggestionItems.forEach(
            function (item) {

                item.addEventListener(
                    'click',
                    function () {

                        if (
                            businessSelect.disabled
                        ) {
                            return;
                        }


                        businessSelect.value =
                            this.dataset.id;


                        businessSearch.value =
                            this.dataset.label;


                        businessSuggestionItems.forEach(
                            function (i) {

                                i.classList.remove(
                                    'selected'
                                );

                            }
                        );


                        this.classList.add(
                            'selected'
                        );


                        businessSearchWrapper.classList.remove(
                            'open'
                        );

                    }
                );

            }
        );


        document.addEventListener(
            'click',
            function (e) {

                if (
                    !businessSearchWrapper.contains(
                        e.target
                    )
                ) {

                    businessSearchWrapper.classList.remove(
                        'open'
                    );

                }

            }
        );


        businessSearchWrapper.addEventListener(
            'click',
            function (e) {

                e.stopPropagation();

            }
        );

    }


});

</script>

@endpush
