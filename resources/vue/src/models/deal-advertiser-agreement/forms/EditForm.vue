<template>
	
	<form :id="formId" @submit.prevent="onSubmit">

        <!-- STATUS -->
        <select-input-component
            name="status"
            label="Estatus"
            validators="required"
            v-model="agreement.status">
            <option value="draft">Borrador</option>
            <option value="active">Activo</option>
            <option value="paused">Pausado</option>
            <option value="pending_payment">Pago pendiente</option>
            <option value="cancelled">Cancelado</option>
            <option value="completed">Completado</option>
        </select-input-component>

        <!-- ESTIMATE CPL -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="estimate_cpl"
            label="CPL Estimado"
            validators="decimal"
            v-model="agreement.payload.estimate_cpl" />

        <!-- CONTRACT TERMS -->
        <textarea-input-component
            :custom-class="inputClass"
            name="contract_terms"
            label="Términos del contrato"
            v-model="agreement.payload.contract_terms" />

        <!-- COMPLETION NOTES -->
        <textarea-input-component
            :custom-class="inputClass"
            name="completion_notes"
            label="Notas al completar"
            v-model="agreement.payload.completion_notes" />

        <!-- PAUSE REASON -->
        <textarea-input-component
            :custom-class="inputClass"
            name="pause_reason"
            label="Motivo de pausa"
            v-model="agreement.payload.pause_reason" />

        <!-- BUDGET -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="budget"
            label="Presupuesto publicitario"
            validators="decimal"
            v-model="agreement.payload.budget" />

        <!-- BUDGET FEE -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="budget_fee"
            label="Comisión (30%)"
            validators="decimal"
            v-model="agreement.payload.budget_fee" />

        <!-- NET BUDGET -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="net_budget"
            label="Presupuesto neto"
            validators="decimal"
            v-model="agreement.payload.net_budget" />

        <!-- BUDGET SPENT -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="budget_spent"
            label="Presupuesto gastado"
            validators="decimal"
            v-model="agreement.payload.budget_spent" />

        <!-- MANAGEMENT FEE -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="management_fee"
            label="Costo de administración"
            validators="decimal"
            v-model="agreement.payload.management_fee" />

        <!-- AVERAGE CPL -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="average_cpl"
            label="CPL promedio"
            validators="decimal"
            v-model="agreement.payload.average_cpl" />

        <!-- MAX CPL -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="max_cpl"
            label="CPL máximo"
            validators="decimal"
            v-model="agreement.payload.max_cpl" />

        <!-- MIN CPL -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="min_cpl"
            label="CPL mínimo"
            validators="decimal"
            v-model="agreement.payload.min_cpl" />

        <!-- START DATE -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="start_date"
            label="Fecha de inicio"
            placeholder="YYYY-MM-DD"
            validators="required date"
            v-model="agreement.start_date" />

        <!-- END DATE -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="end_date"
            label="Fecha de término"
            placeholder="YYYY-MM-DD"
            validators="required date"
            v-model="agreement.end_date" />

        <!-- AUTORENEWAL -->
        <select-input-component
            name="autorenewal"
            label="Renovación automática"
            validators="required"
            v-model="agreement.autorenewal">
            <option :value="1">Sí</option>
            <option :value="0">No</option>
        </select-input-component>

        <!-- LEADS ASSIGNED -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="leads_assigned"
            label="Leads asignados"
            validators="integer"
            v-model="agreement.leads_assigned" />

        <!-- DEAL ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="deal_id"
            label="ID del Deal"
            validators="required"
            v-model="agreement.deal_id" />

        <!-- DEAL ADVERTISER ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="deal_advertiser_id"
            label="ID del Anunciante"
            validators="required"
            v-model="agreement.deal_advertiser_id" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />

    </form>

</template>

<script>

    import { showModel, updateModel } from '@models/deal-advertiser-agreement'
    import JSValidator from 'innoboxrr-js-validator'
    import {
        TextInputComponent,
        TextareaInputComponent,
        SelectInputComponent,
        ButtonComponent,
    } from 'innoboxrr-form-elements'

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
                default: 'editDealAdvertiserAgreementForm'
            },
            agreementId: {
                type: [Number, String],
                required: true
            }
        },

        emits: ['submit'],

        data() {
            return {
                agreement: {
                    status: '',
                    payload: {
                        estimate_cpl: '',
                        contract_terms: '',
                        completion_notes: '',
                        pause_reason: '',
                        budget: '',
                        budget_fee: '',
                        net_budget: '',
                        budget_spent: '',
                        management_fee: '',
                        average_cpl: '',
                        max_cpl: '',
                        min_cpl: '',
                    },
                    start_date: '',
                    end_date: '',
                    autorenewal: '',
                    leads_assigned: '',
                    deal_id: '',
                    deal_advertiser_id: '',
                },
                disabled: false,
                JSValidator: undefined,
            }
        },

        mounted() {
            this.fetchData()
            this.JSValidator = new JSValidator(this.formId).init()
            this.JSValidator.status = true
        },

        methods: {

            fetchData() {
                showModel(this.agreementId).then(res => {
                    this.agreement = res
                })
            },

            onSubmit() {
                if (this.JSValidator.status) {
                    this.disabled = true
                    updateModel(this.agreement.id, {
                        status: this.agreement.status,
                        estimate_cpl: this.agreement.payload.estimate_cpl,
                        contract_terms: this.agreement.payload.contract_terms,
                        completion_notes: this.agreement.payload.completion_notes,
                        pause_reason: this.agreement.payload.pause_reason,
                        budget: this.agreement.payload.budget,
                        budget_fee: this.agreement.payload.budget_fee,
                        net_budget: this.agreement.payload.net_budget,
                        budget_spent: this.agreement.payload.budget_spent,
                        management_fee: this.agreement.payload.management_fee,
                        average_cpl: this.agreement.payload.average_cpl,
                        max_cpl: this.agreement.payload.max_cpl,
                        min_cpl: this.agreement.payload.min_cpl,
                        start_date: this.agreement.start_date,
                        end_date: this.agreement.end_date,
                        autorenewal: this.agreement.autorenewal,
                        leads_assigned: this.agreement.leads_assigned,
                        deal_id: this.agreement.deal_id,
                        deal_advertiser_id: this.agreement.deal_advertiser_id,
                    }).then(res => {
                        this.$emit('submit', res)
                        setTimeout(() => { this.disabled = false }, 2500)
                    }).catch(error => {
                        this.disabled = false
                        if (error?.response?.status === 422)
                            this.JSValidator.appendExternalErrors(error.response.data.errors)
                    })
                } else {
                    this.disabled = false
                }
            }
        }
	}
</script>
