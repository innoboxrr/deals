<template>
    <div class="rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800 md:p-6">
        <i class="mb-2 h-6 w-6 text-gray-400" :class="icon"></i>
        <h3 class="text-gray-500 dark:text-gray-400">
            {{ title }}
        </h3>
        <span class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ count }}
        </span>
        <p class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
            <span 
                class="mr-1.5 flex items-center text-sm font-medium sm:text-base"
                :class="percentage > 0 ? 'text-green-500 dark:text-green-400' : 'text-red-600 dark:text-red-500'">
                <i 
                    class="h-3 w-3 mr-2"
                    :class="percentage > 0 ? 'text-green-500 fa-solid fa-arrow-up' : 'text-red-500 fa-solid fa-arrow-down'"
                    ></i> 
                {{ percentage }}%
            </span>
            {{ percentageText }}
        </p>
    </div>
</template>

<script>
    export default {
        props: {
            title: {
                type: String,
                default: 'Active deals',
            },
            icon: {
                type: String,
                default: 'fa-solid fa-tags',
            },
            count: {
                type: Number,
                default: 0,
            },
            percentage: {
                type: Number,
                default: 0,
            },
            percentageText: {
                type: String,
                default: 'vs last month',
            },
        }
    }
</script>