<template>
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="p-4">
                <div class="flex items-center">
                    <input 
                        id="checkbox-all" 
                        type="checkbox" 
                        class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label 
                        for="checkbox-all" 
                        class="sr-only">
                        checkbox
                    </label>
                </div>
            </th>
            <th scope="col" class="px-4 py-3">
                Agreement
            </th>
            <th scope="col" class="px-4 py-3">
                Progress
            </th>
            <th scope="col" class="px-4 py-3">
                Gasto
            </th>
            <th scope="col" class="px-4 py-3">
                Leads
            </th>
            <th scope="col" class="px-4 py-3">
                CPL
            </th>
            <th scope="col" class="px-4 py-3">
                CPM
            </th>
            <th scope="col" class="px-4 py-3">
                ROI
            </th>
            <th scope="col" class="px-4 py-3">
                Due Date
            </th>
            <th scope="col" class="px-4 py-3">
                <span class="sr-only">Actions</span>
            </th>
        </tr>
    </thead>
</template>

<script>
export default {
    name: 'HeaderTable',
    props: {
        modelValue: {
            type: Boolean,
            default: false,
        },
    },
    emits: ['update:modelValue'],
    computed: {
        value: {
            get() {
                return this.modelValue;
            },
            set(val) {
                this.$emit('update:modelValue', val);
            },
        },
    },
};
</script>
