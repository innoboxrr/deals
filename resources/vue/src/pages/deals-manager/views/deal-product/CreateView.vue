<template>
    <div v-flowbite>
        <section class="flex items-center bg-gray-50 dark:bg-gray-900">
            <div class="w-full">
                <div class="relative overflow-hidden dark:bg-gray-800 border-b">
                    <div class="px-4 divide-y dark:divide-gray-700">
                        <div class="flex items-center justify-between py-3">
                            <div class="flex items-center flex-1 space-x-2">
                                <h5 class="font-semibold dark:text-white">
                                    {{ __deals('Create product') }}
                                </h5>
                            </div>
                            <div class="flex items-center space-x-2 md:space-x-4">
                                <router-link 
                                    :to="{
                                        name: 'DealsProductsManagerDashboard',
                                    }"
                                    class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-white bg-indigo-600 border border-gray-200 rounded-lg fhover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 focus:z-10 focus:ring-4 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 hover:text-white hover:bg-indigo-700">
                                    <i class="h-5 w-5 pt-1 mr-2 text-white fas fa-tachometer-alt"></i>
                                    {{ __deals('Products dashboard') }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="my-4">
            <div class="max-w-4xl mx-auto px-4 py-4 bg-white dark:bg-gray-800 border rounded-lg">
                <div class="flex flex-col space-y-4 p-2 lg:p-8">
                    <DealProductCreateForm />
                </div>
            </div>
        </section>

    </div>
</template>

<script>
    import DealProductCreateForm from "@dealsModels/deal-product/forms/CreateForm.vue";

    export default {
        name: "CreateView",
        components: {
            DealProductCreateForm,
        },
        data() {
            return {
                visibleRow: null,
            };
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
