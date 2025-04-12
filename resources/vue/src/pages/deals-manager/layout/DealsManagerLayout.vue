<template>
    <div>
        <header-component />
        <router-view />
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
    };
</script>
