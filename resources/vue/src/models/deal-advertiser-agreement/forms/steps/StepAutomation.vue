<template>
	<div>

		<!-- PAUSE UNTIL -->
		<text-input-component
			:custom-class="inputClass"
			type="date"
			name="pause_until"
			label="Pausar hasta"
			v-model="localAgreement.payload.automation.pause_until" />

		<!-- PAUSE REASON -->
		<textarea-input-component
			:custom-class="inputClass"
			name="pause_reason"
			label="Motivo de pausa"
			v-model="localAgreement.payload.automation.pause_reason" />

		<!-- CPC -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="cpc"
			label="CPC (Costo por clic)"
			validators="decimal"
			:steps="0.01"
			v-model="localAgreement.payload.automation.cpc" />

		<!-- CPM -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="cpm"
			label="CPM (Costo por mil impresiones)"
			validators="decimal"
			:steps="0.01"
			v-model="localAgreement.payload.automation.cpm" />

	</div>
</template>

<script>
import {
	TextInputComponent,
	TextareaInputComponent
} from 'innoboxrr-form-elements'

export default {
	name: 'StepAutomation',
	components: {
		TextInputComponent,
		TextareaInputComponent
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
				const a = val.payload?.automation
				const valid = !!(
					a?.pause_reason ||
					a?.pause_until ||
					a?.cpc ||
					a?.cpm
				)
				this.$emit('validated', valid)
			},
			deep: true,
			immediate: true
		}
	}
}
</script>
