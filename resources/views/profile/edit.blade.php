@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<div class="profile-page">

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="profile-page-header">

        <div class="profile-header-icon">
            <i class="bi bi-person-circle"></i>
        </div>

        <div>
            <span class="profile-eyebrow">
                ACCOUNT SETTINGS
            </span>

            <h1>
                My Profile
            </h1>

            <p>
                Update your personal information, profile photo,
                and password.
            </p>
        </div>

    </div>


    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div class="profile-alert profile-alert-success">

            <i class="bi bi-check-circle-fill"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- =========================================================
         VALIDATION ERRORS
    ========================================================== --}}

    @if($errors->any())

        <div class="profile-alert profile-alert-danger">

            <i class="bi bi-exclamation-triangle-fill"></i>

            <div>

                <strong>
                    Please correct the following:
                </strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    <div class="profile-grid">


        {{-- =====================================================
             LEFT COLUMN
        ====================================================== --}}

        <div class="profile-main">


            {{-- =================================================
                 SINGLE PROFILE FORM
                 PHOTO + ACCOUNT DETAILS SAVED TOGETHER
            ================================================== --}}

            <form
                method="POST"
                action="{{ route('profile.update') }}"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


                {{-- =================================================
                     PROFILE PHOTO
                ================================================== --}}

                <div class="profile-card">

                    <div class="profile-card-title">

                        <div class="profile-section-icon">
                            <i class="bi bi-person-bounding-box"></i>
                        </div>

                        <div>

                            <h2>
                                Profile Photo
                            </h2>

                            <p>
                                Upload a JPG, PNG, WEBP, or GIF image.
                                Maximum file size is 2MB.
                            </p>

                        </div>

                    </div>


                    <div class="profile-photo-area">

                        {{-- CURRENT PHOTO --}}

                        <div class="profile-photo-wrapper">

                            @if($user->profile_photo)

                                <img
                                    src="{{ asset('storage/' . $user->profile_photo) }}"
                                    alt="{{ $user->name }}"
                                    class="profile-photo"
                                    id="profilePhotoPreview"
                                >

                            @else

                                <div
                                    class="profile-photo-placeholder"
                                    id="profilePhotoPlaceholder"
                                >
                                    <i class="bi bi-person-fill"></i>
                                </div>

                            @endif

                        </div>


                        {{-- PHOTO ACTIONS --}}

                        <div class="profile-photo-actions">

                            <label
                                for="profile_photo"
                                class="btn-change-photo"
                            >

                                <i class="bi bi-camera-fill"></i>

                                Change Photo

                            </label>


                            <input
                                type="file"
                                id="profile_photo"
                                name="profile_photo"
                                accept=".jpg,.jpeg,.png,.webp,.gif,image/jpeg,image/png,image/webp,image/gif"
                                hidden
                            >


                            {{-- SELECTED FILE NAME --}}

                            <div
                                id="selectedPhotoName"
                                class="selected-photo-name"
                            >
                                No new photo selected.
                            </div>


                            {{-- REMOVE EXISTING PHOTO OPTION --}}

                            @if($user->profile_photo)

                                <label class="remove-photo-option">

                                    <input
                                        type="checkbox"
                                        name="remove_profile_photo"
                                        value="1"
                                    >

                                    <span>
                                        Remove current photo
                                    </span>

                                </label>

                            @endif

                            <small class="photo-save-note">

                                <i class="bi bi-info-circle"></i>

                                Your photo will be saved when you click
                                <strong>Save Profile</strong>.

                            </small>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                     ACCOUNT DETAILS
                ================================================== --}}

                <div class="profile-card">

                    <div class="profile-card-title">

                        <div class="profile-section-icon">
                            <i class="bi bi-person-vcard"></i>
                        </div>

                        <div>

                            <h2>
                                Account Details
                            </h2>

                            <p>
                                Update your name, username, email,
                                and gender.
                            </p>

                        </div>

                    </div>


                    <div class="profile-form-grid">


                        {{-- =================================================
                             NAME
                        ================================================== --}}

                        <div class="profile-field full">

                            <label for="name">
                                Full Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                required
                                autocomplete="name"
                            >

                        </div>


                        {{-- =================================================
                             USERNAME
                        ================================================== --}}

                        <div class="profile-field">

                            <label for="username">
                                Username
                            </label>

                            <input
                                type="text"
                                id="username"
                                name="username"
                                value="{{ old('username', $user->username) }}"
                                required
                                autocomplete="username"
                            >

                        </div>


                        {{-- =================================================
                             EMAIL
                        ================================================== --}}

                        <div class="profile-field">

                            <label for="email">
                                Email Address
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                placeholder="Enter email address"
                                autocomplete="email"
                                required
                            >

                        </div>


                        {{-- =================================================
                             GENDER
                        ================================================== --}}

                        <div class="profile-field">

                            <label for="gender">
                                Gender
                            </label>

                            <select
                                id="gender"
                                name="gender"
                            >

                                <option value="">
                                    Select Gender
                                </option>

                                <option
                                    value="Male"
                                    {{ old('gender', $user->gender) === 'Male' ? 'selected' : '' }}
                                >
                                    Male
                                </option>

                                <option
                                    value="Female"
                                    {{ old('gender', $user->gender) === 'Female' ? 'selected' : '' }}
                                >
                                    Female
                                </option>

                                <option
                                    value="Other"
                                    {{ old('gender', $user->gender) === 'Other' ? 'selected' : '' }}
                                >
                                    Other
                                </option>

                            </select>

                        </div>


                        {{-- =================================================
                             ROLE - FIXED
                        ================================================== --}}

                        <div class="profile-field">

                            <label>
                                Role
                            </label>

                            <div class="fixed-role">

                                <div>

                                    <span>
                                        System Role
                                    </span>

                                    <strong>
                                        {{ ucfirst($user->role) }}
                                    </strong>

                                </div>

                                <i class="bi bi-lock-fill"></i>

                            </div>

                            <small>
                                Your system role is fixed and cannot
                                be changed from your profile.
                            </small>

                        </div>

                    </div>


                    {{-- =================================================
                         SAVE PROFILE
                         PHOTO + DETAILS ARE SAVED HERE
                    ================================================== --}}

                    <div class="profile-form-footer">

                        <button
                            type="submit"
                            class="btn-save-profile"
                        >

                            <i class="bi bi-check-circle"></i>

                            Save Profile

                        </button>

                    </div>

                </div>

            </form>



            {{-- =================================================
                 CHANGE PASSWORD
            ================================================== --}}

            <div class="profile-card">

                <div class="profile-card-title">

                    <div class="profile-section-icon">
                        <i class="bi bi-key"></i>
                    </div>

                    <div>

                        <h2>
                            Change Password
                        </h2>

                        <p>
                            Use at least 8 characters for your new
                            password.
                        </p>

                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route('profile.password.update') }}"
                >

                    @csrf
                    @method('PUT')


                    <div class="password-fields">


                        {{-- CURRENT PASSWORD --}}

                        <div class="profile-field">

                            <label for="current_password">
                                Current Password
                            </label>

                            <div class="password-input">

                                <input
                                    type="password"
                                    id="current_password"
                                    name="current_password"
                                    required
                                    autocomplete="current-password"
                                >

                                <button
                                    type="button"
                                    onclick="togglePassword('current_password', this)"
                                >

                                    <i class="bi bi-eye"></i>

                                </button>

                            </div>

                        </div>


                        {{-- NEW PASSWORD --}}

                        <div class="profile-field">

                            <label for="password">
                                New Password
                            </label>

                            <div class="password-input">

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                >

                                <button
                                    type="button"
                                    onclick="togglePassword('password', this)"
                                >

                                    <i class="bi bi-eye"></i>

                                </button>

                            </div>

                        </div>


                        {{-- CONFIRM PASSWORD --}}

                        <div class="profile-field">

                            <label for="password_confirmation">
                                Confirm New Password
                            </label>

                            <div class="password-input">

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                >

                                <button
                                    type="button"
                                    onclick="togglePassword('password_confirmation', this)"
                                >

                                    <i class="bi bi-eye"></i>

                                </button>

                            </div>

                        </div>

                    </div>


                    <div class="profile-form-footer">

                        <button
                            type="submit"
                            class="btn-save-profile"
                        >

                            <i class="bi bi-shield-lock"></i>

                            Change Password

                        </button>

                    </div>

                </form>

            </div>

        </div>



        {{-- =====================================================
             RIGHT COLUMN
        ====================================================== --}}

        <div class="profile-side">


            {{-- =================================================
                 PROFILE SUMMARY
            ================================================== --}}

            <div class="profile-summary-card">

                <div class="summary-photo">

                    @if($user->profile_photo)

                        <img
                            src="{{ asset('storage/' . $user->profile_photo) }}"
                            alt="{{ $user->name }}"
                            id="summaryProfilePhoto"
                        >

                    @else

                        <div class="summary-photo-placeholder">

                            <i class="bi bi-person-fill"></i>

                        </div>

                    @endif

                </div>


                <h3>
                    {{ $user->name }}
                </h3>

                <p>
                    {{ '@' . $user->username }}
                </p>

                <div class="summary-role">

                    <i class="bi bi-shield-check"></i>

                    {{ ucfirst($user->role) }}

                </div>

            </div>



            {{-- =================================================
                 ACCOUNT INFORMATION
            ================================================== --}}

            <div class="profile-info-card">

                <h3>

                    <i class="bi bi-info-circle"></i>

                    Account Information

                </h3>


                <div class="info-row">

                    <span>
                        Username
                    </span>

                    <strong>
                        {{ $user->username }}
                    </strong>

                </div>


                <div class="info-row">

                    <span>
                        Email
                    </span>

                    <strong>
                        {{ $user->email ?: 'Not provided' }}
                    </strong>

                </div>


                <div class="info-row">

                    <span>
                        Gender
                    </span>

                    <strong>
                        {{ $user->gender ?: 'Not provided' }}
                    </strong>

                </div>


                <div class="info-row">

                    <span>
                        Role
                    </span>

                    <strong>
                        {{ ucfirst($user->role) }}
                    </strong>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection



