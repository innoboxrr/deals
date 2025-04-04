<template>

    <form :id="formId" @submit.prevent="onSubmit">

        <!-- FIRED AT -->
        <text-input-component
            :custom-class="inputClass"
            name="fired_at"
            label="Disparado en"
            placeholder="YYYY-MM-DD HH:mm:ss"
            validators="required"
            v-model="fired_at" />

        <!-- RESPONSE -->
        <textarea-input-component
            :custom-class="inputClass"
            name="response"
            label="Respuesta (JSON)"
            v-model="response" />

        <!-- PLATFORM TYPE -->
        <select-input-component
            :custom-class="inputClass"
            name="platform_type"
            label="Tipo de plataforma"
            validators="required"
            v-model="platform_type">
            <option value="Affiliate">Affiliate</option>
            <option value="DealAdPlatform">DealAdPlatform</option>
        </select-input-component>

        <!-- PLATFORM ID -->
        <text-input-component
            :custom-class="inputClass"
            name="platform_id"
            label="ID de la plataforma"
            validators="required"
            v-model="platform_id" />

        <!-- TRACKING EVENT ID -->
        <text-input-component
            :custom-class="inputClass"
            name="deal_lead_traking_event_id"
            label="ID del evento del lead"
            validators="required"
            v-model="deal_lead_traking_event_id" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />

    </form>

</template>

<script>

    import { createModel } from '@models/deal-pixel-fire'
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
                default: 'createDealPixelFireForm',
            }
        },

        emits: ['submit'],

        data() {
            return {
                fired_at: '',
                response: '',
                platform_type: '',
                platform_id: '',
                deal_lead_traking_event_id: '',
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
                    this.disabled = true
                    createModel({
                        fired_at: this.fired_at,
                        response: this.response,
                        platform_type: this.platform_type,
                        platform_id: this.platform_id,
                        deal_lead_traking_event_id: this.deal_lead_traking_event_id,
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
