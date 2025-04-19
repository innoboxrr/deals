<template>
	<div>

		<!-- CTR -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="estimate_ctr"
			label="CTR estimado (%)"
			placeholder="Ej: 2.5"
			validators="decimal"
			:steps="0.01"
			v-model="localAgreement.payload.estimate_metrics.ctr" />

		<!-- CPL -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="estimate_cpl"
			label="CPL estimado"
			placeholder="Ej: 30.00"
			validators="decimal"
			:steps="0.01"
			v-model="localAgreement.payload.estimate_metrics.cpl" />

		<!-- CPA -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="estimate_cpa"
			label="CPA estimado"
			placeholder="Ej: 60.00"
			validators="decimal"
			:steps="0.01"
			v-model="localAgreement.payload.estimate_metrics.cpa" />

		<!-- Tasa de conversión -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="conversion_rate"
			label="Tasa de conversión estimada (%)"
			placeholder="Ej: 5.0"
			validators="decimal"
			:steps="0.01"
			v-model="localAgreement.payload.estimate_metrics.conversion_rate" />

		<!-- Leads esperados por día -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="leads_per_day"
			label="Leads esperados por día"
			placeholder="Ej: 20"
			validators="integer"
			v-model="localAgreement.payload.estimate_metrics.leads_per_day" />

		<!-- ROI estimado -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="roi"
			label="ROI estimado (%)"
			placeholder="Ej: 120"
			validators="decimal"
			:steps="0.01"
			v-model="localAgreement.payload.estimate_metrics.roi" />

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
				const valid = !!(
					e?.ctr ||
					e?.cpl ||
					e?.cpa ||
					e?.conversion_rate ||
					e?.leads_per_day ||
					e?.roi
			 )
				this.$emit('validated', valid)
			},
			deep: true,
			immediate: true
		}
	}
}
</script>
