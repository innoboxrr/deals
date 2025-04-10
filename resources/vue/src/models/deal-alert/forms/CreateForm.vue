<template>

    <form :id="formId" @submit.prevent="onSubmit">

        <!-- DEAL ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="deal_id"
            label="ID del Deal"
            validators="required"
            v-model="deal_id" />

        <!-- TYPE -->
        <select-input-component
            name="type"
            label="Tipo de alerta"
            validators="required"
            v-model="type">
            <option value="high_cpl">Costo por lead alto</option>
            <option value="low_conversion">Baja conversión</option>
            <option value="lead_overload">Sobrecarga de leads</option>
            <option value="no_feedback">Sin feedback</option>
        </select-input-component>

        <!-- MESSAGE -->
        <textarea-input-component
            :custom-class="inputClass"
            name="message"
            label="Mensaje"
            validators="length"
            :min_length="3"
            v-model="message" />

        <!-- STATUS -->
        <select-input-component
            name="status"
            label="Estado"
            validators="required"
            v-model="status">
            <option value="pending">Pendiente</option>
            <option value="resolved">Resuelta</option>
            <option value="ignored">Ignorada</option>
        </select-input-component>

        <!-- DETECTED AT -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="detected_at"
            label="Detectada en"
            placeholder="YYYY-MM-DD HH:mm"
            validators="date"
            v-model="detected_at" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />

    </form>

</template>

<script>

    import { createModel } from '@dealsModels/deal-alert'
    import JSValidator from 'innoboxrr-js-validator'
    import {
        TextInputComponent,
        SelectInputComponent,
        TextareaInputComponent,
        ButtonComponent,
    } from 'innoboxrr-form-elements'

	export default {

        components: {
            TextInputComponent,
            SelectInputComponent,
            TextareaInputComponent,
            ButtonComponent,
        },

        props: {
        	formId: {
        		type: String,
        		default: 'createDealAlertForm',
        	}
        },

        emits: ['submit'],

        data() {
            return {
                deal_id: '',
                type: '',
                message: '',
                status: '',
                detected_at: '',
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
                        deal_id: this.deal_id,
                        type: this.type,
                        message: this.message,
                        status: this.status,
                        detected_at: this.detected_at,
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
