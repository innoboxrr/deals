<template>
    <div 
        v-flowbite 
        class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between">
            <div>
                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">
                    32.4k
                </h5>
            <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                Users this week
            </p>
            </div>
            <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                12%
                <i class="fa-solid fa-arrow-up text-green-500 dark:text-green-500 ms-1"></i>
            </div>
        </div>
        <div id="area-chart"></div>
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
        name: 'AreaChart',
        mounted() {
            this.renderChart()
        },
        methods: {
            renderChart() {
                const options = {
                    chart: {
                        height: "270px",
                        maxWidth: "100%",
                        type: "area",
                        fontFamily: "Inter, sans-serif",
                        dropShadow: {
                        enabled: false,
                        },
                        toolbar: {
                        show: false,
                        },
                    },
                    tooltip: {
                        enabled: true,
                        x: {
                        show: false,
                        },
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                        opacityFrom: 0.55,
                        opacityTo: 0,
                        shade: "#1C64F2",
                        gradientToColors: ["#1C64F2"],
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        width: 6,
                    },
                    grid: {
                        show: false,
                        strokeDashArray: 4,
                        padding: {
                        left: 2,
                        right: 2,
                        top: 0
                        },
                    },
                    series: [
                        {
                        name: "New users",
                        data: [6500, 6418, 6456, 6526, 6356, 6456],
                        color: "#1A56DB",
                        },
                    ],
                    xaxis: {
                        categories: ['01 February', '02 February', '03 February', '04 February', '05 February', '06 February', '07 February'],
                        labels: {
                        show: false,
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
                if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
                    const chart = new ApexCharts(document.getElementById("area-chart"), options);
                    chart.render();
                }
            },
        },
    }
</script>