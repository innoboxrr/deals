<template>
    <div class="">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Agreements</h2>
        <DealAdvertiserAgreementTable 
            :external-filters="{
                deal_advertiser_id: advertiser.id,
            }" />
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
        }
    },
    methods: {
        
    }
};
</script>

<style scoped>
/* Shadows removed; spacing increased for clarity */
</style>
