<template>
    <div v-if="advertiserId" class="p-4">
        <DealAdvertiserAgreementTable 
            :external-filters="{
                deal_advertiser_id: advertiserId,
            }" 
            @eventHandler="handleEvent" />
    </div>
</template>

<script>
    import { useAdvertisersManagerStore } from '@dealsPages/advertisers-manager/store/advertisersManagerStore.js'
    import DealAdvertiserAgreementTable from '@dealsModels/deal-advertiser-agreement/components/deal-advertisers-agreements-table/DealAdvertisersAgreementsTable.vue';
    import  { eventHandler } from '@dealsPages/advertisers-manager/js/event-handler.js'

    export default {
        name: 'IndexView',
        components: {
            DealAdvertiserAgreementTable
        },
        emits: [
            'eventHandler'
        ],
        setup() {
            const advertisersManagerStore = useAdvertisersManagerStore()
            return {
                advertisersManagerStore,
            }
        },
        mounted() {
            this.advertisersManagerStore.setHeaderTitle(this.__deals('Deal Advertiser Agreements'));
            this.advertisersManagerStore.setDealAdvertiserId(this.$route.params.advertiserId);
            this.advertiserId = this.advertisersManagerStore.dealAdvertiserId;
        },
        unmounted() {
            this.advertisersManagerStore.setDealAdvertiserId(null);
        },
        data() {
            return {
                advertiserId: undefined,
            };
        },
        methods: {
            handleEvent(event) {
                eventHandler(this, event.type, event.data, event.callback);
            },
        }
    };
</script>