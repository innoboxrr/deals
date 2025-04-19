<template>
    <section class="mb-4">
        <div class="px-4 mx-auto">
            <div class="bg-white dark:bg-gray-800 relative border sm:rounded-lg">

                <agreements-filters 
                    v-model="globalQuery"
                    :create-route="{
                        name: 'DealsAdvertisersManagerAgreementCreate',
                        params: {
                            advertiserId: externalFilters.deal_advertiser_id,
                        }
                    }"
                    @resetFilters="$emit('resetFilters')" 
                    @createNew="$emit('createNew')"
                    @configAction="$emit('configAction', $event)"
                    @resetConfig="$emit('resetConfig')" />
                
                <show-only-filters v-model="onlyFilter"  />

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <table-head />
                        <tbody data-accordion="table-column">
                            <template 
                                v-for="(agreement, x) in agreements" 
                                :key="x">
                                <TableRow
                                    :agreement="agreement"
                                    :index="x"
                                    :visible="visibleRow === x"
                                    :selectedAgreements="selectedAgreements"
                                    @show="$emit('showDealAdvertiser', agreement)"
                                    @edit="$emit('editDealAdvertiser', agreement)"
                                    @delete="$emit('deleteDealAdvertiser', agreement)"
                                    @toggle="setVisibleRow"
                                    @update:selectedAgreements="toggleSelected">
                                    <template #expanded="{ agreement }">
                                        <RowDetails :agreement="agreement" />
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
    import { indexModel as indexAgreementModel } from '@dealsModels/deal-advertiser-agreement'
    import AgreementsFilters from './AgreementsFilters.vue';
    import ShowOnlyFilters from './ShowOnlyFilters.vue';
    import TableRow from './TableRow.vue';
    import TableHead from './TableHead.vue';
    import TablePagination from './TablePagination.vue';
    import RowDetails from './RowDetails.vue';

    export default {
        name: 'DealAdvertisersAgreementsTable',
        components: {
            AgreementsFilters,
            ShowOnlyFilters,
            TableRow,
            TableHead,
            TablePagination,
            RowDetails,
        },
        props: {
            externalFilters: {
                type: Object,
                required: false,
                default: () => ({}),
            },
            defaultAgreements: {
                type: Array,
                required: false,
            },
        },
        emits: [
            'showDealAdvertiser',
            'editDealAdvertiser',
            'deleteDealAdvertiser',
            'update:selectedAgreements',
        ],
        data() {
            return {
                visibleRow: null,
                globalQuery: this.$route.query.agreementsGlobalQuery || null,
                agreements: this.defaultAgreements || [],

                // Massive operations
                selectedAgreements: [],
                selectAll: false,

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
            globalQuery: {
                handler: debounce(function (val) {
                    const url = new URL(window.location.href)
                    if (val) {
                        url.searchParams.set('agreementsGlobalQuery', val)
                    } else {
                        url.searchParams.delete('agreementsGlobalQuery')
                    }
                    window.history.replaceState({}, '', url)

                    this.fetchAgreements();
                }, 500),
                immediate: false
            },
            onlyFilter(newVal, oldVal) {
                console.log('onlyFilter', newVal, oldVal)
            },
            selectAll(val) {
                if (val) {
                    this.selectedDealAdvertisers = this.agreements.map(deal => deal.id)
                } else {
                    this.selectedDealAdvertisers = []
                }
            }
        },
        methods: {
            async fetchData() {
                if(this.agreements.length === 0) {
                    await this.fetchAgreements();
                }
            },
            async fetchAgreements() {
                try {
                    const response = await indexAgreementModel({
                        paginate: 20,
                        page: this.pagination.current_page,
                        managed: true,
                        global: this.globalQuery,
                        load_advertiser: true,  
                        appends: [
                            // 'daily_spent_progress',
                        ]
                    });
                    this.agreements = response.data || [];
                    const meta = response.meta || {};
                    this.pagination = {
                        current_page: meta.current_page,
                        last_page: meta.last_page,
                        per_page: meta.per_page,
                        total: meta.total,
                        links: meta.links,
                    };
                } catch (error) {
                    console.error("Error fetching agreements:", error);
                }
            },
            toggleSelected(agreementId) {
                if (this.selectedAgreements.includes(agreementId)) {
                    this.selectedAgreements = this.selectedAgreements.filter(id => id !== agreementId)
                } else {
                    this.selectedAgreements.push(agreementId)
                }
            },
            setVisibleRow(row) {
                this.visibleRow = this.visibleRow === row ? null : row;
            },
            goToPage(page) {
                if (page && page !== this.pagination.current_page) {
                    this.pagination.current_page = page;
                    this.fetchAgreements(page);
                }
            },
        },
    };
</script>
