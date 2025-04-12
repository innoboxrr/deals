<template>
    <div v-flowbite>
        <section class="my-4">
            <div class="max-w-6xl mx-auto px-4 py-4 bg-white dark:bg-gray-800 border rounded-lg">
                <div class="flex flex-col space-y-4 p-2 lg:p-8">
                    <DealCreateForm 
                        @submit="dealCreateFormSubmit"/>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { useDealsManagerStore } from '@dealsPages/deals-manager/store/dealsManagerStore.js'
    import DealCreateForm from "@dealsModels/deal/forms/CreateForm.vue";

    export default {
        name: "CreateView",
        components: {
            DealCreateForm,
        },
        setup() {
            const dealsManagerStore = useDealsManagerStore()
            return {
                dealsManagerStore,
            }
        },
        mounted() {
            this.dealsManagerStore.setHeaderTitle(this.__deals('Create a new deal'));
            this.dealsManagerStore.setDealId(null);
        },
        methods: {
            dealCreateFormSubmit(data) {
                this.$router.push({
                    name: "DealsManagerDealDetails",
                    params: {
                        dealId: data.id,
                    },
                });
            },
        }
    };
</script>