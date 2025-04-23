<template>
    <tr 
        v-if="advertiser"
        v-flowbite 
        class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">

        <!-- Checkbox -->
        <td class="px-4 py-2 w-4">
            <div class="flex items-center">
                <input
                    type="checkbox"
                    :value="advertiser.id"
                    :checked="selectedDealAdvertisers.includes(advertiser.id)"
                    @change="$emit('update:selectedDealAdvertisers', advertiser.id)"
                    @click.stop
                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                >
            </div>
        </td>

        <!-- Advertiser -->
        <th
            class="px-4 py-2 font-medium text-blue-800 whitespace-nowrap dark:text-white"
            @click="$emit('toggle', index)">
            
            <p class="mb-1 cursor-pointer">
                (#ID {{ advertiser.agent.user.id }})
                {{ advertiser.agent.user.name }}
                <i class="h-5 w-5 pt-1 text-gray-900 fa-solid fa-caret-down justify-end"></i>
            </p>

            <span
                class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-md"
                :class="{
                    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300': advertiser.status === 'active',
                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300': advertiser.status === 'pending',
                    'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300': advertiser.status === 'inactive',
                    'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300': ['suspended', 'deleted', 'archived', 'expired', 'blocked'].includes(advertiser.status)
                }">
                {{ advertiser.status }}
            </span>
        </th>

        <!-- Company -->
        <td class="px-4 py-2 text-gray-900 dark:text-white whitespace-nowrap">
            <div class="font-medium">
                {{ advertiser.payload.company.name }}
            </div>
            <div class="text-xs">
                Tax Type: {{ advertiser.payload.company.tax_type }}
            </div>
            <div class="text-xs">
                Tax #: {{ advertiser.payload.company.tax_number }}
            </div>
        </td>

        <!-- Activity -->
        <td class="px-4 py-2 whitespace-nowrap dark:text-white">
            <div class="flex items-center space-x-4">
                <!-- Total Spent -->
                <div class="flex flex-col items-center">
                    <span class="text-xs text-gray-500 dark:text-gray-400">Spent</span>
                    <span class="text-sm font-medium">
                        {{ advertiser.payload.activity.total_spent !== null ? advertiser.payload.activity.total_spent : '-' }}
                    </span>
                </div>
                <!-- Campaigns Count -->
                <div class="flex flex-col items-center">
                    <span class="text-xs text-gray-500 dark:text-gray-400">Campaigns</span>
                    <span class="text-sm font-medium">
                        {{ advertiser.payload.activity.campaigns_count ?? '-' }}
                    </span>
                </div>
                <!-- Last Active -->
                <div class="flex flex-col items-center">
                    <span class="text-xs text-gray-500 dark:text-gray-400">Last Active</span>
                    <span class="text-sm font-medium">
                        {{ advertiser.payload.activity.last_active
                            ? formatDate(advertiser.payload.activity.last_active, 'DD/MM/YY')
                            : '-' }}
                    </span>
                </div>
            </div>
        </td>


        <!-- Settings -->
        <td class="px-4 py-2 whitespace-nowrap dark:text-white">
            <div class="flex flex-col items-start space-y-1">
                <div class="text-sm font-medium">
                    {{ advertiser.payload.settings.currency }}
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">
                    {{ advertiser.payload.settings.language }}
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">
                    {{ advertiser.payload.settings.timezone }}
                </div>
            </div>
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
                        <a 
                            @click.prevent="$emit('show', advertiser)"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Show
                        </a>
                    </li>
                    <li>
                        <a 
                            @click.prevent="$emit('edit', advertiser)"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Edit
                        </a>
                    </li>
                </ul>
                <div class="py-1">
                    <a 
                        @click.prevent="$emit('delete', advertiser)"
                        class="block py-2 px-4 text-sm text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        Delete
                    </a>
                </div>
            </div>
        </td>
    </tr>
    <tr v-if="visible" class="flex-1 overflow-x-auto w-full">
        <td class="border-b dark:border-gray-700" colspan="10">
            <slot name="expanded" :advertiser="advertiser"></slot>
        </td>
    </tr>
</template>

<script>
export default {
    name: 'RowTable',
    props: {
        advertiser: {
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
}
</script>