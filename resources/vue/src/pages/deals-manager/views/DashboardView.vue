<template>
    <div>
        <deals-statistics />
        <deals-chart />
        <deals-table 
            @showDeal="showDeal" 
            @editDeal="editDeal"
            @deleteDeal="deleteDeal" />
    </div>
</template>

<script>
    import { deleteModel as deleteDealModel } from '@dealsModels/deal'
    import { useDealsManagerStore } from '@dealsPages/deals-manager/store/dealsManagerStore.js'
    import HeaderComponent from '@dealsPages/deals-manager/components/partials/HeaderComponent.vue'
    import DealsTable from '@dealsModels/deal/components/deals-table'
    import DealsChart from '@dealsModels/deal/components/deals-chart/DealsChart.vue'
    import DealsStatistics from '@dealsModels/deal/components/deals-statistics'

    export default {
        name: "dealDashboardSection",
        components: {
            HeaderComponent,
            DealsTable,
            DealsChart,
            DealsStatistics,
        },
        setup() {
            const dealsManagerStore = useDealsManagerStore()
            return {
                dealsManagerStore,
            }
        },
        mounted() {
            this.dealsManagerStore.setHeaderTitle(this.__deals('Deals Manager'));
        },
        methods: {
            showDeal(deal) {
                console.log('hi')
                this.$router.push({ name: 'DealsManagerDealDetails', params: { dealId: deal.id } })   
            },
            editDeal(deal) {
                this.$router.push({ name: 'DealsManagerDealEdit', params: { dealId: deal.id } })
            },
            async deleteDeal(deal) {
                await deleteDealModel(deal)
            },
        },
    };
</script>
