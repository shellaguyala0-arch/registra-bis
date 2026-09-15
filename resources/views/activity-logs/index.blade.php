@extends('layouts.app')

@section('title', 'History Logs')

@section('content')

<div class="history-page">
    <div class="history-header">

        <div class="history-header-left">

            <div class="history-icon">
                <i class="bi bi-clock-history"></i>
            </div>

            <div>
                <span class="history-eyebrow">
                    SYSTEM ACTIVITY
                </span>

                <h1>History Logs</h1>

                <p>
                    View and monitor important activities performed in REGISTRA.
                </p>
            </div>

        </div>

    </div>
    <div class="history-filter-card">

    <form method="GET" action="{{ route('activity-logs.index') }}">
        <div class="history-search">
            <i class="bi bi-search"></i>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search history logs..."
                autocomplete="off"
            >
        </div>
        <button type="submit" class="history-filter-btn">
            <i class="bi bi-search"></i>
            Search
        </button>
        @if(request('search'))
            <a
                href="{{ route('activity-logs.index') }}"
                class="history-reset-btn"
            >
                <i class="bi bi-x-lg"></i>
                Clear
            </a>
        @endif
    </form>
</div>


        <div class="table-responsive">
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Module</th>
                        <th>Description</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>
                                <div class="history-date">
                                    <strong>
                                        {{ $log->created_at->format('M d, Y') }}
                                    </strong>
                                    <span>
                                        {{ $log->created_at->format('h:i A') }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                @if($log->user)
                                    <div class="history-user">
                                        <div class="history-avatar">
                                            {{ strtoupper(substr($log->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <strong>
                                                {{ $log->user->name }}
                                            </strong>

                                            <span>
                                                {{ ucfirst($log->user->role ?? 'User') }}
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <span class="system-user">
                                        System
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="history-action">
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td>

                                @if($log->module)
                                    <span class="history-module">
                                        {{ $log->module }}
                                    </span>
                                @else
                                    <span class="history-empty">
                                        —
                                    </span>
                                @endif
                            </td>
                            <td class="history-description">
                                {{ $log->description }}
                            </td>
                            <td>
                                <span class="history-ip">
                                    {{ $log->ip_address ?? '—' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="history-empty-state">
                                    <i class="bi bi-clock-history"></i>
                                    <h3>No History Logs</h3>
                                    <p>
                                        There are currently no activity records.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($logs->hasPages())
            <div class="history-pagination">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</div>

<style>

.history-page {
    padding: 5px 0 30px;
}
.history-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}
.history-header-left {
    display: flex;
    align-items: center;
    gap: 16px;
}
.history-icon {
    width: 54px;
    height: 54px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e7f5f8;
    color: #08749b;
    font-size: 25px;
}
.history-eyebrow {
    display: block;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.4px;
    color: #08749b;
    margin-bottom: 3px;
}
.history-header h1 {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
    color: #123b4a;
}
.history-header p {
    margin: 5px 0 0;
    color: #71818a;
    font-size: 14px;
}
.history-filter-card {
    background: #ffffff;
    border: 1px solid #e4ecef;
    border-radius: 15px;
    padding: 16px;
    margin-bottom: 20px;
}
.history-filter-card form {
    display: flex;
    gap: 10px;
    align-items: center;
}
.history-search {
    position: relative;
    flex: 1;
}
.history-search i {
    position: absolute;
    left: 13px;
    top: 50%;
    transform: translateY(-50%);
    color: #91a1a8;
}
.history-search input {
    width: 100%;
    height: 43px;
    border: 1px solid #dce6e9;
    border-radius: 9px;
    padding: 0 14px 0 39px;
    outline: none;
    font-size: 13px;
}
.history-search input:focus {
    border-color: #08749b;
}
.history-select {
    height: 43px;
    min-width: 150px;
    border: 1px solid #dce6e9;
    border-radius: 9px;
    padding: 0 12px;
    color: #38545e;
    background: #fff;
    outline: none;
}
.history-filter-btn {
    height: 43px;
    border: 0;
    border-radius: 9px;
    padding: 0 18px;
    background: #08749b;
    color: #fff;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
}
.history-reset-btn {
    height: 43px;
    display: flex;
    align-items: center;
    padding: 0 15px;
    border: 1px solid #dce6e9;
    border-radius: 9px;
    color: #61747c;
    text-decoration: none;
    font-size: 13px;
}
.history-card {
    background: #ffffff;
    border: 1px solid #e4ecef;
    border-radius: 15px;
    overflow: hidden;
}
.history-card-header {
    padding: 20px 22px;
    border-bottom: 1px solid #edf1f3;
}
.history-card-header h3 {
    margin: 0;
    font-size: 17px;
    color: #234653;
}

.history-card-header span {
    font-size: 12px;
    color: #87969d;
}
.history-table {
    width: 100%;
    border-collapse: collapse;
}
.history-table th {
    padding: 13px 18px;
    background: #f7fafb;
    color: #6d7d84;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    text-align: left;
}
.history-table td {
    padding: 15px 18px;
    border-top: 1px solid #edf1f3;
    vertical-align: middle;
    font-size: 13px;
    color: #445b63;
}
.history-date strong {
    display: block;
    color: #294b57;
    font-size: 12px;
}
.history-date span {
    color: #8b9aa1;
    font-size: 11px;
}
.history-user {
    display: flex;
    align-items: center;
    gap: 9px;
}
.history-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #e7f5f8;
    color: #08749b;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 12px;
}
.history-user strong {
    display: block;
    color: #294b57;
    font-size: 12px;
}
.history-user span {
    display: block;
    color: #8b9aa1;
    font-size: 10px;
    margin-top: 2px;
}
.history-action {
    display: inline-block;
    padding: 5px 9px;
    border-radius: 7px;
    background: #edf7fa;
    color: #08749b;
    font-size: 11px;
    font-weight: 700;
}
.history-module {
    font-size: 11px;
    font-weight: 600;
    color: #55717b;
}
.history-description {
    max-width: 360px;
}
.history-ip {
    font-family: monospace;
    font-size: 11px;
    color: #809198;
}
.history-empty {
    color: #aab5b9;
}
.system-user {
    font-size: 12px;
    color: #7e9097;
}
.history-empty-state {
    text-align: center;
    padding: 60px 20px;
}
.history-empty-state i {
    font-size: 42px;
    color: #b6c8ce;
}
.history-empty-state h3 {
    margin: 12px 0 5px;
    color: #55717b;
    font-size: 17px;
}
.history-empty-state p {
    margin: 0;
    color: #96a4aa;
    font-size: 13px;
}
.history-pagination {
    padding: 15px 20px;
    border-top: 1px solid #edf1f3;
}
@media(max-width: 900px) {
    .history-filter-card form {
        flex-wrap: wrap;
    }
    .history-search {
        flex: 100%;
    }
    .history-select {
        flex: 1;
    }
}
</style>
@endsection