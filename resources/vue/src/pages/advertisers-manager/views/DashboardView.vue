<template>
    <div v-flowbite>
        <deal-advertisers-table class="my-4" />
    </div>
</template>

<script>
    import DealAdvertisersTable from "@dealsModels/deal-advertiser/components/deal-advertisers-table";

    export default {
        name: "DashboardView",
        components: {
            DealAdvertisersTable,
        },
    };
</script>
