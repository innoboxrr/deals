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
                    :value="agreement.id"
                    :checked="selectedDealAdvertisers.includes(agreement.id)"
                    @change="$emit('update:selectedAgreements', deal.id)"
                    @click.stop
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
            @click="$emit('toggle', index)">
            <p class="mb-1 cursor-pointer">
                {{ __deals('Agreement') }} #{{ agreement.id }} 
                <i class="h-5 w-5 pt-1 text-gray-900 fa-solid fa-caret-down  justify-end"></i>
            </p>
            <span 
                class="text-xs font-medium dark:text-gray-400 py-0.5 px-2 rounded-lg"
                :class="{
                    'text-green-500 bg-green-100': agreement.status === 'active',
                    'text-red-500 bg-red-100': agreement.status === 'inactive',
                    'text-yellow-500 bg-yellow-100': agreement.status === 'pending',
                    'text-gray-500 bg-gray-100': [
                        'suspended',
                        'deleted',
                        'archived',
                        'expired',
                        'blocked',
                        'draft',
                        'completed'
                    ].includes(agreement.status)
                }">
                {{ agreement.status }}
            </span>
        </th>
        <td class="px-4 py-2 font-medium whitespace-nowrap cursor-pointer">
            <div class="flex justify-end mb-1">
                <span 
                    uk-tooltip="Importe gastado"
                    class="text-xs font-medium text-gray-500 dark:text-gray-400">
                    {{ spentProgress }}% - ({{ formatCount(agreement.payload.distribution.current_leads_assigned) }} leads)
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
                        {{ formatCount(agreement.payload.distribution.current_leads_approved) }}
                    </span>
                </div>
                <div 
                    class="flex items-center ml-2" 
                    uk-tooltip="Leads duplicados">
                    <i class="fa-solid fa-user-slash text-gray-500 text-xs"></i>
                    <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">
                        {{ formatCount(agreement.payload.distribution.current_leads_duplicates) }}
                    </span>
                </div>
                <div 
                    class="flex items-center ml-2" 
                    uk-tooltip="Leads en cola de espera">
                    <i class="fa-solid fa-clock text-yellow-500 text-xs"></i>
                    <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">
                        {{ formatCount(agreement.payload.distribution.current_leads_waiting) }}
                    </span>
                </div>
                <div 
                    class="flex items-center ml-2"
                    uk-tooltip="Leads rechazados por reglas de negocio">
                    <i class="fa-solid fa-times text-red-500 text-xs"></i>
                    <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">
                        {{ formatCount(agreement.payload.distribution.current_leads_rejected) }}
                    </span>
                </div>
            </div>
        </td>
        <td class="px-4 py-2 text-gray-900 whitespace-nowrap dark:text-white">
            <div class="px-3 py-2 border dark:border-gray-600 bg-white dark:bg-gray-700 rounded-lg text-xs font-medium inline-flex items-center">
                <button v-if="false" class="bg-red-500 hover:bg-red-700 text-white p-1 rounded-md mr-3">
                    <i class="h-3 w-3 fa-solid fa-minus"></i>
                </button>
                <span class="text-green-500">
                    {{ formatCount(agreement.payload.billings.daily_budget ?? 0) }}
                </span>
                /{{ formatCount(agreement.payload.billings.daily_budget_spent ?? 0 ) }}$
                <button v-if="false" class="bg-green-500 hover:bg-green-700 text-white p-1 rounded-md ml-3">
                    <i class="h-3 w-3 fa-solid fa-plus"></i>
                </button>
            </div>
        </td>
        <th 
            scope="row" 
            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            ${{ formatCount(agreement.payload.distribution.current_cpl ?? 0) }}
        </th>
        <th 
            scope="row" 
            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            ${{ formatCount(agreement.payload.distribution.current_cpa ?? 0) }}
        </th>
        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <div class="flex items-center">
                <i 
                    class="h-3 w-3 mr-2"
                    :class="{
                        'fa-solid fa-arrow-up text-green-500': agreement.payload.distribution.current_roi > 0,
                        'fa-solid fa-arrow-down text-red-500': agreement.payload.distribution.current_roi < 0,
                        'fa-solid fa-minus text-gray-500': agreement.payload.distribution.current_roi === 0
                    }"></i>
                {{ formatCount(agreement.payload.distribution.current_roi ?? 0) }}%
            </div>
        </td>
        <td class="px-4 py-2 whitespace-nowrap font-medium text-gray-900 dark:text-white text-xs">
            {{ formatDate(agreement.payload.general.end_date) }}
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
                            @click.stop="$emit('show', agreement)"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            {{ __deals('View') }}
                        </a>
                    </li>
                    <li>
                        <a 
                            @click.stop="$emit('edit', agreement)"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            {{ __deals('Edit') }}
                        </a>
                    </li>
                </ul>
                <div class="py-1">
                    <a 
                        @click.stop="$emit('delete', agreement)"
                        class="block py-2 px-4 text-sm text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        {{ __deals('Delete') }}
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

import { formatCount } from '@dealsUtils/formatters.js'

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
    data() {
        return {
            toggleDropdown: false,
        };
    },
    computed: {
        spentProgress() {
            return Math.round((this.agreement.payload.billings.budget_spent / this.agreement.payload.billings.net_budget) * 100);
        },
    },
    methods: {
        formatCount,
    }
}
</script>