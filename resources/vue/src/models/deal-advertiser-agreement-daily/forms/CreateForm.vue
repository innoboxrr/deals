<template>

    <form :id="formId" @submit.prevent="onSubmit">

        <!-- DATE -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="date"
            label="Fecha"
            placeholder="YYYY-MM-DD"
            validators="required date"
            v-model="date" />

        <!-- START HOUR -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="start_hour"
            label="Hora de inicio"
            placeholder="HH:mm"
            validators="required"
            v-model="start_hour" />

        <!-- END HOUR -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="end_hour"
            label="Hora de término"
            placeholder="HH:mm"
            validators="required"
            v-model="end_hour" />

        <!-- CPL -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="cpl"
            label="CPL"
            validators="decimal"
            v-model="cpl" />

        <!-- BUDGET -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="budget"
            label="Presupuesto"
            validators="decimal"
            v-model="budget" />

        <!-- SPENT -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="spent"
            label="Gastado"
            validators="decimal"
            v-model="spent" />

        <!-- LEADS ASSIGNED -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="leads_assigned"
            label="Leads asignados"
            validators="integer"
            v-model="leads_assigned" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />

    </form>

</template>

<script>

    import { createModel } from '@models/deal-advertiser-agreement-daily'
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
        		default: 'createDealAdvertiserAgreementDailyForm',
        	}
        },

        emits: ['submit'],

        data() {
            return {
                date: '',
                start_hour: '',
                end_hour: '',
                cpl: '',
                budget: '',
                spent: '',
                leads_assigned: '',
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
                    this.disabled = true;
                    createModel({
                        date: this.date,
                        start_hour: this.start_hour,
                        end_hour: this.end_hour,
                        cpl: this.cpl,
                        budget: this.budget,
                        spent: this.spent,
                        leads_assigned: this.leads_assigned,
                    }).then(res => {
                        this.$emit('submit', res)
                        setTimeout(() => { this.disabled = false }, 2500)
                    }).catch(error => {
                        this.disabled = false
                        if (error?.response?.status === 422)
                            this.JSValidator.appendExternalErrors(error.response.data.errors)
                    });
                } else {
                    this.disabled = false
                }
            }
        }
	}
</script>
