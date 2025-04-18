<template>
    <div v-if="dataLoaded" class="bg-white dark:bg-gray-800 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 items-center">
            <div class="md:col-span-1 flex flex-col items-center">
				<img
					:src="localAdvertiser.agent.user.avatar_url"
					alt="Avatar"
					class="w-20 h-20 rounded-full object-cover ring-4 ring-blue-500" />
				<h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mt-4 text-center">
					{{ localAdvertiser.agent.user.name }}
				</h1>
			</div>
            <div
                v-for="(kpi, idx) in kpis"
                :key="idx"
                class="flex flex-col items-center bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                <i :class="kpi.icon + ' text-2xl mb-2 text-blue-500 dark:text-blue-400'"></i>
                <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ kpi.value }}
                </span>
                <span class="text-xs text-gray-500 dark:text-gray-400">
                    {{ kpi.label }}
                </span>
            </div>
        </div>
        <div>
            <nav class="flex space-x-4 border-b border-gray-200 dark:border-gray-700 mb-6">
                <button
                    v-for="tab in tabs"
                    :key="tab.id"
                    @click="activeTab = tab.id"
                    :class="{
                        'border-b-2 border-blue-500 text-blue-600': activeTab === tab.id,
                        'text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200': activeTab !== tab.id
                    }"
                    class="pb-2 px-1 text-sm font-medium">
                    {{ tab.name }}
                </button>
            </nav>
            <div>
				<component
                    :is="activeTabComponent"
                    :advertiser="localAdvertiser" />
            </div>
        </div>
    </div>
</template>

<script>
    import { showModel } from '@dealsModels/deal-advertiser'
    import OverviewTab from './profile-tabs/OverviewTab.vue'
    import ContactsTab from './profile-tabs/ContactsTab.vue'
    import DetailsTab from './profile-tabs/DetailsTab.vue'
    import AgreementsTab from './profile-tabs/AgreementsTab.vue'

    export default {
        name: 'AdvertiserProfile',
        components: {
            OverviewTab,
            ContactsTab,
            DetailsTab,
            AgreementsTab
        },
        props: {
            dealAdvertiser: {
                type: Object,
                required: false
            },
            dealAdvertiserId: {
                type: [Number, String],
                required: false
            },
            defaultAgent: {
                type: Object,
                default: null
            }
        },
        data() {
            return {
                dataLoaded: false,
                localAdvertiser: this.dealAdvertiser || null,
                activeTab: 'overview',
                tabs: [
                    { id: 'overview',   name: 'Overview',   component: 'OverviewTab'   },
                    { id: 'contacts',   name: 'Contacts',   component: 'ContactsTab'   },
                    { id: 'details',    name: 'Details',    component: 'DetailsTab'    },
                    { id: 'agreements', name: 'Agreements', component: 'AgreementsTab' }
                ]
            }
        },
        async mounted() {
            if (!this.localAdvertiser && this.dealAdvertiserId) {
                const res = await showModel(this.dealAdvertiserId, ['agent.user'])
                this.localAdvertiser = res
            }
            this.dataLoaded = true
        },
        computed: {
            activeTabComponent() {
                const tab = this.tabs.find(t => t.id === this.activeTab)
                return tab ? tab.component : null
            },
            kpis() {
                const a = this.localAdvertiser.payload?.activity || {}
                return [
                    {
                        label: 'Total Spent',
                        value: a.total_spent != null ? `$${a.total_spent}` : '-',
                        icon: 'fa-solid fa-dollar-sign'
                    },
                    {
                        label: 'Active campaigns',
                        value: a.campaigns_count ?? '-',
                        icon: 'fa-solid fa-chart-line'
                    },
                    {
                        label: 'Last Active',
                        value: a.last_active ? this.formatDate(a.last_active, 'DD MMM YY') : '-',
                        icon: 'fa-solid fa-clock'
                    }
                ]
            }
        },
    }
</script>
