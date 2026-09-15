<div class="dashboard-chart-section">
    <div class="dashboard-chart-grid">
        <div class="dashboard-chart-panel">
            <div class="dashboard-chart-header">
                <div>
                    <h3>
                        Business Distribution by Category
                    </h3>
                    <p>
                        Number of active businesses by category.
                    </p>
                </div>
                <div class="dashboard-chart-icon">
                    <i class="bi bi-pie-chart-fill"></i>
                </div>
            </div>

            <div class="dashboard-category-chart">

                <canvas id="dashboardCategoryChart"></canvas>

            </div>

        </div>


        <div class="dashboard-chart-panel">

            <div class="dashboard-chart-header">

                <div>

                    <h3>
                        Annual Payment Collection Trend
                    </h3>

                    <p>
                        Monthly payment collections for
                        {{ $currentYear ?? now()->year }}.
                    </p>

                </div>

                <div class="dashboard-chart-icon">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>

            </div>

            <div class="dashboard-payment-chart">

                <canvas id="dashboardPaymentChart"></canvas>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

   
    const businesses =
        @json($businesses ?? []);

    const monthlyCollections =
        @json($monthlyCollections ?? []);

    const currentYear =
        {{ $currentYear ?? now()->year }};



    const categoryCanvas =
        document.getElementById('dashboardCategoryChart');


    if (categoryCanvas) {

        const categoryCounts = {};


        businesses.forEach(function (business) {

            const category =
                business.category || 'Uncategorized';

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

                                    size: 11,

                                    weight: '600'

                                }

                            }

                        },


                        tooltip: {

                            callbacks: {

                                label: function (context) {

                                    const total =
                                        context.dataset.data.reduce(
                                            function (
                                                sum,
                                                value
                                            ) {

                                                return sum + value;

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
        document.getElementById('dashboardPaymentChart');


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

                                    size: 10

                                },

                                maxRotation: 0,

                                autoSkip: true,

                                maxTicksLimit: 6

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

<style>
.dashboard-chart-section {
    width: 100%;
    margin-top: 20px;
}
.dashboard-chart-grid {
    width: 100%;
    display: grid;
    grid-template-columns:
        minmax(0, 1fr)
        minmax(0, 1fr);
    gap: 18px;
}
.dashboard-chart-panel {
    width: 100%;
    min-width: 0;
    background: #ffffff;
    border: 1px solid #d9e8ed;
    border-radius: 18px;
    padding: 24px;
    box-shadow:
        0 8px 24px
        rgba(7, 83, 116, 0.06);
}
.dashboard-chart-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 15px;
}
.dashboard-chart-header h3 {
    margin: 0;
    color: #075374;
    font-size: 18px;
    font-weight: 800;
    line-height: 1.3;
}
.dashboard-chart-header p {
    margin: 7px 0 0;
    color: #72909c;
    font-size: 12px;
    line-height: 1.5;
}
.dashboard-chart-icon {
    width: 40px;
    height: 40px;
    flex: 0 0 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: #e8f6fa;
    color: #075374;
    font-size: 18px;
}
.dashboard-category-chart {
    position: relative;
    width: 100%;
    height: 315px;
}
.dashboard-payment-chart {
    position: relative;
    width: 100%;
    height: 315px;
}
@media (max-width: 900px) {
    .dashboard-chart-grid {
        grid-template-columns: 1fr;
    }
}
@media (max-width: 576px) {
    .dashboard-chart-panel {
        padding: 18px;
        border-radius: 14px;
    }
    .dashboard-chart-header h3 {
        font-size: 16px;
    }
    .dashboard-chart-header p {
        font-size: 11px;
    }
    .dashboard-category-chart {
        height: 280px;
    }
    .dashboard-payment-chart {
        height: 280px;
    }
}
</style>