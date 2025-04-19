<template>
	<div>
		<h3 class="text-lg font-semibold mb-4">
            Integraciones
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
					@update:modelValue="updateCall(index, $event)"
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
				mapping: []
			}
			this.localAgreement.payload.integration.calls.push(newCall)
		},
		updateCall(index, updatedCall) {
			this.localAgreement.payload.integration.calls.splice(index, 1, updatedCall)
		},
		removeCall(index) {
			this.localAgreement.payload.integration.calls.splice(index, 1)
		}
	}
}
</script>

<style scoped>
/* Opcional: estilos para arrastrar */
</style>
