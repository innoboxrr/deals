<template>
	<div class="space-y-4">

		<!-- Lista de headers -->
		<div
			v-for="(header, index) in localHeaders"
			:key="index"
			class="grid grid-cols-[1fr_1fr_auto] gap-x-4 items-end">

			<text-input-component
				class="uk-margin-remove"
				:custom-class="inputClass"
				type="text"
				label="Key"
				v-model="header.key" />

			<text-input-component
				class="uk-margin-remove"
				:custom-class="inputClass"
				type="text"
				label="Value"
				v-model="header.value" />

			<!-- Botón eliminar -->
			<button
				class="text-red-500 text-sm hover:text-red-700 self-start mt-8"
				:title="'Eliminar header'"
				@click="removeHeader(index)">
				<i class="fa-solid fa-times"></i>
			</button>
		</div>

		<!-- Botón Agregar -->
		<div>
			<button
				type="button"
				class="text-sm text-blue-600 hover:underline font-medium mb-6"
				@click="addHeader">
				+ Agregar Header
			</button>
		</div>
	</div>
</template>

<script>
import { TextInputComponent } from 'innoboxrr-form-elements'

export default {
	name: 'HeadersInputComponent',
	components: {
		TextInputComponent
	},
	props: {
		modelValue: {
			type: Array,
		 required: true
		}
	},
	emits: ['update:modelValue'],
	computed: {
		localHeaders: {
			get() {
				return this.modelValue
			},
			set(val) {
				this.$emit('update:modelValue', val)
			}
		}
	},
	methods: {
		addHeader() {
			this.localHeaders.push({ key: '', value: '' })
		},
		removeHeader(index) {
			this.localHeaders.splice(index, 1)
		}
	}
}
</script>
