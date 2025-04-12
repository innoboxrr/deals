<template>
    <div class="flex flex-col px-2 pt-2">
        <div class="w-full mx-auto">
            <div class="flex justify-between items-center mb-4">
                <div class="flex w-full px-2">
                    <LeadsChart />
                </div>
                <div class="flex w-full px-2">
                    <MetricsChart />
                </div>
            </div>
        </div>
        <div class="w-full mx-auto">
            <div class="flex justify-between items-center mb-4">
                <div class="flex w-full px-2">
                    <SpentChart />
                </div>
                <div class="flex w-full px-2">
                    <ProfitChart />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LeadsChart from './charts/LeadsChart.vue'
    import MetricsChart from './charts/MetricsChart.vue'
    import SpentChart from './charts/SpentChart.vue'
    import ProfitChart from './charts/ProfitChart.vue'
    
    export default {
        name: "DealsChart",
        components: {
            LeadsChart,
            MetricsChart,
            SpentChart,
            ProfitChart,
        },
    }
</script>