<template>
	
	<form :id="formId" @submit.prevent="onSubmit">      

        <!-- DEAL AD ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="deal_ad_id"
            label="ID del anuncio"
            validators="required"
            v-model="deal_ad_id" />

        <!-- IMPRESSIONS -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="impressions"
            label="Impresiones"
            validators="integer"
            v-model="impressions" />

        <!-- CLICKS -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="clicks"
            label="Clicks"
            validators="integer"
            v-model="clicks" />

        <!-- LEADS -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="leads"
            label="Leads"
            validators="integer"
            v-model="leads" />

        <!-- SPEND -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="spend"
            label="Gasto"
            validators="decimal"
            v-model="spend" />

        <!-- FROM DATE -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="from_date"
            label="Desde"
            placeholder="YYYY-MM-DD"
            validators="required date"
            v-model="from_date" />

        <!-- TO DATE -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="to_date"
            label="Hasta"
            placeholder="YYYY-MM-DD"
            validators="required date"
            v-model="to_date" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />

    </form>

</template>

<script>

    import { createModel } from '@models/deal-ad-performance-snapshot'
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
        		default: 'createDealAdPerformanceSnapshotForm',
        	}
        },

        emits: ['submit'],

        data() {
            return {
                deal_ad_id: '',
                impressions: '',
                clicks: '',
                leads: '',
                spend: '',
                from_date: '',
                to_date: '',
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
                        deal_ad_id: this.deal_ad_id,
                        impressions: this.impressions,
                        clicks: this.clicks,
                        leads: this.leads,
                        spend: this.spend,
                        from_date: this.from_date,
                        to_date: this.to_date,
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
