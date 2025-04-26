<template>
    <div>
        <!-- Título y Botón de Crear Gateway -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-4">
            <h3 class="text-lg font-semibold mb-2">
                {{ __deals('Gateways assigned') }}
            </h3>
            <button 
                @click="toggleCreateForm" 
                type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                + Crear Gateway
            </button>
        </div>

        <!-- Formulario de creación oculto/visible -->
        <div 
            v-show="showCreateForm" 
            class="px-4 md:px-8 lg:px-16">
            <CreateForm
                :deal-id="localDeal.id"
                @submit="dealAssignmentFormSubmit" />
        </div>

        <!-- Tabla de gateways asignados -->
        <section class="dark:bg-gray-900">
            <div class="bg-white dark:bg-gray-800 relative sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-4 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    {{ __deals('Name') }}
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    {{ __deals('GType') }}
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    {{ __deals('GID') }}
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    {{ __deals('Status') }}
                                </th>
                                <th scope="col" class="px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr 
                                v-for="gateway in gateways" 
                                :key="gateway.id" 
                                class="border-b dark:border-gray-700">
                                <td class="px-4 py-3">
                                    {{ gateway.id }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ gateway.name }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ gateway.gateway_type }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ gateway.gateway_id }}
                                </td>
                                <td class="px-4 py-3">
                                    <span 
                                        v-if="gateway.status === 'active'" 
                                        class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        Activo
                                    </span>
                                    <span 
                                        v-else-if="gateway.status === 'inactive'"
                                        class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        Inactivo
                                    </span>
                                    <span 
                                        v-else-if="gateway.status === 'pending'"
                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        Pendiente
                                    </span>
                                </td>
                                <td class="px-4 py-3 flex items-center space-x-2">
                                    <button @click="showGateway(gateway)" class="text-blue-500 hover:text-blue-700">
                                        <i class="ml-4 fas fa-eye"></i>
                                    </button>
                                    <button @click="editGateway(gateway)" class="text-yellow-500 hover:text-yellow-700">
                                        <i class="ml-4 fas fa-edit"></i>
                                    </button>
                                    <button @click="deleteGateway(gateway)" class="text-red-600 hover:text-red-800">
                                        <i class="ml-4 fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Modal de edición -->
        <div 
            v-if="gateway"
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-50 overflow-y-auto p-4">
            
            <div class="relative w-full max-w-2xl bg-white rounded-lg dark:bg-gray-800 shadow-lg overflow-hidden max-h-[90vh] flex flex-col">
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ mode === 'edit' ? __deals('Edit Gateway') : __deals('View Gateway') }}
                    </h3>
                    <button 
                        @click="closeModal" 
                        type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-6 overflow-y-auto">
                    <EditForm
                        v-if="mode === 'edit'"
                        :deal-id="localDeal.id"
                        :deal-gateway-id="gateway.id"
                        @submit="dealAssignmentFormSubmit" />
                    <GatewayModelProfile
                        v-else-if="mode === 'show'"
                        :deal-gateway-id="gateway.id" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CreateForm from '@dealsModels/deal-gateway/forms/CreateForm.vue'
    import EditForm from '@dealsModels/deal-gateway/forms/EditForm.vue'
    import GatewayModelProfile from '@dealsModels/deal-gateway/widgets/ModelProfile.vue'
    import { 
        indexModel as indexDealGateway,
        deleteModel as deleteDealGateway 
    } from '@dealsModels/deal-gateway'

    export default {
        name: 'StepGateway',
        components: {
            CreateForm,
            EditForm,
            GatewayModelProfile,
        },
        props: {
            modelValue: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                gateways: [],
                showCreateForm: false,
                gateway: null,
                mode: 'create',
            }
        },
        async mounted() {
            await this.fetchData();
            this.$emit('validated', true);
        },
        computed: {
            localDeal: {
                get() {
                    return this.modelValue
                },
                set(value) {
                    this.$emit('update:modelValue', value)
                }
            }
        },
        methods: {
            async fetchData() {
                await this.fetchGateways();
            },
            async fetchGateways() {
                let res = await indexDealGateway({
                    paginate: 0,
                    deal_id: this.localDeal.id,
                });
                this.gateways = res;
            },
            toggleCreateForm() {
                this.showCreateForm = !this.showCreateForm;
                this.gateway = null;
                this.mode = 'create';
            },
            async dealAssignmentFormSubmit(deal) {
                await this.fetchGateways();
                this.localDeal = deal;
                this.showCreateForm = false;
                this.gateway = null;
                this.$emit('validated', true);
            },
            deleteGateway(gateway) {
                deleteDealGateway(gateway).then(() => {
                    this.fetchGateways();
                    this.gateways = this.gateways.filter(g => g.id !== id);
                    this.$emit('validated', true);
                });
            },
            editGateway(gateway) {
                this.gateway = gateway;
                this.mode = 'edit';
            },
            closeModal() {
                this.gateway = null;
            },
            showGateway(gateway) {
                this.gateway = gateway;
                this.mode = 'show';
            },
            getGatewayType(type) {
                switch (type) {
                    case 'landing': return 'Landing';
                    case 'form': return 'Formulario';
                    case 'endpoint': return 'Endpoint';
                    default: return 'Otro';
                }
            }
        }
    }
</script>