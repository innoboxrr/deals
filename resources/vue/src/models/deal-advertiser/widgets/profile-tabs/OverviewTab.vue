<template>
    <div class="p-8 space-y-8">
        <!-- Section Title -->
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
            Company & Compliance
        </h2>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <!-- Company Info Card -->
            <div class="bg-white dark:bg-gray-700 rounded-lg p-8">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-100 mb-4">
                    Company Info
                </h3>
                <dl class="space-y-4">
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Company Name
                        </dt>
                        <dd class="text-sm text-gray-900 dark:text-gray-100">
                            {{ advertiser.payload?.company?.name || '-' }}
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            CFDI Use
                        </dt>
                        <dd class="text-sm text-gray-900 dark:text-gray-100">
                            {{ advertiser.payload?.company?.cfdi_use || '-' }}
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Tax Type
                        </dt>
                        <dd class="text-sm text-gray-900 dark:text-gray-100">
                            {{ advertiser.payload?.company?.tax_type || '-' }}
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Tax Number
                        </dt>
                        <dd class="text-sm text-gray-900 dark:text-gray-100">
                            {{ advertiser.payload?.company?.tax_number || '-' }}
                        </dd>
                    </div>
                </dl>
            </div>

            <!-- Compliance Card -->
            <div class="bg-white dark:bg-gray-700 rounded-lg p-8">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-100 mb-4">
                    Compliance
                </h3>
                <dl class="space-y-4">
                    <div class="flex justify-between items-center">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Status
                        </dt>
                        <dd>
                            <span
                                v-if="advertiser.payload?.compliance?.verified === '1'"
                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-green-700 bg-green-100 rounded-full dark:bg-green-800 dark:text-green-200">
                                Verified
                            </span>
                            <span
                                v-else
                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-700 bg-red-100 rounded-full dark:bg-red-800 dark:text-red-200">
                                Unverified
                            </span>
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Verified On
                        </dt>
                        <dd class="text-sm text-gray-900 dark:text-gray-100">
                            {{ advertiser.payload?.compliance?.verification_date
                                ? formatDate(advertiser.payload.compliance.verification_date)
                                : '-' }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</template>

<script>
import dayjs from 'dayjs';

export default {
    name: 'OverviewTab',
    props: {
        advertiser: {
            type: Object,
            required: true
        }
    },
    methods: {
        formatDate(date, fmt = 'YYYY-MM-DD') {
            return dayjs(date).format(fmt);
        }
    }
};
</script>

<style scoped>
/* Shadows removed; spacing increased for clarity */
</style>
