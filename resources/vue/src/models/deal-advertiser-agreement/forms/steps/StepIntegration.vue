<template>
	<div>
		<h3 class="text-lg font-semibold mb-4 flex items-center justify-between">
			{{ __deals('Integration Calls') }}
			<button 
				@click="allCollapsed = !allCollapsed"
				class="text-sm font-medium text-blue-600 hover:no-underline hover:text-blue-500 transition duration-200 flex items-center">
				<i class="fas mr-2"
					:class="allCollapsed ? 'fa-angle-double-down' : 'fa-angle-double-up'"></i>
				{{ allCollapsed ? __deals('Expand') : __deals('Collapse') }}
			</button>
		</h3>

		<draggable
			v-model="localAgreement.payload.integration.calls"
			handle=".drag-handle"
			item-key="order"
			animation="200"
			class="space-y-4">
			<template #item="{ element, index }">
				<integration-call-item
					:model-value="element"
					:index="index"
					:collapsed-state="allCollapsed"
					@update:modelValue="updateCall(index, $event)"
					@duplicate="duplicateCall(index)"
					@remove="removeCall(index)" />
			</template>
		</draggable>

		<div class="mt-4">
			<button-component
				:custom-class="buttonClass"
				value="Agregar llamado"
				@click="addCall" />
		</div>
	</div>
</template>

<script>
import draggable from 'vuedraggable'
import { ButtonComponent } from 'innoboxrr-form-elements'
import IntegrationCallItem from './step-integration/IntegrationCallItem.vue' // será lo siguiente que armemos

export default {
	name: 'StepIntegration',
	components: {
		draggable,
		ButtonComponent,
		IntegrationCallItem
	},
	props: {
		modelValue: {
			type: Object,
			required: true
		}
	},
	data() {
		return {
			allCollapsed: false
		};
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
				const calls = val.payload?.integration?.calls
				const valid = Array.isArray(calls) && calls.length > 0
				this.$emit('validated', valid)
			},
			deep: true,
			immediate: true
		}
	},
	methods: {
		addCall() {
			const newCall = {
				order: this.localAgreement.payload.integration.calls.length + 1,
				endpoint: '',
				method: 'POST',
				data_method: 'json',
				headers: [],
				auth: {
					type: 'none',
                    api_key: '',
                    username: '',
                    password: '',
                    oauth: {
                        refresh_url: '',
                        refresh_token: '',
                        expiration: '',
                        client_id: '',
                        client_secret: ''
                    }
				},
				mapping: [],
				response_validation: {
					validators: [],
					code: null
				},
				parse_object: this.defaultCodeTemplate()
			}
			this.localAgreement.payload.integration.calls.push(newCall)
		},
		defaultCodeTemplate() {
            return [
                'function parseObject($object, $lead, $previous_response = null) {',
                '    // Puedes modificar el valor aquí usando object y lead',
                '    return $object;',
                '}'
            ].join('\n')
        },
		updateCall(index, updatedCall) {
			this.localAgreement.payload.integration.calls.splice(index, 1, updatedCall)
		},
		removeCall(index) {
			this.localAgreement.payload.integration.calls.splice(index, 1)
		},
		duplicateCall(index) {
			const callToDuplicate = this.localAgreement.payload.integration.calls[index]
			const duplicatedCall = { ...callToDuplicate, order: this.localAgreement.payload.integration.calls.length + 1 }
			this.localAgreement.payload.integration.calls.push(duplicatedCall)
		},
	}
}
</script>

<style scoped>
/* Opcional: estilos para arrastrar */
</style>
