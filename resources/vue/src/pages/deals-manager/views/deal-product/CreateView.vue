<template>
    <div v-flowbite>
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
