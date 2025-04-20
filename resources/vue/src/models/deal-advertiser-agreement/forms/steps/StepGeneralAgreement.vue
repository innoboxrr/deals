<template>
    <div class="space-y-6">

        <!-- DEAL CONFIGURATION -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.deal = !collapsed.deal">
                <span class="text-sm font-semibold">
                    Agreement Configuration
                </span>
                <i :class="['fa-solid', collapsed.deal ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.deal" class="p-4 space-y-4">
                <model-search-input-component 
                    custom-class="bg-gray-50 rounded-lg text-sm py-0.5 border border-gray-300"
                    label-str="Buscar Deal por nombre o ID"
                    placeholder-str="Escribe para buscar"
                    :route="dealRoute"
                    q="name"
                    :externalFilters="{
                        include_advertisers: true,
                        only_active: true,
                        skip_workspace_filter: true,
                    }"
                    :get-option-label="option => `${option.name} (ID: ${option.id})`"
                    @submit="setDeal" />

                <!-- Status -->
                <select-input-component
                    :custom-class="inputClass"
                    name="status"
                    label="Estado"
                    validators="required"
                    v-model="localAgreement.status">
                    <option value="active">Activo</option>
                    <option value="inactive">Inactivo</option>
                    <option value="pending">Pendiente</option>
                    <option value="suspended">Suspendido</option>
                    <option value="deleted">Eliminado</option>
                    <option value="archived">Archivado</option>
                    <option value="expired">Expirado</option>
                    <option value="blocked">Bloqueado</option>
                    <option value="draft">Borrador</option>
                    <option value="completed">Completado</option>
                </select-input-component>

                <div class="flex gap-x-2 items-end">
                    <div class="flex-1">
                        <text-input-component
                            :custom-class="inputClass"
                            type="text"
                            name="token"
                            :help="__deals('If you want to assign a lead directly, overriding the distribution process, the lead must be submitted with this token.')"
                            label="Token de asignación directa"
                            placeholder="Autogenerado si lo deseas"
                            validators="required length"
                            :min_length="6"
                            v-model="localAgreement.payload.general.direct_assignment_token" />
                    </div>

                    <!-- Botón alineado a la base -->
                    <div class="-mb-1.5">
                        <button-component
                            :custom-class="buttonClass + ' px-3 py-2 -mb-0.5'"
                            value="Generar"
                            @click="generateToken" />
                    </div>
                </div>
            </div>
        </div>

        <!-- GENERAL SETTINGS -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.general = !collapsed.general">
                <span class="text-sm font-semibold">General Settings</span>
                <i :class="['fa-solid', collapsed.general ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.general" class="p-4 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 -mb-4">
					<div>
						<text-input-component
							:custom-class="inputClass"
							type="date"
							name="start_date"
							label="Fecha de inicio"
							validators="required"
							v-model="localAgreement.payload.general.start_date" />
					</div>
					<div>
						<text-input-component
							:custom-class="inputClass"
							type="date"
							name="end_date"
							label="Fecha de finalización"
							validators="required"
							v-model="localAgreement.payload.general.end_date" />
					</div>
                </div>

                <timezone-select-input-component 
                    custom-class="bg-gray-50 rounded-lg text-sm py-0.5 border border-gray-300"
                    name="timezone" 
                    label="Zona horaria" 
                    v-model="localAgreement.payload.general.timezone" />

                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="duplicate_lead_time"
                    label="Tiempo para considerar un lead como duplicado (days)"
                    placeholder="Ej: 30"
                    validators="integer"
                    v-model="localAgreement.payload.general.duplicate_lead_time" />

                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="lead_id_prefix"
                    label="Prefijo para IDs de leads"
                    placeholder="Ej: AGMT-"
                    v-model="localAgreement.payload.general.lead_id_prefix" />

                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="default_country"
                    label="País por defecto"
                    placeholder="Ej: México"
                    v-model="localAgreement.payload.general.default_country" />
            </div>
        </div>

        <!-- LEGAL -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.legal = !collapsed.legal">
                <span class="text-sm font-semibold">Legal & Notes</span>
                <i :class="['fa-solid', collapsed.legal ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.legal" class="p-4 space-y-4">
                <textarea-input-component
                    :custom-class="inputClass"
                    name="contract_terms"
                    label="Términos del contrato"
                    validators="required length"
                    :min_length="3"
                    v-model="localAgreement.payload.general.contract_terms" />

                <textarea-input-component
                    :custom-class="inputClass"
                    name="completion_notes"
                    label="Notas de finalización"
                    v-model="localAgreement.payload.general.completion_notes" />
            </div>
        </div>

    </div>
</template>

<script>
import {
    TextInputComponent,
    TextareaInputComponent,
    TimezoneSelectInputComponent,
    ModelSearchInputComponent,
    SelectInputComponent,
    ButtonComponent
} from 'innoboxrr-form-elements'

export default {
    name: 'StepGeneralAgreement',
    components: {
        TextInputComponent,
        TextareaInputComponent,
        TimezoneSelectInputComponent,
        ModelSearchInputComponent,
        SelectInputComponent,
        ButtonComponent
    },
    props: {
        modelValue: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            dealRoute: route('api.innoboxrr.deals.deal.index'),
            collapsed: {
                deal: false,
                general: false,
                legal: true
            }
        }
    },
    computed: {
        localAgreement: {
            get() {
                return this.modelValue
            },
            set(val) {
                this.$emit('update:modelValue', val)
            }
        }
    },
    watch: {
        localAgreement: {
            handler(val) {
                const general = val.payload?.general
                const valid =
                    val.deal_id &&
                    general?.start_date &&
                    general?.end_date &&
                    (general?.contract_terms?.length || 0) >= 3

                this.$emit('validated', valid)
            },
            deep: true,
            immediate: true
        }
    },
    methods: {
        setDeal(dealId) {
            this.localAgreement.deal_id = dealId
        },
        generateToken() {
			const token = crypto.randomUUID().replace(/-/g, '');
			this.localAgreement.payload.general.direct_assignment_token = token;
		}
    }
}
</script>