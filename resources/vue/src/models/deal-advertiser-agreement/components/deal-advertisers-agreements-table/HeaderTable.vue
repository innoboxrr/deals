<template>
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <!-- Checkbox -->
            <th scope="col" class="p-4">
                <div class="flex items-center">
                    <input
                        id="checkbox-all"
                        type="checkbox"
                        v-model="value"
                        class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    />
                    <label for="checkbox-all" class="sr-only">Seleccionar todo</label>
                </div>
            </th>

            <!-- Advertiser -->
            <th scope="col" class="px-4 py-3">Anunciante</th>

            <!-- Company -->
            <th scope="col" class="px-4 py-3">Empresa</th>

            <!-- Activity -->
            <th scope="col" class="px-4 py-3">Actividad</th>

            <!-- Settings -->
            <th scope="col" class="px-4 py-3">Configuración</th>

            <!-- Actions -->
            <th scope="col" class="px-4 py-3">
                <span class="sr-only">Acciones</span>
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
