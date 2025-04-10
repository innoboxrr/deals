<template>
	
	<form :id="formId" @submit.prevent="onSubmit">

        <!-- PRIORITY -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="priority"
            label="Prioridad"
            validators="integer"
            v-model="priority" />

        <!-- SCHEDULE -->
        <textarea-input-component
            :custom-class="inputClass"
            name="schedule"
            label="Horario"
            v-model="schedule" />

        <!-- CAP PER DAY -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="cap_per_day"
            label="Cap por día"
            validators="integer"
            v-model="cap_per_day" />

        <!-- CAP PER WEEK -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="cap_per_week"
            label="Cap por semana"
            validators="integer"
            v-model="cap_per_week" />

        <!-- MAX CAP -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="max_cap"
            label="Cap máximo"
            validators="integer"
            v-model="max_cap" />

        <!-- MONTHLY CAP -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="monthly_cap"
            label="Cap mensual"
            validators="integer"
            v-model="monthly_cap" />

        <!-- DISTRIBUTION PER MINUTE -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="distribution_per_minute"
            label="Distribución por minuto"
            validators="integer"
            v-model="distribution_per_minute" />

        <!-- DISTRIBUTION TYPE -->
        <select-input-component
            name="distribution_type"
            label="Tipo de distribución"
            validators="required"
            v-model="distribution_type">
            <option value="even">Equitativa</option>
            <option value="burst">Explosiva</option>
            <option value="drip">Constante</option>
        </select-input-component>

        <!-- TARGET AUDIENCE -->
        <textarea-input-component
            :custom-class="inputClass"
            name="target_audience"
            label="Audiencia objetivo"
            v-model="target_audience" />

        <!-- AUTO PAUSE THRESHOLD -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="auto_pause_threshold"
            label="Umbral para auto pausa"
            validators="integer"
            v-model="auto_pause_threshold" />

        <!-- DEAL ADVERTISER AGREEMENT ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="deal_advertiser_agreement_id"
            label="ID del Acuerdo"
            validators="required"
            v-model="deal_advertiser_agreement_id" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />

    </form>

</template>

<script>

    import { createModel } from '@dealsModels/deal-advertiser-agreement-config'
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
        		default: 'createDealAdvertiserAgreementConfigForm',
        	}
        },

        emits: ['submit'],

        data() {
            return {
                priority: '',
                schedule: '',
                cap_per_day: '',
                cap_per_week: '',
                max_cap: '',
                monthly_cap: '',
                distribution_per_minute: '',
                distribution_type: '',
                target_audience: '',
                auto_pause_threshold: '',
                deal_advertiser_agreement_id: '',
                disabled: false,
                JSValidator: undefined,
            }
        },

        mounted() {
            this.JSValidator = new JSValidator(this.formId).init();
        },

        methods: {
            onSubmit() {
                if (this.JSValidator.status) {
                    this.disabled = true;
                    createModel({
                        priority: this.priority,
                        schedule: this.schedule,
                        cap_per_day: this.cap_per_day,
                        cap_per_week: this.cap_per_week,
                        max_cap: this.max_cap,
                        monthly_cap: this.monthly_cap,
                        distribution_per_minute: this.distribution_per_minute,
                        distribution_type: this.distribution_type,
                        target_audience: this.target_audience,
                        auto_pause_threshold: this.auto_pause_threshold,
                        deal_advertiser_agreement_id: this.deal_advertiser_agreement_id,
                    }).then(res => {
                        this.$emit('submit', res);
                        setTimeout(() => { this.disabled = false }, 2500);
                    }).catch(error => {
                        this.disabled = false;
                        if (error?.response?.status === 422)
                            this.JSValidator.appendExternalErrors(error.response.data.errors);
                    });
                } else {
                    this.disabled = false;
                }
            }
        }
	}
</script>
