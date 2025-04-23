<template>
    <div v-flowbite>
        <section class="my-4">
            <div class="max-w-6xl mx-auto px-4 py-4 bg-white dark:bg-gray-800 border rounded-lg">
                <div class="flex flex-col space-y-4 p-2 lg:p-8">
                    <deal-advertiser-model-profile 
                        :deal-advertiser-id="$route.params.advertiserId"
                        @eventHandler="handleEvent" />
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { useAdvertisersManagerStore } from '@dealsPages/advertisers-manager/store/advertisersManagerStore.js'
    import DealAdvertiserModelProfile from '@dealsModels/deal-advertiser/widgets/ModelProfile.vue'

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
                console.log(event);
                switch (event.type) {
                    case 'createDealAdvertiserAgreement':
                            this.$router.push({
                                name: 'DealsAdvertisersManagerAgreementCreate',
                                params: {
                                    advertiserId: this.$route.params.advertiserId,
                                },
                            });
                        break;
                    case 'showDealAdvertiserAgreement':
                        this.$router.push({
                            name: 'DealsAdvertisersManagerAgreementShow',
                            params: {
                                advertiserId: this.$route.params.advertiserId,
                                agreementId: event.data.agreement.id,
                            },
                        });
                        break;
                    case 'editDealAdvertiserAgreement':
                        this.$router.push({
                            name: 'DealsAdvertisersManagerAgreementEdit',
                            params: {
                                advertiserId: this.$route.params.advertiserId,
                                agreementId: event.data.agreement.id,
                            },
                        });
                        break;
                    case 'deleteDealAdvertiserAgreement':
                        console.log('deleteDealAdvertiserAgreement', event.data.agreement.id);
                        break;
                    default:
                        break;
                }
            },
        }
    };
</script>