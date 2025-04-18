<template>
    <div class="p-8 space-y-8">
        <!-- Details Section -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Web & Social -->
            <div class="bg-white dark:bg-gray-700 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    Web &amp; Social
                </h3>
                <ul class="space-y-3">
                    <li
                        v-for="(url, key) in (advertiser.payload?.web || {})"
                        :key="key"
                        v-if="url"
                        class="flex items-center space-x-3"
                    >
                        <i :class="iconFor(key) + ' text-gray-500 dark:text-gray-400'" />
                        <a
                            :href="url"
                            target="_blank"
                            class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline"
                        >
                            {{ capitalize(key) }}
                        </a>
                    </li>
                    <li
                        v-if="!hasWebLinks"
                        class="text-sm text-gray-500 dark:text-gray-400"
                    >
                        No links.
                    </li>
                </ul>
            </div>

            <!-- Address -->
            <div class="bg-white dark:bg-gray-700 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    Address
                </h3>
                <p class="text-sm text-gray-900 dark:text-gray-100 mb-2">
                    {{ advertiser.payload?.address?.address || '-' }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ advertiser.payload?.address?.city || '' }},
                    {{ advertiser.payload?.address?.state || '' }}
                    {{ advertiser.payload?.address?.zip || '' }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    {{ advertiser.payload?.address?.country || '' }}
                </p>
            </div>

            <!-- Bank -->
            <div class="bg-white dark:bg-gray-700 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    Bank
                </h3>
                <p class="text-sm text-gray-900 dark:text-gray-100 mb-1">
                    IBAN: {{ advertiser.payload?.bank?.bank_iban || '-' }}
                </p>
                <p class="text-sm text-gray-900 dark:text-gray-100 mb-1">
                    Account: {{ advertiser.payload?.bank?.bank_account || '-' }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                    {{ advertiser.payload?.bank?.bank_name || '-' }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    SWIFT: {{ advertiser.payload?.bank?.bank_swift || '-' }}
                </p>
            </div>

            <!-- Billing Terms -->
            <div class="bg-white dark:bg-gray-700 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    Billing Terms
                </h3>
                <p class="text-sm text-gray-900 dark:text-gray-100">
                    {{ advertiser.payload?.billing?.payment_terms || '-' }}
                </p>
            </div>

            <!-- Contracts -->
            <div class="bg-white dark:bg-gray-700 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    Contracts
                </h3>
                <ul class="space-y-2">
                    <li v-for="(c, i) in contracts" :key="i">
                        <a
                            :href="c.url"
                            target="_blank"
                            class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline"
                        >
                            {{ c.number }}
                        </a>
                        <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">
                            ({{ formatDate(c.start_date) }} – {{ formatDate(c.end_date) }})
                        </span>
                    </li>
                    <li
                        v-if="!contracts.length"
                        class="text-sm text-gray-500 dark:text-gray-400"
                    >
                        No contracts.
                    </li>
                </ul>
            </div>

            <!-- Last Invoice -->
            <div class="bg-white dark:bg-gray-700 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    Last Invoice
                </h3>
                <p class="text-sm text-gray-900 dark:text-gray-100 mb-1">
                    #{{ advertiser.payload?.last_invoice?.number || '-' }}
                </p>
                <p class="text-sm text-gray-900 dark:text-gray-100 mb-1">
                    Amount: {{ advertiser.payload?.last_invoice?.amount ? `$${advertiser.payload.last_invoice.amount}` : '-' }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Date: {{ advertiser.payload?.last_invoice?.date ? formatDate(advertiser.payload.last_invoice.date) : '-' }}
                </p>
            </div>
        </section>
    </div>
</template>

<script>
import dayjs from 'dayjs';

export default {
    name: 'DetailsSection',
    props: {
        advertiser: {
            type: Object,
            required: true
        }
    },
    computed: {
        contracts() {
            try {
                return JSON.parse(this.advertiser.payload.contracts);
            } catch {
                return [];
            }
        },
        hasWebLinks() {
            return Object.values(this.advertiser.payload?.web || {}).some(u => !!u);
        }
    },
    methods: {
        capitalize(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        },
        iconFor(key) {
            const icons = {
                website: 'fa-solid fa-globe',
                facebook: 'fa-brands fa-facebook',
                twitter: 'fa-brands fa-twitter',
                instagram: 'fa-brands fa-instagram',
                linkedin: 'fa-brands fa-linkedin',
                youtube: 'fa-brands fa-youtube',
                tiktok: 'fa-brands fa-tiktok',
                discord: 'fa-brands fa-discord',
                telegram: 'fa-brands fa-telegram',
                whatsapp: 'fa-brands fa-whatsapp',
                pinterest: 'fa-brands fa-pinterest',
                snapchat: 'fa-brands fa-snapchat'
            };
            return icons[key] || 'fa-solid fa-link';
        },
        formatDate(date, fmt = 'YYYY-MM-DD') {
            return dayjs(date).format(fmt);
        }
    }
};
</script>

<style scoped>
/* Clean layout, no shadows, consistent spacing */
</style>