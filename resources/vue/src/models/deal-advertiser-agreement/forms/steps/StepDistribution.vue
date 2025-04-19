<template>
	<div>

		<!-- CPL -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="current_cpl"
			label="CPL actual"
			validators="decimal"
			v-model="localAgreement.payload.distribution.current_cpl" />

		<!-- CPA -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="current_cpa"
			label="CPA actual"
			validators="decimal"
			v-model="localAgreement.payload.distribution.current_cpa" />

		<!-- CTR -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="current_ctr"
			label="CTR actual (%)"
			validators="decimal"
			v-model="localAgreement.payload.distribution.current_ctr" />

		<!-- CPM -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="current_cpm"
			label="CPM actual"
			validators="decimal"
			v-model="localAgreement.payload.distribution.current_cpm" />

		<!-- CPC -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="current_cpc"
			label="CPC actual"
			validators="decimal"
			v-model="localAgreement.payload.distribution.current_cpc" />

		<!-- LEADS ASIGNADOS -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="current_leads_assigned"
			label="Leads asignados"
			validators="integer"
			v-model="localAgreement.payload.distribution.current_leads_assigned" />

		<!-- ROI -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="current_roi"
			label="ROI actual (%)"
			validators="decimal"
			v-model="localAgreement.payload.distribution.current_roi" />

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
				const valid = !!(
					d?.current_cpl ||
					d?.current_cpa ||
					d?.current_ctr ||
					d?.current_cpm ||
					d?.current_cpc ||
					d?.current_leads_assigned ||
					d?.current_roi
			 )
				this.$emit('validated', valid)
			},
			deep: true,
			immediate: true
		}
	}
}
</script>
