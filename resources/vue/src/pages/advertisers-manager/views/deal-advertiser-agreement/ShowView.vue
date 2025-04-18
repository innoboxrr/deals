<template>
    <div v-flowbite>
        <section class="my-4">
            <div class="max-w-6xl mx-auto px-4 py-4 bg-white dark:bg-gray-800 border rounded-lg">
                <div class="flex flex-col space-y-4 p-2 lg:p-8">
                    <AgreementModelProfile
                        :deal-advertiser-agreement-id="$route.params.agreementId" />
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { useAdvertisersManagerStore } from '@dealsPages/advertisers-manager/store/advertisersManagerStore.js'
    import AgreementModelProfile from '@dealsModels/deal-advertiser-agreement/widgets/ModelProfile.vue'

    export default {
        name: "ShowView",
        components: {
            AgreementModelProfile,
        },
        setup() {
            const advertisersManagerStore = useAdvertisersManagerStore()
            return {
                advertisersManagerStore,
            }
        },
        mounted() {
            this.advertisersManagerStore.setHeaderTitle(this.__deals('Show an agreement'));
            this.advertisersManagerStore.setAgreementId(this.$route.params.agreementId);
        },
        unmounted() {
            this.advertisersManagerStore.setAgreementId(null);
        },
        methods: {
            //
        }
    };
</script>