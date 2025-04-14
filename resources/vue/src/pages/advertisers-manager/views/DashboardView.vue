<template>
    <div v-flowbite>
        <header-component />
        <deal-advertisers-table />
    </div>
</template>

<script>
    import HeaderComponent from "@dealsPages/advertisers-manager/components/partials/HeaderComponent.vue";
    import DealAdvertisersTable from "@dealsModels/deal-advertiser/components/deal-advertisers-table";

    export default {
        name: "DashboardView",
        components: {
            HeaderComponent,
            DealAdvertisersTable,
        },
    };
</script>
