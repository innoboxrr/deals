<template>
    <statistics-card-alpha
        icon="fa-solid fa-users"
        title="Advertisers activos"
        count="150"
        :percentage="-8.8"
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