@push('styles')

<style>

/* =========================================================
   PROFILE PAGE
========================================================= */

.profile-page {
    width: 100%;
    max-width: 1250px;
    margin: 0 auto;
    padding: 30px 28px 50px;
}


/* =========================================================
   HEADER
========================================================= */

.profile-page-header {
    background: linear-gradient(
        135deg,
        #075374,
        #004b69
    );

    border-radius: 18px;

    padding: 28px 34px;

    min-height: 130px;

    display: flex;
    align-items: center;

    gap: 20px;

    color: white;

    margin-bottom: 25px;

    box-shadow:
        0 8px 22px rgba(0, 70, 100, .12);
}

.profile-header-icon {
    width: 62px;
    height: 62px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 46px;
}

.profile-eyebrow {
    display: block;

    color: #bfe9f8;

    font-size: 13px;

    font-weight: 700;

    letter-spacing: 1.5px;

    margin-bottom: 3px;
}

.profile-page-header h1 {
    margin: 0;

    font-size: 36px;

    font-weight: 700;
}

.profile-page-header p {
    margin: 5px 0 0;

    color: #e1f4fb;

    font-size: 16px;
}


/* =========================================================
   ALERTS
========================================================= */

.profile-alert {
    display: flex;

    align-items: flex-start;

    gap: 12px;

    padding: 14px 18px;

    border-radius: 12px;

    margin-bottom: 20px;

    font-size: 14px;
}

