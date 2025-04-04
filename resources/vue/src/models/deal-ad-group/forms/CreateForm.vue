<template>
	
	<form :id="formId" @submit.prevent="onSubmit">

        <!-- NAME -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="name"
            label="Nombre"
            placeholder="Nombre del grupo"
            validators="required length"
            :min_length="3"
            v-model="name" />

        <!-- DESCRIPTION -->
        <textarea-input-component
            :custom-class="inputClass"
            name="description"
            label="Descripción"
            placeholder="Descripción del grupo"
            validators="required length"
            :min_length="3"
            v-model="description" />

        <!-- PLATFORM ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="platform_id"
            label="Plataforma"
            validators="required"
            v-model="platform_id" />

        <!-- STATUS -->
        <select-input-component
            name="status"
            label="Estatus"
            validators="required"
            v-model="status">
            <option value="draft">Borrador</option>
            <option value="active">Activo</option>
            <option value="paused">Pausado</option>
            <option value="ended">Finalizado</option>
        </select-input-component>

        <!-- START DATE -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="start_date"
            label="Fecha de inicio"
            placeholder="YYYY-MM-DD"
            validators="required date"
            v-model="start_date" />

        <!-- END DATE -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="end_date"
            label="Fecha de término"
            placeholder="YYYY-MM-DD"
            validators="required date"
            v-model="end_date" />

        <!-- BUDGET -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="budget"
            label="Presupuesto"
            placeholder="Ej. 1000"
            validators="required decimal"
            v-model="budget" />

        <!-- SPENT AMOUNT -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="spent_amount"
            label="Gasto"
            validators="decimal"
            v-model="spent_amount" />

        <!-- TARGET AUDIENCE -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="target_audience"
            label="Audiencia objetivo"
            v-model="target_audience" />

        <!-- TOTAL IMPRESSIONS -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="total_impressions"
            label="Impresiones"
            validators="integer"
            v-model="total_impressions" />

        <!-- TOTAL CLICKS -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="total_clicks"
            label="Clicks"
            validators="integer"
            v-model="total_clicks" />

        <!-- CPC -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="cpc"
            label="Costo por click (CPC)"
            validators="decimal"
            v-model="cpc" />

        <!-- CPM -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="cpm"
            label="Costo por mil (CPM)"
            validators="decimal"
            v-model="cpm" />

        <!-- CONVERSION RATE -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="conversion_rate"
            label="Tasa de conversión (%)"
            validators="decimal"
            v-model="conversion_rate" />

        <!-- TOTAL CONVERSIONS -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="total_conversions"
            label="Conversiones"
            validators="integer"
            v-model="total_conversions" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />

    </form>

</template>

<script>

    import { createModel } from '@models/deal-ad-group'
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
        		default: 'createDealAdGroupForm',
        	},
            dealAdCampaignId: {
                type: [Number, String],
                required: true
            },
        },

        emits: ['submit'],

        data() {
            return {
                name: '',
                description: '',
                platform_id: '',
                status: '',
                start_date: '',
                end_date: '',
                budget: '',
                spent_amount: '',
                target_audience: '',
                total_impressions: '',
                total_clicks: '',
                cpc: '',
                cpm: '',
                conversion_rate: '',
                total_conversions: '',
                deal_ad_campaign_id: this.dealAdCampaignId,
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
                        name: this.name,
                        description: this.description,
                        platform_id: this.platform_id,
                        status: this.status,
                        start_date: this.start_date,
                        end_date: this.end_date,
                        budget: this.budget,
                        spent_amount: this.spent_amount,
                        target_audience: this.target_audience,
                        total_impressions: this.total_impressions,
                        total_clicks: this.total_clicks,
                        cpc: this.cpc,
                        cpm: this.cpm,
                        conversion_rate: this.conversion_rate,
                        total_conversions: this.total_conversions,
                        deal_ad_campaign_id: this.deal_ad_campaign_id,
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
