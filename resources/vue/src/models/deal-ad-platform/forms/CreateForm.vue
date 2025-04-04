<template>
	
	<form :id="formId" @submit.prevent="onSubmit">

        <!-- NAME -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="name"
            label="Nombre"
            validators="required length"
            :min_length="3"
            v-model="name" />

        <!-- API KEY -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="api_key"
            label="API Key"
            validators="required"
            v-model="api_key" />

        <!-- API SECRET -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="api_secret"
            label="API Secret"
            validators="required"
            v-model="api_secret" />

        <!-- PIXEL -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="pixel"
            label="Pixel ID"
            v-model="pixel" />

        <!-- ACCOUNT ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="account_id"
            label="Account ID"
            validators="required"
            v-model="account_id" />

        <!-- AUTH TOKEN -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="auth_token"
            label="Auth Token"
            validators="required"
            v-model="auth_token" />

        <!-- STATUS -->
        <select-input-component
            name="status"
            label="Estatus"
            validators="required"
            v-model="status">
            <option value="connected">Conectado</option>
            <option value="disconnected">Desconectado</option>
            <option value="error">Error</option>
        </select-input-component>

        <!-- INTEGRATION TYPE -->
        <select-input-component
            name="integration_type"
            label="Tipo de integración"
            validators="required"
            v-model="integration_type">
            <option value="api">API</option>
            <option value="manual">Manual</option>
        </select-input-component>

        <!-- LAST SYNC AT -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="last_sync_at"
            label="Última sincronización"
            placeholder="YYYY-MM-DD HH:mm:ss"
            validators="date"
            v-model="last_sync_at" />

        <!-- DEAL ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
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

    import { createModel } from '@models/deal-ad-platform'
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
        		default: 'createDealAdPlatformForm',
        	}
        },

        emits: ['submit'],

        data() {
            return {
                name: '',
                api_key: '',
                api_secret: '',
                pixel: '',
                account_id: '',
                auth_token: '',
                status: '',
                integration_type: '',
                last_sync_at: '',
                deal_id: '',
                disabled: false,
                JSValidator: undefined,
            }
        },

        mounted() {
            this.JSValidator = new JSValidator(this.formId).init();
        },

        methods: {
            onSubmit() {
                if(this.JSValidator.status) {
                    this.disabled = true;
                    createModel({
                        name: this.name,
                        api_key: this.api_key,
                        api_secret: this.api_secret,
                        pixel: this.pixel,
                        account_id: this.account_id,
                        auth_token: this.auth_token,
                        status: this.status,
                        integration_type: this.integration_type,
                        last_sync_at: this.last_sync_at,
                        deal_id: this.deal_id,
                    }).then(res => {
                        this.$emit('submit', res);
                        setTimeout(() => { this.disabled = false; }, 2500);
                    }).catch(error => {
                        this.disabled = false;
                        if(error.response?.status == 422)
                            this.JSValidator.appendExternalErrors(error.response.data.errors);
                    });
                } else {
                    this.disabled = false;
                }
            }
        }
	}
</script>
