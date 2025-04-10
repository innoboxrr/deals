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
            v-model="platform.name" />

        <!-- API KEY -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="api_key"
            label="API Key"
            validators="required"
            v-model="platform.payload.api_key" />

        <!-- API SECRET -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="api_secret"
            label="API Secret"
            validators="required"
            v-model="platform.payload.api_secret" />

        <!-- PIXEL -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="pixel"
            label="Pixel ID"
            v-model="platform.payload.pixel" />

        <!-- ACCOUNT ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="account_id"
            label="Account ID"
            validators="required"
            v-model="platform.payload.account_id" />

        <!-- AUTH TOKEN -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="auth_token"
            label="Auth Token"
            validators="required"
            v-model="platform.payload.auth_token" />

        <!-- STATUS -->
        <select-input-component
            name="status"
            label="Estatus"
            validators="required"
            v-model="platform.payload.status">
            <option value="connected">Conectado</option>
            <option value="disconnected">Desconectado</option>
            <option value="error">Error</option>
        </select-input-component>

        <!-- INTEGRATION TYPE -->
        <select-input-component
            name="integration_type"
            label="Tipo de integración"
            validators="required"
            v-model="platform.payload.integration_type">
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
            v-model="platform.payload.last_sync_at" />

        <!-- DEAL ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="deal_id"
            label="ID del Deal"
            validators="required"
            v-model="platform.deal_id" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />

    </form>

</template>

<script>

    import { showModel, updateModel } from '@dealsModels/deal-ad-platform'
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
                default: 'editDealAdPlatformForm'
            },
            platformId: {
                type: [Number, String],
                required: true
            }
        },

        emits: ['submit'],

        data() {
            return {
                platform: {
                    name: '',
                    payload: {
                        api_key: '',
                        api_secret: '',
                        pixel: '',
                        account_id: '',
                        auth_token: '',
                        status: '',
                        integration_type: '',
                        last_sync_at: '',
                    },
                    deal_id: '',
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
                showModel(this.platformId).then(res => {
                    this.platform = res;
                });
            },

            onSubmit() {
                if (this.JSValidator.status) {
                    this.disabled = true;
                    updateModel(this.platform.id, {
                        name: this.platform.name,
                        api_key: this.platform.payload.api_key,
                        api_secret: this.platform.payload.api_secret,
                        pixel: this.platform.payload.pixel,
                        account_id: this.platform.payload.account_id,
                        auth_token: this.platform.payload.auth_token,
                        status: this.platform.payload.status,
                        integration_type: this.platform.payload.integration_type,
                        last_sync_at: this.platform.payload.last_sync_at,
                        deal_id: this.platform.deal_id,
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
