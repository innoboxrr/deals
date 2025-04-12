<template>
    <statistics-card-alpha
        icon="fa-solid fa-user-check"
        title="Leads generados"
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