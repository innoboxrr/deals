<template>
    <div 
        v-flowbite 
        class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
        <div class="w-full mx-auto">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h5 class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">
                        Clicks
                        <i class="fa-solid fa-circle-info text-xs ml-2"></i>    
                    </h5>
                    <p class="text-gray-900 dark:text-white text-xl leading-none font-bold">
                        42,3k
                    </p>
                </div>
                <div>
                    <h5 class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">
                        CPC
                        <i class="fa-solid fa-circle-info text-xs ml-2"></i>    
                    </h5>
                    <p class="text-gray-900 dark:text-white text-xl leading-none font-bold">
                        $ 5.40
                    </p>
                </div>
                <div>
                    <h5 class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">
                        CPL
                        <i class="fa-solid fa-circle-info text-xs ml-2"></i>    
                    </h5>
                    <p class="text-gray-900 dark:text-white text-xl leading-none font-bold">
                        $ 17
                    </p>
                </div>
                <div>
                    <h5 class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">
                        CTR
                        <i class="fa-solid fa-circle-info text-xs ml-2"></i>    
                    </h5>
                    <p class="text-gray-900 dark:text-white text-xl leading-none font-bold">
                        12%
                    </p>
                </div>
            </div>
        </div>
        <div id="line-chart"></div>
        <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
            <div class="flex justify-between items-center pt-5">
                <!-- Button -->
                <button
                    id="dropdownDefaultButton"
                    data-dropdown-toggle="lastDaysdropdown"
                    data-dropdown-placement="right"
                    class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                    type="button">
                    Last 7 days
                    <i class="fa-solid fa-caret-down text-gray-500 dark:text-gray-400 ms-1"></i>
                </button>
                <!-- Dropdown menu -->
                <div 
                    id="lastDaysdropdown" 
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                    <ul 
                        class="py-2 text-sm text-gray-700 dark:text-gray-200" 
                        aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a 
                                href="#" 
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                Yesterday
                            </a>
                        </li>
                        <li>
                            <a 
                                href="#" 
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                Today
                            </a>
                        </li>
                        <li>
                            <a 
                                href="#" 
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                Last 7 days
                            </a>
                        </li>
                        <li>
                            <a 
                                href="#" 
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                Last 30 days
                            </a>
                        </li>
                        <li>
                            <a 
                                href="#" 
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                Last 90 days
                            </a>
                        </li>
                    </ul>
                </div>
                <a
                    href="#"
                    class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                    Users Report
                    <i class="fa-solid fa-arrow-right text-blue-600 dark:text-blue-500 ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    import ApexCharts from 'apexcharts'

    export default {
        name: 'LineChart',
        props: {
            chartData: {
                type: Object,
                required: false
            }
        },
        mounted() {
            this.renderChart()
        },
        methods: {
            renderChart() {
                const options = {
                    chart: {
                        height: "265px",
                        maxWidth: "100%",
                        type: "line",
                        fontFamily: "Inter, sans-serif",
                        dropShadow: {
                            enabled: false,
                        },
                        toolbar: {
                            show: false,
                        },
                    },
                    stroke: {
                        width: 6,
                    },
                    grid: {
                        show: true,
                        strokeDashArray: 4,
                        padding: {
                            left: 2,
                            right: 2,
                            top: -26
                        },
                    },
                    series: [
                        {
                            name: "Clicks",
                            data: [0.684, 0.4, 0.6, 0.2, 0.8, 1],
                            color: "#1A56DB",
                        },
                        {
                            name: "CPC",
                            data: [0.333, 0, 0.667, 1, 0.333, 0.2],
                            color: "#7E3AF2",
                        },
                        {
                            name: "CPL",
                            data: [0.5, 0, 1, 0.75, 0.25, 0.5],
                            color: "#FBBF24",
                        },
                        {
                            name: "CTR",
                            data: [0, 0.75, 0.25, 1, 0.5, 0.75],
                            color: "#F43F5E",
                        }
                    ],
                    dataLabels: {
                        enabled: false,
                        formatter: function (value, opts) {
                            const serie = opts.w.config.series[opts.seriesIndex].name;
                            if (serie === 'Clicks') {
                                // Desnormalizamos: value * 500 + 6500
                                const actual = value * 500 + 6500;
                                return Math.round(actual) + ' clicks';
                            }
                            if (serie === "CTR") {
                                // Desnormalizamos: value * 0.4 + 2.5
                                const actual = value * 0.4 + 2.5;
                                return actual.toFixed(1) + '%';
                            }
                            if (serie === "CPC") {
                                // Desnormalizamos: value * 0.15 + 1.45
                                const actual = value * 0.15 + 1.45;
                                return '$' + actual.toFixed(2);
                            }
                            if (serie === "CPL") {
                                // Desnormalizamos: value * 2 + 14
                                const actual = value * 2 + 14;
                                return '$' + actual.toFixed(2);
                            }
                            return value;
                        }
                    },
                    tooltip: {
                        enabled: true,
                        x: {
                            show: true,
                        },
                        y: {
                            formatter: function (value, opts) {
                                const serie = opts.w.config.series[opts.seriesIndex].name;
                                if (serie === 'Clicks') {
                                    const actual = value * 500 + 6500;
                                    return Math.round(actual) + ' clicks';
                                }
                                if (serie === "CTR") {
                                    const actual = value * 0.4 + 2.5;
                                    return actual.toFixed(1) + '%';
                                }
                                if (serie === "CPC") {
                                    const actual = value * 0.15 + 1.45;
                                    return '$' + actual.toFixed(2);
                                }
                                if (serie === "CPL") {
                                    const actual = value * 2 + 14;
                                    return '$' + actual.toFixed(2);
                                }
                                return value;
                            }
                        }
                    },
                    legend: {
                        show: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    xaxis: {
                        categories: ['01 Feb', '02 Feb', '03 Feb', '04 Feb', '05 Feb', '06 Feb', '07 Feb'],
                        labels: {
                            show: true,
                            style: {
                                fontFamily: "Inter, sans-serif",
                                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                            }
                        },
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                    },
                    yaxis: {
                        show: false,
                    },
                }

                if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
                    const chart = new ApexCharts(document.getElementById("line-chart"), options);
                    chart.render();
                }
            }
        }
    }
</script>