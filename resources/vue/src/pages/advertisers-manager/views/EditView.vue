<template>
    <div v-flowbite>
        <section class="my-4">
            <div class="max-w-6xl mx-auto px-4 py-4 bg-white dark:bg-gray-800 border rounded-lg">
                <div class="flex flex-col space-y-4 p-2 lg:p-8">
                    <DealAdvertiserEditForm 
                        :advertiser-id="$route.params.advertiserId"
                        @submit="dealAdvertiserEditFormSubmit"/>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { useAdvertisersManagerStore } from '@dealsPages/advertisers-manager/store/advertisersManagerStore.js'
    import DealAdvertiserEditForm from "@dealsModels/deal-advertiser/forms/EditForm.vue";

    export default {
        name: "EditView",
        components: {
            DealAdvertiserEditForm,
        },
        setup() {
            const advertisersManagerStore = useAdvertisersManagerStore()
            return {
                advertisersManagerStore,
            }
        },
        mounted() {
            this.advertisersManagerStore.setHeaderTitle(this.__deals('Edit a new advertiser'));
        },
        methods: {
            dealAdvertiserEditFormSubmit(data) {
                this.$router.push({
                    name: "DealsAdvertisersManagerShow",
                    params: {
                        advertiserId: data.id,
                    },
                });
            },
        }
    };
</script>