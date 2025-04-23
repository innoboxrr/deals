<template>
    <div class="p-4">
        <DealAdvertiserAgreementTable 
            :external-filters="{
                deal_advertiser_id: this.$route.params.advertiserId,
            }" 
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
        emits: [
            'eventHandler'
        ],
    };
</script>