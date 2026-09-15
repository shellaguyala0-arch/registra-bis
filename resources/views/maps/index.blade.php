@extends('layouts.app')
@section('title', 'Hotspot Map')
@section('content')

<style>
.hotspot-page {
    width: 100%;
    max-width: 100%;
}
.hotspot-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 22px;
}
.hotspot-header-left {
    display: flex;
    align-items: center;
    gap: 14px;
}
.hotspot-header-icon {
    width: 54px;
    height: 54px;
    border-radius: 14px;
    background: linear-gradient(135deg, #075374, #007c9e);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    box-shadow: 0 8px 20px rgba(7, 83, 116, 0.16);
    flex-shrink: 0;
}
.hotspot-eyebrow {
    display: block;
    color: #16829e;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.5px;
    margin-bottom: 4px;
    text-transform: uppercase;
}
.hotspot-title {
    margin: 0;
    color: #163f51;
    font-size: 27px;
    font-weight: 800;
    line-height: 1.15;
}
.hotspot-subtitle {
    margin: 5px 0 0;
    color: #7898a7;
    font-size: 13px;
}
.location-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #f1f8fa;
    border: 1px solid #d9edf2;
    border-radius: 12px;
    padding: 10px 14px;
    color: #315f72;
    font-size: 13px;
    font-weight: 700;
    white-space: nowrap;
}
.location-badge i {
    color: #0084a4;
    font-size: 15px;
}
.map-card {
    background: #ffffff;
    border: 1px solid #e1edf1;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(22, 63, 81, 0.07);
}

.map-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    padding: 17px 20px;
    border-bottom: 1px solid #e8f0f3;
    background: #ffffff;
}

.map-card-title {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #234e60;
    font-size: 14px;
    font-weight: 800;
}

.map-card-title i {
    color: #0085a5;
    font-size: 17px;
}

.map-card-description {
    color: #8aa2ad;
    font-size: 14px;
    margin-top: 3px;
}

.map-count {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 11px;
    border-radius: 9px;
    background: #f4fafb;
    color: #357086;
    font-size: 13px;
    font-weight: 700;
    border: 1px solid #deedf1;
    white-space: nowrap;
}
.map-count i {
    color: #0085a5;
}
.map-container {
    width: 100%;
    height: 600px;
    position: relative;
    background: #eef5f7;
}
#hotspotMap {
    width: 100%;
    height: 100%;
}
.map-footer {
    padding: 12px 18px;
    background: #fbfdfe;
    border-top: 1px solid #e8f0f3;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
}

.map-footer-text {
    color: #7b98a4;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 7px;
}

.map-footer-text i {
    color: #16829e;
}
.map-legend-wrapper {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
}

.map-legend,
.density-legend,
.map-instruction {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 6px 10px;
    border-radius: 8px;
    background: #f5fafc;
    border: 1px solid #dceef4;
}

.legend-title,
.density-title {
    color: #315f72;
    font-size: 13px;
    font-weight: 800;
    white-space: nowrap;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #698693;
    font-size: 12px;
    white-space: nowrap;
}

.legend-marker {
    width: 9px;
    height: 9px;
    border-radius: 50%;
    display: inline-block;
}

.active-marker {
    background: #16a34a;
}
.inactive-marker {
    background: #dc2626;
}
.pending-marker {
    background: #f59e0b;
}
.density-legend {
    gap: 8px;
}
.density-gradient {
    width: 95px;
    height: 9px;
    border-radius: 20px;
    background: linear-gradient(
        to right,
        #3cc7a3,
        #f5d547,
        #f58b38,
        #e84b4b
    );
}
.density-labels {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #7898a7;
    font-size: 12px;
}
.density-labels span {
    white-space: nowrap;
}
.map-instruction {
    color: #7898a7;
    font-size: 11px;
    white-space: nowrap;
}
.map-instruction i {
    color: #16829e;
}
.analytics-section {
    margin-top: 24px;
}
.analytics-header {
    margin-bottom: 14px;
}
.analytics-eyebrow {
    color: #16829e;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.4px;
    text-transform: uppercase;
    margin-bottom: 3px;
}

.analytics-title {
    margin: 0;
    color: #234e60;
    font-size: 19px;
    font-weight: 800;
}

