<template>

    <form id="dealPerformanceSnapshotFilterForm" @submit.prevent="onSubmit">

        <div class="uk-child-width-1-3@m uk-child-width-1-1@s" uk-grid>

            <!-- DEAL ID -->
            <text-input-component
                :custom-class="inputClass"
                name="deal_id"
                label="ID del Deal"
                v-model="deal_id" />

            <!-- TIME -->
            <text-input-component
                :custom-class="inputClass"
                name="time"
                label="Fecha / Hora"
                placeholder="YYYY-MM-DD"
                v-model="time" />

            <!-- LEADS GENERATED -->
            <text-input-component
                :custom-class="inputClass"
                type="number"
                name="leads_generated"
                label="Leads generados"
                v-model="leads_generated" />

            <!-- LEADS ASSIGNED -->
            <text-input-component
                :custom-class="inputClass"
                type="number"
                name="leads_assigned"
                label="Leads asignados"
                v-model="leads_assigned" />

            <!-- AVG CPL -->
            <text-input-component
                :custom-class="inputClass"
                type="number"
                name="avg_cpl"
                label="CPL promedio"
                v-model="avg_cpl" />

            <!-- AVG CONVERSION RATE -->
            <text-input-component
                :custom-class="inputClass"
                type="number"
                name="avg_conversion_rate"
                label="Conversión promedio"
                v-model="avg_conversion_rate" />

            <!-- AVG ROI -->
            <text-input-component
                :custom-class="inputClass"
                type="number"
                name="avg_roi"
                label="ROI promedio"
                v-model="avg_roi" />

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

import { TextInputComponent } from 'innoboxrr-form-elements'

export default {

    components: {
        TextInputComponent,
    },

    emits: ['submit'],

    data() {
        return {
            deal_id: '',
            time: '',
            leads_generated: '',
            leads_assigned: '',
            avg_cpl: '',
            avg_conversion_rate: '',
            avg_roi: '',
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
