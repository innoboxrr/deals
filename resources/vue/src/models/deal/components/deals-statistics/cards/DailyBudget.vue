<template>
    <statistics-card-alpha
        icon="fa-solid fa-dollar-sign"
        title="Presupuesto"
        count="1.2k"
        :percentage="19.8"
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