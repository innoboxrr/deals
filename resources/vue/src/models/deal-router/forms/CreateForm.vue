<template>

    <form :id="formId" @submit.prevent="onSubmit">

        <!-- LAST RUN -->
        <text-input-component
            :custom-class="inputClass"
            name="last_run"
            label="Última ejecución"
            placeholder="YYYY-MM-DD HH:mm:ss"
            v-model="last_run" />

        <!-- QUEUE -->
        <text-input-component
            :custom-class="inputClass"
            name="queue"
            label="Cola"
            validators="required"
            v-model="queue" />

        <!-- DEAL ID -->
        <text-input-component
            :custom-class="inputClass"
            name="deal_id"
            label="ID del Deal"
            validators="required"
            v-model="deal_id" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />

    </form>

</template>

<script>

    import { createModel } from '@models/deal-router'
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
                default: 'createDealRouterForm',
            }
        },

        emits: ['submit'],

        data() {
            return {
                last_run: '',
                queue: '',
                deal_id: '',
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
                        last_run: this.last_run,
                        queue: this.queue,
                        deal_id: this.deal_id,
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
