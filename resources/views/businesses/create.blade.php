@extends('layouts.app')
@section('title', 'Register New Business')
@section('content')

<meta name="geoapify-key" content="{{ config('services.geoapify.key') }}">

<div class="register-page">
    <div class="registration-header">
        <div class="header-left">
            <div class="header-icon">
                <i class="bi bi-building"></i>
            </div>
            <div>
                <h1>Register New Business</h1>
                <p>
                    Complete the form below to register a new business
                    and provide its location details.
                </p>
            </div>
        </div>
        <div class="registration-badge">
            <i class="bi bi-building-check"></i>
            Business Registration
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

    @if(session('category_success'))
        <div class="alert alert-success custom-alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('category_success') }}
        </div>
    @endif

    @if(session('category_error'))
        <div class="alert alert-danger custom-alert">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('category_error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('businesses.store') }}" id="businessForm" enctype="multipart/form-data">

    @csrf

    <div class="card-header-custom">
        <div class="section-icon">
            <i class="bi bi-person-bounding-box"></i>
        </div>

        <div>
            <h3>Owner's Photo</h3>
            <p>Upload a clear recent photo of the business owner.</p>
        </div>
    </div>

    <div class="card-body-custom owner-photo-body">

        <div class="owner-photo-upload">

            <div class="owner-photo-preview" id="ownerPhotoPreviewContainer">
                <div class="owner-photo-placeholder" id="ownerPhotoPlaceholder">
                    <i class="bi bi-person"></i>
                </div>

                <img
                    id="ownerPhotoPreview"
                    alt="Owner photo preview"
                >
            </div>

            <label for="ownerPhoto" class="owner-photo-button">
                <i class="bi bi-camera"></i>
                Choose Owner Photo
            </label>

            <input
                type="file"
                name="owner_photo"
                id="ownerPhoto"
                accept="image/jpeg,image/png,image/jpg"
                required
                hidden
            >

            <div class="owner-photo-filename" id="ownerPhotoFilename">
                No photo selected
            </div>

            @error('owner_photo')
                <div class="text-danger small mt-2">
                    {{ $message }}
                </div>
            @enderror

            <div class="file-upload-help">
                <i class="bi bi-info-circle"></i>
                JPG, JPEG, or PNG only. Maximum size: 2 MB.
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
                    Enter the basic information of the business owner
                    and establishment.
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
                        value="{{ old('business_name') }}"
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
                        value="{{ old('owner_name') }}"
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
                            value="{{ old('address') }}"
                            class="form-control custom-input @error('address') is-invalid @enderror"
                            placeholder="Enter complete business address"
                            autocomplete="off"
                            required
                        >
                        <div id="addressSuggestions" class="address-suggestions"></div>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
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
                            value="{{ old('contact_number') }}"
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
                            value="{{ old('email') }}"
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
            @selected(old('category') === $category->name)
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
                                @selected(old('valid_id_type') === 'PhilID / National ID')
                            >
                                PhilID / National ID
                            </option>
                            <option
                                value="Driver's License"
                                @selected(old('valid_id_type') === "Driver's License")
                            >
                                Driver's License
                            </option>
                            <option
                                value="Passport"
                                @selected(old('valid_id_type') === 'Passport')
                            >
                                Passport
                            </option>

                            <option
                                value="UMID"
                                @selected(old('valid_id_type') === 'UMID')
                            >
                                UMID
                            </option>

                            <option
                                value="SSS ID"
                                @selected(old('valid_id_type') === 'SSS ID')
                            >
                                SSS ID
                            </option>

                            <option
                                value="GSIS ID"
                                @selected(old('valid_id_type') === 'GSIS ID')
                            >
                                GSIS ID
                            </option>

                            <option
                                value="PhilHealth ID"
                                @selected(old('valid_id_type') === 'PhilHealth ID')
                            >
                                PhilHealth ID
                            </option>

                            <option
                                value="Postal ID"
                                @selected(old('valid_id_type') === 'Postal ID')
                            >
                                Postal ID
                            </option>

                            <option
                                value="Voter's ID"
                                @selected(old('valid_id_type') === "Voter's ID")
                            >
                                Voter's ID
                            </option>

                            <option
                                value="Other"
                                @selected(old('valid_id_type') === 'Other')
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
                            value="{{ old('valid_id_number') }}"
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
                    <div class="business-field">
    <label class="custom-label">
        <i class="bi bi-card-image"></i>
        Valid ID Picture <span class="required">*</span>
    </label>

    <div class="file-upload-wrapper">

        <input
            type="file"
            name="valid_id_file"
            id="validIdFile"
            class="form-control custom-input @error('valid_id_file') is-invalid @enderror"
            accept="image/jpeg,image/png,image/jpg"
            required
        >
        @error('valid_id_file')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <div class="file-upload-help">
            <i class="bi bi-info-circle"></i>
            Upload a clear picture of the owner's valid ID.
            JPG, JPEG, or PNG only. Maximum size: 5 MB.
        </div>
        <div id="validIdPreviewContainer" class="valid-id-preview-container">
            <img
                id="validIdPreview"
                class="valid-id-preview"
                alt="Valid ID Preview"
            >
        </div>

    </div>
</div>
<div class="business-field">

    <label class="custom-label">
        <i class="bi bi-building"></i>
        Business Exterior Photo
        <span class="required">*</span>
    </label>

    <div class="file-upload-wrapper">

        <input
            type="file"
            name="business_exterior"
            id="businessExterior"
            class="form-control custom-input @error('business_exterior') is-invalid @enderror"
            accept="image/jpeg,image/png,image/jpg"
            required
        >
        @error('business_exterior')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <div class="file-upload-help">
            <i class="bi bi-info-circle"></i>
            Upload a clear picture of the business establishment.
            JPG, JPEG, or PNG only. Maximum size: 5 MB.
        </div>
        <div id="businessExteriorPreviewContainer"
             class="image-preview-container">

            <img
                id="businessExteriorPreview"
                class="image-preview"
                alt="Business Exterior Preview"
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
                                    @selected(old('landmark') === $landmark)
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
                        >{{ old('location_description') }}</textarea>

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
                        Enter the complete business address and use the map
                        to confirm the exact business location.
                    </p>
                </div>
            </div>


            <div class="card-body-custom">
                <div id="businessMap"class="business-map"></div>
                <input
                    type="hidden"
                    id="latitude"
                    name="latitude"
                    value="{{ old('latitude', 12.6863) }}"
                >
                <input
                    type="hidden"
                    id="longitude"
                    name="longitude"
                    value="{{ old('longitude', 124.1263) }}"
                >
                <div class="map-help">
                    <i class="bi bi-info-circle"></i>
                    Enter a complete business address above.
                    The map will automatically search for the location.
                    You can also click the map or drag the marker to adjust
                    the exact location.
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a
                href="{{ route('businesses.index') }}"
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
                Create Business Profile
            </button>
        </div>
    </form>
    </div>
</div>

@endsection

@push('styles')
    <link
        rel="stylesheet"
        href="https://unpkg.com/maplibre-gl@4.7.1/dist/maplibre-gl.css"
    />
<style>
.register-page {
    width: 100%;
    padding: 30px 28px 50px;
    background: #ffffff;
}
.registration-header {
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
.registration-header h1 {
    margin: 0;
    font-size: 38px;
    font-weight: 700;
    letter-spacing: -.5px;
}
.registration-header p {
    margin: 5px 0 0;
    color: #e3f5fc;
    font-size: 17px;
}
.registration-badge {
    background: rgba(255,255,255,.10);
    border: 1px solid rgba(255,255,255,.12);
    padding: 13px 22px;
    border-radius: 30px;
    font-size: 15px;
    font-weight: 600;
    white-space: nowrap;
}
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
.custom-textarea::placeholder {
    color: #88aabd;
}
.custom-textarea:focus {
    border-color: #0088b8 !important;
    box-shadow:
        0 0 0 3px rgba(0,136,184,.10) !important;
    outline: none;
}
.category-select {
    cursor: pointer;
}
.manage-category-option {
    font-weight: 700;
}
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
    box-shadow: 0 3px 8px rgba(0,70,100,.35);
}

.geo-marker-pin i {
    transform: rotate(45deg);
    color: #ffffff;
    font-size: 18px;

}
.category-modal {
    border: 1px solid #9ee2fb;
    border-radius: 18px;
    overflow: hidden;
    box-shadow:
        0 20px 50px rgba(0,60,90,.20);

}


.category-modal-header {
    padding: 22px 25px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #e0eef3;
    background: #ffffff;

}
.category-modal-title {
    display: flex;
    align-items: center;
    gap: 13px;
}


.category-modal-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background: #eff9fc;
    color: #005676;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}


.category-modal-header h5 {

    margin: 0;

    color: #004d70;

    font-size: 19px;

    font-weight: 700;
}

.category-modal-header p {
    margin: 3px 0 0;
    color: #7194a4;
    font-size: 13px;

}
.category-modal-body {
    padding: 24px;
    background: #ffffff;

}
.category-manage-label {
    display: block;
    margin-bottom: 9px;
    color: #003f61;
    font-size: 14px;
    font-weight: 600;

}
.category-manage-label i {
    color: #00739a;
    margin-right: 5px;

}


.add-category-row {
    display: flex;
    gap: 8px;

}


.category-manage-input {
    height: 46px;
    border: 1.5px solid #9cdef7 !important;
    border-radius: 10px !important;
    box-shadow: none !important;
}
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

.image-preview-container {
    display: none;
    margin-top: 14px;
    padding: 10px;
    width: 130px;
    height: 130px;
    border: 1px solid #b9e4f2;
    border-radius: 14px;
    background: #f7fcfd;
    overflow: hidden;
}

.image-preview-container.show {
    display: block;
}

.image-preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 9px;
}

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


