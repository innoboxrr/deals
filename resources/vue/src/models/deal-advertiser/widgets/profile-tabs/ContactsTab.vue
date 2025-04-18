<template>
    <div class="p-8 space-y-6">
        <!-- Contacts Section -->
        <section class="space-y-4">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                Contacts
            </h2>
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6">
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li
                        v-for="(c, i) in contacts"
                        :key="i"
                        class="flex justify-between items-center py-5 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                    >
                        <div>
                            <p class="text-base font-semibold text-gray-900 dark:text-gray-100">
                                {{ c.name }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ c.position }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{ c.email }}<span v-if="c.phone"> • {{ c.phone }}</span>
                            </p>
                        </div>
                        <a
                            :href="`mailto:${c.email}`"
                            class="inline-flex items-center text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline"
                        >
                            <i class="fa-solid fa-envelope mr-1 mt-1 "></i>
                            Email
                        </a>
                    </li>
                    <li
                        v-if="!contacts.length"
                        class="py-5 text-center text-sm text-gray-500 dark:text-gray-400"
                    >
                        No contacts available.
                    </li>
                </ul>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: 'ContactsSection',
    props: {
        advertiser: {
            type: Object,
            required: true
        }
    },
    computed: {
        contacts() {
            try {
                return JSON.parse(this.advertiser.payload.contacts);
            } catch {
                return [];
            }
        }
    }
};
</script>

<style scoped>
/* No shadows; clear, spacious layout */
</style>
