<template>
    <div>
        <header-component :deals="deals" v-model="dealId" />
        <router-view :dealId="dealId" />
    </div>
</template>

<script>
    import { indexModel as indexDealModel, showModel as showDealModel } from '@dealsModels/deal'
    import HeaderComponent from '@dealsPages/deals-manager/components/partials/HeaderComponent.vue'

    export default {
        name: "dealDashboardSection",
        components: {
            HeaderComponent,
        },
        data() {
            return {
                dealId: 1,
                deal: null,
                deals: [
                    { id: 0, name: 'All' },
                    { id: 1, name: 'Deal 1' },
                    { id: 2, name: 'Deal 2' },
                    { id: 3, name: 'Deal 3' },
                ],
            };
        },
    };
</script>
