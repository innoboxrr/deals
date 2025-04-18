<template>
    <div v-flowbite>
        <section class="my-4">
            <div class="max-w-4xl mx-auto px-4 py-4 bg-white dark:bg-gray-800 border rounded-lg">
                <div class="flex flex-col space-y-4 p-2 lg:p-8">
                    <AgreementCreateForm 
                        @submit="agreementCreateFormSubmit"/>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { useAdvertisersManagerStore } from '@dealsPages/advertisers-manager/store/advertisersManagerStore.js'
    import AgreementCreateForm from "@dealsModels/deal-advertiser-agreement/forms/CreateForm.vue";

    export default {
        name: "CreateView",
        components: {
            AgreementCreateForm,
        },
        setup() {
            const advertisersManagerStore = useAdvertisersManagerStore()
            return {
                advertisersManagerStore,
            }
        },
        mounted() {
            this.advertisersManagerStore.setHeaderTitle(this.__deals('Create a new agreement'));
        },
        methods: {
            agreementCreateFormSubmit(data) {
                this.$router.push({
                    name: "DealsAdvertisersManagerAgreementShow",
                    params: {
                        agreementId: data.id,
                    },
                });
            },
        }
    };
</script>