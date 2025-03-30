<template>
    <aside v-if="dataLoaded" class="hidden lg:block w-80 h-full overflow-y-auto bg-gray-50 border-l border-gray-200">
        <header class="flex items-center justify-between border-b border-gray-200 px-4 py-4 sm:px-6 sm:py-6 lg:px-8">
            <h2 class="text-base font-semibold text-gray-900">
                {{ __deals('Activity') }}
            </h2>
            <a href="#" class="text-sm font-semibold text-blue-600">
                {{ __deals('More') }}
                <span class="text-gray-400" aria-hidden="true">&rarr;</span>
            </a>
        </header>
        <ul role="list" class="divide-y divide-gray-200">
            <li v-for="item in activityItems" :key="item.dateTime" class="px-4 py-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-x-3">
                    <img :src="item.user.imageUrl" alt="" class="h-6 w-6 flex-none rounded-full bg-gray-100" />
                    <h3 class="flex-auto truncate text-sm font-semibold text-gray-900">
                        {{ item.user.name }}
                    </h3>
                    <time :datetime="item.dateTime" class="flex-none text-xs text-gray-600">
                        {{ item.date }}
                    </time>
                </div>
                <p class="mt-3 truncate text-sm text-gray-600">
                    {{ item.action }}
                </p>
            </li>
        </ul>
    </aside>
</template>

<script>
    import { useGlobalStore } from '@dealsStore/globalStore.js'

    export default {
        name: 'ActivityFeed',
        data() {
            return {
                dataLoaded: false,
                globalStore: undefined,
            }
        },
        async mounted() {
            this.globalStore = await useGlobalStore();
            this.dataLoaded = true;
        },
        computed: {
            activityItems() { 
                return this.globalStore.activityItems || []
            },
        }
    }
</script>