.analytics-subtitle {
    margin: 4px 0 0;
    color: #8aa2ad;
    font-size: 11px;
}
.analytics-grid {
    display: grid;
    grid-template-columns: minmax(0, 0.9fr) minmax(0, 1.5fr);
    gap: 18px;
}
.analytics-card {
    background: #ffffff;
    border: 1px solid #e1edf1;
    border-radius: 17px;
    padding: 18px;
    box-shadow: 0 7px 22px rgba(22, 63, 81, 0.06);
    min-width: 0;
}
.analytics-card-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 14px;
}
.analytics-card-title {
    color: #315f72;
    font-size: 14px;
    font-weight: 800;
    margin: 0;
}
.analytics-card-description {
    color: #91a6af;
    font-size: 13px;
    margin-top: 3px;
}
.analytics-card-icon {
    width: 34px;
    height: 34px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f0f8fa;
    color: #087f9d;
    flex-shrink: 0;
}
.chart-container {
    position: relative;
    width: 100%;
    height: 315px;
}

.chart-container-small {
    position: relative;
    width: 100%;
    height: 315px;
}
.business-popup {
    min-width: 230px;
    max-width: 280px;
}

.business-popup-photo {
    width: 100%;
    height: 125px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 9px;
    background: #edf4f6;
}

