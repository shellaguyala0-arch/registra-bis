@once

<style>
    .business-map-panel {
        width: 100%;
        margin: 0;
        padding: 0;
    }

    .business-map-panel .panel-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;

        padding: 17px 22px;

        margin: 0;

        background: #fff;

        border-bottom: 1px solid #edf0f4;
    }

    .business-map-panel .panel-heading h3 {
        margin: 0;

        color: #064a6d;

        font-size: 16px;
        font-weight: 800;
    }

    .business-map-panel .panel-heading p {
        margin: 4px 0 0;

        color: #78909c;

        font-size: 11px;
    }

    .map-business-count {
        display: flex;
        align-items: center;

        gap: 6px;

        padding: 7px 11px;

        border-radius: 20px;

        background: #e7f6fc;

        color: #08749b;

        font-size: 10px;

        font-weight: 700;

        white-space: nowrap;
    }

    #businessMap {
        width: 100%;
        height: 100%;
        min-height: 450px;
        border: 0;
        overflow: hidden;
    }


    .business-marker {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #08749b;
        border: 3px solid #ffffff;
        border-radius: 50% 50% 50% 0;
        transform: rotate(-45deg);
        box-shadow:
            0 4px 10px rgba(0, 50, 70, .40);

        cursor: pointer;
    }

    .business-marker i {
        color: #ffffff;

        font-size: 17px;

        transform: rotate(45deg);
    }


    .business-popup {
        min-width: 220px;

        font-family: Arial, sans-serif;
    }

    .business-popup-title {
        color: #064a6d;

        font-size: 14px;

        font-weight: 800;

        line-height: 1.3;

        margin-bottom: 8px;
    }

    .business-popup-row {
        color: #607d8b;

        font-size: 11px;

        line-height: 1.5;

        margin-bottom: 5px;
    }

    .business-popup-label {
        color: #365d6d;

        font-weight: 700;
    }

    .business-popup-status {
        display: inline-block;

        margin-top: 7px;

        padding: 5px 9px;

        border-radius: 20px;

        background: #e7f6fc;

        color: #08749b;

        font-size: 9px;

        font-weight: 700;
    }


    #businessMap .maplibregl-ctrl-group {
        border-radius: 9px;

        overflow: hidden;

        box-shadow: 0 2px 8px rgba(0,0,0,.20);
    }

    #businessMap .maplibregl-ctrl-group button {
        width: 34px;
        height: 34px;
    }



    @media (max-width: 768px) {

        .business-map-panel .panel-heading {
            padding: 14px 16px;

            align-items: flex-start;

            flex-direction: column;

            gap: 10px;
        }

        .map-business-count {
            align-self: flex-start;
        }

        #businessMap {
            min-height: 350px;
        }

    }

    @media (max-width: 480px) {

        .business-map-panel .panel-heading h3 {
            font-size: 14px;
        }

        .business-map-panel .panel-heading p {
            font-size: 10px;
        }

        #businessMap {
            min-height: 320px;
        }

    }

</style>


<link
    href="https://unpkg.com/maplibre-gl@5/dist/maplibre-gl.css"
    rel="stylesheet"
/>

@endonce


<div class="dashboard-panel business-map-panel">

    <div class="panel-heading">

        <div>

            <h3>
                Business Locations
            </h3>

            <p>
                Geographic distribution of registered businesses in San Bartolome.
            </p>

        </div>


        <div class="map-business-count">

            <i class="bi bi-geo-alt-fill"></i>

            {{ $mapBusinesses->count() }} Locations

        </div>

    </div>


    <div id="businessMap"></div>

</div>


@once

