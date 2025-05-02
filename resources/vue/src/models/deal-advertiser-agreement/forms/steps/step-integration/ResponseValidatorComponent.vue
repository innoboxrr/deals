<template>
	<div class="space-y-3">
		<draggable
			v-model="localValidators"
			handle=".drag-handle"
			item-key="index"
			animation="200"
			class="space-y-2">

			<template #item="{ element, index }">
				<div class="border rounded-lg bg-gray-50 overflow-hidden">

					<!-- HEADER -->
					<div
						class="flex justify-between items-start px-4 py-3 bg-gray-50 border-b border-gray-200 cursor-pointer hover:bg-gray-100 transition"
						@click="toggleCollapse(index)">
						
						<!-- Info -->
						<div class="flex items-center gap-3 text-sm font-medium text-gray-800">
							<i class="fa-solid fa-grip-lines drag-handle text-gray-400 text-base cursor-move ml-1"></i>
							<span>Validación #{{ index + 1 }}</span>
						</div>

						<!-- Acciones -->
						<div class="flex items-center gap-x-4 text-gray-400 ml-2">
							<!-- Copiar -->
							<button
								@click.stop="duplicateValidator(index)"
								title="Duplicar"
								class="hover:text-blue-500 transition">
								<i class="fa-solid fa-clone"></i>
							</button>

							<!-- Eliminar -->
							<button
								@click.stop="removeValidator(index)"
								title="Eliminar"
								class="hover:text-red-500 transition">
								<i class="fa-solid fa-trash"></i>
							</button>

							<!-- Colapsar -->
							<button
								title="Expandir/Colapsar"
								class="hover:text-gray-600 transition">
								<i :class="[ 'fa-solid', collapsed[index] ? 'fa-chevron-down' : 'fa-chevron-up' ]"></i>
							</button>
						</div>
					</div>

					<!-- BODY -->
					<div v-show="!collapsed[index]" class="p-4">
						<text-input-component
							class="uk-margin-small"
							:custom-class="inputClass"
							label="Campo del Response (dot notation)"
							placeholder="Ej: data.status"
							v-model="element.path" />

						<select-input-component
							class="uk-margin-small"
							:custom-class="inputClass"
							label="Condición"
							v-model="element.condition">
							<option value="equals">Es igual a</option>
							<option value="not_equals">No es igual a</option>
							<option value="exists">Existe</option>
							<option value="not_exists">No existe</option>
							<option value="includes">Incluye</option>
							<option value="regex">Regex</option>
						</select-input-component>

						<text-input-component
							v-if="!['exists', 'not_exists'].includes(element.condition)"
							class="uk-margin-small"
							:custom-class="inputClass"
							label="Valor esperado"
							v-model="element.expected" />

						<select-input-component
							class="uk-margin-small"
							:custom-class="inputClass"
							label="Resultado de la validación (status)"
							v-model="element.status">
							<option value="VALID">VALID</option>
							<option value="INVALID">INVALID</option>
							<option value="DUPLICATED">DUPLICATED</option>
							<option value="REJECTED">REJECTED</option>
							<option value="CAP">CAP</option>
							<option value="OUT_OF_HOUR">OUT_OF_HOUR</option>
						</select-input-component>
					</div>
				</div>
			</template>
		</draggable>

		<!-- AGREGAR -->
		<button
			type="button"
			class="text-sm text-blue-600 hover:underline font-medium"
			@click="addValidator">
			+ Agregar validación
		</button>

		<!-- Ver si se debe procesar en código -->
		<select-input-component
			:custom-class="inputClass"
			label="¿Procesar respuesta en código personalizado?"
			v-model="localValidators.use_custom_code">
			<option :value="true">Sí</option>
			<option :value="false">No</option>
		</select-input-component>

		<!-- Código personalizado -->
		<div
			v-if="localValidators.use_custom_code" 
			class="my-6 border rounded-md">
			<div
				class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer"
				@click="collapsedCode = !collapsedCode">
				<span class="text-sm font-semibold">
					Procesar en respuesta en código personalizado
				</span>
				<i :class="['fa-solid', collapsedCode ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
			</div>

			<div v-show="!collapsedCode" class="p-4">
				<code-mirror-component
					lang="javascript"
					v-model="localCustomCode"
					placeholder="// Return true si el response es válido, false si no." />
			</div>
		</div>

		<div class="my-6"></div>
	</div>
</template>

<script>
import draggable from 'vuedraggable'
import {
	TextInputComponent,
	SelectInputComponent,
	CodeMirrorComponent,
	ButtonComponent
} from 'innoboxrr-form-elements'

export default {
	name: 'ResponseValidatorComponent',
	components: {
		draggable,
		TextInputComponent,
		SelectInputComponent,
		CodeMirrorComponent,
		ButtonComponent
	},
	props: {
		modelValue: {
			type: Object,
			required: true
		}
	},
	emits: ['update:modelValue'],
	data() {
		return {
			collapsedCode: true,
			collapsed: []
		}
	},
	computed: {
		localValidators: {
			get() {
				if (!Array.isArray(this.collapsed) || this.collapsed.length !== (this.modelValue.validators || []).length) {
					this.collapsed = (this.modelValue.validators || []).map(() => true)
				}
				this.modelValue.use_custom_code = this.modelValue.use_custom_code || false;
				return this.modelValue.validators || [];
			},
			set(val) {
				this.$emit('update:modelValue', { ...this.modelValue, validators: val })
			}
		},
		localCustomCode: {
			get() {
				return this.modelValue.code || this.defaultCodeTemplate()
			},
			set(val) {
				this.$emit('update:modelValue', { ...this.modelValue, code: val })
			}
		}
	},
	methods: {
		addValidator() {
			this.localValidators.push({
				path: '',
				condition: 'equals',
				expected: '',
				status: 'VALID'
			})
			this.collapsed.push(false)
		},
		removeValidator(index) {
			this.localValidators.splice(index, 1)
			this.collapsed.splice(index, 1)
		},
		duplicateValidator(index) {
			const copy = JSON.parse(JSON.stringify(this.localValidators[index]))
			this.localValidators.splice(index + 1, 0, copy)
			this.collapsed.splice(index + 1, 0, false)
		},
		toggleCollapse(index) {
			this.collapsed[index] = !this.collapsed[index]
		},
		defaultCodeTemplate() {
			return [
				'function parseResponse(array $response, array $previousResponse) {',
				'    // Puedes aplicar lógica personalizada de validación aquí',
				'    return true;',
				'}'
			].join('\n')
		}
	}
}
</script>
