@extends('layouts.app')
@section('title', 'Documents')
@section('content')

<div class="documents-page">

    <div class="documents-header">

        <div class="header-left">

            <div class="header-icon">
                <i class="bi bi-file-earmark-text"></i>
            </div>

            <div>
                <span class="eyebrow">SECRETARY</span>

                <h1>Document Issuance</h1>

                <p>
                    Issue clearances, certificates, and tax-related documents.
                </p>
            </div>

        </div>

        <div class="header-right">

            <div class="location-badge">
                <i class="bi bi-geo-alt-fill"></i>
                San Bartolome, Santa Magdalena, Sorsogon
            </div>

        </div>

    </div>


    <div class="documents-panel">
        <div class="panel-header-custom">
            <div>
                <span class="panel-eyebrow">
                    DOCUMENT MANAGEMENT
                </span>
                <h2>Issued Documents</h2>
            </div>
            <div class="panel-icon">
                <i class="bi bi-folder2-open"></i>
            </div>
        </div>


        <div class="document-info-bar">

            <div class="info-location">

                <i class="bi bi-geo-alt-fill"></i>

                <span>
                    Business Document Records
                </span>

            </div>

            <span class="record-label">
                {{ $documents->total() }} Records
            </span>

        </div>


        <div class="table-responsive">

            <table class="documents-table">

                <thead>

                    <tr>

                        <th>Document No.</th>

                        <th>Business</th>

                        <th>Type</th>

                        <th>Issued Date</th>

                        <th>Issued By</th>

                        <th>Status</th>

                        <th class="action-column"></th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($documents as $d)

                        <tr>


                            <td>

                                <div class="document-number">

                                    <div class="document-mini-icon">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>

                                    <span>
                                        {{ $d->document_no }}
                                    </span>

                                </div>

                            </td>



                            <td>

                                <div class="business-cell">

                                    <div class="business-icon">
                                        <i class="bi {{ $d->business ? 'bi-building' : 'bi-person' }}"></i>
                                    </div>

                                    <span>

                                        @if($d->business)

                                            {{ $d->business->business_name }}

                                        @else

                                            No Business Required

                                        @endif

                                    </span>

                                </div>

                            </td>


                            <td>

                                <span class="document-type">
                                    {{ $d->document_type }}
                                </span>

                            </td>



                            <td>

                                <span class="date-cell">

                                    <i class="bi bi-calendar3"></i>

                                    {{ $d->issued_date->format('M d, Y') }}

                                </span>

                            </td>



                            <td>

                                <span class="issuer-name">

                                    {{ $d->issuer->name ?? '—' }}

                                </span>

                            </td>


                            <td>

                                <span class="status-badge approved">

                                    <i class="bi bi-check-circle-fill"></i>

                                    {{ $d->status }}

                                </span>

                            </td>


                            <td class="action-column">

                                <a
                                    href="{{ route('documents.pdf', $d) }}"
                                    class="pdf-btn"
                                    title="View PDF"
                                >

                                    <i class="bi bi-file-earmark-pdf"></i>

                                    PDF

                                </a>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="7">

                                <div class="empty-document-state">

                                    <div class="empty-icon">

                                        <i class="bi bi-file-earmark-x"></i>

                                    </div>

                                    <strong>
                                        No documents issued yet
                                    </strong>

                                    <span>
                                        Issued documents will appear here once they are created.
                                    </span>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="documents-footer">

            <div class="footer-note">

                <i class="bi bi-info-circle"></i>

                <span>
                    Showing issued document records
                </span>

            </div>


            <div class="pagination-wrapper">

                {{ $documents->links() }}

            </div>

        </div>

    </div>

</div>


<style>

.documents-page {
    width: 100%;
    padding-bottom: 30px;
}

.documents-header {
    background: #102a56;
    border-radius: 18px;
    padding: 27px 30px;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    color: #fff;
    box-shadow: 0 8px 25px rgba(16, 42, 86, .12);
}

.header-left {
    display: flex;
    align-items: center;
    gap: 17px;
}

.header-icon {
    width: 58px;
    height: 58px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.17);
    font-size: 26px;
}

.documents-header .eyebrow {
    display: block;
    margin-bottom: 4px;
    color: rgba(255,255,255,.68);
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 1.5px;
}

.documents-header h1 {
    margin: 0;
    font-size: 27px;
    font-weight: 700;
}

.documents-header p {
    margin: 5px 0 0;
    color: rgba(255,255,255,.73);
    font-size: 14px;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 12px;
}

.location-badge {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 9px 14px;
    border-radius: 30px;
    background: rgba(255,255,255,.09);
    border: 1px solid rgba(255,255,255,.16);
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
}

.location-badge i {
    font-size: 14px;
}

.documents-panel {
    background: #fff;
    border: 1px solid #e1e7ef;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 18px rgba(16,42,86,.04);
}

