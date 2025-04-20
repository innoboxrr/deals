<template>
	<div class="border rounded-lg bg-white shadow-sm relative space-y-6">
		<!-- HEADER PRINCIPAL (COLLAPSABLE WRAPPER)-->
		<div class="flex justify-between items-center px-4 py-3 border-b bg-gray-50 cursor-pointer" @click="collapsed = !collapsed">
			<div class="flex items-center gap-2">
				<div class="cursor-move drag-handle text-gray-400">
					<i class="fa-solid fa-grip-vertical"></i>
				</div>
				<h4 class="text-md font-semibold">
					Integración #{{ index + 1 }}
				</h4>
			</div>
			<button
				class="text-red-800 text-sm hover:text-red-700"
				:title="'Eliminar integración'"
				@click.stop="$emit('remove')">
				<i class="fa-solid fa-trash"></i>
			</button>
		</div>
		<div v-show="!collapsed" class="px-6">
			<h3 class="mb-4 text-lg font-semibold border-gray-200">
				1. General
			</h3>
			<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

				<div>
					<text-input-component
						:custom-class="inputClass"
						type="text"
						name="endpoint"
						label="Endpoint"
						validators="required url"
						v-model="localCall.endpoint" />
				</div>
				<div>
					<select-input-component
						:custom-class="inputClass"
						name="method"
						label="Método HTTP"
						v-model="localCall.method">
						<option value="GET">GET</option>
						<option value="POST">POST</option>
						<option value="PUT">PUT</option>
						<option value="DELETE">DELETE</option>
					</select-input-component>
				</div>
				<div>
					<select-input-component
						:custom-class="inputClass"
						name="data_method"
						label="Formato del envío"
						v-model="localCall.data_method">
						<option value="json">JSON</option>
						<option value="form">Form</option>
						<option value="query">Query</option>
					</select-input-component>
				</div>
			</div>
			<!-- HEADERS -->
			<div>
				<h3 class="mb-4 text-lg font-semibold border-t border-gray-200 pt-4">
					2. Headers
				</h3>
				<headers-input-component v-model="localCall.headers" />
			</div>
			<!-- AUTENTICACIÓN -->
			<div>
				<h3 class="mb-4 text-lg font-semibold border-t border-gray-200 pt-4">
					3. Autenticación
				</h3>
				<auth-config-component v-model="localCall.auth" />
			</div>
			<!-- MAPEO -->
			<div>
				<h3 class="mt-6 mb-4 text-lg font-semibold border-t border-gray-200 pt-4">
					4. Mapeo de Campos
				</h3>
				<mapping-fields-component v-model="localCall.mapping" class="mb-4"/>

				<!-- PARSE GLOBAL -->
				<div class="border rounded-md">
					<div
						class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer"
						@click="collapsedParseObject = !collapsedParseObject">
						<span class="text-sm font-semibold">
							Procesamiento Global del Objeto
						</span>
						<i :class="['fa-solid', collapsedParseObject ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
					</div>

					<div v-show="!collapsedParseObject" class="p-4 space-y-4">

						<!-- Vista previa del objeto PHP -->
						<div class="text-sm text-gray-600 bg-white border rounded-md p-3">
							<label class="block font-medium text-gray-700 mb-1">Vista previa del objeto enviado:</label>
							<pre class="text-xs overflow-auto bg-gray-100"><code>{{ generatePhpFullObject(localCall.mapping) }}</code></pre>
						</div>

						<code-mirror-component
							lang="javascript"
							v-model="localCall.parse_object"
							placeholder="// Aquí puedes procesar el objeto final antes de enviarlo" />

					</div>
				</div>

			</div>
			<!-- VALIDACIÓN DE RESPUESTA -->
			<div>
				<h3 class="mt-6 mb-4 text-lg font-semibold border-t border-gray-200 pt-4">
					5. Validación de Respuesta
				</h3>
				<response-validator-component v-model="localCall.response_validation" />
			</div>
		</div>
	</div>
</template>

<script>
import {
	TextInputComponent,
	SelectInputComponent,
	ButtonComponent,
	CodeMirrorComponent
} from 'innoboxrr-form-elements'

import HeadersInputComponent from './HeadersInputComponent.vue'
import AuthConfigComponent from './AuthConfigComponent.vue'
import MappingFieldsComponent from './MappingFieldsComponent.vue'
import ResponseValidatorComponent from './ResponseValidatorComponent.vue'

export default {
	name: 'IntegrationCallItem',
	components: {
		TextInputComponent,
		SelectInputComponent,
		ButtonComponent,
		CodeMirrorComponent,

        HeadersInputComponent,
		AuthConfigComponent,
		MappingFieldsComponent,
		ResponseValidatorComponent
	},
	props: {
		modelValue: {
			type: Object,
			required: true
		},
		index: {
			type: Number,
			required: true
		}
	},
	emits: ['update:modelValue', 'remove'],
	data() {
		return {
			collapsed: false,
			collapsedParseObject: true
		}
	},
	computed: {
		localCall: {
			get() {
				return this.modelValue
			},
			set(val) {
				this.$emit('update:modelValue', val)
			}
		}
	},
	methods: {
		generatePhpFullObject(mapping) {
			if (!Array.isArray(mapping) || mapping.length === 0) return '// Sin campos mapeados'

			const indent = (level) => '\t'.repeat(level)

			const buildNested = (parts, value, level = 1) => {
				if (parts.length === 0) return value

				const current = parts[0]
				const remaining = parts.slice(1)

				const key = isNaN(current) ? `'${current}'` : current
				const nested = buildNested(remaining, value, level + 1)

				const inner = `\n${indent(level)}${key} => ${nested}`
				return `[${inner}\n${indent(level - 1)}]`
			}

			let result = '$object = '

			const tree = {}

			// Convertir todos los mappings a un solo objeto anidado
			for (const field of mapping) {
				if (!field.target || !field.source) continue

				const parts = field.target.split('.')
				let current = tree
				for (let i = 0; i < parts.length - 1; i++) {
					const part = isNaN(parts[i]) ? parts[i] : parseInt(parts[i])
					current[part] = current[part] || {}
					current = current[part]
				}
				const last = parts[parts.length - 1]
				current[last] = `'{{${field.source}}}'`
			}

			const phpBuild = (obj, level = 1) => {
				if (typeof obj !== 'object') return obj

				let out = '[\n'
				for (const key in obj) {
					const value = phpBuild(obj[key], level + 1)
					const k = isNaN(key) ? `'${key}'` : key
					out += `${indent(level)}${k} => ${value},\n`
				}
				out += `${indent(level - 1)}]`
				return out
			}

			result += phpBuild(tree) + ';'
			return result
		}
	}
}
</script>
