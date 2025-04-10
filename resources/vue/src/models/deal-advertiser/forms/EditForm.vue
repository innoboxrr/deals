<template>
	
	<form :id="formId" @submit.prevent="onSubmit">

        <!-- STATUS -->
        <select-input-component
            name="status"
            label="Estatus"
            validators="required"
            v-model="advertiser.status">
            <option value="active">Activo</option>
            <option value="inactive">Inactivo</option>
            <option value="pending">Pendiente</option>
        </select-input-component>

        <!-- AGENT ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="agent_id"
            label="ID del Agente"
            validators="required"
            v-model="advertiser.agent_id" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />

    </form>

</template>

<script>

    import { showModel, updateModel } from '@dealsModels/deal-advertiser'
    import JSValidator from 'innoboxrr-js-validator'
    import {
        TextInputComponent,
        SelectInputComponent,
        ButtonComponent,
    } from 'innoboxrr-form-elements'

	export default {

        components: {
            TextInputComponent,
            SelectInputComponent,
            ButtonComponent,
        },

        props: {
            formId: {
                type: String,
                default: 'editDealAdvertiserForm'
            },
            advertiserId: {
                type: [Number, String],
                required: true
            }
        },

        emits: ['submit'],

        data() {
            return {
                advertiser: {
                    status: '',
                    agent_id: '',
                },
                disabled: false,
                JSValidator: undefined,
            }
        },

        mounted() {
            this.fetchData(); 
            this.JSValidator = new JSValidator(this.formId).init();
            this.JSValidator.status = true;
        },

        methods: {

            fetchData() {
                showModel(this.advertiserId).then(res => {
                    this.advertiser = res;
                });
            },

            onSubmit() {
                if (this.JSValidator.status) {
                    this.disabled = true;
                    updateModel(this.advertiser.id, {
                        status: this.advertiser.status,
                        agent_id: this.advertiser.agent_id,
                    }).then(res => {
                        this.$emit('submit', res);
                        setTimeout(() => { this.disabled = false; }, 2500);
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
