<template>
    <div class="">
        <DealAdvertiserAgreementTable 
            :external-filters="{
                deal_advertiser_id: advertiser.id,
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
    name: 'AgreementsTab',
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