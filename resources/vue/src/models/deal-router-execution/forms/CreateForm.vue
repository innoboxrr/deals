<template>

    <form :id="formId" @submit.prevent="onSubmit">

        <!-- START EXECUTION -->
        <text-input-component
            :custom-class="inputClass"
            name="start_execution"
            label="Inicio de ejecución"
            placeholder="YYYY-MM-DD HH:mm:ss"
            validators="required"
            v-model="start_execution" />

        <!-- END EXECUTION -->
        <text-input-component
            :custom-class="inputClass"
            name="end_execution"
            label="Fin de ejecución"
            placeholder="YYYY-MM-DD HH:mm:ss"
            validators="required"
            v-model="end_execution" />

        <!-- ASSIGNMENT LOG -->
        <textarea-input-component
            :custom-class="inputClass"
            name="assignment_log"
            label="Log de asignación (JSON)"
            v-model="assignment_log" />

        <!-- DEAL ROUTER ID -->
        <text-input-component
            :custom-class="inputClass"
            name="deal_router_id"
            label="ID del DealRouter"
            validators="required"
            v-model="deal_router_id" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />

    </form>

</template>

<script>

    import { createModel } from '@dealsModels/deal-router-execution'
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
                default: 'createDealRouterExecutionForm',
            }
        },

        emits: ['submit'],

        data() {
            return {
                start_execution: '',
                end_execution: '',
                assignment_log: '',
                deal_router_id: '',
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
                        start_execution: this.start_execution,
                        end_execution: this.end_execution,
                        assignment_log: this.assignment_log,
                        deal_router_id: this.deal_router_id,
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