.profile-alert-success {
    background: #e9f8f0;

    color: #166534;

    border: 1px solid #b7e4ca;
}

.profile-alert-danger {
    background: #fff1f2;

    color: #b42318;

    border: 1px solid #fecdd3;
}

.profile-alert ul {
    margin: 6px 0 0;

    padding-left: 18px;
}


/* =========================================================
   GRID
========================================================= */

.profile-grid {
    display: grid;

    grid-template-columns:
        minmax(0, 1fr)
        310px;

    gap: 24px;

    align-items: start;
}

.profile-main {
    min-width: 0;
}

.profile-side {
    position: sticky;

    top: 25px;
}


/* =========================================================
   CARDS
========================================================= */

.profile-card,
.profile-summary-card,
.profile-info-card {
    background: #ffffff;

    border: 1px solid #e4eef2;

    border-radius: 18px;

    box-shadow:
        0 5px 18px rgba(0, 65, 90, .07);

    margin-bottom: 22px;
}

.profile-card {
    padding: 25px;
}

.profile-card-title {
    display: flex;

    align-items: flex-start;

    gap: 13px;

    margin-bottom: 24px;
}

.profile-section-icon {
    width: 42px;
    height: 42px;

    flex-shrink: 0;

    border-radius: 11px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #e8f7fb;

    color: #08749b;

    font-size: 21px;
}

