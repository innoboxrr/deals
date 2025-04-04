<template>
	
	<form :id="formId" @submit.prevent="onSubmit">

        <!-- NAME -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="name"
            label="Nombre"
            placeholder="Nombre del anuncio"
            validators="required length"
            :min_length="3"
            v-model="deal.name" />

        <!-- DESCRIPTION -->
        <textarea-input-component
            :custom-class="inputClass"
            name="description"
            label="Descripción"
            placeholder="Descripción del anuncio"
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
            placeholder="Ej. 500"
            validators="required decimal"
            v-model="deal.payload.budget" />

        <!-- SPENT AMOUNT -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="spent_amount"
            label="Gasto"
            placeholder="Ej. 100"
            validators="decimal"
            v-model="deal.payload.spent_amount" />

        <!-- TARGET AUDIENCE -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="target_audience"
            label="Audiencia objetivo"
            v-model="deal.payload.target_audience" />

        <!-- CLICKS -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="clicks"
            label="Clicks"
            validators="integer"
            v-model="deal.payload.clicks" />

        <!-- IMPRESIONS -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="impresions"
            label="Impresiones"
            validators="integer"
            v-model="deal.payload.impresions" />

        <!-- CPC -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="cpc"
            label="Costo por click"
            validators="decimal"
            v-model="deal.payload.cpc" />

        <!-- CPM -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="cpm"
            label="Costo por mil"
            validators="decimal"
            v-model="deal.payload.cpm" />

        <!-- TOTAL CONVERSIONS -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="total_conversions"
            label="Conversiones"
            validators="integer"
            v-model="deal.payload.total_conversions" />

        <!-- CONVERSION RATE -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="conversion_rate"
            label="Tasa de conversión (%)"
            validators="decimal"
            v-model="deal.payload.conversion_rate" />

        <!-- DEAL AD GROUP ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="deal_ad_group_id"
            label="ID del Grupo de Anuncio"
            validators="required"
            v-model="deal.deal_ad_group_id" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />

    </form>

</template>

<script>

    import { showModel, updateModel } from '@models/deal-ad'
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
                default: 'editDealAdForm'
            },
            dealAdId: {
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
                        clicks: '',
                        impresions: '',
                        cpc: '',
                        cpm: '',
                        total_conversions: '',
                        conversion_rate: '',
                    },
                    deal_ad_group_id: '',
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
                showModel(this.dealAdId).then(res => {
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
                        clicks: this.deal.payload.clicks,
                        impresions: this.deal.payload.impresions,
                        cpc: this.deal.payload.cpc,
                        cpm: this.deal.payload.cpm,
                        total_conversions: this.deal.payload.total_conversions,
                        conversion_rate: this.deal.payload.conversion_rate,
                        deal_ad_group_id: this.deal.deal_ad_group_id,
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
