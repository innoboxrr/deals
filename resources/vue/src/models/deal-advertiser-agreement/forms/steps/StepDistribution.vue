<template>
    <div class="space-y-6">

        <!-- COST METRICS -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.costs = !collapsed.costs">
                <span class="text-sm font-semibold">Cost Metrics</span>
                <i :class="['fa-solid', collapsed.costs ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.costs" class="p-4 space-y-4">
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="current_cpl"
                    label="Current CPL"
                    validators="decimal"
                    v-model="localAgreement.payload.distribution.current_cpl" />

                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="current_cpa"
                    label="Current CPA"
                    validators="decimal"
                    v-model="localAgreement.payload.distribution.current_cpa" />

                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="current_cpc"
                    label="Current CPC"
                    validators="decimal"
                    v-model="localAgreement.payload.distribution.current_cpc" />

                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="current_cpm"
                    label="Current CPM"
                    validators="decimal"
                    v-model="localAgreement.payload.distribution.current_cpm" />
            </div>
        </div>

        <!-- PERFORMANCE METRICS -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.performance = !collapsed.performance">
                <span class="text-sm font-semibold">Performance Metrics</span>
                <i :class="['fa-solid', collapsed.performance ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.performance" class="p-4 space-y-4">
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="current_ctr"
                    label="Current CTR (%)"
                    validators="decimal"
                    v-model="localAgreement.payload.distribution.current_ctr" />

                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="current_roi"
                    label="Current ROI (%)"
                    validators="decimal"
                    v-model="localAgreement.payload.distribution.current_roi" />
            </div>
        </div>

        <!-- VOLUME METRICS -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.volume = !collapsed.volume">
                <span class="text-sm font-semibold">Volume Metrics</span>
                <i :class="['fa-solid', collapsed.volume ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.volume" class="p-4 space-y-4">
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="current_leads_assigned"
                    label="Assigned Leads"
                    validators="integer"
                    v-model="localAgreement.payload.distribution.current_leads_assigned" />
            </div>
        </div>

    </div>
</template>

<script>
import { TextInputComponent } from 'innoboxrr-form-elements'

export default {
    name: 'StepDistribution',
    components: {
        TextInputComponent
    },
    props: {
        modelValue: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            collapsed: {
                costs: false,
                performance: true,
                volume: true
            }
        }
    },
    computed: {
        localAgreement: {
            get() {
                return this.modelValue
            },
            set(value) {
                this.$emit('update:modelValue', value)
            }
        }
    },
    watch: {
        localAgreement: {
            handler(val) {
                const d = val.payload?.distribution
                this.$emit('validated', true)
            },
            deep: true,
            immediate: true
        }
    }
}
</script>
