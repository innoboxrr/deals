<template>
    <tr v-flowbite class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
        <!-- Checkbox -->
        <td class="px-4 py-2 w-4">
            <div class="flex items-center">
                <input
                    type="checkbox"
                    :value="deal.id"
                    :checked="selectedDeals.includes(deal.id)"
                    @change="$emit('update:selectedDeals', deal.id)"
                    @click.stop
                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                >
            </div>
        </td>

        <!-- Deal name and status -->
        <th
            class="px-4 py-2 font-medium text-blue-800 whitespace-nowrap dark:text-white"
            @click="$emit('toggle', index)">
            <p class="mb-1 cursor-pointer">
                {{ deal.name }}
                <i class="h-5 w-5 pt-1 text-gray-900 fa-solid fa-caret-down justify-end"></i>
            </p>
            <span
                class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-md"
                :class="{
                    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300': deal.status === 'active',
                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300': deal.status === 'pending',
                    'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300': deal.status === 'inactive'
                }">
                {{ deal.status }}
            </span>
        </th>

        <!-- Progress -->
        <td class="px-4 py-2 font-medium whitespace-nowrap cursor-pointer">
            <div class="flex justify-end mb-1">
                <span 
                    uk-tooltip="Importe gastado"
                    class="text-xs font-medium text-gray-500 dark:text-gray-400">
                    75%
                </span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                <div class="bg-blue-600 h-1.5 rounded-full" style="width: 75%"></div>
            </div>
            <div class="mt-2 flex justify-between">
                <div 
                    class="flex items-center" 
                    uk-tooltip="6,458 leads generados">
                    <i class="fa-solid fa-check text-green-500 text-xs"></i>
                    <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">
                        6.7K
                    </span>
                </div>
                <div 
                    class="flex items-center ml-2" 
                    uk-tooltip="Leads duplicados">
                    <i class="fa-solid fa-user-slash text-gray-500 text-xs"></i>
                    <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">
                        32
                    </span>
                </div>
                <div 
                    class="flex items-center ml-2" 
                    uk-tooltip="Leads en cola de espera">
                    <i class="fa-solid fa-clock text-yellow-500 text-xs"></i>
                    <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">
                        456
                    </span>
                </div>
                <div 
                    class="flex items-center ml-2"
                    uk-tooltip="Leads rechazados por reglas de negocio">
                    <i class="fa-solid fa-times text-red-500 text-xs"></i>
                    <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">
                        200
                    </span>
                </div>
            </div>
        </td>

        <!-- Max. CPL -->
        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            ${{ deal.payload?.max_cpl || '-' }}
        </td>

        <!-- CPL -->
        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            ${{ deal.payload?.last_performance_snapshot?.avg_cpl || '-' }}
        </td>

        <!-- CPM -->
        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            ${{ deal.payload?.last_performance_snapshot?.avg_cpm || '-' }}
        </td>

        <!-- ROI -->
        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <div class="flex items-center">
                <i class="h-3 w-3 mr-2 text-green-500 fa-solid fa-arrow-up"></i>
                {{ deal.payload?.last_performance_snapshot?.avg_roi || '0%' }}
            </div>
        </td>

        <!-- Due Date -->
        <td class="px-4 py-2 whitespace-nowrap font-medium text-gray-900 dark:text-white text-xs">
            {{ formatDate(deal.payload?.start_date) }}
        </td>

        <!-- Actions -->
        <td class="px-4 py-2">
            <button
                @click="toggleDropdown = !toggleDropdown"
                class="inline-flex items-center p-1 text-sm font-medium text-center text-gray-500 hover:text-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100">
                <i class="h-5 w-5 pt-1 text-gray-900 fa-solid fa-ellipsis"></i>
            </button>
            <div
                v-if="toggleDropdown"
                class="absolute z-10 mt-2 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 right-0">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                    </li>
                </ul>
                <div class="py-1">
                    <a href="#" class="block py-2 px-4 text-sm text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                </div>
            </div>

        </td>
    </tr>

    <tr v-if="visible" class="flex-1 overflow-x-auto w-full">
        <td class="border-b dark:border-gray-700" colspan="10">
            <slot name="expanded" :deal="deal"></slot>
        </td>
    </tr>
</template>

<script>
export default {
    name: 'RowTable',
    props: {
        deal: {
            type: Object,
            required: true
        },
        index: {
            type: Number,
            required: true
        },
        visible: {
            type: Boolean,
            default: false
        },
        selectedDeals: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            toggleDropdown: false,
        };
    },
    methods: {
        formatDate(date) {
            if (!date) return '-'
            const d = new Date(date)
            return d.toLocaleDateString('es-MX', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            })
        }
    }
}
</script>