.profile-card-title h2 {
    margin: 0;

    font-size: 20px;

    color: #163b4b;

    font-weight: 700;
}

.profile-card-title p {
    margin: 4px 0 0;

    color: #71828c;

    font-size: 13px;
}


/* =========================================================
   PHOTO
========================================================= */

.profile-photo-area {
    display: flex;

    align-items: center;

    gap: 25px;
}

.profile-photo-wrapper {
    flex-shrink: 0;
}

.profile-photo,
.profile-photo-placeholder {
    width: 110px;
    height: 110px;

    border-radius: 50%;

    object-fit: cover;

    border: 3px solid #d7eaf0;

    box-shadow:
        0 4px 15px rgba(0, 70, 100, .10);
}

.profile-photo-placeholder {
    display: flex;

    align-items: center;
    justify-content: center;

    background: #e8f7fb;

    color: #08749b;

    font-size: 45px;
}

.profile-photo-actions {
    display: flex;

    flex-direction: column;

    align-items: flex-start;

    gap: 9px;
}

.btn-change-photo {
    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    border-radius: 10px;

    padding: 10px 15px;

    font-size: 13px;

    font-weight: 700;

    cursor: pointer;

    transition: .2s ease;

    background: #087f83;

    color: white;

    border: none;
}

.btn-change-photo:hover {
    background: #066d70;
}

.selected-photo-name {
    max-width: 320px;

    color: #607680;

    font-size: 12px;

    line-height: 1.4;

    word-break: break-word;
}

.photo-save-note {
    color: #7b8c94;

    font-size: 11px;

    line-height: 1.5;
}

.photo-save-note i {
    color: #08749b;

    margin-right: 3px;
}

.remove-photo-option {
    display: flex;

    align-items: center;

    gap: 7px;

    color: #c33d3d;

    font-size: 12px;

    cursor: pointer;
}

.remove-photo-option input {
    width: 15px;
    height: 15px;

    accent-color: #c33d3d;

    cursor: pointer;
}


/* =========================================================
   FORM
========================================================= */

.profile-form-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 18px;
}

.profile-field {
    min-width: 0;
}

.profile-field.full {
    grid-column: 1 / -1;
}

.profile-field label {
    display: block;

    margin-bottom: 7px;

    color: #304955;

    font-size: 13px;

    font-weight: 700;
}

.profile-field input,
.profile-field select {
    width: 100%;

    height: 45px;

    border: 1px solid #dce7eb;

    border-radius: 10px;

    padding: 0 13px;

    background: white;

    color: #273f4a;

    font-size: 14px;

    outline: none;

    transition: .2s ease;
}

