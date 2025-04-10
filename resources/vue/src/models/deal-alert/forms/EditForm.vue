<template>

    <form :id="formId" @submit.prevent="onSubmit">

        <!-- DEAL ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="deal_id"
            label="ID del Deal"
            validators="required"
            v-model="alert.deal_id" />

        <!-- TYPE -->
        <select-input-component
            name="type"
            label="Tipo de alerta"
            validators="required"
            v-model="alert.type">
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
            v-model="alert.message" />

        <!-- STATUS -->
        <select-input-component
            name="status"
            label="Estado"
            validators="required"
            v-model="alert.status">
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
            v-model="alert.detected_at" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />

    </form>

</template>

<script>

    import { showModel, updateModel } from '@dealsModels/deal-alert'
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
                default: 'editDealAlertForm'
            },
            alertId: {
                type: [Number, String],
                required: true
            }
        },

        emits: ['submit'],

        data() {
            return {
                alert: {
                    deal_id: '',
                    type: '',
                    message: '',
                    status: '',
                    detected_at: '',
                },
                disabled: false,
                JSValidator: undefined,
            }
        },

        mounted() {
            this.fetchData()
            this.JSValidator = new JSValidator(this.formId).init()
            this.JSValidator.status = true
        },

        methods: {

            fetchData() {
                showModel(this.alertId).then(res => {
                    this.alert = res
                })
            },

            onSubmit() {
                if (this.JSValidator.status) {
                    this.disabled = true
                    updateModel(this.alert.id, {
                        deal_id: this.alert.deal_id,
                        type: this.alert.type,
                        message: this.alert.message,
                        status: this.alert.status,
                        detected_at: this.alert.detected_at,
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
