<template>

    <form :id="formId" @submit.prevent="onSubmit">

        <!-- EVENT -->
        <text-input-component
            :custom-class="inputClass"
            name="event"
            label="Evento"
            validators="required"
            v-model="event.event" />

        <!-- STATUS -->
        <text-input-component
            :custom-class="inputClass"
            name="status"
            label="Estado"
            validators="required"
            v-model="event.status" />

        <!-- DATA -->
        <textarea-input-component
            :custom-class="inputClass"
            name="data"
            label="Datos"
            v-model="event.data" />

        <!-- DEAL LEAD ID -->
        <text-input-component
            :custom-class="inputClass"
            name="deal_lead_id"
            label="ID del Lead"
            validators="required"
            v-model="event.deal_lead_id" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />

    </form>

</template>

<script>

    import { showModel, updateModel } from '@dealsModels/deal-lead-tracking-event'
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
                default: 'editDealLeadTrackingEventForm'
            },
            eventId: {
                type: [Number, String],
                required: true
            }
        },

        emits: ['submit'],

        data() {
            return {
                event: {
                    event: '',
                    status: '',
                    data: '',
                    deal_lead_id: '',
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
                showModel(this.eventId).then(res => {
                    this.event = res
                })
            },

            onSubmit() {
                if (this.JSValidator.status) {
                    this.disabled = true
                    updateModel(this.event.id, {
                        event: this.event.event,
                        status: this.event.status,
                        data: this.event.data,
                        deal_lead_id: this.event.deal_lead_id,
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
