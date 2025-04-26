<template>
    <div v-if="dataLoaded" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    {{ __deals('Information') }}
                </h5>
                <ul class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                    <li>
                        <span class="font-medium">{{ __deals('Name') }}:</span> {{ localDealGateway.name }}
                    </li>
                    <li>
                        <span class="font-medium">{{ __deals('Type') }}:</span> {{ formatGatewayType(localDealGateway.gateway_type) }}
                    </li>
                    <li>
                        <span class="font-medium">{{ __deals('Status') }}: &nbsp;</span>
                        <span
                            :class="{
                                'text-green-600 font-semibold': localDealGateway.status === 'active',
                                'text-red-600 font-semibold': localDealGateway.status === 'inactive',
                                'text-yellow-600 font-semibold': localDealGateway.status === 'pending',
                            }">
                            {{ localDealGateway.status }}
                        </span>
                    </li>
                    <li>
                        <span class="font-medium">{{ __deals('Created') }}:</span> {{ formatDate(localDealGateway.created_at) }}
                    </li>
                    <li>
                        <span class="font-medium">{{ __deals('Updated') }}:</span> {{ formatDate(localDealGateway.updated_at) }}
                    </li>
                </ul>
            </div>
            <div v-if="localDealGateway.gateway" class="p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    {{ __deals('Details') }}
                </h5>
                <ul class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                    <li>
                        <span class="font-medium">{{ __deals('Name') }}:</span> {{ localDealGateway.gateway.name }}
                    </li>
                    <li>
                        <span class="font-medium">{{ __deals('Views') }}:</span> {{ localDealGateway.gateway.views }}
                    </li>
                    <li>
                        <span class="font-medium">{{ __deals('Registrations') }}:</span> {{ localDealGateway.gateway.registrations }}
                    </li>
                    <li>
                        <span class="font-medium">{{ __deals('Conversions') }}:</span> {{ localDealGateway.gateway.conversions }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>


<script>
    import { showModel } from '@dealsModels/deal-gateway'

    export default {
        props: {
            dealGateway: {
                type: Object,
                required: false,
            },
            dealGatewayId: {
                type: [Number, String],
                required: false
            }
        },
        data() {
            return {
                dataLoaded: false,
                localDealGateway: null,
            }
        },
        created() {
            if (!this.dealGateway && !this.dealGatewayId) {
                console.error("Se debe proporcionar 'dealGateway' o 'dealGatewayId'.");
            }
        },
        mounted() {
            if (!this.dealGateway && this.dealGatewayId) {
                this.fetchDealGateway();
            } else {
                this.localDealGateway = this.dealGateway;
                this.dataLoaded = true;
            }
        },
        methods: {
            async fetchDealGateway() {
                let res = await showModel(this.dealGatewayId, ['gateway']);
                this.localDealGateway = res;
                this.dataLoaded = true;
            },
            formatDate(date) {
                return new Date(date).toLocaleString();
            },
            formatGatewayType(type) {
                if (!type) return 'Desconocido';
                if (type.includes('Landing')) return 'Landing';
                if (type.includes('Form')) return 'Formulario';
                if (type.includes('Endpoint')) return 'Endpoint';
                return type.split('\\').pop();
            },
        }
    }
</script>
