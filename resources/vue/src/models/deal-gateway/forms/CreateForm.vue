<template>
	<form :id="formId" @submit.prevent="onSubmit">	

        <!-- Gateway Type -->
        <select-input-component
            :custom-class="inputClass"
            name="gateway_type"
            :label="__deals('Tipo de Gateway')"
            validators="required"
            v-model="dealGateway.gateway_type">
            <option value="landing">Landing</option>
            <option value="form">Form</option>
            <option value="endpoint">Endpoint</option>
            <option value="blog">Blog</option>
            <option disabled value="embed">Embed</option>
        </select-input-component>

        <!-- Buscar Gateway -->
        <div>
            <model-search-input-component 
                :key="dealGateway.gateway_type"
                custom-class="bg-gray-50 rounded-lg text-sm py-0.5 border border-gray-300"
                label-str="Buscar Gateway"
                placeholder-str="Escribe para buscar"
                :route="gatewaysRoute"
                q="name"
                :externalFilters="{
                    not_in_deal_id: dealId,
                    type: dealGateway.gateway_type,
                }"
                :get-option-label="option => `${option.name} (ID: ${option.id} - Tipo: ${getGatewayType(option.type)})`"
                @submit="setGateway" />
        </div>

        <!-- Name -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="name"
            :label="__deals('Nombre')"
            placeholder="Nombre del Gateway"
            validators="required length"
            :min_length="3"
            v-model="dealGateway.name" />

        <!-- Status -->
        <select-input-component
            :custom-class="inputClass"
            name="status"
            :label="__deals('Status')"
            validators="required"
            v-model="dealGateway.status">
            <option value="active">Activo</option>
            <option value="inactive">Inactivo</option>
            <option value="pending">Pendiente</option>
        </select-input-component>

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />
    </form>
</template>

<script>
import { createModel } from '@dealsModels/deal-gateway'
import JSValidator from 'innoboxrr-js-validator'
import {
    TextInputComponent,
    SelectInputComponent,
    ModelSearchInputComponent,
    ButtonComponent,
} from 'innoboxrr-form-elements'

export default {
    components: {
        TextInputComponent,
        SelectInputComponent,
        ModelSearchInputComponent,
        ButtonComponent,
    },

    props: {
        formId: {
            type: String,
            default: 'createDealGatewayForm',
        },
        dealId: {
            type: Number,
            required: true,
        }
    },

    emits: ['submit'],

    data() {
        return {
            disabled: false,
            dealGateway: {
                name: '',
                status: 1,
                gateway_type: 'landing',
                gateway_id: null,
            },
            JSValidator: undefined,
            gatewaysRoute: route('api.innoboxrr.deals.deal_gateway.search'),
        }
    },

    mounted() {
        this.JSValidator = new JSValidator(this.formId).init();
    },

    methods: {
        setGateway(gatewayId) {
            this.dealGateway.gateway_id = gatewayId || null;
        },

        onSubmit() {
            if (this.JSValidator.status) {
                this.disabled = true;
                createModel({
                    name: this.dealGateway.name,
                    status: this.dealGateway.status,
                    gateway_type: this.dealGateway.gateway_type,
                    gateway_id: this.dealGateway.gateway_id,
                    deal_id: this.dealId,
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
        },

        getGatewayType(type) {
            switch(type) {
                case 'landing': return 'Landing';
                case 'form': return 'Formulario';
                case 'endpoint': return 'Endpoint';
                case 'embed': return 'Embed';
                case 'blog': return 'Blog';
                default: return 'Otro';
            }
        }
    }
}
</script>
