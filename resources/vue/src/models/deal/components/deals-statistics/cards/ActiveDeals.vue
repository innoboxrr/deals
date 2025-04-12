<template>
    <statistics-card-alpha
        icon="fa-solid fa-tags"
        title="Deals activos"
        count="82.1k"
        percentage="8.8"
        percentageText="vs last month" />
</template>

<script>
    import StatisticsCardAlpha from '@dealsComponents/cards/StatisticsCardAlpha.vue';

    export default {
        components: {
            StatisticsCardAlpha,
        },
    };
</script>