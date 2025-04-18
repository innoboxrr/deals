<template>
    <div v-flowbite>
        <section class="my-4">
            <div class="max-w-4xl mx-auto px-4 py-4 bg-white dark:bg-gray-800 border rounded-lg">
                <div class="flex flex-col space-y-4 p-2 lg:p-8">
                    <DealAdvertiserCreateForm 
                        @submit="dealAdvertiserCreateFormSubmit"/>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { useAdvertisersManagerStore } from '@dealsPages/advertisers-manager/store/advertisersManagerStore.js'
    import DealAdvertiserCreateForm from "@dealsModels/deal-advertiser/forms/CreateForm.vue";

    export default {
        name: "CreateView",
        components: {
            DealAdvertiserCreateForm,
        },
        setup() {
            const advertisersManagerStore = useAdvertisersManagerStore()
            return {
                advertisersManagerStore,
            }
        },
        mounted() {
            this.advertisersManagerStore.setHeaderTitle(this.__deals('Create a new advertiser'));
        },
        methods: {
            dealAdvertiserCreateFormSubmit(data) {
                this.$router.push({
                    name: "DealsAdvertisersManagerAdvertiserShow",
                    params: {
                        advertiserId: data.id,
                    },
                });
            },
        }
    };
</script>