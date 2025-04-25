<template>
    <div v-flowbite class="border-b dark:border-gray-700 mx-4">
        <div class="flex items-center justify-between space-x-4 pt-3">
            <div class="flex-1 flex items-center space-x-3">
                <h5 class="dark:text-white font-semibold">
                    {{ title }}
                </h5>
            </div>
        </div>
        <div class="flex flex-col-reverse md:flex-row items-center justify-between md:space-x-4 py-3">
            <div class="w-full flex flex-col space-y-3 md:space-y-0 md:flex-row md:items-center justify-between">
                <form
                    @submit.prevent
                    class="w-full md:max-w-sm flex-1 md:mr-4" >
                    <label for="global-search" class="sr-only">
                        {{ __deals('Search') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="h-5 w-5 text-gray-400 fa-solid fa-magnifying-glass"></i>
                        </div>
                        <input
                            id="global-search"
                            type="search"
                            class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            :placeholder="__deals('Search')"
                            v-model="value.search"
                            required />
                        <button
                            type="submit"
                            class="absolute right-0 top-0 bottom-0 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 text-white font-medium rounded-r-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700">
                            {{ __deals('Search') }}
                        </button>
                    </div>
                </form>
                <div class="flex items-center space-x-4 ml-4 justify-end">
                    <div>
                        <button
                            id="advertiserFilterDropdownButton"
                            data-dropdown-toggle="advertiserFilterDropdown"
                            type="button"
                            class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            <i class="h-5 w-5 pt-1 mr-2 text-gray-900 fa-solid fa-filter"></i>
                            {{ __deals('Filters') }}
                            <i class="h-5 w-5 pt-1 ml-2 text-gray-400 fa-solid fa-caret-down"></i>
                        </button>
                        <div
                            id="advertiserFilterDropdown"
                            class="hidden z-10 p-3 bg-white rounded-lg shadow w-56 dark:bg-gray-700" >
                            <h6 class="mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __deals('Filters') }}
                            </h6>
                            <ul class="space-y-2 text-sm" aria-labelledby="advertiserFilterDropdownButton">
                                <li 
                                    v-for="opt in statusOptions" 
                                    :key="opt.value">
                                    <label class="flex items-center text-sm font-medium text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md px-1.5 py-1 w-full" >
                                        <input
                                            type="checkbox"
                                            :value="opt.value"
                                            v-model="value.status"
                                            class="w-4 h-4 mr-2 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                                        {{ opt.label }}
                                    </label>
                                </li>
                            </ul>
                            <h6 class="mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __deals('By Agreements') }}
                            </h6>
                            <ul class="space-y-2 text-sm" aria-labelledby="advertiserFilterDropdownButton">
                                <li 
                                    v-for="opt in agreementsCountOptions" 
                                    :key="opt.value">
                                    <label class="flex items-center text-sm font-medium text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md px-1.5 py-1 w-full">
                                        <input
                                            type="radio"
                                            :value="opt.value"
                                            v-model="value.agreements_count"
                                            class="w-4 h-4 mr-2 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        />
                                        {{ opt.label }}
                                    </label>
                                </li>
                            </ul>
                            <a
                                href="#"
                                class="flex items-center text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline mt-4 ml-1.5"
                                @click.prevent="resetFilters" >
                                {{ __deals('Reset filters') }}
                            </a>
                        </div>
                    </div>
                    <div>
                        <button
                            id="advertiserBulkDropdownButton"
                            data-dropdown-toggle="advertiserBulkDropdown"
                            type="button"
                            class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" >
                            <i class="h-5 w-5 pt-1 mr-2 text-gray-900 fa-solid fa-tasks"></i>
                            {{ __deals('Bulk actions') }}
                        </button>
                        <div
                            id="advertiserBulkDropdown"
                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                            <ul 
                                class="py-1 text-sm text-gray-700 dark:text-gray-200" 
                                aria-labelledby="advertiserBulkDropdownButton">
                                <li 
                                    v-for="opt in bulkOptions" 
                                    :key="opt.action">
                                    <a
                                        href="#"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        @click.prevent="$emit('eventHandler', { 
                                            type: opt.action, 
                                            data: {
                                                selectedAdvertisers: selectedAdvertisers,
                                            }
                                        });">
                                        {{ opt.label }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <button
                            @click="$emit('eventHandler', { 
                                type: 'createAdvertiser', 
                                data: {}
                            });"
                            class="w-full md:w-auto flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 sm:px-4 sm:py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 hover:text-white">
                            <i class="h-5 w-5 pt-1 mr-2 text-white fa-solid fa-plus"></i>
                            {{ __deals('New') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AdvertisersFilters',
    props: {
        title: { 
            type: String, 
            default: 'Advertisers' 
        },
        modelValue: {
            type: Object,
            default: () => ({
                search: '',
                status: [],
                agreements_count: null,
            })
        },
        selectedAdvertisers: {
            type: Array,
            default: () => [],
        },
        statusOptions: { 
            type: Array,  
            default: () => [
                { label: 'Active', value: 'active' },
                { label: 'Inactive', value: 'inactive' },
                { label: 'Pending', value: 'pending' },
                { label: 'Suspended', value: 'suspended' },
                { label: 'Deleted', value: 'deleted' },
                { label: 'Archived', value: 'archived' },
                { label: 'Expired', value: 'expired' },
                { label: 'Blocked', value: 'blocked' },
            ]
        },
        agreementsCountOptions: { 
            type: Array,  
            default: () => [
                { label: '0-5', value: '0-5' },
                { label: '6-10', value: '6-10' },
                { label: '11-20', value: '11-20' },
                { label: '21-50', value: '21-50' },
                { label: '51-100', value: '51-100' },
                { label: '101+', value: '101+' }
            ]
        },
        bulkOptions:    { 
            type: Array,  
            default: () => [
                { label: 'Suspend', action: 'suspendAdvertisers' },
                { label: 'Activate', action: 'activateAdvertisers' },
                { label: 'Export', action: 'exportAdvertisers' },
                { label: 'Delete', action: 'deleteAdvertisers' },
            ]
        },
    },
    emits: [
        'update:modelValue',
        'eventHandler'
    ],
    mounted() {
        this.$nextTick(() => {
            this.value = {
                ...this.modelValue,
                status: Array.isArray(this.modelValue.status) ? this.modelValue.status : [],
                agreements_count: this.modelValue.agreements_count || null,
            };
        });
    },
    computed: {
        value: {
            set(val) {
                this.$emit('update:modelValue', val);
            },
            get() {
                return this.modelValue;
            },
        },
    },
    methods: {
        resetFilters() {
            this.value.search = '';
            this.value.status = [];
            this.value.agreements_count = null;
        },
    }
};
</script>