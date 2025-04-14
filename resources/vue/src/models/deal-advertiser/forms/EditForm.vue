<template>
    <form :id="formId" @submit.prevent="onSubmit">

        <!-- AGENTE (solo lectura si ya tiene asociado) -->
        <div v-if="advertiser.agent_id">
            <p class="text-sm text-gray-500 mb-2">Agente asociado</p>
            <p class="font-semibold">ID: {{ advertiser.agent_id }}</p>
        </div>

        <!-- NOMBRE LEGAL -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="legal_name"
            label="Nombre legal"
            validators="required length"
            :min_length="3"
            v-model="advertiser.payload.legal_name" />

        <!-- VAT / RFC / NIT -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="vat_number"
            label="Identificación fiscal (VAT / RFC / NIT)"
            v-model="advertiser.payload.vat_number" />

        <!-- PAÍS DE RESIDENCIA FISCAL -->
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

        <!-- NOTAS INTERNAS -->
        <textarea-input-component
            :custom-class="inputClass"
            name="notes"
            label="Notas internas"
            placeholder="Notas sobre facturación u observaciones administrativas"
            v-model="advertiser.payload.notes" />

        <!-- INFORMACIÓN DE LA ÚLTIMA FACTURA -->
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

        <!-- ESTADO DEL ANUNCIANTE -->
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

        <!-- BOTÓN DE GUARDAR -->
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
        ButtonComponent
    } from 'innoboxrr-form-elements'

    import { updateModel, showModel } from '@dealsModels/deal-advertiser'

    export default {
        components: {
            TextInputComponent,
            TextareaInputComponent,
            SelectInputComponent,
            ButtonComponent,
        },
        props: {
            formId: {
                type: String,
                default: 'editDealAdvertiserForm'
            },
            advertiserId: {
                type: [String, Number],
                required: true
            },
            buttonText: {
                type: String,
                default: 'Actualizar'
            }
        },
        emits: ['submit'],
        data() {
            return {
                advertiser: {
                    id: null,
                    agent_id: null,
                    status: '',
                    payload: {
                        legal_name: '',
                        vat_number: '',
                        country: '',
                        currency: '',
                        notes: '',
                        last_invoice_amount: null,
                        last_invoice_date: null
                    }
                },
                disabled: false,
                inputClass: 'mb-4',
                buttonClass: ''
            }
        },
        mounted() {
            this.fetchAdvertiser()
        },
        methods: {
            fetchAdvertiser() {
                showModel(this.advertiserId).then(res => {
                    this.advertiser = res
                })
            },
            onSubmit() {
                this.disabled = true
                updateModel(this.advertiser.id, {
                    status: this.advertiser.status,
                    ...this.advertiser.payload,
                })
                    .then(res => {
                        this.$emit('submit', res)
                        setTimeout(() => { this.disabled = false }, 2500)
                    })
                    .catch(() => {
                        this.disabled = false
                    })
            }
        }
    }
</script>
