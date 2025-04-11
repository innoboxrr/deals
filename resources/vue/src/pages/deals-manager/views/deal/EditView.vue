<template>
    <div v-flowbite>
        <section class="my-4">
            <div class="max-w-6xl mx-auto px-4 py-4 bg-white dark:bg-gray-800 border rounded-lg">
                <div class="flex flex-col space-y-4 p-2 lg:p-8">
                    <DealEditForm />
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import DealEditForm from "@dealsModels/deal/forms/EditForm.vue";

    export default {
        name: "EditView",
        components: {
            DealEditForm,
        },
    };
</script>