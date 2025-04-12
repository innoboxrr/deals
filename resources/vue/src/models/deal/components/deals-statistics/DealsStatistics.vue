<template>
    <div class="px-4 mt-4 mb-2 grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg :grid-cols-4 xl:grid-cols-5">
        <active-deals />
        <active-advertisers />
        <leads-generated />
        <daily-budget />
        <budget-spent />
    </div>
</template>

<script>
    import ActiveDeals from './cards/ActiveDeals.vue';
    import ActiveAdvertisers from './cards/ActiveAdvertisers.vue';
    import LeadsGenerated from './cards/LeadsGenerated.vue';
    import DailyBudget from './cards/DailyBudget.vue';
    import BudgetSpent from './cards/BudgetSpent.vue';
    export default {
        components: {
            ActiveDeals,
            ActiveAdvertisers,
            LeadsGenerated,
            DailyBudget,
            BudgetSpent,
        },
    };
</script>