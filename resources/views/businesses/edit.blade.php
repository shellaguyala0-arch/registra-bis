@extends('layouts.app')

@section('title', 'Edit Business Profile')

@section('content')

<meta name="geoapify-key" content="{{ config('services.geoapify.key') }}">

<div class="edit-page">
    <div class="edit-header">
        <div class="header-left">
            <div class="header-icon">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div>
                <h1>Edit Business Profile</h1>
                <p>
                    Update the business information, owner's documents,
                    photos, and location details.
                </p>
            </div>
        </div>
        <div class="edit-badge">
            <i class="bi bi-building-check"></i>
            Business Profile
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger custom-alert">
            <div class="fw-bold mb-2">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                Please correct the following:
            </div>
            <ul class="mb-0">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success custom-alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <form
        method="POST"
        action="{{ route('businesses.update', $business) }}"
        id="businessForm"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        <div class="registration-card owner-photo-card">
            <div class="card-header-custom">

                <div class="section-icon">
                    <i class="bi bi-person-bounding-box"></i>
                </div>
                <div>
                    <h3>Owner's Photo</h3>

                    <p>
                        Update the business owner's photo if necessary.
                    </p>
                </div>

            </div>


            <div class="card-body-custom owner-photo-body">
                <div class="owner-photo-upload">

                    <div
                        class="owner-photo-preview {{ $business->owner_photo ? 'has-image' : '' }}"
                        id="ownerPhotoPreviewContainer"
                    >

                        <div
                            class="owner-photo-placeholder"
                            id="ownerPhotoPlaceholder"
                            style="{{ $business->owner_photo ? 'display:none;' : '' }}"
                        >
                            <i class="bi bi-person"></i>
                        </div>


                        <img
                            id="ownerPhotoPreview"
                            src="{{ asset($business->owner_photo) }}"
                            alt="Owner photo"
                            style="{{ $business->owner_photo ? 'display:block;' : 'display:none;' }}"
                        >

                    </div>


                    <label
                        for="ownerPhoto"
                        class="owner-photo-button"
                    >

                        <i class="bi bi-camera"></i>

                        Choose Owner Photo

                    </label>


                    <input
                        type="file"
                        name="owner_photo"
                        id="ownerPhoto"
                        accept="image/jpeg,image/png,image/jpg"
                        hidden
                    >


                    <div
                        class="owner-photo-filename"
                        id="ownerPhotoFilename"
                    >
                        {{ $business->owner_photo ? 'Current photo saved — choose a new file to replace it' : 'No photo selected' }}
                    </div>


                    @error('owner_photo')

                        <div class="text-danger small mt-2">
                            {{ $message }}
                        </div>

                    @enderror


                    <div class="file-upload-help">

                        <i class="bi bi-info-circle"></i>

                        JPG, JPEG, or PNG only.
                        Maximum size: 2 MB.
                        Leave empty to keep the current photo.

                    </div>

                </div>

            </div>

        </div>

        <div class="registration-card">
            <div class="card-header-custom">
                <div class="section-icon">
                    <i class="bi bi-building"></i>
                </div>
                <div>
                    <h3>Business Information</h3>
                    <p>
                        Update the basic information of the business
                        owner and establishment.
                    </p>
                </div>
            </div>


            <div class="card-body-custom">

                <div class="business-form-grid">
                    <div class="business-field">
                        <label class="custom-label">
                            <i class="bi bi-building"></i>
                            Business Name
                            <span class="required">*</span>
                        </label>


                        <input
                            type="text"
                            name="business_name"
                            value="{{ old('business_name', $business->business_name) }}"
                            class="form-control custom-input @error('business_name') is-invalid @enderror"
                            placeholder="Enter business name"
                            required
                        >


                        @error('business_name')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="business-field">
                        <label class="custom-label">
                            <i class="bi bi-person"></i>
                            Owner Name
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="owner_name"
                            value="{{ old('owner_name', $business->owner_name) }}"
                            class="form-control custom-input @error('owner_name') is-invalid @enderror"
                            placeholder="Enter owner's full name"
                            required
                        >


                        @error('owner_name')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror
                    </div>

                    <div class="business-field address-autocomplete-wrapper">
                        <label class="custom-label">
                            <i class="bi bi-geo-alt"></i>
                            Business Address
                            <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            name="address"
                            id="businessAddress"
                            value="{{ old('address', $business->address) }}"
                            class="form-control custom-input @error('address') is-invalid @enderror"
                            placeholder="Enter complete business address"
                            autocomplete="off"
                            required
                        >
                        <div
                            id="addressSuggestions"
                            class="address-suggestions"
                        ></div>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                    <div class="business-field">
                        <label class="custom-label">
                            <i class="bi bi-telephone"></i>
                            Contact Number
                            <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            name="contact_number"
                            value="{{ old('contact_number', $business->contact_number) }}"
                            class="form-control custom-input @error('contact_number') is-invalid @enderror"
                            placeholder="09XXXXXXXXX"
                            maxlength="30"
                            required
                        >


                        @error('contact_number')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>
                    <div class="business-field">
                        <label class="custom-label">
                            <i class="bi bi-envelope"></i>
                            Business Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $business->email) }}"
                            class="form-control custom-input @error('email') is-invalid @enderror"
                            placeholder="example@business.com"
                        >
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                    <div class="business-field">
                        <label class="custom-label category-label">

                            <span>

                                <i class="bi bi-shop"></i>

                                Business Category

                                <span class="required">*</span>

                            </span>

                        </label>


                        <select
                            name="category"
                            id="businessCategory"
                            class="form-select custom-input category-select @error('category') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                Select category
                            </option>


                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->name }}"
                                    @selected(old('category', $business->category) === $category->name)
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>


                        @error('category')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    <div class="business-field">

                        <label class="custom-label">

                            <i class="bi bi-person-vcard"></i>

                            Valid ID Type

                            <span class="required">*</span>

                        </label>


                        <select
                            name="valid_id_type"
                            class="form-select custom-input @error('valid_id_type') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                Select ID Type
                            </option>


                            <option
                                value="PhilID / National ID"
                                @selected(old('valid_id_type', $business->valid_id_type) === 'PhilID / National ID')
                            >
                                PhilID / National ID
                            </option>


                            <option
                                value="Driver's License"
                                @selected(old('valid_id_type', $business->valid_id_type) === "Driver's License")
                            >
                                Driver's License
                            </option>


                            <option
                                value="Passport"
                                @selected(old('valid_id_type', $business->valid_id_type) === 'Passport')
                            >
                                Passport
                            </option>


                            <option
                                value="UMID"
                                @selected(old('valid_id_type', $business->valid_id_type) === 'UMID')
                            >
                                UMID
                            </option>


                            <option
                                value="SSS ID"
                                @selected(old('valid_id_type', $business->valid_id_type) === 'SSS ID')
                            >
                                SSS ID
                            </option>


                            <option
                                value="GSIS ID"
                                @selected(old('valid_id_type', $business->valid_id_type) === 'GSIS ID')
                            >
                                GSIS ID
                            </option>


                            <option
                                value="PhilHealth ID"
                                @selected(old('valid_id_type', $business->valid_id_type) === 'PhilHealth ID')
                            >
                                PhilHealth ID
                            </option>


                            <option
                                value="Postal ID"
                                @selected(old('valid_id_type', $business->valid_id_type) === 'Postal ID')
                            >
                                Postal ID
                            </option>


                            <option
                                value="Voter's ID"
                                @selected(old('valid_id_type', $business->valid_id_type) === "Voter's ID")
                            >
                                Voter's ID
                            </option>


                            <option
                                value="Other"
                                @selected(old('valid_id_type', $business->valid_id_type) === 'Other')
                            >
                                Other
                            </option>

                        </select>


                        @error('valid_id_type')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    <div class="business-field">
                        <label class="custom-label">

                            <i class="bi bi-card-text"></i>

                            Valid ID Number

                            <span class="required">*</span>

                        </label>


                        <input
                            type="text"
                            name="valid_id_number"
                            value="{{ old('valid_id_number', $business->valid_id_number) }}"
                            class="form-control custom-input @error('valid_id_number') is-invalid @enderror"
                            placeholder="Enter valid ID number"
                            maxlength="100"
                            required
                        >


                        @error('valid_id_number')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    <div class="business-field photo-field">
                        <label class="custom-label">
                            <i class="bi bi-card-image"></i>
                            Valid ID Picture
                        </label>


                        <div class="file-upload-wrapper">

                            <input
                                type="file"
                                name="valid_id_file"
                                id="validIdFile"
                                class="form-control custom-input @error('valid_id_file') is-invalid @enderror"
                                accept="image/jpeg,image/png,image/jpg"
                            >


                            @error('valid_id_file')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror


                            <div class="file-upload-help">

                                <i class="bi bi-info-circle"></i>

                                Choose a new image only if you want to
                                replace the current valid ID picture.
                                JPG, JPEG, or PNG only. Maximum size: 5 MB.

                            </div>


                            <div
                                id="validIdPreviewContainer"
                                class="valid-id-preview-container {{ $business->valid_id_file ? 'has-image' : '' }}"
                            >

                                <div class="existing-photo-label">

                                    <i class="bi bi-check-circle-fill"></i>

                                    Current Valid ID Picture

                                </div>


                                <img
                                    id="validIdPreview"
                                    class="valid-id-preview"
                                    src="{{ asset($business->valid_id_file) }}"
                                    alt="Valid ID Picture"
                                >

                            </div>
                        </div>

                    </div>


                    <div class="business-field photo-field">

                        <label class="custom-label">

                            <i class="bi bi-building"></i>

                            Business Exterior Photo

                        </label>


                        <div class="file-upload-wrapper">

                            <input
                                type="file"
                                name="business_exterior"
                                id="businessExterior"
                                class="form-control custom-input @error('business_exterior') is-invalid @enderror"
                                accept="image/jpeg,image/png,image/jpg"
                            >


                            @error('business_exterior')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror


                            <div class="file-upload-help">

                                <i class="bi bi-info-circle"></i>

                                Choose a new image only if you want to
                                replace the current business exterior photo.
                                JPG, JPEG, or PNG only. Maximum size: 5 MB.

                            </div>


                            <div
                                id="businessExteriorPreviewContainer"
                                class="image-preview-container {{ $business->business_exterior ? 'show' : '' }}"
                            >

                                <div class="existing-photo-label">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Current Business Exterior Photo
                                </div>
                                <img
                                    id="businessExteriorPreview"
                                    class="image-preview"
                                    src="{{ asset($business->business_exterior) }}"
                                    alt="Business Exterior Photo"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="business-field">
                        <label class="custom-label">
                            <i class="bi bi-geo-alt"></i>
                            Landmark Reference
                        </label>
                        <select
                            name="landmark"
                            class="form-select custom-input @error('landmark') is-invalid @enderror"
                        >
                            <option value="">
                                Select landmark
                            </option>
                            @foreach($landmarks as $landmark)
                                <option
                                    value="{{ $landmark }}"
                                    @selected(old('landmark', $business->landmark) === $landmark)
                                >
                                    {{ $landmark }}
                                </option>

                            @endforeach

                        </select>
                        @error('landmark') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="business-field">
                        <label class="custom-label">
                            <i class="bi bi-pin-map"></i>
                            Location Description
                        </label>
                        <textarea
                            name="location_description"
                            class="form-control custom-textarea @error('location_description') is-invalid @enderror"
                            rows="3"
                            placeholder="Describe the exact location, nearby landmarks or access roads"
                        >{{ old('location_description', $business->location_description) }}</textarea>


                        @error('location_description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="registration-card location-card">
            <div class="card-header-custom">
                <div class="section-icon">
                    <i class="bi bi-map"></i>
                </div>
                <div>
                    <h3>Location Profile</h3>
                    <p>
                        Confirm the exact location of the business
                        using the map.
                    </p>
                </div>
            </div>

            <div class="card-body-custom">
                <div
                    id="businessMap"
                    class="business-map"
                ></div>
                <input
                    type="hidden"
                    id="latitude"
                    name="latitude"
                    value="{{ old('latitude', $business->latitude ?? 12.6863) }}"
                >


                <input
                    type="hidden"
                    id="longitude"
                    name="longitude"
                    value="{{ old('longitude', $business->longitude ?? 124.1263) }}"
                >


                <div class="map-help">

                    <i class="bi bi-info-circle"></i>

                    The saved business location is displayed on the map.
                    You can drag the marker or click the map to update
                    the exact location.

                </div>

            </div>

        </div>


        {{-- =====================================================
             FORM ACTIONS
        ====================================================== --}}

        <div class="form-actions">

            <a
                href="{{ route('businesses.show', $business) }}"
                class="btn-cancel"
            >

                <i class="bi bi-x-lg"></i>

                Cancel

            </a>


            <button
                type="submit"
                class="btn-create"
                id="submitButton"
            >

                <i class="bi bi-check-circle"></i>

                Save Changes

            </button>

        </div>


    </form>

</div>

@endsection


{{-- =========================================================
     STYLES
========================================================= --}}

@push('styles')

<link
    rel="stylesheet"
    href="https://unpkg.com/maplibre-gl@4.7.1/dist/maplibre-gl.css"
/>


<style>

* {
    box-sizing: border-box;
}


/* =========================================================
   PAGE
========================================================= */

.edit-page {

    width: 100%;

    padding: 30px 28px 50px;

    background: #ffffff;

}


/* =========================================================
   HEADER
========================================================= */

.edit-header {

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

    color: #ffffff;

    box-shadow:
        0 8px 20px rgba(0,70,100,.12);

    margin-bottom: 30px;

}


.header-left {

    display: flex;

    align-items: center;

    gap: 20px;

}


.header-icon {

    width: 62px;

    height: 62px;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 38px;

    color: #ffffff;

    flex-shrink: 0;

}


.edit-header h1 {

    margin: 0;

    font-size: 38px;

    font-weight: 700;

    letter-spacing: -.5px;

}


.edit-header p {

    margin: 5px 0 0;

    color: #e3f5fc;

    font-size: 17px;

}


.edit-badge {

    background: rgba(255,255,255,.10);

    border: 1px solid rgba(255,255,255,.12);

    padding: 13px 22px;

    border-radius: 30px;

    font-size: 15px;

    font-weight: 600;

    white-space: nowrap;

}


/* =========================================================
   CARD
========================================================= */

.registration-card {

    background: #ffffff;

    border: 1px solid #9ee2fb;

    border-radius: 20px;

    overflow: hidden;

    margin-bottom: 26px;

    box-shadow:
        0 8px 20px rgba(0,70,100,.06);

}


.card-header-custom {

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


.card-header-custom h3 {

    margin: 0;

    color: #004d70;

    font-size: 22px;

    font-weight: 700;

}


.card-header-custom p {

    margin: 3px 0 0;

    color: #6e91a3;

    font-size: 14px;

}


.card-body-custom {

    padding: 30px 32px 34px;

}


/* =========================================================
   FORM GRID
========================================================= */

.business-form-grid {

    display: grid;

    grid-template-columns:
        minmax(0, 1fr)
        minmax(0, 1fr);

    column-gap: 32px;

    row-gap: 26px;

    width: 100%;

}


.business-field {

    width: 100%;

    min-width: 0;

}


/* =========================================================
   LABEL
========================================================= */

.custom-label {

    display: block;

    margin-bottom: 9px;

    color: #003f61;

    font-size: 16px;

    font-weight: 600;

    line-height: 1.3;

}


.custom-label i {

    color: #005c7e;

    margin-right: 7px;

    font-size: 17px;

}


.required {

    color: #0084b7;

    font-weight: 700;

}


/* =========================================================
   INPUT
========================================================= */

.custom-input {

    width: 100%;

    height: 57px;

    min-height: 57px;

    border: 1.5px solid #9cdef7 !important;

    border-radius: 13px !important;

    padding: 0 18px;

    color: #003f61;

    font-size: 16px;

    background-color: #ffffff !important;

    box-shadow: none !important;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;

}


.custom-input::placeholder {

    color: #88aabd;

    opacity: 1;

}


.custom-input:focus {

    border-color: #0088b8 !important;

    box-shadow:
        0 0 0 3px rgba(0,136,184,.10) !important;

    outline: none;

}


select.custom-input {

    cursor: pointer;

}


.custom-textarea {

    width: 100%;

    min-height: 120px;

    border: 1.5px solid #9cdef7 !important;

    border-radius: 13px !important;

    padding: 15px 18px;

    color: #003f61;

    font-size: 16px;

    background: #ffffff !important;

    resize: vertical;

    box-shadow: none !important;

}


.custom-textarea:focus {

    border-color: #0088b8 !important;

    box-shadow:
        0 0 0 3px rgba(0,136,184,.10) !important;

    outline: none;

}


/* =========================================================
   FILE UPLOAD
========================================================= */

.file-upload-wrapper {

    width: 100%;

}


.file-upload-wrapper .custom-input {

    height: auto;

    min-height: 57px;

    padding: 10px 14px;

    display: flex;

    align-items: center;

    cursor: pointer;

}


.file-upload-wrapper input[type="file"] {

    color: #527789;

}


.file-upload-wrapper input[type="file"]::file-selector-button {

    border: none;

    background: #eff9fc;

    color: #005676;

    border: 1px solid #b9e4f2;

    border-radius: 9px;

    padding: 9px 14px;

    margin-right: 12px;

    font-weight: 600;

    cursor: pointer;

}


.file-upload-wrapper input[type="file"]::file-selector-button:hover {

    background: #dff3f9;

}


.file-upload-help {

    margin-top: 8px;

    color: #7194a4;

    font-size: 13px;

    line-height: 1.5;

}


.file-upload-help i {

    color: #00739a;

    margin-right: 4px;

}


/* =========================================================
   OWNER PHOTO
========================================================= */

.owner-photo-card {

    margin-bottom: 26px;

}


.owner-photo-body {

    padding: 25px !important;

}


.owner-photo-upload {

    width: 100%;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

}


.owner-photo-preview {

    width: 190px;

    height: 190px;

    border-radius: 50%;

    border: 4px solid #d8f1f8;

    background: #eff9fc;

    display: flex;

    align-items: center;

    justify-content: center;

    overflow: hidden;

    margin-bottom: 18px;

    box-shadow:
        0 6px 18px rgba(0,70,100,.10);

}


.owner-photo-placeholder {

    width: 100%;

    height: 100%;

    display: flex;

    align-items: center;

    justify-content: center;

    color: #78aabb;

    font-size: 72px;

}


.owner-photo-preview img {

    width: 100%;

    height: 100%;

    object-fit: cover;

}


.owner-photo-button {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    min-height: 48px;

    padding: 0 22px;

    border-radius: 11px;

    border: none;

    background: #005676;

    color: #ffffff;

    font-size: 15px;

    font-weight: 600;

    cursor: pointer;

    transition:
        background .2s ease,
        transform .2s ease,
        box-shadow .2s ease;

}


.owner-photo-button:hover {

    background: #003f59;

    color: #ffffff;

    transform: translateY(-1px);

    box-shadow:
        0 5px 12px rgba(0,70,100,.20);

}


.owner-photo-button i {

    font-size: 17px;

}


.owner-photo-filename {

    margin-top: 10px;

    color: #527789;

    font-size: 13px;

    max-width: 450px;

    text-align: center;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;

}


.owner-photo-upload .file-upload-help {

    margin-top: 7px;

    text-align: center;

}


/* =========================================================
   EXISTING IMAGE PREVIEWS
========================================================= */

.valid-id-preview-container,
.image-preview-container {

    margin-top: 14px;

    padding: 12px;

    border: 1px solid #d8edf3;

    border-radius: 12px;

    background: #f8fcfd;

    text-align: center;

}


.valid-id-preview-container:not(.has-image),
.image-preview-container:not(.show) {

    display: none;

}


.existing-photo-label {

    margin-bottom: 10px;

    color: #397287;

    font-size: 12px;

    font-weight: 600;

    text-align: left;

}


.existing-photo-label i {

    color: #198754;

    margin-right: 4px;

}


.valid-id-preview {

    display: block;

    width: 100%;

    max-width: 440px;

    max-height: 260px;

    object-fit: contain;

    margin: 0 auto;

    border-radius: 8px;

}


.image-preview {

    display: block;

    width: 100%;

    max-width: 520px;

    max-height: 280px;

    object-fit: contain;

    margin: 0 auto;

    border-radius: 8px;

}


/* =========================================================
   MAP
========================================================= */

.business-map {

    width: 100%;

    height: 420px;

    border-radius: 15px;

    border: 1.5px solid #9cdef7;

    overflow: hidden;

    background: #edf7fa;

}


.map-help {

    margin-top: 15px;

    padding: 13px 16px;

    background: #eff9fc;

    border-radius: 10px;

    color: #497b91;

    font-size: 14px;

    line-height: 1.5;

}


.map-help i {

    color: #00749b;

    margin-right: 6px;

}


/* =========================================================
   MAP MARKER
========================================================= */

.geo-marker {

    display: flex;

    align-items: center;

    justify-content: center;

}


.geo-marker-pin {

    width: 38px;

    height: 38px;

    border-radius: 50% 50% 50% 0;

    background: #005676;

    transform: rotate(-15deg);

    display: flex;

    align-items: center;

    justify-content: center;

    box-shadow:
        0 3px 8px rgba(0,70,100,.35);

}


.geo-marker-pin i {

    transform: rotate(45deg);

    color: #ffffff;

    font-size: 18px;

}


/* =========================================================
   ADDRESS AUTOCOMPLETE
========================================================= */

.address-autocomplete-wrapper {

    position: relative;

}


.address-suggestions {

    position: absolute;

    top: 100%;

    left: 0;

    right: 0;

    z-index: 1000;

    background: #ffffff;

    border: 1.5px solid #9cdef7;

    border-top: none;

    border-radius: 0 0 13px 13px;

    max-height: 240px;

    overflow-y: auto;

    box-shadow:
        0 8px 16px rgba(0,70,100,.10);

    display: none;

}


.address-suggestions.open {

    display: block;

}


.address-suggestion-item {

    padding: 12px 18px;

    font-size: 15px;

    color: #003f61;

    cursor: pointer;

    border-bottom: 1px solid #edf4f6;

}


.address-suggestion-item:last-child {

    border-bottom: none;

}


.address-suggestion-item:hover {

    background: #eff9fc;

}


.address-suggestion-empty {

    padding: 12px 18px;

    font-size: 14px;

    color: #8aa5b1;

}


/* =========================================================
   ALERT
========================================================= */

.custom-alert {

    border-radius: 13px;

    border: none;

    margin-bottom: 25px;

}


/* =========================================================
   ACTIONS
========================================================= */

.form-actions {

    display: flex;

    justify-content: flex-end;

    align-items: center;

    gap: 12px;

    margin-top: 10px;

}


.btn-cancel {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    min-height: 50px;

    padding: 0 23px;

    border: 1px solid #c7dce5;

    background: #ffffff;

    color: #41697a;

    text-decoration: none;

    border-radius: 11px;

    font-weight: 600;

    transition: .2s;

}


.btn-cancel:hover {

    background: #f3f8fa;

    color: #003f61;

}


.btn-create {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    min-height: 50px;

    padding: 0 26px;

    border: none;

    border-radius: 11px;

    background: #005676;

    color: #ffffff;

    font-size: 15px;

    font-weight: 600;

    transition: .2s;

}


.btn-create:hover {

    background: #003f59;

    color: #ffffff;

    transform: translateY(-1px);

    box-shadow:
        0 5px 12px rgba(0,70,100,.20);

}


.btn-create:disabled {

    opacity: .7;

    cursor: not-allowed;

    transform: none;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 900px) {

    .edit-page {

        padding: 20px 15px 40px;

    }


    .edit-header {

        padding: 25px;

        align-items: flex-start;

        flex-direction: column;

    }


    .edit-header h1 {

        font-size: 30px;

    }


    .edit-header p {

        font-size: 16px;

    }


    .edit-badge {

        font-size: 14px;

    }

}


@media (max-width: 700px) {

    .business-form-grid {

        grid-template-columns: 1fr;

        row-gap: 20px;

    }


    .registration-card .card-body-custom {

        padding: 22px 18px 28px;

    }


    .card-header-custom {

        padding: 22px 20px;

    }


    .business-map {

        height: 350px;

    }

}


@media (max-width: 576px) {

    .header-left {

        align-items: flex-start;

    }


    .header-icon {

        width: 45px;

        font-size: 30px;

    }


    .edit-header h1 {

        font-size: 25px;

    }


    .edit-header p {

        font-size: 14px;

    }


    .card-header-custom h3 {

        font-size: 19px;

    }


    .card-header-custom p {

        font-size: 13px;

    }


    .card-body-custom {

        padding: 22px 18px;

    }


    .custom-label {

        font-size: 14px;

    }


    .custom-input {

        height: 52px;

        min-height: 52px;

        font-size: 15px;

    }


    .business-map {

        height: 320px;

    }


    .form-actions {

        flex-direction: column-reverse;

        width: 100%;

    }


    .btn-cancel,
    .btn-create {

        width: 100%;

    }


    .owner-photo-preview {

        width: 160px;

        height: 160px;

    }

}

</style>

@endpush


{{-- =========================================================
     SCRIPTS
========================================================= --}}

@push('scripts')

<script src="https://unpkg.com/maplibre-gl@4.7.1/dist/maplibre-gl.js"></script>


<script>

document.addEventListener('DOMContentLoaded', function () {


    /* =====================================================
       GEOAPIFY
    ====================================================== */

    const GEOAPIFY_KEY =
        @json(config('services.geoapify.key'));


    const DEFAULT_LAT = 12.6863;
    const DEFAULT_LNG = 124.1263;


    const mapElement =
        document.getElementById('businessMap');


    const latitudeInput =
        document.getElementById('latitude');


    const longitudeInput =
        document.getElementById('longitude');


    const addressInput =
        document.getElementById('businessAddress');


    if (!mapElement) {
        return;
    }


    let latitude =
        parseFloat(latitudeInput?.value);


    let longitude =
        parseFloat(longitudeInput?.value);


    if (!Number.isFinite(latitude)) {
        latitude = DEFAULT_LAT;
    }


    if (!Number.isFinite(longitude)) {
        longitude = DEFAULT_LNG;
    }


    /* =====================================================
       MAP
    ====================================================== */

    if (GEOAPIFY_KEY) {

        const map = new maplibregl.Map({

            container: 'businessMap',

            style: {

                version: 8,

                sources: {

                    'geoapify-tiles': {

                        type: 'raster',

                        tiles: [

                            'https://maps.geoapify.com/v1/tile/osm-bright/{z}/{x}/{y}.png?apiKey='
                            + encodeURIComponent(GEOAPIFY_KEY)

                        ],

                        tileSize: 256,

                        attribution:
                            '&copy; Geoapify &nbsp;|&nbsp; &copy; OpenStreetMap contributors'

                    }

                },

                layers: [

                    {

                        id: 'geoapify-tiles-layer',

                        type: 'raster',

                        source: 'geoapify-tiles',

                        minzoom: 0,

                        maxzoom: 20

                    }

                ]

            },

            center: [
                longitude,
                latitude
            ],

            zoom: 17,

            minZoom: 12,

            maxZoom: 20

        });


        map.addControl(
            new maplibregl.NavigationControl(),
            'top-right'
        );


        const barangayBounds = [

            [124.0900, 12.6500],

            [124.1450, 12.7050]

        ];


        map.setMaxBounds(barangayBounds);


        const markerEl =
            document.createElement('div');


        markerEl.className =
            'geo-marker';


        markerEl.innerHTML = `

            <div class="geo-marker-pin">

                <i class="bi bi-geo-alt-fill"></i>

            </div>

        `;


        const marker = new maplibregl.Marker({

            element: markerEl,

            draggable: true,

            anchor: 'bottom'

        })

        .setLngLat([
            longitude,
            latitude
        ])

        .addTo(map);


        function updateCoordinates(lat, lng) {

            if (latitudeInput) {

                latitudeInput.value =
                    Number(lat).toFixed(7);

            }


            if (longitudeInput) {

                longitudeInput.value =
                    Number(lng).toFixed(7);

            }

        }


        updateCoordinates(
            latitude,
            longitude
        );


        function escapeHtml(value) {

            if (!value) {
                return '';
            }


            return String(value)

                .replace(/&/g, '&amp;')

                .replace(/</g, '&lt;')

                .replace(/>/g, '&gt;')

                .replace(/"/g, '&quot;')

                .replace(/'/g, '&#039;');

        }


        function showMarkerPopup(html) {

            const popup =
                new maplibregl.Popup({
                    offset: 25
                })
                .setHTML(html);


            marker.setPopup(popup);

            marker.togglePopup();

        }


        async function reverseGeocode(
            lat,
            lng,
            updateAddress = true
        ) {

            try {

                const url =

                    'https://api.geoapify.com/v1/geocode/reverse'

                    + '?lat='
                    + encodeURIComponent(lat)

                    + '&lon='
                    + encodeURIComponent(lng)

                    + '&format=json'

                    + '&apiKey='
                    + encodeURIComponent(GEOAPIFY_KEY);


                const response =
                    await fetch(url);


                if (!response.ok) {

                    throw new Error(
                        'Reverse geocoding request failed.'
                    );

                }


                const data =
                    await response.json();


                if (
                    !data.results ||
                    !data.results.length
                ) {

                    return;

                }


                const result =
                    data.results[0];


                const formatted =
                    result.formatted || '';


                if (
                    updateAddress &&
                    addressInput &&
                    formatted
                ) {

                    addressInput.value =
                        formatted;

                }


                showMarkerPopup(`

                    <div style="min-width:220px; font-size:13px;">

                        <strong>
                            Selected Business Location
                        </strong>

                        <br>

                        <span>
                            ${escapeHtml(formatted)}
                        </span>

                    </div>

                `);


            } catch (error) {

                console.error(
                    'Geoapify reverse geocoding error:',
                    error
                );

            }

        }


        marker.on(
            'dragend',
            async function () {

                const lngLat =
                    marker.getLngLat();


                updateCoordinates(
                    lngLat.lat,
                    lngLat.lng
                );


                await reverseGeocode(
                    lngLat.lat,
                    lngLat.lng,
                    true
                );

            }
        );


        map.on(
            'click',
            async function (event) {

                const {
                    lng,
                    lat
                } = event.lngLat;


                marker.setLngLat([
                    lng,
                    lat
                ]);


                updateCoordinates(
                    lat,
                    lng
                );


                await reverseGeocode(
                    lat,
                    lng,
                    true
                );

            }
        );


        /* =================================================
           ADDRESS AUTOCOMPLETE
        ================================================== */

        let searchTimer = null;

        let searchController = null;


        let suggestions =
            document.getElementById(
                'addressSuggestions'
            );


        if (addressInput) {

            addressInput.addEventListener(
                'input',
                function () {

                    clearTimeout(searchTimer);


                    const query =
                        this.value.trim();


                    if (query.length < 3) {

                        hideAddressSuggestions();

                        return;

                    }


                    searchTimer =
                        setTimeout(
                            function () {

                                searchAddress(query);

                            },
                            350
                        );

                }
            );


            addressInput.addEventListener(
                'keydown',
                function (event) {

                    if (
                        event.key === 'Enter'
                    ) {

                        event.preventDefault();

                        const query =
                            this.value.trim();


                        if (query.length >= 3) {

                            searchAddress(query);

                        }

                    }

                }
            );

        }


        async function searchAddress(query) {

            if (!query) {
                return;
            }


            if (searchController) {

                searchController.abort();

            }


            searchController =
                new AbortController();


            try {

                const filter =

                    'rect:124.0900,12.6500,124.1450,12.7050|countrycode:ph';


                const bias =

                    'proximity:124.1263,12.6863';


                const url =

                    'https://api.geoapify.com/v1/geocode/autocomplete'

                    + '?text='
                    + encodeURIComponent(query)

                    + '&filter='
                    + encodeURIComponent(filter)

                    + '&bias='
                    + encodeURIComponent(bias)

                    + '&limit=6'

                    + '&format=json'

                    + '&apiKey='
                    + encodeURIComponent(GEOAPIFY_KEY);


                const response =
                    await fetch(
                        url,
                        {
                            signal:
                                searchController.signal
                        }
                    );


                if (!response.ok) {

                    throw new Error(
                        'Geoapify autocomplete failed.'
                    );

                }


                const data =
                    await response.json();


                displaySuggestions(
                    data.results || []
                );


            } catch (error) {

                if (
                    error.name ===
                    'AbortError'
                ) {

                    return;

                }


                console.error(
                    'Geoapify search error:',
                    error
                );


                hideAddressSuggestions();

            }

        }


        function displaySuggestions(results) {

            if (!suggestions) {
                return;
            }


            suggestions.innerHTML = '';


            if (!results.length) {

                suggestions.innerHTML = `

                    <div class="address-suggestion-empty">

                        No matching location found.

                    </div>

                `;


                suggestions.classList.add(
                    'open'
                );


                return;

            }


            results.forEach(
                function (result) {

                    const item =
                        document.createElement(
                            'div'
                        );


                    item.className =
                        'address-suggestion-item';


                    const title =

                        result.address_line1 ||

                        result.name ||

                        result.city ||

                        'Location';


                    const subtitle =

                        result.address_line2 ||

                        result.formatted ||

                        '';


                    item.innerHTML = `

                        <div style="
                            display:flex;
                            gap:10px;
                            align-items:flex-start;
                        ">

                            <i
                                class="bi bi-geo-alt-fill"
                                style="
                                    color:#075374;
                                    margin-top:2px;
                                "
                            ></i>

                            <div>

                                <div style="
                                    font-weight:600;
                                    color:#003f61;
                                ">

                                    ${escapeHtml(title)}

                                </div>

                                <div style="
                                    font-size:12px;
                                    color:#7194a4;
                                    margin-top:2px;
                                ">

                                    ${escapeHtml(subtitle)}

                                </div>

                            </div>

                        </div>

                    `;


                    item.addEventListener(
                        'click',
                        function () {

                            selectLocation(
                                result
                            );

                        }
                    );


                    suggestions.appendChild(
                        item
                    );

                }
            );


            suggestions.classList.add(
                'open'
            );

        }


        function selectLocation(result) {

            const lat =
                parseFloat(result.lat);


            const lng =
                parseFloat(result.lon);


            if (
                !Number.isFinite(lat) ||
                !Number.isFinite(lng)
            ) {

                return;

            }


            const formatted =

                result.formatted ||

                result.address_line1 ||

                '';


            if (addressInput) {

                addressInput.value =
                    formatted;

            }


            updateCoordinates(
                lat,
                lng
            );


            marker.setLngLat([
                lng,
                lat
            ]);


            map.flyTo({

                center: [
                    lng,
                    lat
                ],

                zoom: 18,

                speed: 1.2

            });


            showMarkerPopup(`

                <div style="
                    min-width:220px;
                    font-size:13px;
                ">

                    <strong>
                        Business Location
                    </strong>

                    <br>

                    ${escapeHtml(formatted)}

                </div>

            `);


            hideAddressSuggestions();

        }


        function hideAddressSuggestions() {

            if (!suggestions) {
                return;
            }


            suggestions.innerHTML = '';

            suggestions.classList.remove(
                'open'
            );

        }


        document.addEventListener(
            'click',
            function (event) {

                if (
                    addressInput &&
                    !event.target.closest(
                        '.address-autocomplete-wrapper'
                    )
                ) {

                    hideAddressSuggestions();

                }

            }
        );


        setTimeout(
            function () {

                map.resize();

            },
            500
        );


        setTimeout(
            function () {

                map.resize();

            },
            1000
        );

    }


    /* =====================================================
       OWNER PHOTO PREVIEW
    ====================================================== */

    const ownerPhoto =
        document.getElementById(
            'ownerPhoto'
        );


    const ownerPhotoPreview =
        document.getElementById(
            'ownerPhotoPreview'
        );


    const ownerPhotoPreviewContainer =
        document.getElementById(
            'ownerPhotoPreviewContainer'
        );


    const ownerPhotoPlaceholder =
        document.getElementById(
            'ownerPhotoPlaceholder'
        );


    const ownerPhotoFilename =
        document.getElementById(
            'ownerPhotoFilename'
        );


    if (
        ownerPhoto &&
        ownerPhotoPreview &&
        ownerPhotoPreviewContainer
    ) {

        ownerPhoto.addEventListener(
            'change',
            function () {

                const file =
                    this.files[0];


                if (!file) {

                    return;

                }


                if (
                    !file.type.startsWith(
                        'image/'
                    )
                ) {

                    this.value = '';

                    alert(
                        'Please select a valid JPG, JPEG, or PNG image.'
                    );

                    return;

                }


                if (ownerPhotoFilename) {

                    ownerPhotoFilename.textContent =
                        'New photo: ' + file.name;

                }


                const reader =
                    new FileReader();


                reader.onload =
                    function (event) {

                        ownerPhotoPreview.src =
                            event.target.result;


                        ownerPhotoPreview.style.display =
                            'block';


                        ownerPhotoPreviewContainer
                            .classList
                            .add('has-image');


                        if (
                            ownerPhotoPlaceholder
                        ) {

                            ownerPhotoPlaceholder.style.display =
                                'none';

                        }

                    };


                reader.readAsDataURL(file);

            }
        );

    }

    const validIdFile =
        document.getElementById(
            'validIdFile'
        );


    const validIdPreview =
        document.getElementById(
            'validIdPreview'
        );


    const validIdPreviewContainer =
        document.getElementById(
            'validIdPreviewContainer'
        );


    if (
        validIdFile &&
        validIdPreview &&
        validIdPreviewContainer
    ) {

        validIdFile.addEventListener(
            'change',
            function () {

                const file =
                    this.files[0];


                if (!file) {
                    return;
                }


                if (
                    !file.type.startsWith(
                        'image/businesses-attachments'
                    )
                ) {

                    this.value = '';

                    alert(
                        'Please select a valid JPG, JPEG, or PNG image.'
                    );

                    return;

                }


                const reader =
                    new FileReader();


                reader.onload =
                    function (event) {

                        validIdPreview.src =
                            event.target.result;


                        validIdPreviewContainer
                            .classList
                            .add('has-image');

                    };


                reader.readAsDataURL(file);


                const label =
                    validIdPreviewContainer
                        .querySelector(
                            '.existing-photo-label'
                        );


                if (label) {

                    label.innerHTML = `

                        <i class="bi bi-arrow-repeat"></i>

                        New Valid ID Picture

                    `;

                }

            }
        );

    }

    const businessExterior =
        document.getElementById(
            'businessExterior'
        );


    const businessExteriorPreview =
        document.getElementById(
            'businessExteriorPreview'
        );


    const businessExteriorPreviewContainer =
        document.getElementById(
            'businessExteriorPreviewContainer'
        );


    if (
        businessExterior &&
        businessExteriorPreview &&
        businessExteriorPreviewContainer
    ) {

        businessExterior.addEventListener(
            'change',
            function () {

                const file =
                    this.files[0];


                if (!file) {
                    return;
                }


                if (
                    !file.type.startsWith(
                        'image/businesses-attachments'
                    )
                ) {

                    this.value = '';

                    alert(
                        'Please select a valid JPG, JPEG, or PNG image.'
                    );

                    return;

                }

                const reader =
                    new FileReader();

                reader.onload =
                    function (event) {

                        businessExteriorPreview.src =
                            event.target.result;


                        businessExteriorPreviewContainer
                            .classList
                            .add('show');
                    };

                reader.readAsDataURL(file);

                const label =
                    businessExteriorPreviewContainer
                        .querySelector(
                            '.existing-photo-label'
                        );

                if (label) {
                    label.innerHTML = `
                        <i class="bi bi-arrow-repeat"></i>
                        New Business Exterior Photo

                    `;
                }
            }
        );
    }

    const contactInput =
        document.querySelector(
            'input[name="contact_number"]'
        );

    if (contactInput) {
        contactInput.addEventListener(
            'input',
            function () {
                this.value =
                    this.value.replace(
                        /[^0-9+\-\s]/g,
                        ''
                    );
            }
        );

    }
    const form =
        document.getElementById(
            'businessForm'
        );

    const submitButton =
        document.getElementById(
            'submitButton'
        );

    if (form) {
        form.addEventListener(
            'submit',
            function () {

                if (submitButton) {
                    submitButton.disabled =
                        true;

                    submitButton.innerHTML = `
                        <span
                            class="spinner-border spinner-border-sm"
                            role="status"
                            aria-hidden="true"
                        ></span>

                        Saving Changes...
                    `;
                }
            }
        );
    }
});
</script>

@endpush
