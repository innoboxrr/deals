<template>
    <div v-flowbite class="my-4">
        <div class="max-w-6xl mx-auto px-4 py-4 bg-white dark:bg-gray-800 border rounded-lg">
            <div class="flex flex-col space-y-4 p-2 lg:p-8">
                <DealAdvertiserModelProfile
                    :deal-advertiser-id="$route.params.advertiserId"
                    @eventHandler="handleEvent" />
            </div>
        </div>
    </div>
</template>

<script>
    import { useAdvertisersManagerStore } from '@dealsPages/advertisers-manager/store/advertisersManagerStore.js'
    import DealAdvertiserModelProfile from '@dealsModels/deal-advertiser/widgets/ModelProfile.vue'
    import  { eventHandler } from '@dealsPages/advertisers-manager/js/event-handler.js'

    export default {
        name: "ShowView",
        components: {
            DealAdvertiserModelProfile,
        },
        setup() {
            const advertisersManagerStore = useAdvertisersManagerStore()
            return {
                advertisersManagerStore,
            }
        },
        mounted() {
            this.advertisersManagerStore.setHeaderTitle(this.__deals('Show an advertiser'));
            this.advertisersManagerStore.setDealAdvertiserId(this.$route.params.advertiserId);
        },
        unmounted() {
            this.advertisersManagerStore.setDealAdvertiserId(null);
        },
        methods: {
            handleEvent(event) {
                eventHandler(this, event.type, event.data);
            },
        }
    };
</script>