<template>
	<div>

		<!-- AUTORENOVACIÓN -->
		<select-input-component
			:custom-class="inputClass"
			name="autorenewal"
			label="¿Renovar automáticamente?"
			validators="required"
			v-model="localAgreement.payload.billings.autorenewal">
			<option :value="true">Sí</option>
			<option :value="false">No</option>
		</select-input-component>

		<!-- MANAGEMENT FEE -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="management_fee"
			label="Costo de administración"
			placeholder="Ej: 500"
			validators="decimal"
			v-model="localAgreement.payload.billings.management_fee" />

		<!-- BUDGET -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="budget"
			label="Presupuesto"
			placeholder="Ej: 10000"
			validators="decimal"
			v-model="localAgreement.payload.billings.budget" />

		<!-- BUDGET FEE -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="budget_fee"
			label="Comisión sobre presupuesto (%)"
			placeholder="Ej: 30"
			validators="decimal"
			v-model="localAgreement.payload.billings.budget_fee" />

		<!-- NET BUDGET -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="net_budget"
			label="Presupuesto Neto"
			placeholder="Ej: 7000"
			validators="decimal"
			v-model="localAgreement.payload.billings.net_budget" />

		<!-- BUDGET SPENT -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="budget_spent"
			label="Gasto real"
			placeholder="Ej: 6800"
			validators="decimal"
			v-model="localAgreement.payload.billings.budget_spent" />

	</div>
</template>

<script>
import {
	TextInputComponent,
	SelectInputComponent
} from 'innoboxrr-form-elements'

export default {
	name: 'StepBillingAgreement',
	components: {
		TextInputComponent,
		SelectInputComponent
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
			set(val) {
				this.$emit('update:modelValue', val)
			}
		}
	},
	watch: {
		localAgreement: {
			handler(val) {
				const b = val.payload?.billings
				const valid = b &&
					b.autorenewal !== '' &&
					b.management_fee !== '' &&
					b.budget !== '' &&
					b.budget_fee !== '' &&
					b.net_budget !== '' &&
					b.budget_spent !== ''
				this.$emit('validated', valid)
			},
			deep: true,
			immediate: true
		}
	}
}
</script>
