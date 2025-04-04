<template>

    <form :id="formId" @submit.prevent="onSubmit">

        <!-- KEY -->
        <select-input-component
            name="key"
            label="Campo (key)"
            validators="required"
            v-model="constraint.key">
            <option value="estado">Estado</option>
            <option value="edad_maxima">Edad máxima</option>
            <option value="edad_minima">Edad mínima</option>
            <option value="rango_de_edad">Rango de edad</option>
            <option value="genero">Género</option>
            <option value="ubicacion">Ubicación</option>
            <option value="intereses">Intereses</option>
            <option value="plataforma">Plataforma</option>
            <option value="dispositivo">Dispositivo</option>
            <option value="tipo_de_anuncio">Tipo de anuncio</option>
            <option value="fecha_inicio">Fecha de inicio</option>
            <option value="fecha_fin">Fecha de fin</option>
            <option value="presupuesto_maximo">Presupuesto máximo</option>
            <option value="cpc_maximo">CPC máximo</option>
            <option value="cpm_maximo">CPM máximo</option>
            <option value="conversiones_maximas">Conversiones máximas</option>
            <option value="tiempo_minimo">Tiempo mínimo</option>
        </select-input-component>

        <!-- OPERATOR -->
        <select-input-component
            name="operator"
            label="Operador"
            validators="required"
            v-model="constraint.operator">
            <option value="=">=</option>
            <option value="!=">!=</option>
            <option value=">">&gt;</option>
            <option value=">=">&gt;=</option>
            <option value="<">&lt;</option>
            <option value="<=">&lt;=</option>
            <option value="IN">IN</option>
            <option value="NOT IN">NOT IN</option>
            <option value="LIKE">LIKE</option>
            <option value="NOT LIKE">NOT LIKE</option>
            <option value="BETWEEN">BETWEEN</option>
            <option value="NOT BETWEEN">NOT BETWEEN</option>
        </select-input-component>

        <!-- VALUE -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="value"
            label="Valor"
            validators="required"
            v-model="constraint.value" />

        <!-- DEAL ADVERTISER AGREEMENT ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="deal_advertiser_agreement_id"
            label="ID del Acuerdo"
            validators="required"
            v-model="constraint.deal_advertiser_agreement_id" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />

    </form>

</template>

<script>

    import { showModel, updateModel } from '@models/deal-advertiser-agreement-constraint'
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
                default: 'editDealAdvertiserAgreementConstraintForm'
            },
            constraintId: {
                type: [Number, String],
                required: true
            }
        },

        emits: ['submit'],

        data() {
            return {
                constraint: {
                    key: '',
                    operator: '',
                    value: '',
                    deal_advertiser_agreement_id: '',
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
                showModel(this.constraintId).then(res => {
                    this.constraint = res;
                });
            },

            onSubmit() {
                if (this.JSValidator.status) {
                    this.disabled = true;
                    updateModel(this.constraint.id, {
                        key: this.constraint.key,
                        operator: this.constraint.operator,
                        value: this.constraint.value,
                        deal_advertiser_agreement_id: this.constraint.deal_advertiser_agreement_id,
                    }).then(res => {
                        this.$emit('submit', res)
                        setTimeout(() => { this.disabled = false }, 2500)
                    }).catch(error => {
                        this.disabled = false
                        if (error?.response?.status === 422)
                            this.JSValidator.appendExternalErrors(error.response.data.errors)
                    });
                } else {
                    this.disabled = false
                }
            }
        }
	}
</script>
