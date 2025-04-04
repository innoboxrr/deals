<template>

    <form :id="formId" @submit.prevent="onSubmit">

        <!-- EVENT -->
        <text-input-component
            :custom-class="inputClass"
            name="event"
            label="Evento"
            validators="required"
            v-model="event" />

        <!-- STATUS -->
        <text-input-component
            :custom-class="inputClass"
            name="status"
            label="Estado"
            validators="required"
            v-model="status" />

        <!-- DATA -->
        <textarea-input-component
            :custom-class="inputClass"
            name="data"
            label="Datos (JSON u observaciones)"
            v-model="data" />

        <!-- DEAL LEAD ID -->
        <text-input-component
            :custom-class="inputClass"
            name="deal_lead_id"
            label="ID del Lead"
            validators="required"
            v-model="deal_lead_id" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />

    </form>

</template>

<script>

    import { createModel } from '@models/deal-lead-tracking-event'
    import JSValidator from 'innoboxrr-js-validator'
    import {
        TextInputComponent,
        TextareaInputComponent,
        ButtonComponent,
    } from 'innoboxrr-form-elements'

    export default {

        components: {
            TextInputComponent,
            TextareaInputComponent,
            ButtonComponent,
        },

        props: {
            formId: {
                type: String,
                default: 'createDealLeadTrackingEventForm',
            }
        },

        emits: ['submit'],

        data() {
            return {
                event: '',
                status: '',
                data: '',
                deal_lead_id: '',
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
                        event: this.event,
                        status: this.status,
                        data: this.data,
                        deal_lead_id: this.deal_lead_id,
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
