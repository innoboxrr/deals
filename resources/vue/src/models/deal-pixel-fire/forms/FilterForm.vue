<template>

    <form id="dealPixelFireFilterForm" @submit.prevent="onSubmit">

        <div class="uk-child-width-1-2@m uk-child-width-1-1@s" uk-grid>

            <!-- FIRED AT -->
            <text-input-component
                :custom-class="inputClass"
                name="fired_at"
                label="Disparado en"
                placeholder="YYYY-MM-DD HH:mm:ss"
                v-model="fired_at" />

            <!-- RESPONSE -->
            <textarea-input-component
                :custom-class="inputClass"
                name="response"
                label="Respuesta"
                v-model="response" />

            <!-- PLATFORM TYPE -->
            <select-input-component
                :custom-class="inputClass"
                name="platform_type"
                label="Tipo de plataforma"
                v-model="platform_type">
                <option value="">Todos</option>
                <option value="Affiliate">Affiliate</option>
                <option value="DealAdPlatform">DealAdPlatform</option>
            </select-input-component>

            <!-- PLATFORM ID -->
            <text-input-component
                :custom-class="inputClass"
                name="platform_id"
                label="ID de la plataforma"
                v-model="platform_id" />

            <!-- TRACKING EVENT ID -->
            <text-input-component
                :custom-class="inputClass"
                name="deal_lead_traking_event_id"
                label="ID del evento del lead"
                v-model="deal_lead_traking_event_id" />

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
    TextareaInputComponent,
    SelectInputComponent
} from 'innoboxrr-form-elements'

export default {

    components: {
        TextInputComponent,
        TextareaInputComponent,
        SelectInputComponent,
    },

    emits: ['submit'],

    data() {
        return {
            fired_at: '',
            response: '',
            platform_type: '',
            platform_id: '',
            deal_lead_traking_event_id: '',
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