.panel-header-custom {
    padding: 20px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #edf0f4;
}

.panel-eyebrow {
    display: block;
    color: #738096;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 1.3px;
}

.panel-header-custom h2 {
    margin: 3px 0 0;
    color: #172b4d;
    font-size: 18px;
    font-weight: 700;
}

.panel-icon {
    width: 39px;
    height: 39px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: #eef4fc;
    color: #1456a0;
    font-size: 17px;
}
.document-info-bar {
    min-height: 51px;
    padding: 11px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #f8fafc;
    border-bottom: 1px solid #edf0f4;
}

.info-location {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #34445b;
    font-size: 14px;
    font-weight: 600;
}

.info-location i {
    color: #1456a0;
}

.record-label {
    color: #8994a5;
    font-size: 14px;
}
.documents-table {
    width: 100%;
    border-collapse: collapse;
}

.documents-table thead th {
    padding: 13px 22px;
    background: #fbfcfe;
    color: #738096;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: .6px;
    text-transform: uppercase;
    border-bottom: 1px solid #e8edf2;
    text-align: left;
    white-space: nowrap;
}

.documents-table tbody td {
    padding: 14px 22px;
    color: #46546a;
    font-size: 14px;
    border-bottom: 1px solid #edf0f4;
    vertical-align: middle;
}

.documents-table tbody tr {
    transition: .15s ease;
}
.documents-table tbody tr:hover {
    background: #fafcff;
}
.documents-table tbody tr:last-child td {
    border-bottom: none;
}
.document-number {
    display: flex;
    align-items: center;
    gap: 9px;
    color: #263852;
    font-weight: 700;
}

.document-mini-icon {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: #eef4fc;
    color: #1456a0;
    font-size: 14px;
}

.business-cell {
    display: flex;
    align-items: center;
    gap: 9px;
    color: #34445b;
    font-weight: 600;
}
.business-icon {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 7px;
    background: #f1f4f8;
    color: #68768a;
    font-size: 14px;
}
.document-type {
    display: inline-block;
    padding: 5px 9px;
    border-radius: 6px;
    background: #f1f4f8;
    color: #59677b;
    font-size: 14px;
    font-weight: 600;
}
.date-cell {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #5d6a7e;
    white-space: nowrap;
}

.date-cell i {
    color: #8b98aa;
    font-size: 12px;
}
.issuer-name {
    color: #566479;
}
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 9px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 700;
}

.status-badge.approved {
    background: #e9f8ef;
    color: #20965a;
}

.status-badge i {
    font-size: 14px;
}

.action-column {
    text-align: right !important;
    white-space: nowrap;
}

.pdf-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 6px 10px;
    border: 1px solid #dce3ec;
    border-radius: 7px;
    background: #fff;
    color: #526176;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    transition: .2s ease;
}

.pdf-btn:hover {
    background: #f2f6fb;
    border-color: #cbd6e4;
    color: #1456a0;
}

.pdf-btn i {
    font-size: 14px;
}


.empty-document-state {
    min-height: 210px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.empty-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
    border-radius: 12px;
    background: #f1f4f8;
    color: #8995a6;
    font-size: 21px;
}

.empty-document-state strong {
    color: #4c5b70;
    font-size: 14px;
}

.empty-document-state span {
    margin-top: 4px;
    color: #8994a5;
    font-size: 14px;
}


.documents-footer {
    min-height: 59px;
    padding: 10px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fafbfd;
    border-top: 1px solid #edf0f4;
}

.footer-note {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #8a95a5;
    font-size: 14px;
}

.footer-note i {
    color: #8995a6;
}

.pagination-wrapper .pagination {
    margin: 0;
}

.pagination-wrapper .page-link {
    border: 1px solid #e1e7ef;
    color: #5c6a7e;
    font-size: 14px;
    padding: 5px 9px;
}

.pagination-wrapper .page-item.active .page-link {
    background: #1456a0;
    border-color: #1456a0;
    color: #fff;
}

.pagination-wrapper .page-link:hover {
    background: #f1f5fa;
    color: #1456a0;
}

@media (max-width: 1000px) {

    .documents-header {
        align-items: flex-start;
    }

    .header-right {
        flex-direction: column;
        align-items: flex-end;
    }

}


@media (max-width: 768px) {

    .documents-header {
        padding: 22px;
        flex-direction: column;
        align-items: flex-start;
    }

    .header-right {
        width: 100%;
        align-items: flex-start;
    }

    .location-badge {
        white-space: normal;
    }

    .documents-header h1 {
        font-size: 23px;
    }

    .panel-header-custom {
        padding: 18px;
    }

    .document-info-bar {
        padding: 11px 18px;
    }

    .documents-table thead th,
    .documents-table tbody td {
        padding-left: 18px;
        padding-right: 18px;
    }
    .documents-footer {
        padding: 12px 18px;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
}
</style>
@endsection