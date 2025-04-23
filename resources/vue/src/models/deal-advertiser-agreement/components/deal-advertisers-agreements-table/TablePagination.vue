<template>
    <nav class="flex flex-wrap justify-between items-center p-4" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-2 md:mb-0">
            {{ __deals('Showing') }} 
            <span class="font-semibold text-gray-900 dark:text-white">
                {{ pagination.per_page * (pagination.current_page - 1) + 1 }}
            </span>
            -
            <span class="font-semibold text-gray-900 dark:text-white">
                {{ pagination.per_page * pagination.current_page }}
            </span>
            {{ __deals('of') }}
            <span class="font-semibold text-gray-900 dark:text-white">
                {{ pagination.total }}
            </span>
        </span>
        <ul class="inline-flex items-stretch -space-x-px">
            <li 
                v-for="(link, i) in pagination.links" 
                :key="i">
                <button
                    :disabled="!link.url"
                    @click="goToPageFromLink(link.url)"
                    v-html="link.label"
                    :class="[
                        'px-3 py-2 text-sm font-medium border',
                        link.active
                            ? 'z-10 text-blue-700 bg-blue-100 border-blue-300 dark:bg-blue-700 dark:text-white'
                            : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
                    ]"></button>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: 'TablePagination',
        props: {
            pagination: {
                type: Object,
                required: true,
            },
        },
        emits: [
            'goToPage'
        ],
        methods: {
            goToPageFromLink(url) {
                if (!url) return
                const page = new URL(url).searchParams.get('page')
                if (page) {
                    this.$emit('goToPage', Number(page))
                }
            },
        },
    }
</script>