<template>

    <form :id="formId" @submit.prevent="onSubmit">

        <!-- LAST RUN -->
        <text-input-component
            :custom-class="inputClass"
            name="last_run"
            label="Última ejecución"
            placeholder="YYYY-MM-DD HH:mm:ss"
            v-model="router.last_run" />

        <!-- QUEUE -->
        <text-input-component
            :custom-class="inputClass"
            name="queue"
            label="Cola"
            validators="required"
            v-model="router.queue" />

        <!-- DEAL ID -->
        <text-input-component
            :custom-class="inputClass"
            name="deal_id"
            label="ID del Deal"
            validators="required"
            v-model="router.deal_id" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />

    </form>

</template>

<script>

    import { showModel, updateModel } from '@dealsModels/deal-router'
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
                default: 'editDealRouterForm'
            },
            routerId: {
                type: [Number, String],
                required: true
            }
        },

        emits: ['submit'],

        data() {
            return {
                router: {
                    last_run: '',
                    queue: '',
                    deal_id: '',
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
                showModel(this.routerId).then(res => {
                    this.router = res
                })
            },

            onSubmit() {
                if (this.JSValidator.status) {
                    this.disabled = true
                    updateModel(this.router.id, {
                        last_run: this.router.last_run,
                        queue: this.router.queue,
                        deal_id: this.router.deal_id,
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
