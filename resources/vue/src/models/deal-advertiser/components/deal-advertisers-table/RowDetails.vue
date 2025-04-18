<template>
    <deal-model-profile :deal="deal" />
</template>

<script>
    import DealModelProfile from '@dealsModels/deal/widgets/ModelProfile.vue'
    export default {
        name: 'RowDetails',
        components: {
            DealModelProfile,
        },
        props: {
            deal: {
                type: Object,
                required: true
            },
        },
    }
</script>