.profile-field input:focus,
.profile-field select:focus {
    border-color: #1495a1;

    box-shadow:
        0 0 0 3px rgba(20,149,161,.10);
}

.profile-field small {
    display: block;

    margin-top: 6px;

    color: #7b8c94;

    font-size: 11px;
}


/* =========================================================
   FIXED ROLE
========================================================= */

.fixed-role {
    min-height: 45px;

    padding: 8px 12px;

    border-radius: 10px;

    border: 1px solid #dce7eb;

    background: #f7fafb;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;
}

.fixed-role div {
    display: flex;

    flex-direction: column;

    gap: 1px;
}

.fixed-role span {
    color: #7b8c94;

    font-size: 10px;
}

.fixed-role strong {
    color: #24434f;

    font-size: 13px;
}

.fixed-role > i {
    color: #8ca1aa;

    font-size: 13px;
}


/* =========================================================
   BUTTON
========================================================= */

.profile-form-footer {
    display: flex;

    justify-content: flex-end;

    margin-top: 22px;

    padding-top: 18px;

    border-top: 1px solid #edf2f4;
}

.btn-save-profile {
    border: none;

    border-radius: 10px;

    padding: 12px 22px;

    background: #087f83;

    color: white;

    font-size: 13px;

    font-weight: 700;

    display: inline-flex;

    align-items: center;

    gap: 8px;

    cursor: pointer;

    transition: .2s ease;
}

.btn-save-profile:hover {
    background: #066d70;
}


/* =========================================================
   PASSWORD
========================================================= */

.password-fields {
    display: grid;

    grid-template-columns:
        repeat(3, minmax(0, 1fr));

    gap: 18px;
}

.password-input {
    position: relative;
}

.password-input input {
    padding-right: 43px;
}

.password-input button {
    position: absolute;

    right: 8px;

    top: 50%;

    transform: translateY(-50%);

    border: none;

    background: transparent;

    color: #78909a;

    cursor: pointer;

    font-size: 16px;
}


/* =========================================================
   SIDE SUMMARY
========================================================= */

.profile-summary-card {
    padding: 28px;

    text-align: center;
}

.summary-photo {
    margin-bottom: 15px;
}

.summary-photo img,
.summary-photo-placeholder {
    width: 105px;
    height: 105px;

    border-radius: 50%;

    object-fit: cover;

    margin: 0 auto;

    border: 3px solid #d8edf2;
}

.summary-photo-placeholder {
    display: flex;

    align-items: center;
    justify-content: center;

    background: #e8f7fb;

    color: #08749b;

    font-size: 43px;
}

.profile-summary-card h3 {
    margin: 0;

    color: #163b4b;

    font-size: 20px;

    font-weight: 700;
}

.profile-summary-card > p {
    margin: 4px 0 13px;

    color: #7b8c94;

    font-size: 13px;
}

.summary-role {
    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 7px 12px;

    border-radius: 20px;

    background: #e8f7fb;

    color: #08749b;

    font-size: 12px;

    font-weight: 700;
}


/* =========================================================
   ACCOUNT INFORMATION
========================================================= */

.profile-info-card {
    padding: 20px;
}

.profile-info-card h3 {
    margin: 0 0 15px;

    display: flex;

    align-items: center;

    gap: 8px;

    color: #234451;

    font-size: 16px;
}

.profile-info-card h3 i {
    color: #08749b;
}

.info-row {
    display: flex;

    align-items: flex-start;

    justify-content: space-between;

    gap: 15px;

    padding: 11px 0;

    border-bottom: 1px solid #edf2f4;
}

.info-row:last-child {
    border-bottom: none;
}

.info-row span {
    color: #7b8c94;

    font-size: 12px;
}

