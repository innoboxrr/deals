<template>
    <div v-flowbite>
        <section class="flex items-center bg-gray-50 dark:bg-gray-900">
            <div class="w-full">
                <div class="relative overflow-hidden dark:bg-gray-800 border-b">
                    <div class="px-4 divide-y dark:divide-gray-700">
                        <div class="flex items-center justify-between py-3">
                            <div class="flex items-center flex-1 space-x-2">
                                <h5 class="font-semibold dark:text-white">
                                    Dashboard de anunciantes
                                </h5>
                            </div>
                            <div class="flex items-center space-x-2 md:space-x-4">
                                <router-link
                                    :to="{
                                        name: 'DealsAdvertisersManagerCreate'
                                    }" 
                                    class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-white bg-indigo-600 border border-gray-200 rounded-lg fhover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 focus:z-10 focus:ring-4 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 hover:text-white">
                                    <i class="h-5 w-5 pt-1 mr-2 text-white fa-solid fa-plus"></i>
                                    {{ __deals('Create new') }}
                                </router-link>
                                <button 
                                    type="button"
                                    class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    <i class="h-5 w-5 pt-1 mr-2 text-gray-900 fa-solid fa-download"></i>
                                    Export
                                </button>
                            </div>
                        </div>
                        <div class="flex flex-col items-stretch py-4 md:flex-row md:items-center">
                            <div class="flex flex-col space-y-3 md:flex-row md:items-center w-full md:space-y-0 justify-between">
                                <div class="flex flex-col space-y-1 md:space-y-0 md:flex-row md:items-center md:mr-5">
                                    <span class="mx-auto text-gray-500 md:mx-4 pt-2 px-3">
                                        Results from: 
                                    </span>
                                    <div class="relative min-w-[12rem]">
                                        <input 
                                            name="start" 
                                            type="date" 
                                            id="start" 
                                            placeholder="Select start date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <span class="mx-auto text-gray-500 md:mx-4 pt-2 px-3">to</span>
                                    <div class="relative min-w-[12rem]">
                                        <input 
                                            name="end" 
                                            type="date" 
                                            placeholder="Select end date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2.5 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                </div>
                                <div class="ml-auto md:mr-4 min-w-[10rem]">
                                    <select 
                                        id="compare"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2.5 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Compare to</option>
                                        <option value="last_year">Last Year</option>
                                        <option value="last_month">Last Month</option>
                                        <option value="yesterday">Yesterday</option>
                                        <option value="last_week">Last Week</option>
                                        <option value="last_3_months">Last 3 Months</option>
                                        <option value="last_6_months">Last 6 Months</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="px-4 my-4 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800 md:p-6">
                <i class="mb-2 h-6 w-6 text-gray-400 fa-solid fa-users"></i>
                <h3 class="text-gray-500 dark:text-gray-400">
                    Anunciantes activos
                </h3>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">
                    45
                </span>
                <p class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                    <span class="mr-1.5 flex items-center text-sm font-medium text-green-500 dark:text-green-400 sm:text-base">
                        <i class="h-3 w-3 mr-2 text-green-500 fa-solid fa-arrow-up"></i> 7%
                    </span>
                    vs last month
                </p>
            </div>
            <div class="rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800 md:p-6">
                <i class="mb-2 h-6 w-6 text-gray-400 fa-solid fa-chart-line"></i>
                <h3 class="text-gray-500 dark:text-gray-400">
                    Management revenue
                </h3>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">
                    $82.1k
                </span>
                <p class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400 sm:text-base">
                    <span class="mr-1.5 flex items-center text-sm font-medium text-green-500 dark:text-green-400 sm:text-base">
                        <i class="h-3 w-3 mr-2 text-green-500 fa-solid fa-arrow-up"></i> 8.8%
                    </span>
                    vs last month
                </p>
            </div>
            <div class="rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800 md:p-6">
                <svg
                    class="mb-2 h-6 w-6 text-gray-400"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"
                    />
                </svg>
                <h3 class="text-gray-500 dark:text-gray-400">
                    Inversión publicitaria
                </h3>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">
                    $54.3k
                </span>
                <p class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400 sm:text-base">
                    <span class="mr-1.5 flex items-center text-sm font-medium text-red-600 dark:text-red-500">
                        <i class="h-3 w-3 mr-2 text-red-500 fa-solid fa-arrow-down"></i> 2.5%
                    </span>
                    vs last month
                </p>
            </div>
            <div class="rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800 md:p-6">
                <i class="mb-2 h-6 w-6 text-gray-400 fa-solid fa-dollar-sign"></i>
                <h3 class="text-gray-500 dark:text-gray-400">
                    Comisión publicitaria
                </h3>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">
                    $2.3k
                </span>
                <p class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400 sm:text-base">
                    <span class="mr-1.5 flex items-center text-sm font-medium text-green-500 dark:text-green-400">
                        <i class="h-3 w-3 mr-2 text-green-500 fa-solid fa-arrow-up"></i> 5.6%
                    </span>
                    vs last month
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import { MagnifyingGlassIcon } from "@heroicons/vue/20/solid";

    export default {
        name: "HeaderComponent",
        components: {
            MagnifyingGlassIcon,
        },
    };
</script>
