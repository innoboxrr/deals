<template>
    <div v-flowbite>
        <DealAdvertisersTable
            class="my-4" 
            @eventHandler="handleEvent"
        />
    </div>
</template>

<script>
    import { useAdvertisersManagerStore } from '@dealsPages/advertisers-manager/store/advertisersManagerStore.js'
    import DealAdvertisersTable from "@dealsModels/deal-advertiser/components/deal-advertisers-table";
    import  { eventHandler } from '@dealsPages/advertisers-manager/js/event-handler.js'

    export default {
        name: "DashboardView",
        components: {
            DealAdvertisersTable,
        },
        setup() {
            const advertisersManagerStore = useAdvertisersManagerStore()
            return {
                advertisersManagerStore,
            }
        },
        mounted() {
            this.advertisersManagerStore.setHeaderTitle(this.__deals('Deal Advertiser Dashboard'));
            this.advertisersManagerStore.resetProps();
        },
        methods: {
            handleEvent(event) {
                eventHandler(this, event.type, event.data, event.callback);
            },
        },
    };
</script>