.info-row strong {
    color: #28434e;

    font-size: 12px;

    text-align: right;

    word-break: break-word;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1000px) {

    .profile-grid {
        grid-template-columns: 1fr;
    }

    .profile-side {
        position: static;
    }

    .profile-summary-card {
        text-align: left;

        display: flex;

        align-items: center;

        gap: 18px;
    }

    .summary-photo {
        margin: 0;
    }

    .profile-summary-card h3,
    .profile-summary-card > p {
        margin-left: 0;
    }

}


@media (max-width: 700px) {

    .profile-page {
        padding: 20px 15px 40px;
    }

    .profile-page-header {
        padding: 23px 20px;

        min-height: auto;
    }

    .profile-header-icon {
        width: 45px;
        height: 45px;

        font-size: 34px;
    }

    .profile-page-header h1 {
        font-size: 28px;
    }

    .profile-page-header p {
        font-size: 13px;
    }

    .profile-form-grid,
    .password-fields {
        grid-template-columns: 1fr;
    }

    .profile-field.full {
        grid-column: auto;
    }

    .profile-photo-area {
        align-items: flex-start;
    }

}


@media (max-width: 480px) {

    .profile-card {
        padding: 18px;
    }

    .profile-photo-area {
        flex-direction: column;
    }

    .profile-photo-actions {
        width: 100%;
    }

    .btn-change-photo {
        width: 100%;

        justify-content: center;
    }

    .profile-summary-card {
        flex-direction: column;

        align-items: center;

        text-align: center;
    }

    .profile-form-footer {
        justify-content: stretch;
    }

    .btn-save-profile {
        width: 100%;

        justify-content: center;
    }

}

</style>

@endpush



@push('scripts')

<script>

/* =========================================================
   PASSWORD VISIBILITY
========================================================= */

function togglePassword(id, button)
{
    const input = document.getElementById(id);
    const icon = button.querySelector('i');

    if (input.type === 'password') {

        input.type = 'text';

        icon.classList.remove('bi-eye');

        icon.classList.add('bi-eye-slash');

    } else {

        input.type = 'password';

        icon.classList.remove('bi-eye-slash');

        icon.classList.add('bi-eye');

    }
}


/* =========================================================
   PROFILE PHOTO PREVIEW
   IMPORTANT:
   Selecting the photo DOES NOT submit the form.
========================================================= */

document.addEventListener('DOMContentLoaded', function () {

    const photoInput = document.getElementById('profile_photo');

    const selectedPhotoName =
        document.getElementById('selectedPhotoName');

    if (!photoInput) {
        return;
    }


    photoInput.addEventListener('change', function () {

        if (!this.files || !this.files.length) {

            selectedPhotoName.textContent =
                'No new photo selected.';

            return;
        }


        const file = this.files[0];


        /* Show selected file name */

        selectedPhotoName.textContent =
            'Selected: ' + file.name;


        /* =================================================
           PREVIEW THE NEW PHOTO IMMEDIATELY
           BUT DO NOT SUBMIT THE FORM
        ================================================== */

        const reader = new FileReader();


        reader.onload = function (event) {

            const photoPreview =
                document.getElementById('profilePhotoPreview');

            const placeholder =
                document.getElementById('profilePhotoPlaceholder');


            if (photoPreview) {

                photoPreview.src =
                    event.target.result;

            } else if (placeholder) {

                const newImage =
                    document.createElement('img');

                newImage.src =
                    event.target.result;

                newImage.alt =
                    'Profile Photo Preview';

                newImage.className =
                    'profile-photo';

                newImage.id =
                    'profilePhotoPreview';


                placeholder.replaceWith(newImage);

            }


            /* Update right-side summary preview */

            const summaryImage =
                document.getElementById('summaryProfilePhoto');


            if (summaryImage) {

                summaryImage.src =
                    event.target.result;

            }

        };


        reader.readAsDataURL(file);

    });

});

</script>

@endpush