@php
    $user = auth()->user();
    $role = $user->role;
@endphp

<div class="sidebar">

    {{-- =========================================================
         BRAND
    ========================================================== --}}
    <div class="sidebar-brand">

        <img
            src="{{ asset('images/logo.png') }}"
            alt="Barangay Logo"
            class="brand-logo"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
        >

        <div class="brand-logo-fallback" style="display:none;">
            <i class="bi bi-shield-fill-check"></i>
        </div>

        <div class="brand-title">
            REGISTRA
        </div>

        <div class="brand-subtitle">
            Barangay Management System
        </div>

    </div>


    {{-- =========================================================
         USER PROFILE
         REAL PROFILE PHOTO + REAL NAME
    ========================================================== --}}
    <div class="sidebar-user">

        <a
            href="{{ route('profile.edit') }}"
            class="sidebar-user-link"
        >

            {{-- PROFILE PHOTO --}}
            <div class="user-avatar">

                @if($user->profile_photo)

                    <img
                        src="{{ asset('storage/' . $user->profile_photo) }}"
                        alt="{{ $user->name }}"
                        class="sidebar-profile-photo"
                    >

                @else

                    <div class="user-avatar-letter">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                @endif

            </div>


            {{-- USER NAME --}}
            <div class="user-info">

                <strong>
                    {{ $user->name }}
                </strong>

                <small>
                    {{ ucfirst($role) }}
                </small>

            </div>

        </a>

    </div>


    {{-- =========================================================
         MAIN
    ========================================================== --}}
    <div class="sidebar-section">
        MAIN
    </div>

    <a
        href="{{ route('dashboard') }}"
        class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
    >
        <i class="bi bi-speedometer2"></i>
        <span>Dashboard</span>
    </a>

    @if($role === 'treasurer')

        <div class="sidebar-section">
            BUSINESS MANAGEMENT
        </div>

        <a
            href="{{ route('businesses.create') }}"
            class="sidebar-link {{ request()->routeIs('businesses.create') ? 'active' : '' }}"
        >
            <i class="bi bi-building-add"></i>
            <span>Register New Business</span>
        </a>


        <a
            href="{{ route('businesses.index') }}"
            class="sidebar-link
            {{ request()->routeIs('businesses.index')
                || request()->routeIs('businesses.show')
                || request()->routeIs('businesses.edit')
                ? 'active'
                : '' }}"
        >
            <i class="bi bi-building"></i>
            <span>Business Profiling</span>
        </a>


        <a
            href="{{ route('closures.index') }}"
            class="sidebar-link {{ request()->routeIs('closures.*') ? 'active' : '' }}"
        >
            <i class="bi bi-building-x"></i>
            <span>Business Closure</span>
        </a>


        <div class="sidebar-section">
            FINANCIAL MANAGEMENT
        </div>

        <a
            href="{{ route('payments.index') }}"
            class="sidebar-link {{ request()->routeIs('payments.*') ? 'active' : '' }}"
        >
            <i class="bi bi-credit-card"></i>
            <span>Payments</span>
        </a>


        <div class="sidebar-section">
            REPORTS
        </div>

        <a
            href="{{ route('reports.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.*') ? 'active' : '' }}"
        >
            <i class="bi bi-bar-chart"></i>
            <span>Reports</span>
        </a>


        <div class="sidebar-section">
            LOCATION
        </div>

        <a
            href="{{ route('map.index') }}"
            class="sidebar-link {{ request()->routeIs('map.*') ? 'active' : '' }}"
        >
            <i class="bi bi-geo-alt"></i>
            <span>Hotspot Map</span>
        </a>


        <div class="sidebar-section">
            SETTINGS
        </div>

        <a
            href="{{ route('settings.business-categories.index') }}"
            class="sidebar-link {{ request()->routeIs('settings.business-categories.*') ? 'active' : '' }}"
        >
            <i class="bi bi-tags"></i>
            <span>Business Categories</span>
        </a>


        <a
            href="{{ route('activity-logs.index') }}"
            class="sidebar-link {{ request()->routeIs('activity-logs.index') ? 'active' : '' }}"
        >
            <i class="bi bi-clock-history"></i>
            <span>History Logs</span>
        </a>

    @elseif($role === 'secretary')

        <div class="sidebar-section">
            BUSINESS
        </div>

        <a
            href="{{ route('businesses.index') }}"
            class="sidebar-link
            {{ request()->routeIs('businesses.index')
                || request()->routeIs('businesses.show')
                ? 'active'
                : '' }}"
        >
            <i class="bi bi-building"></i>
            <span>Business Profiling</span>
        </a>


        <a
            href="{{ route('closures.index') }}"
            class="sidebar-link {{ request()->routeIs('closures.*') ? 'active' : '' }}"
        >
            <i class="bi bi-building-x"></i>
            <span>Business Closure</span>
        </a>


        <div class="sidebar-section">
            DOCUMENTS
        </div>

        <a
            href="{{ route('documents.index') }}"
            class="sidebar-link {{ request()->routeIs('documents.index') ? 'active' : '' }}"
        >
            <i class="bi bi-file-earmark-text"></i>
            <span>Issue Documents</span>
        </a>


        <a
            href="{{ route('documents.pending') }}"
            class="sidebar-link {{ request()->routeIs('documents.pending') ? 'active' : '' }}"
        >
            <i class="bi bi-hourglass-split"></i>
            <span>Pending Documents</span>
        </a>


        <div class="sidebar-section">
            LOCATION
        </div>

        <a
            href="{{ route('map.index') }}"
            class="sidebar-link {{ request()->routeIs('map.*') ? 'active' : '' }}"
        >
            <i class="bi bi-geo-alt"></i>
            <span>Hotspot Map</span>
        </a>


    @elseif($role === 'captain')

        <div class="sidebar-section">
            MONITORING
        </div>

        <a
            href="{{ route('businesses.index') }}"
            class="sidebar-link"
        >
            <i class="bi bi-building"></i>
            <span>Business Records</span>
        </a>


        <a
            href="{{ route('reports.index') }}"
            class="sidebar-link"
        >
            <i class="bi bi-bar-chart"></i>
            <span>Reports</span>
        </a>


        <div class="sidebar-section">
            LOCATION
        </div>

        <a
            href="{{ route('map.index') }}"
            class="sidebar-link"
        >
            <i class="bi bi-geo-alt"></i>
            <span>Hotspot Map</span>
        </a>

    @endif
    <div class="sidebar-bottom">
        <a
            href="{{ route('profile.edit') }}"
            class="sidebar-link profile-bottom-link {{ request()->routeIs('profile.*') ? 'active' : '' }}"
        >
            <i class="bi bi-person-circle"></i>
            <span>My Profile</span>
        </a>


        {{-- LOGOUT --}}
        <form
            method="POST"
            action="{{ route('logout') }}"
        >
            @csrf

            <button
                type="submit"
                class="sidebar-link logout-link"
            >
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>

        </form>

    </div>
