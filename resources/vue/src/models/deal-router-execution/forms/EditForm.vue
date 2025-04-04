<template>

    <form :id="formId" @submit.prevent="onSubmit">

        <!-- START EXECUTION -->
        <text-input-component
            :custom-class="inputClass"
            name="start_execution"
            label="Inicio de ejecución"
            placeholder="YYYY-MM-DD HH:mm:ss"
            validators="required"
            v-model="execution.start_execution" />

        <!-- END EXECUTION -->
        <text-input-component
            :custom-class="inputClass"
            name="end_execution"
            label="Fin de ejecución"
            placeholder="YYYY-MM-DD HH:mm:ss"
            validators="required"
            v-model="execution.end_execution" />

        <!-- ASSIGNMENT LOG -->
        <textarea-input-component
            :custom-class="inputClass"
            name="assignment_log"
            label="Log de asignación (JSON)"
            v-model="execution.assignment_log" />

        <!-- DEAL ROUTER ID -->
        <text-input-component
            :custom-class="inputClass"
            name="deal_router_id"
            label="ID del DealRouter"
            validators="required"
            v-model="execution.deal_router_id" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />

    </form>

</template>

<script>

import { showModel, updateModel } from '@models/deal-router-execution'
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
            default: 'editDealRouterExecutionForm'
        },
        executionId: {
            type: [Number, String],
            required: true
        }
    },

    emits: ['submit'],

    data() {
        return {
            execution: {
                start_execution: '',
                end_execution: '',
                assignment_log: '',
                deal_router_id: '',
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
            showModel(this.executionId).then(res => {
                this.execution = res
            })
        },

        onSubmit() {
            if (this.JSValidator.status) {
                this.disabled = true
                updateModel(this.execution.id, {
                    start_execution: this.execution.start_execution,
                    end_execution: this.execution.end_execution,
                    assignment_log: this.execution.assignment_log,
                    deal_router_id: this.execution.deal_router_id,
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
