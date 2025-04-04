<template>

    <form id="dealLeadFilterForm" @submit.prevent="onSubmit">

        <div class="uk-child-width-1-3@m uk-child-width-1-1@s" uk-grid>

            <!-- IDENTIDAD -->
            <text-input-component :custom-class="inputClass" name="name" label="Nombre" v-model="name" />
            <text-input-component :custom-class="inputClass" name="email" label="Email" v-model="email" />
            <text-input-component :custom-class="inputClass" name="phone" label="Teléfono" v-model="phone" />
            <text-input-component :custom-class="inputClass" name="whatsapp" label="WhatsApp" v-model="whatsapp" />

            <!-- STATUS -->
            <select-input-component :custom-class="inputClass" name="status" label="Estatus" v-model="status">
                <option value="">Todos</option>
                <option value="new">Nuevo</option>
                <option value="assigned">Asignado</option>
                <option value="rejected">Rechazado</option>
                <option value="sold">Vendido</option>
            </select-input-component>

            <!-- BOOLEANO -->
            <select-input-component :custom-class="inputClass" name="is_test" label="¿Es test?" v-model="is_test">
                <option value="">Todos</option>
                <option value="0">No</option>
                <option value="1">Sí</option>
            </select-input-component>

            <!-- INTERÉS Y FRAUDE -->
            <select-input-component :custom-class="inputClass" name="interest_level" label="Interés" v-model="interest_level">
                <option value="">Todos</option>
                <option value="low">Bajo</option>
                <option value="medium">Medio</option>
                <option value="high">Alto</option>
            </select-input-component>

            <select-input-component :custom-class="inputClass" name="fraud_risk" label="Riesgo fraude" v-model="fraud_risk">
                <option value="">Todos</option>
                <option value="low">Bajo</option>
                <option value="medium">Medio</option>
                <option value="high">Alto</option>
            </select-input-component>

            <!-- UTM Y TRAFICO -->
            <text-input-component :custom-class="inputClass" name="utm_source" label="UTM Source" v-model="utm_source" />
            <text-input-component :custom-class="inputClass" name="utm_campaign" label="UTM Campaign" v-model="utm_campaign" />
            <text-input-component :custom-class="inputClass" name="platform" label="Plataforma" v-model="platform" />
            <text-input-component :custom-class="inputClass" name="traffic_id" label="Traffic ID" v-model="traffic_id" />

            <!-- FECHAS -->
            <text-input-component :custom-class="inputClass" name="assigned_at" label="Asignado en" v-model="assigned_at" />
            <text-input-component :custom-class="inputClass" name="source_verified_at" label="Verificado en" v-model="source_verified_at" />

            <!-- MÉTRICAS -->
            <text-input-component :custom-class="inputClass" type="number" name="score" label="Score" v-model="score" />
            <text-input-component :custom-class="inputClass" type="number" name="cpl" label="CPL" v-model="cpl" />
            <text-input-component :custom-class="inputClass" type="number" name="interaction_count" label="Interacciones" v-model="interaction_count" />
            <text-input-component :custom-class="inputClass" type="number" name="form_steps_completed" label="Pasos completados" v-model="form_steps_completed" />

        </div>

        <div class="uk-flex uk-flex-right uk-child-width-auto@m uk-child-width-1-1@m" uk-grid>
            <div>
                <button :class="buttonClass">
                    Buscar
                </button>
            </div>
            <div>
                <button 
                    :class="buttonClass + ' bg-gray-400'"
                    @click.prevent="resetForm()">
                    Resetear
                </button>
            </div>
        </div>

    </form>

</template>

<script>

    import {
        TextInputComponent,
        SelectInputComponent,
    } from 'innoboxrr-form-elements'

    export default {

        components: {
            TextInputComponent,
            SelectInputComponent,
        },

        emits: ['submit'],

        data() {
            return {
                name: '', email: '', phone: '', whatsapp: '',
                status: '', is_test: '', interest_level: '', fraud_risk: '',
                utm_source: '', utm_campaign: '', platform: '', traffic_id: '',
                assigned_at: '', source_verified_at: '',
                score: '', cpl: '', interaction_count: '', form_steps_completed: '',
            }
        },

        methods: {

            onSubmit() {
                this.$emit('submit', { ...this.$data })
            },

            resetForm() {
                Object.assign(this.$data, this.$options.data())
                this.onSubmit()
            }

        }
    }

</script>
