<template>
	
	<form :id="formId" @submit.prevent="onSubmit">      

        <!-- NAME -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="name"
            label="Nombre"
            placeholder="Nombre del Deal"
            validators="required length"
            :min_length="3"
            v-model="name" />

        <!-- DESCRIPTION -->
        <textarea-input-component
            :custom-class="inputClass"
            name="description"
            label="Descripción"
            placeholder="Descripción del Deal"
            validators="required length"
            :min_length="3"
            v-model="description" />

        <!-- MAX CPL -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="max_cpl"
            label="Costo por Lead máximo"
            placeholder="Ej. 20.5"
            validators="required decimal"
            v-model="max_cpl" />

        <!-- AUTO PAUSE ON THRESHOLD -->
        <select-input-component
            name="auto_pause_campaigns_on_threshold"
            label="¿Pausar campañas automáticamente?"
            validators="required"
            v-model="auto_pause_campaigns_on_threshold">
            <option :value="1">Sí</option>
            <option :value="0">No</option>
        </select-input-component>

        <!-- SNAPSHOT INTERVAL -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="snapshot_performnace_frenquency_interval"
            label="Intervalo de snapshots"
            placeholder="Ej. 5"
            validators="required integer"
            v-model="snapshot_performnace_frenquency_interval" />

        <!-- SNAPSHOT UNIT -->
        <select-input-component
            name="snapshot_performnace_frenquency_unit"
            label="Unidad de frecuencia"
            validators="required"
            v-model="snapshot_performnace_frenquency_unit">
            <option value="minutes">Minutos</option>
            <option value="hours">Horas</option>
            <option value="days">Días</option>
        </select-input-component>

        <!-- NOTIFICATIONS RULES -->
        <tags-input-component
            name="welcome_notifications_rules"
            label="Reglas de notificación"
            placeholder="Agregar reglas"
            v-model="welcome_notifications_rules" />

        <!-- DEAL PRODUCT ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="deal_product_id"
            label="ID de Producto"
            validators="required"
            v-model="deal_product_id" />

        <!-- WORKSPACE ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="workspace_id"
            label="ID del Workspace"
            validators="required"
            v-model="workspace_id" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />
        
    </form>

</template>

<script>

    import { createModel } from '@models/deal'
    import JSValidator from 'innoboxrr-js-validator'
    import {
        TextInputComponent,
        TextareaInputComponent,
        SelectInputComponent,
        TagsInputComponent,
        ButtonComponent,
    } from 'innoboxrr-form-elements'

	export default {

        components: {
            TextInputComponent,
            TextareaInputComponent,
            SelectInputComponent,
            TagsInputComponent,
            ButtonComponent,
        },

        props: {
        	formId: {
        		type: String,
        		default: 'createDealForm',
        	}
        },

        emits: ['submit'],

        data() {
            return {
                name: '',
                description: '',
                max_cpl: '',
                auto_pause_campaigns_on_threshold: 0,
                snapshot_performnace_frenquency_interval: '',
                snapshot_performnace_frenquency_unit: '',
                welcome_notifications_rules: [],
                deal_product_id: '',
                workspace_id: '',
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
                        description: this.description,
                        max_cpl: this.max_cpl,
                        auto_pause_campaigns_on_threshold: Number(this.auto_pause_campaigns_on_threshold),
                        snapshot_performnace_frenquency_interval: this.snapshot_performnace_frenquency_interval,
                        snapshot_performnace_frenquency_unit: this.snapshot_performnace_frenquency_unit,
                        welcome_notifications_rules: this.welcome_notifications_rules,
                        deal_product_id: this.deal_product_id,
                        workspace_id: this.workspace_id
                    }).then(res => {
                        this.$emit('submit', res);
                        setTimeout(() => { this.disabled = false; }, 2500);
                    }).catch(error => {
                        this.disabled = false;
                        if (error.response?.status === 422)
                            this.JSValidator.appendExternalErrors(error.response.data.errors);
                    });
                } else {
                    this.disabled = false;
                }
            }
        }
	}
</script>
