<template>

    <form :id="formId" @submit.prevent="onSubmit">

        <!-- DATOS PERSONALES -->
        <text-input-component :custom-class="inputClass" name="name" label="Nombre" v-model="lead.name" />
        <text-input-component :custom-class="inputClass" name="email" label="Email" v-model="lead.email" />
        <text-input-component :custom-class="inputClass" name="phone" label="Teléfono" v-model="lead.phone" />
        <text-input-component :custom-class="inputClass" name="whatsapp" label="WhatsApp" v-model="lead.whatsapp" />
        <text-input-component :custom-class="inputClass" name="dob" label="Fecha nacimiento" v-model="lead.dob" />
        <text-input-component :custom-class="inputClass" name="gender" label="Género" v-model="lead.gender" />
        <text-input-component :custom-class="inputClass" name="address" label="Dirección" v-model="lead.address" />
        <text-input-component :custom-class="inputClass" name="postalcode" label="CP" v-model="lead.postalcode" />
        <text-input-component :custom-class="inputClass" name="city" label="Ciudad" v-model="lead.city" />
        <text-input-component :custom-class="inputClass" name="state" label="Estado" v-model="lead.state" />
        <text-input-component :custom-class="inputClass" name="country" label="País" v-model="lead.country" />

        <!-- UTM -->
        <text-input-component :custom-class="inputClass" name="utm_source" label="UTM Source" v-model="lead.utm_source" />
        <text-input-component :custom-class="inputClass" name="utm_medium" label="UTM Medium" v-model="lead.utm_medium" />
        <text-input-component :custom-class="inputClass" name="utm_campaign" label="UTM Campaign" v-model="lead.utm_campaign" />
        <text-input-component :custom-class="inputClass" name="utm_term" label="UTM Term" v-model="lead.utm_term" />
        <text-input-component :custom-class="inputClass" name="utm_content" label="UTM Content" v-model="lead.utm_content" />

        <!-- TRACKING -->
        <text-input-component :custom-class="inputClass" name="url" label="URL" v-model="lead.url" />
        <text-input-component :custom-class="inputClass" name="referer" label="Referer" v-model="lead.referer" />
        <text-input-component :custom-class="inputClass" name="ip" label="IP" v-model="lead.ip" />
        <text-input-component :custom-class="inputClass" name="platform" label="Plataforma" v-model="lead.platform" />
        <text-input-component :custom-class="inputClass" name="traffic_id" label="Traffic ID" v-model="lead.traffic_id" />

        <!-- ESTATUS -->
        <select-input-component :custom-class="inputClass" name="status" label="Estatus" v-model="lead.status">
            <option value="new">Nuevo</option>
            <option value="assigned">Asignado</option>
            <option value="rejected">Rechazado</option>
            <option value="sold">Vendido</option>
        </select-input-component>

        <text-input-component :custom-class="inputClass" name="score" label="Score" type="number" v-model="lead.score" />
        <text-input-component :custom-class="inputClass" name="cpl" label="CPL" type="number" v-model="lead.cpl" />
        <text-input-component :custom-class="inputClass" name="assigned_at" label="Asignado en" v-model="lead.assigned_at" />
        <text-input-component :custom-class="inputClass" name="conversion_stage" label="Etapa conversión" v-model="lead.conversion_stage" />
        <text-input-component :custom-class="inputClass" name="deal_gateway_id" label="Gateway ID" v-model="lead.deal_gateway_id" />

        <!-- BOOLEANO -->
        <select-input-component :custom-class="inputClass" name="is_test" label="¿Es test?" v-model="lead.is_test">
            <option value="0">No</option>
            <option value="1">Sí</option>
        </select-input-component>

        <text-input-component :custom-class="inputClass" name="other" label="Otro" v-model="lead.other" />
        <text-input-component :custom-class="inputClass" name="duplicates_with" label="Duplicado con..." v-model="lead.duplicates_with" />
        <textarea-input-component :custom-class="inputClass" name="notes" label="Notas" v-model="lead.notes" />
        <text-input-component :custom-class="inputClass" name="source_verified_at" label="Verificado en" v-model="lead.source_verified_at" />

        <!-- MÉTRICAS -->
        <text-input-component :custom-class="inputClass" name="time_on_page" label="Tiempo en página" type="number" v-model="lead.time_on_page" />
        <text-input-component :custom-class="inputClass" name="interaction_count" label="Interacciones" type="number" v-model="lead.interaction_count" />
        <text-input-component :custom-class="inputClass" name="form_steps_completed" label="Pasos completados" type="number" v-model="lead.form_steps_completed" />

        <!-- SELECTS -->
        <select-input-component :custom-class="inputClass" name="interest_level" label="Interés" v-model="lead.interest_level">
            <option value="">Sin definir</option>
            <option value="low">Bajo</option>
            <option value="medium">Medio</option>
            <option value="high">Alto</option>
        </select-input-component>

        <select-input-component :custom-class="inputClass" name="fraud_risk" label="Riesgo de fraude" v-model="lead.fraud_risk">
            <option value="">Sin definir</option>
            <option value="low">Bajo</option>
            <option value="medium">Medio</option>
            <option value="high">Alto</option>
        </select-input-component>

        <button-component :custom-class="buttonClass" :disabled="disabled" value="Actualizar" />

    </form>

</template>

<script>

import { showModel, updateModel } from '@dealsModels/deal-lead'
import JSValidator from 'innoboxrr-js-validator'
import {
    TextInputComponent,
    SelectInputComponent,
    TextareaInputComponent,
    ButtonComponent,
} from 'innoboxrr-form-elements'

export default {

    components: {
        TextInputComponent,
        SelectInputComponent,
        TextareaInputComponent,
        ButtonComponent,
    },

    props: {
        formId: {
            type: String,
            default: 'editDealLeadForm'
        },
        leadId: {
            type: [Number, String],
            required: true
        }
    },

    emits: ['submit'],

    data() {
        return {
            lead: {},
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
            showModel(this.leadId).then(res => {
                this.lead = res
            })
        },

        onSubmit() {
            if (this.JSValidator.status) {
                this.disabled = true
                updateModel(this.lead.id, { ...this.lead }).then(res => {
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
