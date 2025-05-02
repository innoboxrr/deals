<template>
    <div v-flowbite>
        <section class="my-4">
            <div class="max-w-6xl mx-auto px-4 py-4 bg-white dark:bg-gray-800 border rounded-lg">
                <div class="flex flex-col space-y-4 p-2 lg:p-8">
                    <AgreementEditForm 
                        :deal-advertiser-agreement-id="$route.params.agreementId"
                        @submit="agreementEditFormSubmit"/>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { useAdvertisersManagerStore } from '@dealsPages/advertisers-manager/store/advertisersManagerStore.js'
    import AgreementEditForm from "@dealsModels/deal-advertiser-agreement/forms/EditForm.vue";

    export default {
        name: "EditView",
        components: {
            AgreementEditForm,
        },
        setup() {
            const advertisersManagerStore = useAdvertisersManagerStore()
            return {
                advertisersManagerStore,
            }
        },
        mounted() {
            this.advertisersManagerStore.setHeaderTitle(this.__deals('Edit agreement'));
            this.advertisersManagerStore.setAgreementId(this.$route.params.agreementId);
            this.advertisersManagerStore.setDealAdvertiserId(this.$route.params.advertiserId);
        },
        unmounted() {
            this.advertisersManagerStore.setAgreementId(null);
            this.advertisersManagerStore.setDealAdvertiserId(null);
        },
        methods: {
            agreementEditFormSubmit(data) {
                /*
                this.$router.push({
                    name: "DealsAdvertisersManagerAdvertiserShow",
                    params: {
                        agreementId: data.id,
                    },
                });
                */
                this.alert('success');
            },
        }
    };
</script>