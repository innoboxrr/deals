<template>
    <div v-flowbite>
        <deal-advertisers-table 
            class="my-4" 
            @createDealAdvertiser="createDealAdvertiser"
            @showDealAdvertiser="showDealAdvertiser"
            @editDealAdvertiser="editDealAdvertiser"
            @deleteDealAdvertiser="deleteDealAdvertiser"
            @selectedDealAdvertisers="selectedDealAdvertisers"
            @toggleDealAdvertiser="toggleDealAdvertiser"
        />
    </div>
</template>

<script>
    import DealAdvertisersTable from "@dealsModels/deal-advertiser/components/deal-advertisers-table";

    export default {
        name: "DashboardView",
        components: {
            DealAdvertisersTable,
        },
        methods: {
            createDealAdvertiser() {
                this.$router.push({
                    name: 'DealsAdvertisersManagerAdvertiserCreate',
                });
            },
            showDealAdvertiser(advertiser) {
                this.$router.push({
                    name: 'DealsAdvertisersManagerAdvertiserShow',
                    params: {
                        advertiserId: advertiser.id,
                    }
                })
            },
            editDealAdvertiser(advertiser) {
                this.$router.push({
                    name: 'DealsAdvertisersManagerAdvertiserEdit',
                    params: {
                        advertiserId: advertiser.id,
                    }
                })
            },
            deleteDealAdvertiser(advertiser) {
                console.log(advertiser);
            },
            selectedDealAdvertisers(selected) {
                console.log(advertiser);
            },
            toggleDealAdvertiser(advertiser) {
                console.log(advertiser);
            },
        },
    };
</script>
