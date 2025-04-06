<template>
    <div class="min-h-screen">
        <nav class="mb-4 pt-4 px-4" aria-label="Breadcrumb">
            <ol role="list" class="flex items-center space-x-4">
                <li>
                    <div>
                        <router-link 
                            :to="{ name: 'DealsAdsManagerAds' }" 
                            class="text-gray-400 hover:text-gray-500">
                            <HomeIcon class="h-5 w-5 shrink-0" aria-hidden="true" />
                            <span class="sr-only">Home</span>
                        </router-link>
                    </div>
                </li>
                <li v-for="page in pages" :key="page.name">
                    <div class="flex items-center">
                        <ChevronRightIcon class="h-5 w-5 shrink-0 text-gray-400" aria-hidden="true" />
                        <router-link 
                            :to="page.href" 
                            class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                            :aria-current="page.current ? 'page' : undefined">
                            {{ page.name }}
                        </router-link>
                    </div>
                </li>
            </ol>
        </nav>
        <div>
            <router-view />
        </div>
    </div>
</template>
  
<script>
    import { ChevronRightIcon, HomeIcon } from '@heroicons/vue/20/solid'
    
    export default {
        name: "AdsView",
        components: {
            ChevronRightIcon,
            HomeIcon
        },
        computed: {
            dealId() {
                return this.$route.params.dealId || null
            },
            platformId() {
                return this.$route.params.platformId || null
            },
            campaignId() {
                return this.$route.params.campaignId || null
            },
            adGroupId() {
                return this.$route.params.adGroupId || null
            },
            adId() {
                return this.$route.params.adId || null
            },
            pages() {
                const arr = []
                if (this.dealId) {
                    arr.push({
                        name: `Deal ${this.dealId}`,
                        href: { name: 'DealsAdsManagerAdsDealView', params: { dealId: this.dealId } },
                        current: !this.platformId && !this.campaignId && !this.adGroupId && !this.adId
                    })
                }
                if (this.platformId) {
                    arr.push({
                        name: `Platform ${this.platformId}`,
                        href: { name: 'DealsAdsManagerAdsPlatformView', params: { dealId: this.dealId, platformId: this.platformId } },
                        current: !this.campaignId && !this.adGroupId && !this.adId
                    })
                }
                if (this.campaignId) {
                    arr.push({
                        name: `Campaign ${this.campaignId}`,
                        href: { name: 'DealsAdsManagerAdsCampaignView', params: { dealId: this.dealId, platformId: this.platformId, campaignId: this.campaignId } },
                        current: !this.adGroupId && !this.adId
                    })
                }
                if (this.adGroupId) {
                    arr.push({
                        name: `Ad Group ${this.adGroupId}`,
                        href: { name: 'DealsAdsManagerAdsAdGroupView', params: { dealId: this.dealId, platformId: this.platformId, campaignId: this.campaignId, adGroupId: this.adGroupId } },
                        current: !this.adId
                    })
                }
                if (this.adId) {
                    arr.push({
                        name: `Ad ${this.adId}`,
                        href: { name: 'DealsAdsManagerAdsAdView', params: { dealId: this.dealId, platformId: this.platformId, campaignId: this.campaignId, adGroupId: this.adGroupId, adId: this.adId } },
                        current: true
                    })
                }
                return arr
            }
        }
    }
</script>
  