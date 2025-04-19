<template>
    <tr 
        v-if="agreement"
        v-flowbite 
        class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">

        <td class="px-4 py-2 w-4">
            <div class="flex items-center">
                <input 
                    id="checkbox-table-search-1" 
                    type="checkbox" 
                    onclick="event.stopPropagation()" 
                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label 
                    for="checkbox-table-search-1" 
                    class="sr-only">
                    checkbox
                </label>
            </div>
        </td>
        <th 
            class="px-4 py-2 font-medium text-blue-800 whitespace-nowrap dark:text-white"
            @click="setVisibleRow(x)">
            <p class="mb-1 cursor-pointer">
                Upload feed and Reels in Instagram 
                <i class="h-5 w-5 pt-1 text-gray-900 fa-solid fa-caret-down  justify-end"></i>
            </p>
            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                In progress
            </span>
        </th>
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
        <td class="px-4 py-2 text-gray-900 whitespace-nowrap dark:text-white">
            <div class="px-2 py-1 border dark:border-gray-600 bg-white dark:bg-gray-700 rounded-lg text-xs font-medium inline-flex items-center">
                <button class="bg-red-500 hover:bg-red-700 text-white p-1 rounded-md mr-3">
                    <i class="h-3 w-3 fa-solid fa-minus"></i>
                </button>
                <span class="text-green-500">48</span>/1750$
                <button class="bg-green-500 hover:bg-green-700 text-white p-1 rounded-md ml-3">
                    <i class="h-3 w-3 fa-solid fa-plus"></i>
                </button>
            </div>
        </td>
        <th 
            scope="row" 
            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            1754
        </th>
        <th 
            scope="row" 
            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            $84 
        </th>
        <th 
            scope="row" 
            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            $84 
        </th>
        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <div class="flex items-center">
                <i class="h-3 w-3 mr-2 text-green-500 fa-solid fa-arrow-up"></i>
                4.7%
            </div>
        </td>
        <td class="px-4 py-2 whitespace-nowrap font-medium text-gray-900 dark:text-white text-xs">
            23 Nov 2022
        </td>
        <td class="px-4 py-2">
            <button 
                :id="`dropdown-button-${x}`" 
                type="button" 
                :data-dropdown-toggle="`dropdown-${x}`" 
                class="inline-flex items-center p-1 text-sm font-medium text-center text-gray-500 hover:text-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100">
                <i class="h-5 w-5 pt-1 text-gray-900 fa-solid fa-ellipsis"></i>
            </button>
            <div 
                :id="`dropdown-${x}`" 
                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                <ul 
                    class="py-1 text-sm text-gray-700 dark:text-gray-200" 
                    :aria-labelledby="`dropdown-button-${x}`">
                    <li>
                        <a 
                            href="#" 
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Show
                        </a>
                    </li>
                    <li>
                        <a 
                            href="#" 
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Edit
                        </a>
                    </li>
                </ul>
                <div class="py-1">
                    <a 
                        href="#" 
                        class="block py-2 px-4 text-sm text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        Delete
                    </a>
                </div>
            </div>
        </td>
    </tr>
    <tr v-if="visible" class="flex-1 overflow-x-auto w-full">
        <td class="border-b dark:border-gray-700" colspan="10">
            <slot name="expanded" :agreement="agreement"></slot>
        </td>
    </tr>
</template>

<script>
export default {
    name: 'RowTable',
    props: {
        agreement: {
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
        selectedDealAdvertisers: {
            type: Array,
            default: () => []
        }
    },
    emits: ['toggle', 'show', 'edit', 'delete'],
    mounted() {
        console.log(this.agreement);
    },
    data() {
        return {
            toggleDropdown: false,
        };
    },
}
</script>