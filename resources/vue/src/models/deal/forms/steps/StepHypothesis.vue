<template>
    <div>
        <!-- CTR esperado -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="hypothesis_ctr"
            label="CTR esperado (%)"
            placeholder="Ej: 2.5"
            :steps="0.01"
            v-model="localDeal.payload.hypothesis.ctr" />

        <!-- CPL ideal -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="hypothesis_cpl"
            label="CPL ideal"
            placeholder="Ej: 15.00"
            :steps="0.01"
            v-model="localDeal.payload.hypothesis.cpl" />

        <!-- CPA ideal -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="hypothesis_cpa"
            label="CPA ideal"
            placeholder="Ej: 40.00"
            :steps="0.01"
            v-model="localDeal.payload.hypothesis.cpa" />

        <!-- Conversión estimada -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="hypothesis_conversion_rate"
            label="Tasa de conversión estimada (%)"
            placeholder="Ej: 5.0"
            :steps="0.01"
            v-model="localDeal.payload.hypothesis.conversion_rate" />

        <!-- Leads esperados por día -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="hypothesis_leads_per_day"
            label="Leads esperados por día"
            placeholder="Ej: 20"
            validators="integer"
            v-model="localDeal.payload.hypothesis.leads_per_day" />

        <!-- ROI estimado -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="hypothesis_roi"
            label="ROI estimado (%)"
            placeholder="Ej: 120"
            :steps="0.01"
            v-model="localDeal.payload.hypothesis.roi" />
    </div>
</template>

<script>
    import {
        TextInputComponent
    } from 'innoboxrr-form-elements'

    export default {
        name: 'StepHypothesis',
        components: {
            TextInputComponent,
        },
        props: {
            modelValue: {
                type: Object,
                required: true
            }
        },
        data() {
            return {}
        },
        computed: {
            localDeal: {
                get() {
                    return this.modelValue
                },
                set(value) {
                    this.$emit('update:modelValue', value)
                }
            }
        },
        watch: {
            localDeal: {
                handler(val) {
                    const h = val.payload?.hypothesis
                    const valid = !!(h?.ctr || h?.cpl || h?.cpa || h?.conversion_rate || h?.leads_per_day)
                    this.$emit('validated', valid)
                },
                deep: true,
                immediate: true
            }
        }
    }
</script>
