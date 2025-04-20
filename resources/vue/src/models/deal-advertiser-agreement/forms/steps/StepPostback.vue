<template>
	<div>

		<!-- ACTIVACIÓN -->
		<select-input-component
			:custom-class="inputClass"
			name="enabled"
			label="¿Activar postback?"
			v-model="localAgreement.payload.postback.enabled">
			<option :value="true">Sí</option>
			<option :value="false">No</option>
		</select-input-component>

		<div v-if="localAgreement.payload.postback.enabled === true">
			<!-- TOKEN -->
			<div class="flex gap-x-2 items-end">
				<div class="flex-1">
					<text-input-component
						:custom-class="inputClass"
						type="text"
						name="token"
						label="Token de autenticación"
						placeholder="Autogenerado si lo deseas"
						validators="required length"
						:min_length="6"
						v-model="localAgreement.payload.postback.token" />
				</div>

				<!-- Botón alineado a la base -->
				<div class="-mb-1.5">
					<button-component
						:custom-class="buttonClass + ' px-3 py-2 -mb-0.5'"
						value="Generar"
						@click="generateToken" />
				</div>
			</div>

			<!-- MÉTODO -->
			<select-input-component	
				class="uk-margin-remove"
				:custom-class="inputClass"
				name="postback_method"
				label="Método HTTP esperado"
				v-model="localAgreement.payload.postback.method">
				<option value="POST">POST</option>
				<option value="GET">GET</option>
			</select-input-component>

			<!-- IPs PERMITIDAS -->
			<tags-input-component
				:custom-class="inputClass"
				name="allowed_ips"
				label="IPs permitidas para recibir postback"
				placeholder="Ej: 192.168.1.1"
				v-model="localAgreement.payload.postback.allowed_ips" />
		</div>
	</div>
</template>

<script>
import {
	TextInputComponent,
	SelectInputComponent,
	TagsInputComponent,
	ButtonComponent
} from 'innoboxrr-form-elements'

export default {
	name: 'StepPostback',
	components: {
		TextInputComponent,
		SelectInputComponent,
		TagsInputComponent,
		ButtonComponent
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
	methods: {
		generateToken() {
			const token = crypto.randomUUID().replace(/-/g, '')
			this.localAgreement.payload.postback.token = token
		}
	},
	watch: {
		localAgreement: {
			handler(val) {
				const p = val.payload?.postback
				const valid = !!(p?.enabled && p?.token?.length >= 6)
				this.$emit('validated', valid)
			},
			deep: true,
			immediate: true
		}
	}
}
</script>
