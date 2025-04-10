<template>

    <form :id="formId" @submit.prevent="onSubmit">

        <!-- DEAL ID -->
        <text-input-component
            :custom-class="inputClass"
            name="deal_id"
            label="ID del Deal"
            validators="required"
            v-model="snapshot.deal_id" />

        <!-- TIME -->
        <text-input-component
            :custom-class="inputClass"
            name="time"
            label="Fecha / Hora"
            placeholder="YYYY-MM-DD HH:mm:ss"
            validators="required"
            v-model="snapshot.time" />

        <!-- LEADS GENERATED -->
        <text-input-component
            :custom-class="inputClass"
            name="leads_generated"
            label="Leads generados"
            type="number"
            validators="integer"
            v-model="snapshot.leads_generated" />

        <!-- LEADS ASSIGNED -->
        <text-input-component
            :custom-class="inputClass"
            name="leads_assigned"
            label="Leads asignados"
            type="number"
            validators="integer"
            v-model="snapshot.leads_assigned" />

        <!-- AVG CPL -->
        <text-input-component
            :custom-class="inputClass"
            name="avg_cpl"
            label="CPL promedio"
            type="number"
            validators="decimal"
            v-model="snapshot.avg_cpl" />

        <!-- AVG CONVERSION RATE -->
        <text-input-component
            :custom-class="inputClass"
            name="avg_conversion_rate"
            label="Tasa de conversión promedio"
            type="number"
            validators="decimal"
            v-model="snapshot.avg_conversion_rate" />

        <!-- AVG ROI -->
        <text-input-component
            :custom-class="inputClass"
            name="avg_roi"
            label="ROI promedio"
            type="number"
            validators="decimal"
            v-model="snapshot.avg_roi" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />

    </form>

</template>

<script>

    import { showModel, updateModel } from '@dealsModels/deal-performance-snapshot'
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
                default: 'editDealPerformanceSnapshotForm'
            },
            snapshotId: {
                type: [Number, String],
                required: true
            }
        },

        emits: ['submit'],

        data() {
            return {
                snapshot: {
                    deal_id: '',
                    time: '',
                    leads_generated: '',
                    leads_assigned: '',
                    avg_cpl: '',
                    avg_conversion_rate: '',
                    avg_roi: '',
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
                showModel(this.snapshotId).then(res => {
                    this.snapshot = res
                })
            },

            onSubmit() {
                if (this.JSValidator.status) {
                    this.disabled = true
                    updateModel(this.snapshot.id, {
                        deal_id: this.snapshot.deal_id,
                        time: this.snapshot.time,
                        leads_generated: this.snapshot.leads_generated,
                        leads_assigned: this.snapshot.leads_assigned,
                        avg_cpl: this.snapshot.avg_cpl,
                        avg_conversion_rate: this.snapshot.avg_conversion_rate,
                        avg_roi: this.snapshot.avg_roi,
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