</div>

<style>
.sidebar {
    height: 100vh;
    overflow-y: auto;
    overflow-x: hidden;
    display: flex;
    flex-direction: column;
    scrollbar-width: thin;
    scrollbar-color: rgba(255,255,255,.20) transparent;
}

.sidebar::-webkit-scrollbar {
    width: 6px;
}

.sidebar::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,.20);
    border-radius: 10px;
}
.sidebar::-webkit-scrollbar-thumb:hover {
    background: rgba(255,255,255,.35);
}
.sidebar-brand {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}
.brand-logo {
    width: 64px;
    height: 64px;
    object-fit: contain;
    border-radius: 50%;
    background: #ffffff;
    padding: 0;
    margin-bottom: 4px;
    box-shadow:
        0 3px 10px rgba(0,0,0,.15);
}
.brand-logo-fallback {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: #ffffff;
    color: #08749b;
    font-size: 28px;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
    box-shadow:
        0 3px 10px rgba(0,0,0,.15);
}
.sidebar-user {
    width: 100%;
    padding: 16px 14px 20px;
    margin-top: 8px;
    border-bottom: 1px solid rgba(255,255,255,.12);
}
.sidebar-user-link {
    display: flex;
    align-items: center;
    gap: 13px;
    width: 100%;
    padding: 10px 8px;
    border-radius: 12px;
    text-decoration: none;
    color: white;
    transition:
        background .2s ease,
        transform .2s ease;
}
.sidebar-user-link:hover {
    background: rgba(255,255,255,.10);
    color: white;
    transform: translateY(-1px);
}
.user-avatar {
    width: 58px;
    height: 58px;
    flex-shrink: 0;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    border: 3px solid rgba(255,255,255,.65);

    box-shadow:
        0 3px 12px rgba(0,0,0,.20);
}
.sidebar-profile-photo {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
}

.user-avatar-letter {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    color: #075374;
    font-size: 25px;
    font-weight: 800;
}
.user-info {
    min-width: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    flex: 1;
}
.user-info strong {
    display: block;
    color: #ffffff;
    font-size: 17px;
    font-weight: 800;
    line-height: 1.25;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.user-info small {
    display: block;
    margin-top: 5px;
    color: #bfe9f8;
    font-size: 14px;
    font-weight: 600;
    text-transform: capitalize;
}
.sidebar-section {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.2px;
}
.sidebar-bottom {
    margin-top: auto;

    padding-top: 12px;
    padding-bottom: 15px;
}
.sidebar-link {
    text-decoration: none;
}
.logout-link {
    width: 100%;
    border: none;
    background: transparent;
    cursor: pointer;
    text-align: left;
}


.profile-bottom-link {
    margin-bottom: 3px;
}

@media (max-width: 700px) {
    .user-avatar {
        width: 52px;
        height: 52px;
    }
    .user-info strong {
        font-size: 15px;
    }
    .user-info small {
        font-size: 12px;
    }
}
</style>