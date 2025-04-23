<template>
    <section class="mb-4">
        <div class="bg-white dark:bg-gray-800 relative border sm:rounded-lg">

            <agreements-filters 
                @createAgreement="$emit('createDealAdvertiserAgreement', {
                    type: 'createDealAdvertiserAgreement',
                    data: {}
                })"
                v-model="queryFilters" />
            
            <show-only-filters v-model="onlyFilter"  />

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <table-head v-model="selectAll" />
                    <tbody data-accordion="table-column">
                        <template 
                            v-for="(agreement, x) in agreements" 
                            :key="x">
                            <TableRow
                                :agreement="agreement"
                                :index="x"
                                :visible="visibleRow === x"
                                :selectedAgreements="selectedAgreements"
                                @show="$emit('showDealAdvertiserAgreement', { type: 'showDealAdvertiserAgreement', data: { agreement: agreement } })"
                                @edit="$emit('editDealAdvertiserAgreement', { type: 'editDealAdvertiserAgreement', data: { agreement: agreement } })"
                                @delete="$emit('deleteDealAdvertiserAgreement', { type: 'deleteDealAdvertiserAgreement', data: { agreement: agreement } })"
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
            createRoute: {
                type: Object,
                required: false,
            }
        },
        emits: [
            'showDealAdvertiser',
            'editDealAdvertiser',
            'deleteDealAdvertiser',
            
            'update:selectedAgreements',

            'createDealAdvertiserAgreement',
            'showDealAdvertiserAgreement',
            'editDealAdvertiserAgreement',
            'deleteDealAdvertiserAgreement',
        ],
        data() {
            return {
                visibleRow: null,
                agreements: this.defaultAgreements || [],

                // Massive operations
                selectedAgreements: [],
                selectAll: false,

                queryFilters: {
                    search: this.$route.query.agreementsGlobalQuery
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
            'queryFilters.search': {
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
                immediate: false,
                deep: true,
            },
            onlyFilter(newVal, oldVal) {
                console.log('onlyFilter', newVal, oldVal)
            },
            selectAll(val) {
                if (val) {
                    this.selectedAgreements = this.agreements.map(deal => deal.id)
                } else {
                    this.selectedAgreements = []
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
                        global: this.queryFilters.search,
                        load_advertiser: 1,  
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

                    console.log(this.agreements);
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
