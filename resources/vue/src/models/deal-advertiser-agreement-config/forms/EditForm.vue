<template>

	<form :id="formId" @submit.prevent="onSubmit">

        <!-- PRIORITY -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="priority"
            label="Prioridad"
            validators="integer"
            v-model="config.payload.priority" />

        <!-- SCHEDULE -->
        <textarea-input-component
            :custom-class="inputClass"
            name="schedule"
            label="Horario"
            v-model="config.payload.schedule" />

        <!-- CAP PER DAY -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="cap_per_day"
            label="Cap por día"
            validators="integer"
            v-model="config.payload.cap_per_day" />

        <!-- CAP PER WEEK -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="cap_per_week"
            label="Cap por semana"
            validators="integer"
            v-model="config.payload.cap_per_week" />

        <!-- MAX CAP -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="max_cap"
            label="Cap máximo"
            validators="integer"
            v-model="config.payload.max_cap" />

        <!-- MONTHLY CAP -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="monthly_cap"
            label="Cap mensual"
            validators="integer"
            v-model="config.payload.monthly_cap" />

        <!-- DISTRIBUTION PER MINUTE -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="distribution_per_minute"
            label="Distribución por minuto"
            validators="integer"
            v-model="config.payload.distribution_per_minute" />

        <!-- DISTRIBUTION TYPE -->
        <select-input-component
            name="distribution_type"
            label="Tipo de distribución"
            validators="required"
            v-model="config.payload.distribution_type">
            <option value="even">Equitativa</option>
            <option value="burst">Explosiva</option>
            <option value="drip">Constante</option>
        </select-input-component>

        <!-- TARGET AUDIENCE -->
        <textarea-input-component
            :custom-class="inputClass"
            name="target_audience"
            label="Audiencia objetivo"
            v-model="config.payload.target_audience" />

        <!-- AUTO PAUSE THRESHOLD -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="auto_pause_threshold"
            label="Umbral para auto pausa"
            validators="integer"
            v-model="config.payload.auto_pause_threshold" />

        <!-- DEAL ADVERTISER AGREEMENT ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="deal_advertiser_agreement_id"
            label="ID del Acuerdo"
            validators="required"
            v-model="config.deal_advertiser_agreement_id" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />

	</form>

</template>

<script>

    import { showModel, updateModel } from '@models/deal-advertiser-agreement-config'
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
                default: 'editDealAdvertiserAgreementConfigForm'
            },
            configId: {
                type: [Number, String],
                required: true
            }
        },

        emits: ['submit'],

        data() {
            return {
                config: {
                    payload: {
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
                    },
                    deal_advertiser_agreement_id: '',
                },
                disabled: false,
                JSValidator: undefined,
            }
        },

        mounted() {
            this.fetchData();
            this.JSValidator = new JSValidator(this.formId).init();
            this.JSValidator.status = true;
        },

        methods: {

            fetchData() {
                showModel(this.configId).then(res => {
                    this.config = res;
                });
            },

            onSubmit() {
                if (this.JSValidator.status) {
                    this.disabled = true;
                    updateModel(this.config.id, {
                        priority: this.config.payload.priority,
                        schedule: this.config.payload.schedule,
                        cap_per_day: this.config.payload.cap_per_day,
                        cap_per_week: this.config.payload.cap_per_week,
                        max_cap: this.config.payload.max_cap,
                        monthly_cap: this.config.payload.monthly_cap,
                        distribution_per_minute: this.config.payload.distribution_per_minute,
                        distribution_type: this.config.payload.distribution_type,
                        target_audience: this.config.payload.target_audience,
                        auto_pause_threshold: this.config.payload.auto_pause_threshold,
                        deal_advertiser_agreement_id: this.config.deal_advertiser_agreement_id,
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
