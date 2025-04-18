<template>
    <section v-flowbite class="mb-4">
        <div class="px-4 mx-auto">
            <div class="bg-white dark:bg-gray-800 relative border sm:rounded-lg">
                <div class="border-b dark:border-gray-700 mx-4">
                    <div class="flex items-center justify-between space-x-4 pt-3">
                        <div class="flex-1 flex items-center space-x-3">
                            <h5 class="dark:text-white font-semibold">
                                {{ __deals('Advertisers') }}
                            </h5>
                        </div>
                    </div>
                    <div class="flex flex-col-reverse md:flex-row items-center justify-between md:space-x-4 py-3">
                        <div class="w-full flex flex-col space-y-3 md:space-y-0 md:flex-row md:items-center justify-between">
                            <form class="w-full md:max-w-sm flex-1 md:mr-4">
                                <label 
                                    for="globalQuery" 
                                    class="text-sm font-medium text-gray-900 sr-only dark:text-white">
                                    {{ __deals('Search') }}
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="h-5 w-5 pt-1 text-gray-400 fa-solid fa-magnifying-glass"></i>
                                    </div>
                                    <input 
                                        type="search" 
                                        id="globalQuery" 
                                        class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                        :placeholder="__deals('Search...')" 
                                        required
                                        v-model="globalQuery">
                                    <button 
                                        type="submit" 
                                        class="text-white absolute right-0 bottom-0 top-0 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-r-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 rounded-lg">
                                        {{ __deals('Search') }}
                                    </button>
                                </div>
                            </form>
                            <div class="flex items-center space-x-4 ml-4 justify-end">
                                <div>
                                    <button 
                                        id="advertisersFilterDropdownButton" 
                                        data-dropdown-toggle="advertisersFilterDropdown" 
                                        type="button" 
                                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                        <i class="h-5 w-5 pt-1 mr-2 text-gray-900 fa-solid fa-filter"></i>
                                        {{ __deals('Filters') }}
                                        <i class="h-5 w-5 pt-1 ml-2 text-gray-400 fa-solid fa-caret-down"></i>
                                    </button>
                                    <div 
                                        id="advertisersFilterDropdown" 
                                        class="z-10 hidden p-3 bg-white rounded-lg shadow w-56 dark:bg-gray-700">
                                        <h6 class="mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            By status
                                        </h6>
                                        <ul 
                                            class="space-y-2 text-sm" 
                                            aria-labelledby="advertisersFilterDropdownButton">
                                            <li>
                                                <label 
                                                    class="flex items-center text-sm font-medium text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md px-1.5 py-1 w-full">
                                                    <input 
                                                        type="checkbox" 
                                                        value="" 
                                                        class="w-4 h-4 mr-2 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    In progress
                                                </label>
                                            </li>
                                            <li>
                                                <label 
                                                    class="flex items-center text-sm font-medium text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md px-1.5 py-1 w-full">
                                                    <input 
                                                        type="checkbox" 
                                                        value="" 
                                                        checked 
                                                        class="w-4 h-4 mr-2 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    In review
                                                </label>
                                            </li>
                                            <li>
                                                <label 
                                                    class="flex items-center text-sm font-medium text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md px-1.5 py-1 w-full">
                                                    <input 
                                                        type="checkbox" 
                                                        value="" 
                                                        class="w-4 h-4 mr-2 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    Completed
                                                </label>
                                            </li>
                                            <li>
                                                <label class="flex items-center text-sm font-medium text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md px-1.5 py-1 w-full">
                                                    <input type="checkbox" value="" class="w-4 h-4 mr-2 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    Canceled
                                                </label>
                                            </li>
                                        </ul>
                                        <h6 class="mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">By number of users</h6>
                                        <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                            <li>
                                                <label class="flex items-center text-sm font-medium text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md px-1.5 py-1 w-full">
                                                    <input type="checkbox" value="" checked class="w-4 h-4 mr-2 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    5-10 peoples
                                                </label>
                                            </li>
                                            <li>
                                                <label class="flex items-center text-sm font-medium text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md px-1.5 py-1 w-full">
                                                    <input type="checkbox" value="" class="w-4 h-4 mr-2 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    10+ peoples
                                                </label>
                                            </li>
                                            <li>
                                                <label class="flex items-center text-sm font-medium text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md px-1.5 py-1 w-full">
                                                    <input type="checkbox" value="" class="w-4 h-4 mr-2 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    More than 10 peoples
                                                </label>
                                            </li>
                                        </ul>
                                        <a href="#" class="flex items-center text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline mt-4 ml-1.5">Apply to all projects</a>
                                    </div>
                                </div>
                                <div>
                                    <button 
                                        id="advertisersActionDropdownButton" 
                                        data-dropdown-toggle="advertisersActionDropdown" 
                                        type="button" 
                                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                        <i class="h-5 w-5 pt-1 mr-2 text-gray-900 fa-solid fa-cog"></i>
                                        {{ __deals('Bulk Actions') }}
                                    </button>
                                    <div 
                                        id="advertisersActionDropdown" 
                                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul 
                                            class="py-1 text-sm text-gray-700 dark:text-gray-200" 
                                            aria-labelledby="advertisersActionDropdownButton">
                                            <li>
                                                <a 
                                                    href="#" 
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    Pause
                                                </a>
                                            </li>
                                            <li>
                                                <a 
                                                    href="#" 
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    Take snapshot
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a 
                                                href="#" 
                                                class="block py-2 px-4 text-sm text-red-700 hover:text-red-700 hover:bg-red-100 dark:hover:bg-red-600 dark:text-red-200 dark:hover:text-white">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button 
                                        type="button" 
                                        class="w-full md:w-auto flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 sm:px-4 sm:py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        <i class="h-5 w-5 pt-1 mr-2 text-white fa-solid fa-plus"></i>
                                        {{ __deals('New') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-4 pb-3 flex flex-wrap">
                    <div class="hidden md:flex items-center text-sm font-medium text-gray-900 dark:text-white mr-4 mt-3">
                        Show only:
                    </div>
                    <div class="flex flex-wrap">
                        <div class="flex items-center mt-3 mr-4">
                            <input 
                                id="all-tasks" 
                                type="radio" 
                                value="" 
                                name="show-only" 
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label 
                                for="all-tasks" 
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                All
                            </label>
                        </div>
                        <div class="flex items-center mr-4 mt-3">
                            <input 
                                id="completed" 
                                type="radio" 
                                value="" 
                                name="show-only" 
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label 
                                for="completed" 
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Completed tasks
                            </label>
                        </div>
                        <div class="flex items-center mr-4 mt-3">
                            <input 
                                id="in-progress" 
                                type="radio"
                                value="" 
                                name="show-only" 
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label 
                                for="in-progress" 
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Tasks in progress
                            </label>
                        </div>
                        <div class="flex items-center mr-4 mt-3">
                            <input 
                                id="in-review" 
                                type="radio" 
                                value="" 
                                name="show-only" 
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label 
                                for="in-review" 
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Tasks in review
                            </label>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <header-table  v-model="selectAll" />
                        <tbody data-accordion="table-column">
                            <template 
                                v-for="(dealAdvertiser, x) in dealAdvertisers" 
                                :key="x">
                                <RowTable
                                    :advertiser="dealAdvertiser"
                                    :index="x"
                                    :visible="visibleRow === x"
                                    :selectedDealAdvertisers="selectedDealAdvertisers"
                                    @show="$emit('showDealAdvertiser', dealAdvertiser)"
                                    @edit="$emit('editDealAdvertiser', dealAdvertiser)"
                                    @delete="$emit('deleteDealAdvertiser', dealAdvertiser)"
                                    @toggle="setVisibleRow"
                                    @update:selectedDealAdvertisers="toggleSelected">
                                    <template #expanded="{ advertiser }">
                                        <RowDetails :advertiser="advertiser" />
                                    </template>
                                </RowTable>
                            </template>
                        </tbody>
                    </table>
                </div>
                <nav class="flex flex-wrap justify-between items-center p-4" aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-2 md:mb-0">
                        Showing 
                        <span class="font-semibold text-gray-900 dark:text-white">
                            {{ pagination.per_page * (pagination.current_page - 1) + 1 }}
                        </span>
                        -
                        <span class="font-semibold text-gray-900 dark:text-white">
                            {{ pagination.per_page * pagination.current_page }}
                        </span>
                        of
                        <span class="font-semibold text-gray-900 dark:text-white">
                            {{ pagination.total }}
                        </span>
                    </span>
                    <ul class="inline-flex items-stretch -space-x-px">
                        <li 
                            v-for="(link, i) in pagination.links" 
                            :key="i">
                            <button
                                :disabled="!link.url"
                                @click="goToPageFromLink(link.url)"
                                v-html="link.label"
                                :class="[
                                    'px-3 py-2 text-sm font-medium border',
                                    link.active
                                        ? 'z-10 text-blue-700 bg-blue-100 border-blue-300 dark:bg-blue-700 dark:text-white'
                                        : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
                                ]"></button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</template>

<script>
    import { debounce } from 'innoboxrr-js-libs/libs/utils'
    import { indexModel as indexDealAdvertiserModel } from '@dealsModels/deal-advertiser'
    import HeaderTable from '@dealsModels/deal-advertiser/components/deal-advertisers-table/HeaderTable.vue'
    import RowTable from '@dealsModels/deal-advertiser/components/deal-advertisers-table/RowTable.vue'
    import RowDetails from '@dealsModels/deal-advertiser/components/deal-advertisers-table/RowDetails.vue'

    export default {
        name: "DealAdvertisersTable",
        components: {
            HeaderTable,
            RowTable,
            RowDetails,
        },
        props: {
            defaultAdvertisers: {
                type: Array,
                required: false,
            },
        },
        emits: [
            'showDealAdvertiser',
            'editDealAdvertiser',
            'deleteDealAdvertiser',
            'selectedDealAdvertisers',
            'toggleDealAdvertiser',
        ],
        data() {
            return {
                visibleRow: null,
                globalQuery: this.$route.query.dealAdvertiserGlobalQuery || null,
                dealAdvertisers: this.defaultAdvertisers || [],

                // Massive operations
                selectedDealAdvertisers: [],
                selectAll: false,

                // Pagination
                pagination: {
                    current_page: 1,
                    last_page: 1,
                    per_page: 10,
                    total: 0,
                    links: [],
                }
            };
        },
        async mounted() {
            await this.fetchData();
        },
        watch: {
            globalQuery: {
                handler: debounce(function (val) {
                    const url = new URL(window.location.href)
                    if (val) {
                        url.searchParams.set('dealAdvertiserGlobalQuery', val)
                    } else {
                        url.searchParams.delete('dealAdvertiserGlobalQuery')
                    }
                    window.history.replaceState({}, '', url)

                    this.fetchDealAdvertisers();
                }, 500),
                immediate: false
            },
            selectAll(val) {
                if (val) {
                    this.selectedDealAdvertisers = this.dealAdvertisers.map(deal => deal.id)
                } else {
                    this.selectedDealAdvertisers = []
                }
            }
        },
        methods: {
            async fetchData() {
                if(this.dealAdvertisers.length === 0) {
                    await this.fetchDealAdvertisers();
                }
            },
            async fetchDealAdvertisers() {
                try {
                    const response = await indexDealAdvertiserModel({
                        paginate: 20,
                        page: this.pagination.current_page,
                        managed: true,
                        global: this.globalQuery,
                        load_agent_user: 1,
                        appends: [
                            // 'daily_spent_progress',
                        ]
                    });
                    this.dealAdvertisers = response.data || [];
                    const meta = response.meta || {};
                    this.pagination = {
                        current_page: meta.current_page,
                        last_page: meta.last_page,
                        per_page: meta.per_page,
                        total: meta.total,
                        links: meta.links,
                    };
                } catch (error) {
                    console.error("Error fetching dealAdvertisers:", error);
                }
            },
            goToPage(page) {
                if (page && page !== this.pagination.current_page) {
                    this.pagination.current_page = page;
                    this.fetchDealAdvertisers(page);
                }
            },
            goToPageFromLink(url) {
                if (!url) return
                const page = new URL(url).searchParams.get('page')
                if (page) {
                    this.goToPage(Number(page))
                }
            },
            toggleSelected(dealId) {
                if (this.selectedDealAdvertisers.includes(dealId)) {
                    this.selectedDealAdvertisers = this.selectedDealAdvertisers.filter(id => id !== dealId)
                } else {
                    this.selectedDealAdvertisers.push(dealId)
                }
            },
            setVisibleRow(row) {
                this.visibleRow = this.visibleRow === row ? null : row;
            },
        }
    };
</script>