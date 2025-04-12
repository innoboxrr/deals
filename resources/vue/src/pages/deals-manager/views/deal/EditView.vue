<template>
    <div v-flowbite>
        <section class="my-4">
            <div class="max-w-6xl mx-auto px-4 py-4 bg-white dark:bg-gray-800 border rounded-lg">
                <div class="flex flex-col space-y-4 p-2 lg:p-8">
                    <DealEditForm :deal-id="$route.params.dealId" />
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { useDealsManagerStore } from '@dealsPages/deals-manager/store/dealsManagerStore.js'
    import DealEditForm from "@dealsModels/deal/forms/EditForm.vue";

    export default {
        name: "EditView",
        components: {
            DealEditForm,
        },
        setup() {
            const dealsManagerStore = useDealsManagerStore()
            return {
                dealsManagerStore,
            }
        },
        mounted() {
            this.dealsManagerStore.setHeaderTitle('Edit Deal');
            this.dealsManagerStore.setDealId(this.$route.params.dealId);
        },
        unmounted() {
            this.dealsManagerStore.setDealId(null);
        },
    };
</script>