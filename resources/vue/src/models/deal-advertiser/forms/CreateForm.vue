<template>
    <form :id="formId" @submit.prevent="onSubmit">

        <!-- AGENTE ASOCIADO -->
        <model-search-input-component 
            v-if="!advertiser.agent_id"
            custom-class="bg-gray-50 rounded-lg text-sm py-0.5"
            label-str="Buscar agente por cédula o nombre"
            placeholder-str="Escribe para buscar"
            :route="agentRoute"
            q="name"
            :get-option-label="option => `${option.name} (${option.code})`"
            @submit="setAgent" />

        <!-- NOMBRE LEGAL -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="legal_name"
            label="Nombre legal"
            validators="required length"
            :min_length="3"
            v-model="advertiser.payload.legal_name" />

        <!-- VAT NUMBER -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="vat_number"
            label="VAT / RFC / NIT"
            v-model="advertiser.payload.vat_number" />

        <!-- PAÍS -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="country"
            label="País de residencia fiscal"
            v-model="advertiser.payload.country" />

        <!-- MONEDA PREFERIDA -->
        <select-input-component
            :custom-class="inputClass"
            name="currency"
            label="Moneda preferida"
            v-model="advertiser.payload.currency">
            <option value="">Selecciona una moneda</option>
            <option value="MXN">MXN</option>
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
        </select-input-component>

        <!-- NOTAS -->
        <textarea-input-component
            :custom-class="inputClass"
            name="notes"
            label="Notas internas"
            placeholder="Notas sobre facturación, observaciones..."
            v-model="advertiser.payload.notes" />

        <!-- ÚLTIMA FACTURA -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="last_invoice_amount"
            label="Monto de última factura"
            validators="decimal"
            v-model="advertiser.payload.last_invoice_amount" />

        <text-input-component
            :custom-class="inputClass"
            type="date"
            name="last_invoice_date"
            label="Fecha de última factura"
            v-model="advertiser.payload.last_invoice_date" />

        <!-- ESTADO -->
        <select-input-component
            :custom-class="inputClass"
            validators="required"
            name="status"
            label="Estado del anunciante"
            v-model="advertiser.status">
            <option value="">Selecciona un estado</option>
            <option value="active">Activo</option>
            <option value="inactive">Inactivo</option>
            <option value="suspended">Suspendido</option>
            <option value="blacklisted">Lista negra</option>
        </select-input-component>

        <timezone-select-input-component
            custom-class="bg-gray-50 rounded-lg text-sm py-0.5"
            validators="required"
            name="timezone"
            label="Zona horaria"
            placeholder="Escribe para buscar una zona horaria"
            v-model="advertiser.payload.timezone" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            :value="buttonText" />

    </form>
</template>

<script>
import {
    TextInputComponent,
    TextareaInputComponent,
    SelectInputComponent,
    ModelSearchInputComponent,
    ButtonComponent
} from 'innoboxrr-form-elements'
import TimezoneSelectInputComponent from 'innoboxrr-form-elements/src/TimezoneSelectInputComponent.vue'

import { createModel } from '@dealsModels/deal-advertiser'

export default {
    components: {
        TextInputComponent,
        TextareaInputComponent,
        SelectInputComponent,
        ModelSearchInputComponent,
        TimezoneSelectInputComponent,
        ButtonComponent,
    },
    props: {
        formId: {
            type: String,
            default: 'createDealAdvertiserForm'
        },
        agentId: {
            type: [String, Number],
            default: null
        },
        buttonText: {
            type: String,
            default: 'Guardar'
        }
    },
    emits: ['submit'],
    data() {
        return {
            advertiser: {
                agent_id: this.agentId,
                status: '',
                payload: {
                    legal_name: '',
                    vat_number: '',
                    country: '',
                    currency: '',
                    notes: '',
                    timezone: null,
                    last_invoice_amount: null,
                    last_invoice_date: null
                }
            },
            disabled: false,
            buttonClass: '',
            agentRoute: route('api.agent.index')
        }
    },
    methods: {
        setAgent(agent) {
            this.advertiser.agent_id = agent.id
        },
        onSubmit() {
            this.disabled = true
            createModel({
                    status: this.advertiser.status,
                    ...this.advertiser.payload,
                    agent_id: this.advertiser.agent_id,
                })
                .then(res => {
                    this.$emit('submit', res)
                    setTimeout(() => { this.disabled = false }, 2500)
                })
                .catch(err => {
                    this.disabled = false
                })
        }
    }
}
</script>
