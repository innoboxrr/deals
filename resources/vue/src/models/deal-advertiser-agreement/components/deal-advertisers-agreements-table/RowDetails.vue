<template>
    <div class="m-4">
        <DealAgreementModelProfile :deal-advertiser-agreement="agreement" />
    </div>
</template>

<script>
    import DealAgreementModelProfile from '@dealsModels/deal-advertiser-agreement/widgets/ModelProfile.vue'
    export default {
        name: 'RowDetails',
        components: {
            DealAgreementModelProfile,
        },
        props: {
            agreement: {
                type: Object,
                required: true
            },
        },
    }
</script>