.business-popup-placeholder {
    width: 100%;
    height: 125px;
    border-radius: 8px;
    margin-bottom: 9px;
    background: linear-gradient(135deg, #eef6f8, #dceef2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #7fa1ae;
    font-size: 28px;
}

.business-popup-name {
    font-size: 14px;
    font-weight: 800;
    color: #234e60;
    margin-bottom: 5px;
}

.business-popup-row {
    display: flex;
    align-items: flex-start;
    gap: 7px;
    margin-top: 5px;
    color: #6e8995;
    font-size: 12px;
    line-height: 1.4;
}

.business-popup-row i {
    color: #0782a1;
    margin-top: 1px;
}

.business-popup-status {
    display: inline-flex;
    margin-top: 8px;
    padding: 4px 8px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 800;
}

.popup-active {
    color: #147a3b;
    background: #eaf8ef;
}

.popup-inactive {
    color: #b42318;
    background: #fff0ef;
}
.popup-pending {
    color: #9a6700;
    background: #fff8df;
}
.map-error {
    position: absolute;
    inset: 0;
    z-index: 500;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: #f5fafb;
}
.map-error-box {
    max-width: 420px;
    text-align: center;
    background: #ffffff;
    border: 1px solid #dfedf1;
    border-radius: 14px;
    padding: 24px;
    box-shadow: 0 8px 25px rgba(22, 63, 81, 0.08);
}
.map-error-box i {
    color: #16829e;
    font-size: 30px;
    margin-bottom: 13px;
}
.map-error-box h4 {
    color: #315f72;
    font-size: 15px;
    font-weight: 800;
    margin-bottom: 6px;
}
.map-error-box p {
    color: #829ba5;
    font-size: 13px;
    margin: 0;
}
.landmark-report-section{
    margin-top:24px
}
.landmark-report-card{
    background:#fff;
    border:1px solid #e1edf1;
    border-radius:17px;
    padding:18px;
    box-shadow:0 7px 22px rgba(22,63,81,.06)
}
.landmark-report-header{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:15px;
    margin-bottom:16px
}
.landmark-report-title-wrap{
    display:flex;
    align-items:flex-start;
    gap:11px
}
.landmark-report-icon{
    width:38px;
    height:38px;
    border-radius:10px;
    background:#f0f8fa;
    color:#087f9d;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
    font-size:17px
}
.landmark-report-title{
    color:#315f72;
    font-size:14px;
    font-weight:800;
    margin:0
}
.landmark-report-description{
    color:#91a6af;
    font: size 14px;
    px;margin-top:3px
}
.landmark-report-total{
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:7px 11px;
    border-radius:9px;
    background:#f4fafb;
    color:#357086;
    font-size:14px;
    font-weight:700;
    border:1px solid #deedf1;
    white-space:nowrap
}
.landmark-summary-grid{
    display:grid;
    grid-template-columns:repeat(3,minmax(0,1fr));
    gap:12px;
    margin-bottom:16px
}
.landmark-summary-item{
    border:1px solid #e5eff2;
    background:#fbfdfe;
    border-radius:11px;
    padding:12px 13px
}
.landmark-summary-label{
    color:#8aa2ad;
    font-size:14px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.7px;
    margin-bottom:4px
}
.landmark-summary-value{
    color:#234e60;
    font-size:16px;
    font-weight:800;
    line-height:1.2
}
.landmark-summary-subvalue{
    color:#7898a7;
    font-size:14px;
    margin-top:3px;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis
}
.landmark-table-wrap{
    width:100%;overflow-x:auto;
    border:1px solid #e4eef1;
    border-radius:11px
}
.landmark-report-table{
    width:100%;
    border-collapse:collapse;
    min-width:610px
}
.landmark-report-table th{
    padding:10px 12px;
    background:#f5fafc;
    color:#527180;
    font-size:14px;
    font-weight:800;
    text-transform:uppercase;
    letter-spacing:.55px;
    text-align:left;
    border-bottom:1px solid #e2edf0;
    white-space:nowrap
}
.landmark-report-table td{
    padding:10px 12px;
    color:#5f7b87;
    font-size:14px;
    border-bottom:1px solid #edf3f5;
    vertical-align:middle
}
.landmark-report-table tbody tr:last-child td{
    border-bottom:0
}
.landmark-report-table tbody tr:hover{
    background:#fbfdfe
}
.landmark-rank{
    width:34px;
    color:#8aa2ad;
    font-weight:800
}
.landmark-name-cell{
    color:#315f72!important;
    font-weight:800;
    min-width:190px
}
.landmark-count-cell{
    color:#234e60!important;
    font-weight:800;
    white-space:nowrap
}
.landmark-percentage{
    min-width:155px
}
.landmark-progress{
    height:7px;
    background:#eaf2f4;
    border-radius:20px;
    overflow:hidden;
    margin-bottom:4px
}
.landmark-progress-bar{
    height:100%;
    background:linear-gradient(90deg,#16829e,#075374);
    border-radius:inherit;
    min-width:4px
}
.landmark-percentage-text{
    color:#829ba5;
    font-size:13px
}
.landmark-density-badge{
    display:inline-flex;
    align-items:center;
    padding:4px 8px;
    border-radius:20px;
    font-size:13px;
    font-weight:800;
    white-space:nowrap
}
.landmark-density-low{
    color:#147a3b;
    background:#eaf8ef
}
.landmark-density-medium{
    color:#9a6700;
    background:#fff8df
}
.landmark-density-high{
    color:#b42318;
    background:#fff0ef
}
.landmark-empty{
    padding:24px 16px;
    text-align:center;
    color:#8aa2ad;
    font-size:14px
}
.landmark-report-note{
    margin-top:10px;
    color:#91a6af;
    font-size:14px;
    line-height:1.5
}
@media (max-width:700px){
    .landmark-report-header{
        flex-direction:column
    }
    .landmark-report-total{
        align-self:flex-start
    }
    .landmark-summary-grid{
        grid-template-columns:1fr
    }
}
@media (max-width: 1100px) {

    .analytics-grid {
        grid-template-columns: 1fr;
    }

    .chart-container,
    .chart-container-small {
        height: 330px;
    }
}
@media (max-width: 900px) {
    .hotspot-header {
        align-items: flex-start;
        flex-direction: column;
    }
    .location-badge {
        align-self: flex-start;
    }
    .map-footer {
        align-items: flex-start;
        flex-direction: column;
    }
    .map-legend-wrapper {
        width: 100%;
    }
    .density-legend {
        flex-wrap: wrap;
    }
}

@media (max-width: 700px) {
    .hotspot-title {
        font-size: 22px;
    }
    .hotspot-subtitle {
        font-size: 14px;
    }
    .hotspot-header-icon {
        width: 47px;
        height: 47px;
        font-size: 21px;
    }
    .map-card-header {
        align-items: flex-start;
        flex-direction: column;
    }
    .map-container {
        height: 470px;
    }
    .map-legend-wrapper {
        flex-direction: column;
        align-items: stretch;
    }
    .map-legend,
    .density-legend,
    .map-instruction {
        width: 100%;
        justify-content: flex-start;
    }
    .density-legend {
        flex-wrap: wrap;
    }
    .analytics-card {
        padding: 14px;
    }
    .chart-container,
    .chart-container-small {
        height: 280px;
    }
}

@media (max-width: 450px) {
    .map-container {
        height: 400px;
    }
    .density-gradient {
        width: 75px;
    }
    .density-labels {
        gap: 4px;
    }
    .chart-container,
    .chart-container-small {
        height: 245px;
    }
}
</style>


<div class="hotspot-page">
    <div class="hotspot-header">
        <div class="hotspot-header-left">
            <div class="hotspot-header-icon">
                <i class="bi bi-geo-alt-fill"></i>
            </div>
            <div>
                <span class="hotspot-eyebrow">
                    LOCATION INTELLIGENCE
                </span>
                <h1 class="hotspot-title">
                    Business Hotspot Map
                </h1>
                <p class="hotspot-subtitle">
                    Visualize registered businesses and identify areas with higher business concentration.
                </p>
            </div>
        </div>

        <div class="location-badge">
            <i class="bi bi-pin-map-fill"></i>
            <span>
                San Bartolome, Santa Magdalena, Sorsogon
            </span>
        </div>
    </div>

    <div class="map-card">

        <div class="map-card-header">
            <div>
                <div class="map-card-title">
                    <i class="bi bi-map"></i>
                    <div>
                        Business Locations
                        <div class="map-card-description">
                            Business markers and density visualization
                        </div>
                    </div>
                </div>
            </div>

            <div class="map-count">
                <i class="bi bi-buildings"></i>
                {{ count($businesses ?? []) }}
                {{ count($businesses ?? []) === 1 ? 'Business' : 'Businesses' }}
            </div>

        </div>

        <div class="map-container">
            <div id="hotspotMap"></div>
        </div>
        <div class="map-footer">
            <div class="map-footer-text">
                <i class="bi bi-info-circle"></i>
                <span>
                    Heat areas indicate higher concentrations of registered businesses.
                </span>
            </div>
            <div class="map-legend-wrapper">
                <div class="map-legend">
                    <span class="legend-title">
                        Status
                    </span>
                    <div class="legend-item">
                        <span class="legend-marker active-marker"></span>
                        <span>Active</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-marker inactive-marker"></span>
                        <span>Inactive</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-marker pending-marker"></span>
                        <span>Pending</span>
                    </div>
                </div>
                <div class="density-legend">
                    <span class="density-title">
                        Business Density
                    </span>
                    <div class="density-gradient"></div>
                    <div class="density-labels">
                        <span>Low</span>
                        <span>Medium</span>
                        <span>High</span>
                    </div>
                </div>

                <div class="map-instruction">
                    <i class="bi bi-hand-index-thumb"></i>
                    <span>
                        Click a marker to view details
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="landmark-report-section">
        <div class="landmark-report-card">
            <div class="landmark-report-header">
                <div class="landmark-report-title-wrap">
                    <div class="landmark-report-icon"><i class="bi bi-bar-chart-line-fill"></i></div>
                    <div>
                        <h3 class="landmark-report-title">Business Density by Landmark</h3>
                        <div class="landmark-report-description">Hotspot summary showing the number and concentration of registered businesses by area or landmark.</div>
                    </div>
                </div>
                <div class="landmark-report-total"><i class="bi bi-geo-alt-fill"></i><span id="landmarkReportCount">0 landmarks</span></div>
            </div>
            <div class="landmark-summary-grid">
                <div class="landmark-summary-item"><div class="landmark-summary-label">Highest Concentration</div><div class="landmark-summary-value" id="topLandmarkCount">0</div><div class="landmark-summary-subvalue" id="topLandmarkName">No landmark data</div></div>
                <div class="landmark-summary-item"><div class="landmark-summary-label">Identified Landmarks</div><div class="landmark-summary-value" id="identifiedLandmarks">0</div><div class="landmark-summary-subvalue">Areas with assigned landmark</div></div>
                <div class="landmark-summary-item"><div class="landmark-summary-label">Without Landmark</div><div class="landmark-summary-value" id="withoutLandmark">0</div><div class="landmark-summary-subvalue">Businesses needing area assignment</div></div>
            </div>
            <div class="landmark-table-wrap">
                <table class="landmark-report-table">
                    <thead><tr><th>#</th><th>Area / Landmark</th><th>Businesses</th><th>Share of Businesses</th><th>Density</th></tr></thead>
                    <tbody id="landmarkReportBody"><tr><td colspan="5" class="landmark-empty">No landmark data available.</td></tr></tbody>
                </table>
            </div>
            <div class="landmark-report-note">Density is based on the number of registered businesses assigned to each landmark. Low: 1–3 businesses, Medium: 4–7 businesses, High: 8 or more businesses.</div>
        </div>
    </div>

    <div class="analytics-section">
        <div class="analytics-header">
            <div class="analytics-eyebrow">
                LOCATION & FINANCIAL ANALYTICS
            </div>
            <h2 class="analytics-title">
                Business Insights
            </h2>
            <p class="analytics-subtitle">
                Summary of business categories and payment collections for {{ $currentYear ?? now()->year }}.
            </p>
        </div>
        <div class="analytics-grid">
            <div class="analytics-card">
                <div class="analytics-card-header">
                    <div>
                        <h3 class="analytics-card-title">
                            Business Distribution by Category
                        </h3>
                        <div class="analytics-card-description">
                            Number of active businesses by category
                        </div>
                    </div>
                    <div class="analytics-card-icon">
                        <i class="bi bi-pie-chart-fill"></i>
                    </div>
                </div>
                <div class="chart-container-small">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>

            <div class="analytics-card">
                <div class="analytics-card-header">
                    <div>
                        <h3 class="analytics-card-title">
                            Annual Payment Collection Trend
                        </h3>
                        <div class="analytics-card-description">
                            Monthly payment collections for {{ $currentYear ?? now()->year }}
                        </div>
                    </div>
                    <div class="analytics-card-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="paymentChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.heat/dist/leaflet-heat.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const businesses = @json($businesses ?? []);
    const monthlyCollections = @json($monthlyCollections ?? []);
    const currentYear = {{ $currentYear ?? now()->year }};
    const GEOAPIFY_KEY = @json(config('services.geoapify.key'));

    let map = null;

    if (GEOAPIFY_KEY) {

        map = L.map('hotspotMap', {
            zoomControl: true,
            attributionControl: true
        });
        const defaultCenter = [
            12.6871,
            124.1276
        ];

        const sanBartolomeBounds = L.latLngBounds(
            [12.6500, 124.0900],
            [12.7200, 124.1650]
        );

        L.tileLayer(
            'https://maps.geoapify.com/v1/tile/osm-bright/{z}/{x}/{y}.png?apiKey='
            + encodeURIComponent(GEOAPIFY_KEY),
            {
                maxZoom: 20,
                attribution:
                    '&copy; OpenStreetMap contributors &copy; Geoapify'
            }
        ).addTo(map);

        map.setView(defaultCenter, 16);
        map.setMaxBounds(sanBartolomeBounds);
        map.options.maxBoundsViscosity = 1.0;

        const densityPoints = [];
        businesses.forEach(function (business) {
            if (
                business.latitude === null ||
                business.longitude === null ||
                business.latitude === '' ||
                business.longitude === ''
            ) {
                return;
            }

            const lat = parseFloat(
                business.latitude
            );

            const lng = parseFloat(
                business.longitude
            );

            if (
                Number.isNaN(lat) ||
                Number.isNaN(lng)
            ) {
                return;
            }

            densityPoints.push([
                lat,
                lng,
                1
            ]);

        });

        if (
            typeof L.heatLayer === 'function' &&
            densityPoints.length > 0
        ) {
            L.heatLayer(
                densityPoints,
                {
                    radius: 42,
                    blur: 30,
                    maxZoom: 18,
                    minOpacity: 0.30,
                    max: 1.0
                }
            ).addTo(map);

        }

        function escapeHtml(value) {
            if (
                value === null ||
                value === undefined
            ) {
                return '';
            }

            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function createBusinessIcon(status) {
            const normalizedStatus =
                String(status || 'Pending').toLowerCase();
            
            let markerColor = '#f59e0b';

            if (normalizedStatus === 'active') {
                markerColor = '#16a34a';
            }

            if (normalizedStatus === 'inactive') {
                markerColor = '#dc2626';
            }

            return L.divIcon({
                className: 'custom-business-marker',
                html: `
                    <div
                        style="
                            width: 26px;
                            height: 26px;
                            border-radius: 50% 50% 50% 0;
                            background: ${markerColor};
                            transform: rotate(-45deg);
                            border: 3px solid #ffffff;
                            box-shadow:
                                0 3px 9px rgba(0,0,0,.28);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                    >
                        <div
                            style="
                                width: 7px;
                                height: 7px;
                                border-radius: 50%;
                                background: #ffffff;
                                transform: rotate(45deg);
                            "
                        ></div>
                    </div>
                `,

                iconSize: [26, 26],

                iconAnchor: [13, 26],

                popupAnchor: [0, -25]

            });
        }

        function buildPhotoHtml(business) {

            let photoSrc =
                business.business_exterior ||
                business.business_exterior_path ||
                '';

            if (!photoSrc) {
                return `
                    <div class="business-popup-placeholder">
                        <i class="bi bi-building"></i>
                    </div>
                `;

            }

            photoSrc = String(photoSrc);
            if (!/^https?:\/\//i.test(photoSrc)) {

                photoSrc =
                    '/' +
                    photoSrc.replace(/^\/+/, '');

            }


            return `
                <img
                    src="${escapeHtml(photoSrc)}"
                    class="business-popup-photo"
                    alt="Business Photo"
                    onerror="
                        this.style.display='none';
                        this.nextElementSibling.style.display='flex';
                    "
                >

                <div
                    class="business-popup-placeholder"
                    style="display:none;"
                >
                    <i class="bi bi-building"></i>
                </div>
            `;

        }

        function buildPopupHtml(business) {

            const businessName =
                business.business_name ||
                business.name ||
                'Unnamed Business';


            const ownerName =
                business.owner_name ||
                business.owner ||
                'Not available';


            const address =
                business.address ||
                'No address provided';


            const category =
                business.category ||
                'Uncategorized';


            const landmark =
                business.landmark ||
                '';


            const status =
                business.registration_status ||
                'Pending';


            const normalizedStatus =
                String(status).toLowerCase();


            let statusClass =
                'popup-pending';


            if (normalizedStatus === 'active') {
                statusClass = 'popup-active';
            }

            if (normalizedStatus === 'inactive') {
                statusClass = 'popup-inactive';
            }


            return `
                <div class="business-popup">

                    ${buildPhotoHtml(business)}

                    <div class="business-popup-name">
                        ${escapeHtml(businessName)}
                    </div>

                    <div class="business-popup-row">
                        <i class="bi bi-person-fill"></i>
                        <span>
                            ${escapeHtml(ownerName)}
                        </span>
                    </div>

                    <div class="business-popup-row">
                        <i class="bi bi-tag-fill"></i>
                        <span>
                            ${escapeHtml(category)}
                        </span>
                    </div>

                    <div class="business-popup-row">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>
                            ${escapeHtml(address)}
                        </span>
                    </div>

                    ${
                        landmark
                            ? `
                                <div class="business-popup-row">
                                    <i class="bi bi-signpost-2-fill"></i>
                                    <span>
                                        ${escapeHtml(landmark)}
                                    </span>
                                </div>
                            `
                            : ''
                    }

                    <div>
                        <span
                            class="business-popup-status ${statusClass}"
                        >
                            ${escapeHtml(status)}
                        </span>
                    </div>

                </div>
            `;

        }

        businesses.forEach(function (business) {

            if (
                business.latitude === null ||
                business.longitude === null ||
                business.latitude === '' ||
                business.longitude === ''
            ) {
                return;
            }


            const lat =
                parseFloat(business.latitude);

            const lng =
                parseFloat(business.longitude);


            if (
                Number.isNaN(lat) ||
                Number.isNaN(lng)
            ) {
                return;
            }


            const marker = L.marker(
                [lat, lng],
                {
                    icon: createBusinessIcon(
                        business.registration_status
                    )
                }
            );


            marker
                .bindPopup(
                    buildPopupHtml(business),
                    {
                        maxWidth: 300,
                        minWidth: 230
                    }
                )
                .addTo(map);

        });


        setTimeout(function () {

            if (map) {

                map.invalidateSize();

                map.setView(
                    defaultCenter,
                    16
                );

            }

        }, 400);


    } else {

        const mapElement =
            document.getElementById('hotspotMap');


        if (mapElement) {

            mapElement.innerHTML = `
                <div class="map-error">

                    <div class="map-error-box">

                        <i class="bi bi-map"></i>

                        <h4>
                            Map configuration required
                        </h4>

                        <p>
                            The Geoapify API key is missing.
                            Please configure
                            <strong>services.geoapify.key</strong>
                            in your Laravel environment.
                        </p>

                    </div>

                </div>
            `;

        }

        console.error(
            'Geoapify API key is missing.'
        );

    }

    const landmarkReportBody=document.getElementById('landmarkReportBody');
    const landmarkReportCount=document.getElementById('landmarkReportCount');
    const topLandmarkCount=document.getElementById('topLandmarkCount');
    const topLandmarkName=document.getElementById('topLandmarkName');
    const identifiedLandmarks=document.getElementById('identifiedLandmarks');
    const withoutLandmark=document.getElementById('withoutLandmark');

    if(landmarkReportBody){
        const landmarkCounts={};
        let businessesWithoutLandmark=0;
        businesses.forEach(function(business){
            const rawLandmark=business.landmark===null||business.landmark===undefined?'':String(business.landmark).trim();
            
            if(!rawLandmark){
                businessesWithoutLandmark++;
                return;
            }

            const normalizedLandmark=rawLandmark.replace(/\s+/g,' ');

            const landmarkKey=normalizedLandmark.toLowerCase();

            if(!landmarkCounts[landmarkKey]) 
                landmarkCounts[landmarkKey]={
                    name:normalizedLandmark,
                    count:0
                };
            landmarkCounts[landmarkKey].count++;
        });
        const landmarkRows=Object.values(landmarkCounts)
            .sort(function(a,b){
                return b.count-a.count||a.name.localeCompare(b.name)
            });
        const totalBusinesses=businesses.length;
        const identifiedCount=landmarkRows.length;
        
        if(landmarkReportCount)landmarkReportCount.textContent=identifiedCount+(identifiedCount===1?' landmark':' landmarks');
        
        if(identifiedLandmarks)identifiedLandmarks.textContent=identifiedCount;
        
        if(withoutLandmark)withoutLandmark.textContent=businessesWithoutLandmark;

        if(landmarkRows.length>0){
            const top=landmarkRows[0];
            if(topLandmarkCount)topLandmarkCount.textContent=top.count;
            if(topLandmarkName){topLandmarkName.textContent=top.name;topLandmarkName.title=top.name;}
            landmarkReportBody.innerHTML=landmarkRows.map(function(row,index){
                
            const percentage=totalBusinesses>0?(row.count/totalBusinesses*100).toFixed(1):'0.0';
                let density='Low',densityClass='landmark-density-low';
                if(row.count>=8){density='High';densityClass='landmark-density-high'}else if(row.count>=4){density='Medium';densityClass='landmark-density-medium'}
            
                const width=totalBusinesses>0?Math.min(100,(row.count/totalBusinesses)*100):0;
                return `<tr><td class="landmark-rank">${index+1}</td><td class="landmark-name-cell">${escapeHtml(row.name)}</td><td class="landmark-count-cell">${row.count}</td><td class="landmark-percentage"><div class="landmark-progress"><div class="landmark-progress-bar" style="width:${width}%;"></div></div><div class="landmark-percentage-text">${percentage}% of all businesses</div></td><td><span class="landmark-density-badge ${densityClass}">${density}</span></td></tr>`;
            }).join('');
        }else{
            if(topLandmarkCount)topLandmarkCount.textContent='0';
            if(topLandmarkName)topLandmarkName.textContent='No landmark data';
            landmarkReportBody.innerHTML='<tr><td colspan="5" class="landmark-empty">No businesses have an assigned landmark.</td></tr>';
        }
    }

    const categoryCanvas =
        document.getElementById('categoryChart');

    if (categoryCanvas) {
        const categoryCounts = {};

        businesses.forEach(function (business) {

            const category =
                business.category ||
                'Uncategorized';


            categoryCounts[category] =
                (categoryCounts[category] || 0) + 1;

        });

        const categoryLabels =
            Object.keys(categoryCounts);

        const categoryValues =
            categoryLabels.map(function (category) {

                return categoryCounts[category];

            });

        const categoryColors = [
            '#075374',
            '#16829e',
            '#3ca6a3',
            '#66b447',
            '#a8c64e',
            '#f5c84c',
            '#f39a38',
            '#e76f51',
            '#d94f70',
            '#9b59b6',
            '#6c63a8',
            '#4f83cc',
            '#2f9eaa',
            '#5c8d89',
            '#7b8794'
        ];


        new Chart(
            categoryCanvas,
            {
                type: 'doughnut',

                data: {

                    labels: categoryLabels,

                    datasets: [
                        {
                            data: categoryValues,

                            backgroundColor:
                                categoryLabels.map(
                                    function (_, index) {
                                        return categoryColors[
                                            index %
                                            categoryColors.length
                                        ];
                                    }
                                ),

                            borderWidth: 2,
                            borderColor: '#ffffff',
                            hoverOffset: 5
                        }
                    ]

                },

                options: {

                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '64%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                padding: 13,
                                color: '#587887',
                                font: {
                                    size: 14,
                                    weight: '600'
                                }

                            }

                        },

                        tooltip: {

                            callbacks: {

                                label: function (
                                    context
                                ) {

                                    const total =
                                        context.dataset.data
                                            .reduce(
                                                function (
                                                    sum,
                                                    value
                                                ) {
                                                    return sum +
                                                        value;
                                                },
                                                0
                                            );


                                    const value =
                                        context.parsed;


                                    const percentage =
                                        total > 0
                                            ? (
                                                value /
                                                total *
                                                100
                                            ).toFixed(1)
                                            : 0;


                                    return (
                                        ' ' +
                                        context.label +
                                        ': ' +
                                        value +
                                        ' (' +
                                        percentage +
                                        '%)'
                                    );

                                }

                            }

                        }

                    }

                }

            }
        );

    }

    const paymentCanvas =
        document.getElementById('paymentChart');


    if (paymentCanvas) {

        const monthNames = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];

        const yearlyCollections =
            Array(12).fill(0);

        monthlyCollections.forEach(
            function (item) {

                const monthNumber =
                    parseInt(
                        item.month_number,
                        10
                    );


                if (
                    monthNumber >= 1 &&
                    monthNumber <= 12
                ) {

                    yearlyCollections[
                        monthNumber - 1
                    ] =
                        parseFloat(
                            item.total || 0
                        );
                }
            }
        );

        const paymentLabels =
            monthNames.map(
                function (month) {

                    return (
                        month +
                        ' ' +
                        currentYear
                    );

                }
            );

        const paymentValues =
            yearlyCollections.map(
                function (value) {

                    return parseFloat(
                        value || 0
                    );

                }
            );

        const ctx =
            paymentCanvas.getContext('2d');

        const gradient =
            ctx.createLinearGradient(
                0,
                0,
                0,
                330
            );
        gradient.addColorStop(
            0,
            'rgba(7, 83, 116, 0.28)'
        );
        gradient.addColorStop(
            1,
            'rgba(7, 83, 116, 0.02)'
        );

        new Chart(
            paymentCanvas,
            {
                type: 'line',
                data: {
                    labels: paymentLabels,
                    datasets: [
                        {
                            label:
                                'Payment Collection',

                            data:
                                paymentValues,

                            borderColor:
                                '#075374',

                            backgroundColor:
                                gradient,

                            borderWidth: 3,

                            fill: true,

                            tension: 0.42,

                            cubicInterpolationMode:
                                'monotone',

                            pointRadius: 4,
                            pointHoverRadius: 6,
                            pointBackgroundColor:
                                '#ffffff',
                            pointBorderColor:
                                '#075374',
                            pointBorderWidth: 2
                        }
                    ]

                },

                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false

                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#829ba5',
                                font: {
                                    size: 13
                                },
                                maxRotation: 0,
                                autoSkip: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color:
                                    'rgba(100, 140, 150, 0.10)'
                            },
                            ticks: {

                                color: '#829ba5',
                                font: {
                                    size: 10
                                },
                                callback:
                                    function (value) {
                                        return '₱' +
                                            Number(value)
                                                .toLocaleString(
                                                    'en-PH'
                                                );
                                    }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor:
                                '#173f50',
                            padding: 11,
                            titleFont: {
                                size: 10,
                                weight: '700'
                            },
                            bodyFont: {
                                size: 11
                            },
                            callbacks: {
                                label:
                                    function (context) {
                                        return (
                                            ' Collection: ₱' +
                                            Number(
                                                context.parsed.y
                                            ).toLocaleString(
                                                'en-PH',
                                                {
                                                    minimumFractionDigits:
                                                        2,
                                                    maximumFractionDigits:
                                                        2
                                                }
                                            )
                                        );
                                    }
                            }
                        }
                    }
                }
            }
        );
    }
});
</script>

@endsection 