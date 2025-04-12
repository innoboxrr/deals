<template>
    <div v-flowbite v-if="dataLoaded">
        <div class="px-4 mt-4 mb-2 grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
            <div class="rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800 md:p-6">
                <i class="mb-2 h-6 w-6 text-gray-400 fa-solid fa-tags"></i>
                <h3 class="text-gray-500 dark:text-gray-400">
                    {{ __deals('Active deals') }}
                </h3>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">
                    4
                </span>
                <p class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                    <span class="mr-1.5 flex items-center text-sm font-medium text-green-500 dark:text-green-400 sm:text-base">
                        <i class="h-3 w-3 mr-2 text-green-500 fa-solid fa-arrow-up"></i> 7%
                    </span>
                    vs last month
                </p>
            </div>

            <div class="rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800 md:p-6">
                <i class="mb-2 h-6 w-6 text-gray-400 fa-solid fa-users"></i>
                <h3 class="text-gray-500 dark:text-gray-400">
                    {{ __deals('Active advertisers') }}
                </h3>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">
                    4
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
    import { showModel as showDealModel } from '@dealsModels/deal'
    import { useDealsManagerStore } from '@dealsPages/deals-manager/store/dealsManagerStore.js'
    export default {
        name: "ShowView",
        setup() {
            const dealsManagerStore = useDealsManagerStore()
            return {
                dealsManagerStore,
            }
        },
        data() {
            return {
                dataLoaded: false,
                deal: null,
            }
        },
        async mounted() {
            await this.fetchData();
            this.dataLoaded = true;
            this.dealsManagerStore.setHeaderTitle('Deal #' + this.deal.id + ' - ' + this.deal.name);
            this.dealsManagerStore.setDealId(this.$route.params.dealId);
        },
        unmounted() {
            this.dealsManagerStore.setDealId(null);
        },
        methods: {
            async fetchData() {
                await this.fetchDeal();
            },
            async fetchDeal() {
                this.deal = await showDealModel(this.$route.params.dealId);
                // Pending: Si deal tiene product denfinir state dealProductId
            }
        }
    }
</script>