<template>
    <div v-flowbite>
        <section class="my-4">
            <div class="max-w-4xl mx-auto px-4 py-4 bg-white dark:bg-gray-800 border rounded-lg">
                <div class="flex flex-col space-y-4 p-2 lg:p-8">
                    <DealProductCreateForm 
                        :deal-id="$route.params.dealId" />
                </div>
            </div>
        </section>

    </div>
</template>

<script>
    import DealProductCreateForm from "@dealsModels/deal-product/forms/CreateForm.vue";
    import { useDealsManagerStore } from '@dealsPages/deals-manager/store/dealsManagerStore.js'

    export default {
        name: "CreateView",
        components: {
            DealProductCreateForm,
        },
        setup() {
            const dealsManagerStore = useDealsManagerStore()
            return {
                dealsManagerStore,
            }
        },
        data() {
            return {
                visibleRow: null,
            };
        },
        mounted() {
            this.dealsManagerStore.setHeaderTitle('Create Deal Product');
            this.dealsManagerStore.setDealId(this.$route.params.dealId);
        },
        methods: {
            setVisibleRow(row) {
                this.visibleRow = this.visibleRow === row ? null : row;
            },
        },
    };
</script>

<style scoped>
/* Ajusta estilos adicionales si lo deseas */
</style>
