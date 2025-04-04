<template>
	
	<form :id="formId" @submit.prevent="onSubmit">      

        <!-- DEAL AD CAMPAIGN ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="deal_ad_campaign_id"
            label="Campaña"
            placeholder="ID de campaña"
            validators="required"
            v-model="deal_ad_campaign_id" />

        <!-- CONDITION TYPE -->
        <select-input-component
            name="condition_type"
            label="Condición"
            validators="required"
            v-model="condition_type">
            <option value="cost_per_lead_greater_than">Costo por lead mayor a</option>
            <option value="conversion_rate_lower_than">Tasa de conversión menor a</option>
            <option value="click_through_rate_lower_than">CTR menor a</option>
            <option value="impressions_lower_than">Impresiones menores a</option>
            <option value="spent_amount_greater_than">Gasto mayor a</option>
            <option value="total_conversions_greater_than">Conversiones mayores a</option>
        </select-input-component>

        <!-- VALUE -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="value"
            label="Valor de comparación"
            placeholder="Ej. 10"
            validators="required decimal"
            v-model="value" />

        <!-- ACTION -->
        <select-input-component
            name="action"
            label="Acción"
            validators="required"
            v-model="action">
            <option value="pause">Pausar</option>
            <option value="notify">Notificar</option>
            <option value="increase_budget">Aumentar presupuesto</option>
            <option value="decrease_budget">Reducir presupuesto</option>
            <option value="change_bid">Cambiar puja</option>
            <option value="optimize_for_conversions">Optimizar para conversiones</option>
        </select-input-component>

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />

    </form>

</template>

<script>

    import { createModel } from '@models/deal-ad-campaign-rule'
    import JSValidator from 'innoboxrr-js-validator'
    import {
        TextInputComponent,
        SelectInputComponent,
        ButtonComponent,
    } from 'innoboxrr-form-elements'

	export default {

        components: {
            TextInputComponent,
            SelectInputComponent,
            ButtonComponent,
        },

        props: {
        	formId: {
        		type: String,
        		default: 'createDealAdCampaignRuleForm',
        	}
        },

        emits: ['submit'],

        data() {
            return {
                deal_ad_campaign_id: '',
                condition_type: '',
                value: '',
                action: '',
                disabled: false,
                JSValidator: undefined,
            }
        },

        mounted() {
            this.JSValidator = new JSValidator(this.formId).init();
        },

        methods: {
            onSubmit() {
                if(this.JSValidator.status) {
                    this.disabled = true;
                    createModel({
                        deal_ad_campaign_id: this.deal_ad_campaign_id,
                        condition_type: this.condition_type,
                        value: this.value,
                        action: this.action,
                    }).then(res => {
                        this.$emit('submit', res);
                        setTimeout(() => { this.disabled = false; }, 2500);
                    }).catch(error => {
                        this.disabled = false;
                        if(error.response?.status == 422)
                            this.JSValidator.appendExternalErrors(error.response.data.errors);
                    });
                } else {
                    this.disabled = false;
                }
            }
        }
	}
</script>
