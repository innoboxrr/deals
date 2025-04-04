<template>

    <form id="dealLeadTrackingEventFilterForm" @submit.prevent="onSubmit">

        <div class="uk-child-width-1-2@m uk-child-width-1-1@s" uk-grid>

            <!-- EVENT -->
            <text-input-component
                :custom-class="inputClass"
                name="event"
                label="Evento"
                v-model="event" />

            <!-- STATUS -->
            <text-input-component
                :custom-class="inputClass"
                name="status"
                label="Estado"
                v-model="status" />

            <!-- DATA -->
            <textarea-input-component
                :custom-class="inputClass"
                name="data"
                label="Contenido / Datos"
                v-model="data" />

            <!-- DEAL LEAD ID -->
            <text-input-component
                :custom-class="inputClass"
                name="deal_lead_id"
                label="ID del Lead"
                v-model="deal_lead_id" />

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
} from 'innoboxrr-form-elements'

export default {

    components: {
        TextInputComponent,
        TextareaInputComponent,
    },

    emits: ['submit'],

    data() {
        return {
            event: '',
            status: '',
            data: '',
            deal_lead_id: '',
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