.custom-alert {

    border-radius: 13px;

    border: none;

    margin-bottom: 25px;

}
@media (max-width: 900px) {

    .register-page {

        padding: 20px 15px 40px;

    }


    .registration-header {

        padding: 25px;

        align-items: flex-start;

        flex-direction: column;

    }

    .registration-header h1 {
        font-size: 30px;
    }
    .registration-header p {
        font-size: 16px;
    }
    .registration-badge {
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
    .registration-header h1 {
        font-size: 25px;
    }
    .registration-header p {
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
    box-shadow: 0 8px 16px rgba(0,70,100,.10);
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

.address-suggestion-item:hover,
.address-suggestion-item.active {
    background: #eff9fc;
}

.address-suggestion-empty {
    padding: 12px 18px;
    font-size: 14px;
    color: #8aa5b1;
}
    .custom-textarea {

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

    .add-category-row {
        flex-direction: column;
    }
    .btn-add-category {
        width: 100%;
    }

}
.owner-photo-card {
    margin-bottom: 20px;
}
.owner-photo-body {
    padding: 18px 25px 20px !important;
    min-height: auto !important;
    height: auto !important;
}
.owner-photo-upload {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.owner-photo-preview {
    width: 170px;
    height: 170px;
    border-radius: 50%;
    border: 4px solid #d8f1f8;
    background: #eff9fc;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    margin-bottom: 18px;
    box-shadow: 0 6px 18px rgba(0, 70, 100, 0.10);
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
    display: none;
}
.owner-photo-preview.has-image img {
    display: block;
}
.owner-photo-preview.has-image .owner-photo-placeholder {
    display: none;
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
        background 0.2s ease,
        transform 0.2s ease,
        box-shadow 0.2s ease;
}
.owner-photo-button:hover {
    background: #003f59;
    color: #ffffff;
    transform: translateY(-1px);
    box-shadow: 0 5px 12px rgba(0, 70, 100, 0.20);
}
.owner-photo-button i {
    font-size: 17px;
}
.owner-photo-filename {
    margin-top: 10px;
    color: #527789;
    font-size: 13px;
    max-width: 350px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.owner-photo-upload .file-upload-help {
    margin-top: 7px;
    text-align: center;
}
.valid-id-preview-container,
.image-preview-container {
    display: none;
    margin-top: 12px;
    padding: 10px;
    border: 1px solid #d8edf3;
    border-radius: 10px;
    background: #f8fcfd;
    text-align: center;
}

.valid-id-preview-container.has-image,
.image-preview-container.show {
    display: block;
}

.valid-id-preview,
.image-preview {
    display: block;
    max-width: 100%;
    width: 360px;
    max-height: 220px;
    object-fit: contain;
    margin: 0 auto;
    border-radius: 7px;
}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/maplibre-gl@4.7.1/dist/maplibre-gl.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const GEOAPIFY_KEY =
        @json(config('services.geoapify.key'));

    if (!GEOAPIFY_KEY) {
        console.error('Geoapify API key is missing.');
        return;
    }

    const DEFAULT_LAT = 12.6863;
    const DEFAULT_LNG = 124.1263;

    const mapElement =
        document.getElementById('businessMap');

    if (!mapElement) {
        console.error('Business map element not found.');
        return;
    }

    const latitudeInput = document.getElementById('latitude');
    const longitudeInput = document.getElementById('longitude');
    const addressInput = document.getElementById('businessAddress');

    let latitude = parseFloat(latitudeInput?.value);
    let longitude = parseFloat(longitudeInput?.value);

    if (!Number.isFinite(latitude)) {
        latitude = DEFAULT_LAT;
    }

    if (!Number.isFinite(longitude)) {
        longitude = DEFAULT_LNG;
    }

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
        center: [longitude, latitude],
        zoom: 17,
        minZoom: 12,
        maxZoom: 20
    });

    map.addControl(new maplibregl.NavigationControl(), 'top-right');

    const barangayBounds = [
        [124.0900, 12.6500],
        [124.1450, 12.7050]
    ];

    map.setMaxBounds(barangayBounds);

    const markerEl = document.createElement('div');
    markerEl.className = 'geo-marker';
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
        .setLngLat([longitude, latitude])
        .addTo(map);

    function updateCoordinates(lat, lng) {

        if (latitudeInput) {
            latitudeInput.value = Number(lat).toFixed(7);
        }

        if (longitudeInput) {
            longitudeInput.value = Number(lng).toFixed(7);
        }
    }

    updateCoordinates(latitude, longitude);

    function showMarkerPopup(html) {

        const popup = new maplibregl.Popup({ offset: 25 })
            .setHTML(html);

        marker.setPopup(popup);
        marker.togglePopup();
    }

    async function reverseGeocode(lat, lng, updateAddress = true) {

        try {

            const url =
                'https://api.geoapify.com/v1/geocode/reverse'
                + '?lat=' + encodeURIComponent(lat)
                + '&lon=' + encodeURIComponent(lng)
                + '&format=json'
                + '&apiKey=' + encodeURIComponent(GEOAPIFY_KEY);

            const response = await fetch(url);

            if (!response.ok) {
                throw new Error('Reverse geocoding request failed.');
            }

            const data = await response.json();

            if (!data.results || !data.results.length) {
                return;
            }

            const result = data.results[0];
            const formatted = result.formatted || '';

            if (updateAddress && addressInput && formatted) {
                addressInput.value = formatted;
            }

            showMarkerPopup(`
                <div style="min-width:220px; font-size:13px;">
                    <strong>Selected Business Location</strong>
                    <br>
                    <span>${escapeHtml(formatted)}</span>
                </div>
            `);

        } catch (error) {
            console.error('Geoapify reverse geocoding error:', error);
        }
    }
    marker.on('dragend', async function () {

        const lngLat = marker.getLngLat();

        updateCoordinates(lngLat.lat, lngLat.lng);

        await reverseGeocode(lngLat.lat, lngLat.lng, true);
    });
    map.on('click', async function (event) {

        const { lng, lat } = event.lngLat;

        marker.setLngLat([lng, lat]);

        updateCoordinates(lat, lng);

        await reverseGeocode(lat, lng, true);
    });

    let searchTimer = null;
    let searchController = null;
    let selectedSuggestion = false;

    if (addressInput) {

        addressInput.addEventListener('input', function () {

            selectedSuggestion = false;

            clearTimeout(searchTimer);

            const query = this.value.trim();

            if (query.length < 3) {
                hideAddressSuggestions();
                return;
            }

            searchTimer = setTimeout(function () {
                searchAddress(query);
            }, 350);
        });

        addressInput.addEventListener('keydown', function (event) {

            if (event.key === 'Enter') {

                event.preventDefault();

                const query = this.value.trim();

                if (query.length >= 3) {
                    searchAddress(query);
                }
            }
        });
    }

    let suggestions = document.getElementById('addressSuggestions');

    if (!suggestions && addressInput) {

        suggestions = document.createElement('div');
        suggestions.id = 'addressSuggestions';
        suggestions.className = 'address-suggestions';

        addressInput.parentNode.appendChild(suggestions);
    }
    async function searchAddress(query) {

        if (!query) {
            return;
        }

        if (searchController) {
            searchController.abort();
        }

        searchController = new AbortController();

        try {
            const filter =
                'rect:124.0900,12.6500,124.1450,12.7050|countrycode:ph';

            const bias =
                'proximity:124.1263,12.6863';

            const url =
                'https://api.geoapify.com/v1/geocode/autocomplete'
                + '?text=' + encodeURIComponent(query)
                + '&filter=' + encodeURIComponent(filter)
                + '&bias=' + encodeURIComponent(bias)
                + '&limit=6'
                + '&format=json'
                + '&apiKey=' + encodeURIComponent(GEOAPIFY_KEY);

            const response = await fetch(url, { signal: searchController.signal });

            if (!response.ok) {
                throw new Error('Geoapify autocomplete failed.');
            }

            const data = await response.json();
            const results = data.results || [];

            displaySuggestions(results);

        } catch (error) {

            if (error.name === 'AbortError') {
                return;
            }

            console.error('Geoapify search error:', error);

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

            suggestions.classList.add('open');

            return;
        }

        results.forEach(function (result) {

            const item = document.createElement('div');
            item.className = 'address-suggestion-item';

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
                <div style="display:flex; gap:10px; align-items:flex-start;">
                    <i class="bi bi-geo-alt-fill" style="color:#075374; margin-top:2px;"></i>
                    <div>
                        <div style="font-weight:600; color:#003f61;">
                            ${escapeHtml(title)}
                        </div>
                        <div style="font-size:12px; color:#7194a4; margin-top:2px;">
                            ${escapeHtml(subtitle)}
                        </div>
                    </div>
                </div>
            `;

            item.addEventListener('click', function () {
                selectLocation(result);
            });

            suggestions.appendChild(item);
        });
        suggestions.classList.add('open');
    }

    function selectLocation(result) {

        const lat = parseFloat(result.lat);
        const lng = parseFloat(result.lon);

        if (!Number.isFinite(lat) || !Number.isFinite(lng)) {
            return;
        }

        const formatted =
            result.formatted ||
            result.address_line1 ||
            '';

        selectedSuggestion = true;

        if (addressInput) {
            addressInput.value = formatted;
        }

        updateCoordinates(lat, lng);

        marker.setLngLat([lng, lat]);

        map.flyTo({
            center: [lng, lat],
            zoom: 18,
            speed: 1.2
        });

        showMarkerPopup(`
            <div style="min-width:220px; font-size:13px;">
                <strong>Business Location</strong>
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
        suggestions.classList.remove('open');
    }

    class LocateControl {

        onAdd(mapInstance) {

            this._map = mapInstance;

            this._container = document.createElement('div');
            this._container.className = 'maplibregl-ctrl maplibregl-ctrl-group';

            const button = document.createElement('button');
            button.type = 'button';
            button.title = 'Use my current location';
            button.innerHTML = '<i class="bi bi-crosshair"></i>';
            button.style.width = '29px';
            button.style.height = '29px';
            button.style.display = 'flex';
            button.style.alignItems = 'center';
            button.style.justifyContent = 'center';
            button.style.background = '#ffffff';
            button.style.color = '#075374';
            button.style.fontSize = '16px';
            button.style.border = 'none';
            button.style.cursor = 'pointer';

            button.addEventListener('click', function () {
                useCurrentLocation();
            });

            this._container.appendChild(button);

            return this._container;
        }

        onRemove() {
            this._container.parentNode.removeChild(this._container);
            this._map = undefined;
        }
    }

    map.addControl(new LocateControl(), 'bottom-right');

    function useCurrentLocation() {

        if (!navigator.geolocation) {
            alert('Your browser does not support location services.');
            return;
        }

        navigator.geolocation.getCurrentPosition(

            async function (position) {

                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                updateCoordinates(lat, lng);

                marker.setLngLat([lng, lat]);

                map.flyTo({
                    center: [lng, lat],
                    zoom: 18,
                    speed: 1.2
                });

                await reverseGeocode(lat, lng, true);
            },

            function (error) {
                console.error('Location error:', error);
                alert('Unable to get your current location. Please allow location access in your browser.');
            },

            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    }

    document.addEventListener('click', function (event) {

        if (addressInput && !event.target.closest('.address-autocomplete-wrapper')) {
            hideAddressSuggestions();
        }
    });

    setTimeout(function () {
        map.resize();
    }, 500);

    setTimeout(function () {
        map.resize();
    }, 1000);


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



    const form =
        document.getElementById('businessForm');

    const submitButton =
        document.getElementById('submitButton');

    if (form) {

        form.addEventListener('submit', function () {

            if (submitButton) {

                submitButton.disabled = true;

                submitButton.innerHTML = `
                    <span
                        class="spinner-border spinner-border-sm"
                        role="status"
                        aria-hidden="true">
                    </span>

                    Saving Business...
                `;
            }
        });
    }


    const contactInput =
        document.querySelector('input[name="contact_number"]');

    if (contactInput) {

        contactInput.addEventListener('input', function () {

            this.value =
                this.value.replace(/[^0-9+\-\s]/g, '');
        });
    }

    const ownerPhoto = document.getElementById('ownerPhoto');
    const ownerPhotoPreview = document.getElementById('ownerPhotoPreview');
    const ownerPhotoPreviewContainer = document.getElementById('ownerPhotoPreviewContainer');
    const ownerPhotoPlaceholder = document.getElementById('ownerPhotoPlaceholder');
    const ownerPhotoFilename = document.getElementById('ownerPhotoFilename');

    if (ownerPhoto && ownerPhotoPreview && ownerPhotoPreviewContainer) {

        ownerPhoto.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {

                ownerPhotoPreview.removeAttribute('src');
                ownerPhotoPreviewContainer.classList.remove('has-image');

                if (ownerPhotoPlaceholder) {
                    ownerPhotoPlaceholder.style.display = 'flex';
                }

                if (ownerPhotoFilename) {
                    ownerPhotoFilename.textContent = 'No photo selected';
                }

                return;
            }

            if (!file.type.startsWith('image/')) {

                this.value = '';

                ownerPhotoPreview.removeAttribute('src');
                ownerPhotoPreviewContainer.classList.remove('has-image');

                if (ownerPhotoPlaceholder) {
                    ownerPhotoPlaceholder.style.display = 'flex';
                }

                alert('Please select a valid JPG, JPEG, or PNG image.');

                return;
            }

            if (ownerPhotoFilename) {
                ownerPhotoFilename.textContent = file.name;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                ownerPhotoPreview.src = event.target.result;
                ownerPhotoPreviewContainer.classList.add('has-image');

                if (ownerPhotoPlaceholder) {
                    ownerPhotoPlaceholder.style.display = 'none';
                }
            };

            reader.readAsDataURL(file);
        });
    }


    const validIdFile = document.getElementById('validIdFile');
    const validIdPreview = document.getElementById('validIdPreview');
    const validIdPreviewContainer = document.getElementById('validIdPreviewContainer');

    if (validIdFile && validIdPreview && validIdPreviewContainer) {

        validIdFile.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {

                validIdPreview.removeAttribute('src');
                validIdPreviewContainer.classList.remove('has-image');

                return;
            }

            if (!file.type.startsWith('image/')) {

                this.value = '';

                validIdPreview.removeAttribute('src');
                validIdPreviewContainer.classList.remove('has-image');

                alert('Please select a valid JPG, JPEG, or PNG image.');

                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                validIdPreview.src = event.target.result;
                validIdPreviewContainer.classList.add('has-image');
            };

            reader.readAsDataURL(file);
        });
    }

    const businessExterior = document.getElementById('businessExterior');
    const businessExteriorPreview = document.getElementById('businessExteriorPreview');
    const businessExteriorPreviewContainer = document.getElementById('businessExteriorPreviewContainer');

    if (businessExterior && businessExteriorPreview && businessExteriorPreviewContainer) {

        businessExterior.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {

                businessExteriorPreview.removeAttribute('src');
                businessExteriorPreviewContainer.classList.remove('show');

                return;
            }

            if (!file.type.startsWith('image/')) {

                this.value = '';

                businessExteriorPreview.removeAttribute('src');
                businessExteriorPreviewContainer.classList.remove('show');

                alert('Please select a valid JPG, JPEG, or PNG image.');

                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                businessExteriorPreview.src = event.target.result;
                businessExteriorPreviewContainer.classList.add('show');
            };

            reader.readAsDataURL(file);
        });
    }

});

</script>

@endpush