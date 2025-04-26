<template>
    <form :id="formId" @submit.prevent="onSubmit">
        
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
            value="Actualizar" />
        
    </form>
</template>

<script>
import { showModel, updateModel } from '@dealsModels/deal-gateway'
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
            default: 'editDealGatewayForm',
        },
        dealGatewayId: {
            type: [Number, String],
            required: true,
        },
        dealId: {
            type: Number,
            required: true,
        }
    },

    emits: ['submit'],

    data() {
        return {
            dealGateway: {
                name: '',
                status: 1,
            },
            disabled: false,
            gatewaysRoute: '/admin/deals/gateways',
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
            this.fetchDealGateway();
        },

        fetchDealGateway() {
            showModel(this.dealGatewayId).then(res => {
                this.dealGateway = res;
            });
        },

        setGateway(gateway) {
            this.dealGateway.gateway_id = gateway?.id || null;
        },

        onSubmit() {
            if (this.JSValidator.status) {
                this.disabled = true;
                updateModel(this.dealGateway.id, {
                    name: this.dealGateway.name,
                    status: this.dealGateway.status,
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
    }
}
</script>
