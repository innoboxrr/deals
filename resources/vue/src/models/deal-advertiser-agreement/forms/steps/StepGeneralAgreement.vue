<template>
	<div>

		<!-- DEAL ASOCIADO -->
		<model-search-input-component 
			custom-class="bg-gray-50 rounded-lg text-sm py-0.5 border border-gray-300"
			label-str="Buscar Deal por nombre o ID"
			placeholder-str="Escribe para buscar"
			:route="dealRoute"
			q="name"
			:externalFilters="{
				include_advertisers: true,
				only_active: true,
				skip_workspace_filter: true,
			}"
			:get-option-label="option => `${option.name} (ID: ${option.id})`"
			@submit="setDeal" />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 -mb-4">
            <div>
                <!-- FECHAS -->
                <text-input-component
                    :custom-class="inputClass"
                    type="date"
                    name="start_date"
                    label="Fecha de inicio"
                    validators="required"
                    v-model="localAgreement.payload.general.start_date" />
            </div>
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="date"
                    name="end_date"
                    label="Fecha de finalización"
                    validators="required"
                    v-model="localAgreement.payload.general.end_date" />
            </div>
        </div>

		<!-- CONTRATO -->
		<textarea-input-component
			:custom-class="inputClass"
			name="contract_terms"
			label="Términos del contrato"
			validators="required length"
			:min_length="3"
			v-model="localAgreement.payload.general.contract_terms" />

		<!-- NOTAS DE FINALIZACIÓN -->
		<textarea-input-component
			:custom-class="inputClass"
			name="completion_notes"
			label="Notas de finalización"
			v-model="localAgreement.payload.general.completion_notes" />
	</div>
</template>

<script>
import {
	TextInputComponent,
	TextareaInputComponent,
	ModelSearchInputComponent
} from 'innoboxrr-form-elements'

export default {
	name: 'StepGeneralAgreement',
	components: {
		TextInputComponent,
		TextareaInputComponent,
		ModelSearchInputComponent
	},
	props: {
		modelValue: {
			type: Object,
			required: true
		}
	},
	data() {
		return {
			dealRoute: route('api.innoboxrr.deals.deal.index') // Ajusta si usas otro endpoint
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
				const general = val.payload?.general
				const valid =
					val.deal_id &&
					general?.start_date &&
					general?.end_date &&
					(general?.contract_terms?.length || 0) >= 3

				this.$emit('validated', valid)
			},
			deep: true,
			immediate: true
		}
	},
	methods: {
		setDeal(dealId) {
			this.localAgreement.deal_id = dealId
		}
	}
}
</script>
