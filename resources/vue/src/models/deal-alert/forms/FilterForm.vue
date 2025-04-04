<template>

    <form id="dealAlertFilterForm" @submit.prevent="onSubmit">

        <div class="uk-flex uk-flex-left uk-child-width-1-3@m uk-child-width-1-1@s" uk-grid>

            <!-- DEAL ID -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="deal_id"
                    label="ID del Deal"
                    v-model="deal_id" />
            </div>

            <!-- TYPE -->
            <div>
                <select-input-component
                    name="type"
                    label="Tipo de alerta"
                    v-model="type">
                    <option value="">Todos</option>
                    <option value="high_cpl">Costo por lead alto</option>
                    <option value="low_conversion">Baja conversión</option>
                    <option value="lead_overload">Sobrecarga de leads</option>
                    <option value="no_feedback">Sin feedback</option>
                </select-input-component>
            </div>

            <!-- MESSAGE -->
            <div>
                <textarea-input-component
                    :custom-class="inputClass"
                    name="message"
                    label="Mensaje"
                    v-model="message" />
            </div>

            <!-- STATUS -->
            <div>
                <select-input-component
                    name="status"
                    label="Estado"
                    v-model="status">
                    <option value="">Todos</option>
                    <option value="pending">Pendiente</option>
                    <option value="resolved">Resuelta</option>
                    <option value="ignored">Ignorada</option>
                </select-input-component>
            </div>

            <!-- DETECTED AT -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="detected_at"
                    label="Detectada en"
                    placeholder="YYYY-MM-DD HH:mm"
                    v-model="detected_at" />
            </div>

        </div>

        <div class="uk-flex uk-flex-right uk-child-width-auto@m uk-child-width-1-1@m" uk-grid>
            <div>
                <button :class="buttonClass">
                    {{ __('Buscar') }}
                </button>
            </div>
            <div>
                <button 
                    :class="buttonClass + ' bg-gray-400'"
                    @click.prevent="resetForm()">
                    {{ __('Resetear') }}
                </button>
            </div>
        </div>

    </form>

</template>

<script>

    import {
        TextInputComponent,
        SelectInputComponent,
        TextareaInputComponent,
    } from 'innoboxrr-form-elements'

    export default {

        components: {
            TextInputComponent,
            SelectInputComponent,
            TextareaInputComponent,
        },

        emits: ['submit'],

        data() {
            return {
                deal_id: '',
                type: '',
                message: '',
                status: '',
                detected_at: '',
            }
        },

        methods: {

            onSubmit() {
                this.$emit('submit', {
                    deal_id: this.deal_id,
                    type: this.type,
                    message: this.message,
                    status: this.status,
                    detected_at: this.detected_at,
                });
            },

            resetForm() {
                Object.assign(this.$data, this.$options.data());
                this.onSubmit();
            }
        }
    }
</script>
