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
            v-model="deal.name" />

        <!-- DESCRIPTION -->
        <textarea-input-component
            :custom-class="inputClass"
            name="description"
            label="Descripción"
            placeholder="Descripción del grupo"
            validators="required length"
            :min_length="3"
            v-model="deal.description" />

        <!-- PLATFORM ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="platform_id"
            label="Plataforma"
            validators="required"
            v-model="deal.payload.platform_id" />

        <!-- STATUS -->
        <select-input-component
            name="status"
            label="Estatus"
            validators="required"
            v-model="deal.payload.status">
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
            v-model="deal.payload.start_date" />

        <!-- END DATE -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="end_date"
            label="Fecha de término"
            placeholder="YYYY-MM-DD"
            validators="required date"
            v-model="deal.payload.end_date" />

        <!-- BUDGET -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="budget"
            label="Presupuesto"
            validators="required decimal"
            v-model="deal.payload.budget" />

        <!-- SPENT AMOUNT -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="spent_amount"
            label="Gasto"
            validators="decimal"
            v-model="deal.payload.spent_amount" />

        <!-- TARGET AUDIENCE -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="target_audience"
            label="Audiencia objetivo"
            v-model="deal.payload.target_audience" />

        <!-- TOTAL IMPRESSIONS -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="total_impressions"
            label="Impresiones"
            validators="integer"
            v-model="deal.payload.total_impressions" />

        <!-- TOTAL CLICKS -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="total_clicks"
            label="Clicks"
            validators="integer"
            v-model="deal.payload.total_clicks" />

        <!-- CPC -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="cpc"
            label="Costo por click (CPC)"
            validators="decimal"
            v-model="deal.payload.cpc" />

        <!-- CPM -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="cpm"
            label="Costo por mil (CPM)"
            validators="decimal"
            v-model="deal.payload.cpm" />

        <!-- CONVERSION RATE -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="conversion_rate"
            label="Tasa de conversión (%)"
            validators="decimal"
            v-model="deal.payload.conversion_rate" />

        <!-- TOTAL CONVERSIONS -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="total_conversions"
            label="Conversiones"
            validators="integer"
            v-model="deal.payload.total_conversions" />

        <!-- DEAL AD CAMPAIGN ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="deal_ad_campaign_id"
            label="ID de Campaña"
            validators="required"
            v-model="deal.deal_ad_campaign_id" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />

    </form>

</template>

<script>

    import { showModel, updateModel } from '@models/deal-ad-group'
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
                default: 'editDealAdGroupForm'
            },
            dealAdGroupId: {
                type: [Number, String],
                required: true
            }
        },

        emits: ['submit'],

        data() {
            return {
                deal: {
                    name: '',
                    description: '',
                    payload: {
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
                    },
                    deal_ad_campaign_id: '',
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
                showModel(this.dealAdGroupId).then(res => {
                    this.deal = res;
                });
            },

            onSubmit() {
                if (this.JSValidator.status) {
                    this.disabled = true;
                    updateModel(this.deal.id, {
                        name: this.deal.name,
                        description: this.deal.description,
                        platform_id: this.deal.payload.platform_id,
                        status: this.deal.payload.status,
                        start_date: this.deal.payload.start_date,
                        end_date: this.deal.payload.end_date,
                        budget: this.deal.payload.budget,
                        spent_amount: this.deal.payload.spent_amount,
                        target_audience: this.deal.payload.target_audience,
                        total_impressions: this.deal.payload.total_impressions,
                        total_clicks: this.deal.payload.total_clicks,
                        cpc: this.deal.payload.cpc,
                        cpm: this.deal.payload.cpm,
                        conversion_rate: this.deal.payload.conversion_rate,
                        total_conversions: this.deal.payload.total_conversions,
                        deal_ad_campaign_id: this.deal.deal_ad_campaign_id,
                    }).then(res => {
                        this.$emit('submit', res);
                        setTimeout(() => { this.disabled = false; }, 2500);
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
