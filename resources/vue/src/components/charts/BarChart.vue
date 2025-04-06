<template>
    <div 
        v-flowbite 
        class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between border-gray-200 border-b dark:border-gray-700 pb-3">
            <dl>
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Profit</dt>
                <dd class="leading-none text-3xl font-bold text-gray-900 dark:text-white">$5,405</dd>
            </dl>
            <div>
                <span class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
                    <i class="fa-solid fa-arrow-up text-green-500 dark:text-green-400 mr-2"></i>
                    Profit rate 23.5%
                </span>
            </div>
        </div>

        <div class="grid grid-cols-2 py-3 justify-between items-center">
            <dl>
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Income</dt>
                <dd class="leading-none text-xl font-bold text-green-500 dark:text-green-400">$23,635</dd>
            </dl>
            <dl>
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Expense</dt>
                <dd class="leading-none text-xl font-bold text-red-600 dark:text-red-500">-$18,230</dd>
            </dl>
        </div>

        <div id="bar-chart"></div>
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
        name: 'BarChart',
        mounted() {
            this.renderChart()
        },
        methods: {
            renderChart() {
                const options = {
                    series: [
                        {
                            name: "Income",
                            color: "#31C48D",
                            data: ["1420", "1650", "2120"],
                        },
                        {
                            name: "Expense",
                            data: ["788", "1100", "1200"],
                            color: "#F05252",
                        }
                    ],
                    chart: {
                        sparkline: {
                            enabled: false,
                        },
                        type: "bar",
                        width: "100%",
                        height: 220,
                        toolbar: {
                            show: false,
                        }
                    },
                    fill: {
                        opacity: 1,
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                            columnWidth: "100%",
                            borderRadiusApplication: "end",
                            borderRadius: 6,
                            dataLabels: {
                                position: "top",
                            },
                        },
                    },
                    legend: {
                        show: true,
                        position: "bottom",
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    tooltip: {
                        shared: true,
                        intersect: false,
                        formatter: function (value) {
                            return "$" + value
                        }
                    },
                    xaxis: {
                        labels: {
                            show: true,
                            style: {
                                fontFamily: "Inter, sans-serif",
                                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                            },
                            formatter: function(value) {
                                return "$" + value
                            }
                        },
                        categories: ["Oct", "Nov", "Dec"],
                        axisTicks: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                    },
                    yaxis: {
                        labels: {
                            show: true,
                            style: {
                                fontFamily: "Inter, sans-serif",
                                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                            }
                        }
                    },
                    grid: {
                        show: true,
                        strokeDashArray: 4,
                        padding: {
                            left: 2,
                            right: 2,
                            top: -20
                        },
                    },
                    fill: {
                        opacity: 1,
                    }
                    }

                    if(document.getElementById("bar-chart") && typeof ApexCharts !== 'undefined') {
                        const chart = new ApexCharts(document.getElementById("bar-chart"), options);
                        chart.render();
                    }

            },
        },
    }
</script>