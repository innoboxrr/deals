<template>
    <div class="m-4">
        <deal-advertiser-model-profile 
            @eventHandler="$emit('eventHandler', $event)"
            :deal-advertiser="advertiser" />
    </div>
</template>

<script>
    import DealAdvertiserModelProfile from '@dealsModels/deal-advertiser/widgets/ModelProfile.vue'
    export default {
        name: 'RowDetails',
        components: {
            DealAdvertiserModelProfile,
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
    }
</script>