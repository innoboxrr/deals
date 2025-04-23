<template>
    <div class="p-4">
        <DealAdvertiserAgreementTable 
            :external-filters="{
                deal_advertiser_id: this.$route.params.advertiserId,
            }" 
            @showDealAdvertiserAgreement="$emit('eventHandler', $event)"
            @editDealAdvertiserAgreement="$emit('eventHandler', $event)"
            @deleteDealAdvertiserAgreement="$emit('eventHandler', $event)"
            @createDealAdvertiserAgreement="$emit('eventHandler', $event)" />
    </div>
</template>


<script>
    import DealAdvertiserAgreementTable from '@dealsModels/deal-advertiser-agreement/components/deal-advertisers-agreements-table/DealAdvertisersAgreementsTable.vue';

    export default {
        name: 'IndexView',
        components: {
            DealAdvertiserAgreementTable
        },
        props: {
            advertiser: {
                type: Object,
                required: true
            },
            createRoute: {
                type: Object,
                required: true
            }
        },
        mounted() {
            this.advertisersManagerStore.setHeaderTitle(this.__deals('Edit agreement'));
            this.advertisersManagerStore.setDealAdvertiserId(this.$route.params.advertiserId);
        },
        unmounted() {
            this.advertisersManagerStore.setDealAdvertiserId(null);
        },
        emits: [
            'eventHandler'
        ],
    };
</script>