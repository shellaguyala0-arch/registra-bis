@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="page-title">
    <div>
        <span class="eyebrow">OVERVIEW</span>
        <h1>Welcome to REGISTRA</h1>
        <p>
            {{ now()->format('l, F d, Y') }} •
            Monitor business registration and collections at a glance.
        </p>
    </div>

    <span class="role-pill">
        {{ auth()->user()->roleLabel() }} Role
    </span>
</div>

<div class="row g-3 mb-4">

    <div class="col-md-6 col-xl-3">
        <div class="stat-card">
            <div>
                <div class="stat-label">Total Businesses</div>
                <div class="stat-value">{{ $businesses }}</div>
            </div>

            <div class="stat-icon">
                <i class="bi bi-shop"></i>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-card">
            <div>
                <div class="stat-label">Pending Applications</div>
                <div class="stat-value">{{ $pending }}</div>
            </div>

            <div class="stat-icon">
                <i class="bi bi-clock-history"></i>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-card">
            <div>
                <div class="stat-label">Total Collections</div>
                <div class="stat-value">
                    ₱{{ number_format($collections, 2) }}
                </div>
            </div>

            <div class="stat-icon">
                <i class="bi bi-cash-stack"></i>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-card">
            <div>
                <div class="stat-label">Fully Paid</div>
                <div class="stat-value">{{ $fullyPaid }}</div>
            </div>

            <div class="stat-icon">
                <i class="bi bi-check2-circle"></i>
            </div>
        </div>
    </div>

</div>

<div class="row g-4">

    <div class="col-lg-8">

        <div class="panel h-100">

            <div class="panel-header">
                <h5>Business Profiling Dashboard</h5>

                <div class="d-flex gap-2">
                    <a href="{{ route('businesses.index') }}"
                       class="btn btn-sm btn-outline-secondary">
                        View Profiles
                    </a>

                    <a href="{{ route('map.index') }}"
                       class="btn btn-sm btn-primary">
                        View Hotspot Map
                    </a>
                </div>
            </div>

            <div class="panel-body">

                <div class="row g-4">

                    <div class="col-md-6">

                        <h6 class="fw-bold small mb-3">
                            Businesses by Category
                        </h6>

                        @php
                            $max = $categories->max('total') ?: 1;
                        @endphp

                        @forelse($categories as $c)

                            <div class="mb-3">

                                <div class="d-flex justify-content-between small">
                                    <span>{{ $c->category }}</span>
                                    <strong>{{ $c->total }}</strong>
                                </div>

                                <div class="mini-bar mt-1">
                                    <span
                                        style="width: {{ ($c->total / $max) * 100 }}%">
                                    </span>
                                </div>

                            </div>

                        @empty

                            <div class="empty-state">
                                No categories yet.
                            </div>

                        @endforelse

                    </div>

                    <div class="col-md-6">

                        <h6 class="fw-bold small mb-3">
                            Collections by Category
                        </h6>

                        @php
                            $maxc = $categoryCollections->max('total') ?: 1;
                        @endphp

                        @forelse($categoryCollections as $c)

                            <div class="mb-3">

                                <div class="d-flex justify-content-between small">
                                    <span>{{ $c->category }}</span>

                                    <strong>
                                        ₱{{ number_format($c->total, 2) }}
                                    </strong>
                                </div>

                                <div class="mini-bar mt-1">
                                    <span
                                        style="width: {{ ($c->total / $maxc) * 100 }}%">
                                    </span>
                                </div>

                            </div>

                        @empty

                            <div class="empty-state">
                                No collections yet.
                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
