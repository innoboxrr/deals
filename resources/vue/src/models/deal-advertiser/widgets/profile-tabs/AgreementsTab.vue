<template>
    <div v-if="advertiser">
        <DealAdvertiserAgreementTable 
            :external-filters="{
                deal_advertiser_id: advertiser.id,
            }" 
            @eventHandler="$emit('eventHandler', $event)" />
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
    },
    emits: [
        'eventHandler'
    ],
};
</script>