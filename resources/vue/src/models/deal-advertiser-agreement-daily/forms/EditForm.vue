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
            v-model="daily.date" />

        <!-- START HOUR -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="start_hour"
            label="Hora de inicio"
            placeholder="HH:mm"
            validators="required"
            v-model="daily.start_hour" />

        <!-- END HOUR -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="end_hour"
            label="Hora de término"
            placeholder="HH:mm"
            validators="required"
            v-model="daily.end_hour" />

        <!-- CPL -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="cpl"
            label="CPL"
            validators="decimal"
            v-model="daily.cpl" />

        <!-- BUDGET -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="budget"
            label="Presupuesto"
            validators="decimal"
            v-model="daily.budget" />

        <!-- SPENT -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="spent"
            label="Gastado"
            validators="decimal"
            v-model="daily.spent" />

        <!-- LEADS ASSIGNED -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="leads_assigned"
            label="Leads asignados"
            validators="integer"
            v-model="daily.leads_assigned" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />

    </form>

</template>

<script>

    import { showModel, updateModel } from '@dealsModels/deal-advertiser-agreement-daily'
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
                default: 'editDealAdvertiserAgreementDailyForm'
            },
            dailyId: {
                type: [Number, String],
                required: true
            }
        },

        emits: ['submit'],

        data() {
            return {
                daily: {
                    date: '',
                    start_hour: '',
                    end_hour: '',
                    cpl: '',
                    budget: '',
                    spent: '',
                    leads_assigned: '',
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
                showModel(this.dailyId).then(res => {
                    this.daily = res
                })
            },

            onSubmit() {
                if (this.JSValidator.status) {
                    this.disabled = true
                    updateModel(this.daily.id, {
                        date: this.daily.date,
                        start_hour: this.daily.start_hour,
                        end_hour: this.daily.end_hour,
                        cpl: this.daily.cpl,
                        budget: this.daily.budget,
                        spent: this.daily.spent,
                        leads_assigned: this.daily.leads_assigned,
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
