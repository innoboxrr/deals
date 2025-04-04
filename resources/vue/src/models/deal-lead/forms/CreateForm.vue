<template>

    <form :id="formId" @submit.prevent="onSubmit">

        <!-- DATOS DE CONTACTO -->
        <text-input-component :custom-class="inputClass" name="name" label="Nombre" v-model="name" />
        <text-input-component :custom-class="inputClass" name="email" label="Email" v-model="email" />
        <text-input-component :custom-class="inputClass" name="phone" label="Teléfono" v-model="phone" />
        <text-input-component :custom-class="inputClass" name="whatsapp" label="WhatsApp" v-model="whatsapp" />
        <text-input-component :custom-class="inputClass" name="dob" label="Fecha de nacimiento" v-model="dob" />
        <text-input-component :custom-class="inputClass" name="gender" label="Género" v-model="gender" />
        <text-input-component :custom-class="inputClass" name="address" label="Dirección" v-model="address" />
        <text-input-component :custom-class="inputClass" name="postalcode" label="Código Postal" v-model="postalcode" />
        <text-input-component :custom-class="inputClass" name="city" label="Ciudad" v-model="city" />
        <text-input-component :custom-class="inputClass" name="state" label="Estado" v-model="state" />
        <text-input-component :custom-class="inputClass" name="country" label="País" v-model="country" />

        <!-- UTM -->
        <text-input-component :custom-class="inputClass" name="utm_source" label="UTM Source" v-model="utm_source" />
        <text-input-component :custom-class="inputClass" name="utm_medium" label="UTM Medium" v-model="utm_medium" />
        <text-input-component :custom-class="inputClass" name="utm_campaign" label="UTM Campaign" v-model="utm_campaign" />
        <text-input-component :custom-class="inputClass" name="utm_term" label="UTM Term" v-model="utm_term" />
        <text-input-component :custom-class="inputClass" name="utm_content" label="UTM Content" v-model="utm_content" />

        <!-- TRACKING -->
        <text-input-component :custom-class="inputClass" name="url" label="URL" v-model="url" />
        <text-input-component :custom-class="inputClass" name="referer" label="Referer" v-model="referer" />
        <text-input-component :custom-class="inputClass" name="ip" label="IP" v-model="ip" />
        <text-input-component :custom-class="inputClass" name="platform" label="Plataforma" v-model="platform" />
        <text-input-component :custom-class="inputClass" name="traffic_id" label="Traffic ID" v-model="traffic_id" />

        <!-- STATUS -->
        <select-input-component :custom-class="inputClass" name="status" label="Estatus" v-model="status">
            <option value="new">Nuevo</option>
            <option value="assigned">Asignado</option>
            <option value="rejected">Rechazado</option>
            <option value="sold">Vendido</option>
        </select-input-component>

        <text-input-component :custom-class="inputClass" type="number" name="score" label="Score" v-model="score" />
        <text-input-component :custom-class="inputClass" type="number" name="cpl" label="CPL" v-model="cpl" />
        <text-input-component :custom-class="inputClass" name="assigned_at" label="Asignado en" v-model="assigned_at" />
        <text-input-component :custom-class="inputClass" name="conversion_stage" label="Etapa de conversión" v-model="conversion_stage" />
        <text-input-component :custom-class="inputClass" name="deal_gateway_id" label="Gateway ID" v-model="deal_gateway_id" />

        <!-- BOOLEANO -->
        <select-input-component :custom-class="inputClass" name="is_test" label="¿Es test?" v-model="is_test">
            <option value="0">No</option>
            <option value="1">Sí</option>
        </select-input-component>

        <text-input-component :custom-class="inputClass" name="other" label="Otro" v-model="other" />
        <text-input-component :custom-class="inputClass" name="duplicates_with" label="Duplicado con..." v-model="duplicates_with" />
        <textarea-input-component :custom-class="inputClass" name="notes" label="Notas" v-model="notes" />
        <text-input-component :custom-class="inputClass" name="source_verified_at" label="Verificado en" v-model="source_verified_at" />

        <!-- MÉTRICAS -->
        <text-input-component :custom-class="inputClass" type="number" name="time_on_page" label="Tiempo en página" v-model="time_on_page" />
        <text-input-component :custom-class="inputClass" type="number" name="interaction_count" label="Interacciones" v-model="interaction_count" />
        <text-input-component :custom-class="inputClass" type="number" name="form_steps_completed" label="Pasos completados" v-model="form_steps_completed" />

        <!-- INTERÉS / FRAUDE -->
        <select-input-component :custom-class="inputClass" name="interest_level" label="Nivel de interés" v-model="interest_level">
            <option value="">Sin definir</option>
            <option value="low">Bajo</option>
            <option value="medium">Medio</option>
            <option value="high">Alto</option>
        </select-input-component>

        <select-input-component :custom-class="inputClass" name="fraud_risk" label="Riesgo de fraude" v-model="fraud_risk">
            <option value="">Sin definir</option>
            <option value="low">Bajo</option>
            <option value="medium">Medio</option>
            <option value="high">Alto</option>
        </select-input-component>

        <button-component :custom-class="buttonClass" :disabled="disabled" value="Crear" />

    </form>

</template>

<script>
    import { createModel } from '@models/deal-lead'
    import JSValidator from 'innoboxrr-js-validator'
    import {
        TextInputComponent,
        SelectInputComponent,
        TextareaInputComponent,
        ButtonComponent
    } from 'innoboxrr-form-elements'

    export default {
        components: {
            TextInputComponent,
            SelectInputComponent,
            TextareaInputComponent,
            ButtonComponent
        },

        props: {
            formId: {
                type: String,
                default: 'createDealLeadForm',
            }
        },

        emits: ['submit'],

        data() {
            return {
                name: '', email: '', phone: '', whatsapp: '', dob: '', gender: '',
                address: '', postalcode: '', city: '', state: '', country: '',
                utm_source: '', utm_medium: '', utm_campaign: '', utm_term: '', utm_content: '',
                url: '', referer: '', ip: '', platform: '', traffic_id: '',
                status: '', score: '', cpl: '', assigned_at: '', conversion_stage: '', deal_gateway_id: '',
                is_test: '0', other: '', duplicates_with: '', notes: '', source_verified_at: '',
                time_on_page: '', interaction_count: '', form_steps_completed: '',
                interest_level: '', fraud_risk: '',
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
                    createModel({ ...this.$data }).then(res => {
                        this.$emit('submit', res)
                        setTimeout(() => { this.disabled = false }, 2500)
                    }).catch(error => {
                        this.disabled = false
                        if (error?.response?.status === 422) {
                            this.JSValidator.appendExternalErrors(error.response.data.errors)
                        }
                    })
                } else {
                    this.disabled = false
                }
            }
        }
    }
</script>
