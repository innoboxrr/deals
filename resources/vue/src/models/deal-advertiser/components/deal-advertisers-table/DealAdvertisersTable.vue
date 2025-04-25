<template>
    <section v-flowbite class="mb-4">
        <div class="px-4 mx-auto">
            <div class="bg-white dark:bg-gray-800 relative border sm:rounded-lg">
                <advertisers-filters 
                    @eventHandler="$emit('eventHandler', $event);"
                    :selected-advertisers="selectedAdvertisers"
                    v-model="queryFilters" />
                <show-only-filters 
                    v-model="onlyFilter"  />
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <TableHead  v-model="selectAll" />
                        <tbody data-accordion="table-column">
                            <template 
                                v-for="(advertiser, x) in advertisers" 
                                :key="x">
                                <TableRow
                                    :advertiser="advertiser"
                                    :index="x"
                                    :visible="visibleRow === x"
                                    :selectedAdvertisers="selectedAdvertisers"
                                    @show="$emit('eventHandler', { 
                                        type: 'showAdvertiser', 
                                        data: { 
                                            advertiserId: advertiser.id 
                                        }
                                    })"
                                    @edit="$emit('eventHandler', { 
                                        type: 'editAdvertiser', 
                                        data: { 
                                            advertiserId: advertiser.id 
                                        }
                                    })"
                                    @agreements="$emit('eventHandler', { 
                                        type: 'showAdvertiserAgreements', 
                                        data: { 
                                            advertiserId: advertiser.id 
                                        }
                                    })"
                                    @delete="$emit('eventHandler', { 
                                        type: 'deleteAdvertiser', 
                                        data: { 
                                            advertiserId: advertiser.id 
                                        }, 
                                        callback: fetchAdvertisers 
                                    })"
                                    @toggle="setVisibleRow"
                                    @update:selectedAdvertisers="toggleSelected">
                                    <template #expanded="{ advertiser }">
                                        <RowDetails 
                                            :advertiser="advertiser"
                                            @eventHandler="$emit('eventHandler', $event)" />
                                    </template>
                                </TableRow>
                            </template>
                        </tbody>
                    </table>
                </div>
                <table-pagination :pagination="pagination" @goToPage="goToPage" />
            </div>
        </div>
    </section>
</template>

<script>
    import { debounce } from 'innoboxrr-js-libs/libs/utils'
    import { indexModel as indexAdvertiserModel } from '@dealsModels/deal-advertiser'
    import AdvertisersFilters from './AdvertisersFilters.vue';
    import ShowOnlyFilters from './ShowOnlyFilters.vue';
    import TableRow from './TableRow.vue';
    import TableHead from './TableHead.vue';
    import TablePagination from './TablePagination.vue';
    import RowDetails from './RowDetails.vue';

    export default {
        name: "DealAdvertisersTable",
        components: {
            AdvertisersFilters,
            ShowOnlyFilters,
            TableRow,
            TableHead,
            TablePagination,
            RowDetails,
        },
        props: {
            defaultAdvertisers: {
                type: Array,
                required: false,
            },
        },
        emits: [
            'eventHandler',
        ],
        data() {
            return {
                visibleRow: null,
                advertisers: this.defaultAdvertisers || [],

                // Massive operations
                selectedAdvertisers: [],
                selectAll: false,

                // Filters
                queryFilters: {
                    search: this.$route.query.advertisersGlobalQuery
                },
                onlyFilter: null,

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
            queryFilters: {
                handler: debounce(function (val) {
                    this.fetchAdvertisers();
                }, 500),
                deep: true,
            },
            'queryFilters.search': {
                handler: debounce(function (val) {
                    const url = new URL(window.location.href)
                    if (val) {
                        url.searchParams.set('advertiserGlobalQuery', val)
                    } else {
                        url.searchParams.delete('advertiserGlobalQuery')
                    }
                    window.history.replaceState({}, '', url)
                }, 500),
                immediate: false
            },
            onlyFilter(newVal, oldVal) {
                if (newVal !== oldVal) {
                    this.fetchAdvertisers();
                }
            },
            selectAll(val) {
                if (val) {
                    this.selectedAdvertisers = this.advertisers.map(advertiser => advertiser.id);
                } else {
                    this.selectedAdvertisers = []
                }
            },
        },
        methods: {
            async fetchData() {
                if(this.advertisers.length === 0) {
                    await this.fetchAdvertisers();
                }
            },
            async fetchAdvertisers() {
                try {
                    const response = await indexAdvertiserModel({
                        paginate: 20,
                        page: this.pagination.current_page,
                        managed: true,
                        global: this.queryFilters.search,
                        load_agent_user: 1,
                        status: this.onlyFilter,
                        statuses: this.queryFilters.status,
                        agreements_count: this.queryFilters.agreements_count,
                        appends: [
                            // 'daily_spent_progress',
                        ]
                    });
                    this.advertisers = response.data || [];
                    const meta = response.meta || {};
                    this.pagination = {
                        current_page: meta.current_page,
                        last_page: meta.last_page,
                        per_page: meta.per_page,
                        total: meta.total,
                        links: meta.links,
                    };
                } catch (error) {
                    console.error("Error fetching advertisers:", error);
                }
            },
            toggleSelected(advertiserId) {
                const exists = this.selectedAdvertisers.includes(advertiserId);

                this.selectedAdvertisers = exists
                    ? [...this.selectedAdvertisers.filter(id => id !== advertiserId)]
                    : [...this.selectedAdvertisers, advertiserId];
            },
            setVisibleRow(row) {
                this.visibleRow = this.visibleRow === row ? null : row;
            },
            goToPage(page) {
                if (page && page !== this.pagination.current_page) {
                    this.pagination.current_page = page;
                    this.fetchAdvertisers();
                }
            },
        }
    };
</script>