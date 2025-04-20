<template>
    <div class="space-y-6">

        <!-- ESTIMACIONES DE PERFORMANCE -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.performance = !collapsed.performance">
                <span class="text-sm font-semibold">Performance Estimates</span>
                <i :class="['fa-solid', collapsed.performance ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.performance" class="p-4 space-y-4">

                <!-- CTR -->
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="estimate_ctr"
                    :label="__deals('Estimated CTR (%)')"
                    :placeholder="__deals('Ex: 2.5')"
                    :help="__deals('The Click-Through Rate (CTR) represents the percentage of users who click on an ad after seeing it. A healthy CTR indicates that your ad is relevant and engaging. Ideal range: 1.5% - 3.5%')"
                    validators="decimal"
                    :steps="0.01"
                    v-model="localAgreement.payload.estimate_metrics.ctr" />

                <!-- CPL -->
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="estimate_cpl"
                    :label="__deals('Estimated CPL')"
                    :placeholder="__deals('Ex: 30.00')"
                    :help="__deals('Cost Per Lead (CPL) estimates how much it costs to acquire a single lead. Lower CPL generally means a more efficient campaign. Ideal CPL varies by industry. Common healthy range: $10 - $50 USD')"
                    validators="decimal"
                    :steps="0.01"
                    v-model="localAgreement.payload.estimate_metrics.cpl" />

                <!-- CPA -->
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="estimate_cpa"
                    :label="__deals('Estimated CPA')"
                    :placeholder="__deals('Ex: 60.00')"
                    :help="__deals('Cost Per Acquisition (CPA) reflects the cost of getting one paying customer or conversion. It helps measure true campaign performance. Ideal CPA depends on the product/service. Healthy range: $30 - $100 USD')"
                    validators="decimal"
                    :steps="0.01"
                    v-model="localAgreement.payload.estimate_metrics.cpa" />

                <!-- Conversion Rate -->
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="conversion_rate"
                    :label="__deals('Estimated Conversion Rate (%)')"
                    :placeholder="__deals('Ex: 5.0')"
                    :help="__deals('Conversion Rate is the percentage of visitors who complete a desired action (e.g., filling a form, purchase). Healthy range: 3% - 10%')"
                    validators="decimal"
                    :steps="0.01"
                    v-model="localAgreement.payload.estimate_metrics.conversion_rate" />

                <!-- Leads per Day -->
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="leads_per_day"
                    :label="__deals('Expected Leads per Day')"
                    :placeholder="__deals('Ex: 20')"
                    :help="__deals('Estimate the number of leads your campaign should generate daily. Depends on budget and goals, but 10+ leads/day is often a good benchmark.')"
                    validators="integer"
                    v-model="localAgreement.payload.estimate_metrics.leads_per_day" />

                <!-- ROI -->
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="roi"
                    :label="__deals('Estimated ROI (%)')"
                    :placeholder="__deals('Ex: 120')"
                    :help="__deals('Return on Investment (ROI) shows the expected profitability. A 100% ROI means you doubled your investment. Healthy campaigns usually aim for 100% - 300%')"
                    validators="decimal"
                    :steps="0.01"
                    v-model="localAgreement.payload.estimate_metrics.roi" />

                <!-- Qualification Rate -->
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="lead_qualification_rate"
                    :label="__deals('Estimated Lead Qualification Rate (%)')"
                    :placeholder="__deals('Ex: 70')"
                    :help="__deals('Percentage of leads that are considered qualified based on client criteria. Typically over 60% is acceptable.')"
                    validators="decimal"
                    :steps="0.01"
                    v-model="localAgreement.payload.estimate_metrics.lead_qualification_rate" />
            </div>
        </div>
    </div>
</template>

<script>
import { TextInputComponent } from 'innoboxrr-form-elements'

export default {
    name: 'StepEstimateMetrics',
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
                performance: false
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
                const e = val.payload?.estimate_metrics
                const valid = Object.values(e || {}).some(v => v !== '' && v !== undefined)
                this.$emit('validated', valid)
            },
            deep: true,
            immediate: true
        }
    }
}
</script>
