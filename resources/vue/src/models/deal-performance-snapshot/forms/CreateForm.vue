<template>

    <form :id="formId" @submit.prevent="onSubmit">

        <!-- DEAL ID -->
        <text-input-component
            :custom-class="inputClass"
            name="deal_id"
            label="ID del Deal"
            validators="required"
            v-model="deal_id" />

        <!-- TIME -->
        <text-input-component
            :custom-class="inputClass"
            name="time"
            label="Fecha / Hora"
            placeholder="YYYY-MM-DD HH:mm:ss"
            validators="required"
            v-model="time" />

        <!-- LEADS GENERATED -->
        <text-input-component
            :custom-class="inputClass"
            name="leads_generated"
            label="Leads generados"
            type="number"
            validators="integer"
            v-model="leads_generated" />

        <!-- LEADS ASSIGNED -->
        <text-input-component
            :custom-class="inputClass"
            name="leads_assigned"
            label="Leads asignados"
            type="number"
            validators="integer"
            v-model="leads_assigned" />

        <!-- AVG CPL -->
        <text-input-component
            :custom-class="inputClass"
            name="avg_cpl"
            label="CPL promedio"
            type="number"
            validators="decimal"
            v-model="avg_cpl" />

        <!-- AVG CONVERSION RATE -->
        <text-input-component
            :custom-class="inputClass"
            name="avg_conversion_rate"
            label="Tasa de conversión promedio"
            type="number"
            validators="decimal"
            v-model="avg_conversion_rate" />

        <!-- AVG ROI -->
        <text-input-component
            :custom-class="inputClass"
            name="avg_roi"
            label="ROI promedio"
            type="number"
            validators="decimal"
            v-model="avg_roi" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />

    </form>

</template>

<script>

    import { createModel } from '@dealsModels/deal-performance-snapshot'
    import JSValidator from 'innoboxrr-js-validator'
    import {
        TextInputComponent,
        ButtonComponent,
    } from 'innoboxrr-form-elements'

    export default {

        components: {
            TextInputComponent,
            ButtonComponent,
        },

        props: {
            formId: {
                type: String,
                default: 'createDealPerformanceSnapshotForm',
            }
        },

        emits: ['submit'],

        data() {
            return {
                deal_id: '',
                time: '',
                leads_generated: '',
                leads_assigned: '',
                avg_cpl: '',
                avg_conversion_rate: '',
                avg_roi: '',
                disabled: false,
                JSValidator: undefined,
            }
        },

        mounted() {
            this.JSValidator = new JSValidator(this.formId).init()
        },

        methods: {
            onSubmit() {
                if (this.JSValidator.status) {
                    this.disabled = true
                    createModel({
                        deal_id: this.deal_id,
                        time: this.time,
                        leads_generated: this.leads_generated,
                        leads_assigned: this.leads_assigned,
                        avg_cpl: this.avg_cpl,
                        avg_conversion_rate: this.avg_conversion_rate,
                        avg_roi: this.avg_roi,
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
