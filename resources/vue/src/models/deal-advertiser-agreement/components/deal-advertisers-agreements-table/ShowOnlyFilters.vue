<template>
    <div class="mx-4 pb-3 flex flex-wrap">
        <div class="hidden md:flex items-center text-sm font-medium text-gray-900 dark:text-white mr-4 mt-3">
            {{ label }}
        </div>
        <div class="flex flex-wrap">
            <label
                v-for="opt in options"
                :key="opt.value"
                class="flex items-center mr-4 mt-3"
            >
                <input
                    type="radio"
                    :id="opt.value"
                    :value="opt.value"
                    name="show-only"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    :checked="opt.value === value"
                    v-model="value"
                />
                <span class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    {{ opt.label }}
                </span>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ShowOnlyFilters',
    props: {
        modelValue: {
            type: String,
            default: ''
        },
        label: {
            type: String,
            default: 'Show only:'
        }
    },
    emits: ['update:modelValue'],
    computed: {
        value: {
            get() {
                return this.$props.modelValue;
            },
            set(value) {
                this.$emit('update:modelValue', value);
            }
        }
    },
    data() {
        return {
            options: [
                { label: 'All',               value: '' },
                { label: 'Completed',   value: 'completed' },
                { label: 'In progress', value: 'in_progress' },
                { label: 'Paused',   value: 'paused' },
                { label: 'Cancelled', value: 'cancelled' },
                { label: 'Draft',     value: 'draft' }
            ]
        };
    }
};
</script>

<style scoped>
/* No requiere estilos adicionales */
</style>
