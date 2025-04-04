<template>

    <form :id="formId" @submit.prevent="onSubmit">

        <!-- BEFORE -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="before"
            label="CPL Antes"
            validators="required decimal"
            v-model="before" />

        <!-- AFTER -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="after"
            label="CPL Después"
            validators="required decimal"
            v-model="after" />

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

    import { createModel } from '@models/deal-advertiser-agreement-cpl-adjustment'
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
        		default: 'createDealAdvertiserAgreementCplAdjustmentForm',
        	}
        },

        emits: ['submit'],

        data() {
            return {
                before: '',
                after: '',
                deal_advertiser_agreement_id: '',
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
                        before: this.before,
                        after: this.after,
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