<script src="https://unpkg.com/maplibre-gl@5/dist/maplibre-gl.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const GEOAPIFY_KEY =
        @json(config('services.geoapify.key'));


    if (!GEOAPIFY_KEY) {

        console.error(
            'Geoapify API key is missing.'
        );

        return;
    }

    const businesses =
        @json($mapBusinesses);


    const sanBartolome = [
        124.1276,
        12.6871
    ];


    const sanBartolomeBounds = {

        minLng: 124.105,

        maxLng: 124.150,

        minLat: 12.665,

        maxLat: 12.710

    };


    const map =
        new maplibregl.Map({

            container: 'businessMap',

            style:
                'https://maps.geoapify.com/v1/styles/osm-bright/style.json?apiKey='
                + encodeURIComponent(GEOAPIFY_KEY),

            center: sanBartolome,

            zoom: 15.5,

            minZoom: 13,

            maxZoom: 19,

            attributionControl: true

        });


    map.addControl(

        new maplibregl.NavigationControl({

            showCompass: false

        }),

        'top-right'

    );


    map.on('error', function (event) {

        console.error(
            'MapLibre error:',
            event && event.error
        );

    });


    map.on('load', async function () {

        const bounds =
            new maplibregl.LngLatBounds(
                sanBartolome,
                sanBartolome
            );


        let validMarkerCount = 0;



        for (const business of businesses) {

            let latitude =
                parseFloat(
                    business.latitude
                );

            let longitude =
                parseFloat(
                    business.longitude
                );


            const hasValidCoordinates =
                Number.isFinite(latitude) &&
                Number.isFinite(longitude) &&
                latitude !== 0 &&
                longitude !== 0;


            const coordinatesAreInSanBartolome =
                hasValidCoordinates &&
                longitude >= sanBartolomeBounds.minLng &&
                longitude <= sanBartolomeBounds.maxLng &&
                latitude >= sanBartolomeBounds.minLat &&
                latitude <= sanBartolomeBounds.maxLat;


            if (!coordinatesAreInSanBartolome) {

                const geocoded =
                    await geocodeBusiness(
                        business
                    );


                if (geocoded) {

                    longitude =
                        geocoded.longitude;

                    latitude =
                        geocoded.latitude;

                } else {


                    longitude =
                        sanBartolome[0];

                    latitude =
                        sanBartolome[1];

                }

            }


            addBusinessMarker(
                business,
                latitude,
                longitude,
                bounds
            );


            validMarkerCount++;

        }


        if (validMarkerCount > 0) {

            map.fitBounds(

                bounds,

                {

                    padding: {

                        top: 70,

                        bottom: 50,

                        left: 50,

                        right: 50

                    },

                    maxZoom: 17,

                    duration: 0

                }

            );

        } else {

            map.jumpTo({

                center: sanBartolome,

                zoom: 15.5

            });

        }


    });


   
    async function geocodeBusiness(business) {
        const addressParts = [

            business.address,

            business.location_description,

            'San Bartolome',

            'Santa Magdalena',

            'Sorsogon',

            'Philippines'

        ];


        const searchText =
            addressParts

                .filter(function (value) {

                    return value !== null &&
                           value !== undefined &&
                           String(value).trim() !== '';

                })

                .join(', ');


        if (!searchText) {

            return null;

        }


        try {

            const url =
                'https://api.geoapify.com/v1/geocode/search'
                + '?text='
                + encodeURIComponent(searchText)
                + '&filter=countrycode:ph'
                + '&limit=5'
                + '&apiKey='
                + encodeURIComponent(GEOAPIFY_KEY);


            const response =
                await fetch(url);


            if (!response.ok) {

                console.error(
                    'Geoapify geocoding failed:',
                    response.status
                );

                return null;

            }


            const data =
                await response.json();


            if (
                !data.features ||
                !data.features.length
            ) {

                return null;

            }

            for (
                const feature of data.features
            ) {

                const coordinates =
                    feature.geometry &&
                    feature.geometry.coordinates;


                if (
                    !coordinates ||
                    coordinates.length < 2
                ) {

                    continue;

                }


                const lng =
                    parseFloat(
                        coordinates[0]
                    );

                const lat =
                    parseFloat(
                        coordinates[1]
                    );


                if (
                    !Number.isFinite(lat) ||
                    !Number.isFinite(lng)
                ) {

                    continue;

                }


                if (

                    lng >=
                        sanBartolomeBounds.minLng &&
                    lng <=
                        sanBartolomeBounds.maxLng &&
                    lat >=
                        sanBartolomeBounds.minLat &&
                    lat <=
                        sanBartolomeBounds.maxLat

                ) {

                    return {

                        longitude: lng,

                        latitude: lat

                    };

                }

            }


            return null;


        } catch (error) {

            console.error(
                'Business geocoding error:',
                error
            );

            return null;

        }

    }



    function addBusinessMarker(
        business,
        latitude,
        longitude,
        bounds
    ) {

        bounds.extend([
            longitude,
            latitude
        ]);


        const markerElement =
            document.createElement('div');


        markerElement.className =
            'business-marker';


        markerElement.innerHTML = `
            <i class="bi bi-geo-alt-fill"></i>
        `;



        const popupHTML = `

            <div class="business-popup">

                <div class="business-popup-title">

                    ${escapeHtml(
                        business.business_name
                    )}

                </div>


                <div class="business-popup-row">

                    <span class="business-popup-label">
                        Owner:
                    </span>

                    ${escapeHtml(
                        business.owner_name
                    )}

                </div>


                <div class="business-popup-row">

                    <span class="business-popup-label">
                        Address:
                    </span>

                    ${escapeHtml(
                        business.address
                    )}

                </div>


                <span class="business-popup-status">

                    ${escapeHtml(
                        business.registration_status
                    )}

                </span>

            </div>

        `;


        const popup =
            new maplibregl.Popup({

                offset: 28,

                closeButton: true,

                closeOnClick: true

            })


            .setHTML(
                popupHTML
            );


        new maplibregl.Marker({

            element: markerElement,

            anchor: 'bottom'

        })

        .setLngLat([

            longitude,

            latitude

        ])

        .setPopup(popup)

        .addTo(map);

    }

    function escapeHtml(value) {

        if (
            value === null ||
            value === undefined
        ) {

            return '';

        }


        return String(value)

            .replace(
                /&/g,
                '&amp;'
            )

            .replace(
                /</g,
                '&lt;'
            )

            .replace(
                />/g,
                '&gt;'
            )

            .replace(
                /"/g,
                '&quot;'
            )

            .replace(
                /'/g,
                '&#039;'
            );

    }

});

</script>

@endonce