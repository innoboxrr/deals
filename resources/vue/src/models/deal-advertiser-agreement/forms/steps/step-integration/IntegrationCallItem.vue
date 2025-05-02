<template>
	<div class="border rounded-lg bg-white shadow-sm relative space-y-6">
		<div 
			class="flex justify-between items-center px-4 py-3 border-b bg-gray-50 cursor-pointer" 
			@click="collapsed = !collapsed">
			<div class="flex items-center gap-2">
				<div class="cursor-move drag-handle text-gray-400">
					<i class="fa-solid fa-grip-vertical"></i>
				</div>
				<h4 class="text-md font-semibold">
					Integración #{{ index + 1 }}
				</h4>
			</div>
			<div class="flex items-center space-x-4 text-gray-400">
				<button
					@click.stop="$emit('duplicate')"
					title="Duplicar campo"
					class="hover:text-blue-500 transition mr-2">
					<i class="fa-solid fa-clone"></i>
				</button>
				<button
					class="text-red-800 text-sm hover:text-red-700"
					:title="'Eliminar integración'"
					@click.stop="$emit('remove')">
					<i class="fa-solid fa-trash"></i>
				</button>
				<button
					title="Expandir/Colapsar"
					class="hover:text-gray-600 transition">
					<i
						:class="[
							'fa-solid',
							!collapsed ? 'fa-chevron-down' : 'fa-chevron-up'
						]"></i>
				</button>
			</div>
		</div>
		<div v-show="!collapsed" class="px-6">
			<div class="items-center mb-4">
				<h3 class="text-lg font-semibold">
					Configuración de la Integración
				</h3>
				<select-input-component
					:custom-class="inputClass"
					name="type"
					label="Tipo de integración"
					v-model="localCall.type">
					<option value="api">API</option>
					<option value="email">Email</option>
					<option value="database">Base de datos</option>
				</select-input-component>
			</div>

			<div v-if="localCall.type !== undefined" class="mb-4">	

				<h3 class="mb-4 text-lg font-semibold border-gray-200 border-t border-gray-200 pt-4">
					Integración <b>{{ localCall.type.slice(0, 1).toUpperCase() + localCall.type.slice(1) }}</b> - Configuración
				</h3>

				<div v-if="localCall.type === 'api'" 
					class="grid grid-cols-1 md:grid-cols-3 gap-4 border-b border-gray-200 pt-4">
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

				<div v-if="localCall.type === 'email'" class="space-y-6">

					<!-- Emails destino -->
					<tags-input-component
						:custom-class="inputClass"
						name="emails"
						label="Emails de destino"
						placeholder="Emails separados por comas"
						v-model="localCall.emails" />

					<!-- Método de envío -->
					<select-input-component
						:custom-class="inputClass"
						name="send_strategy"
						label="Estrategia de Envío"
						v-model="localCall.email_send_strategy">
						<option value="immediate">Enviar en cuanto lleguen los leads</option>
						<option value="threshold">Enviar al alcanzar un mínimo de leads</option>
						<option value="cron">Enviar periódicamente por cron</option>
					</select-input-component>

					<!-- Umbral mínimo de leads para enviar (solo si strategy = threshold) -->
					<div v-if="localCall.email_send_strategy === 'threshold'" 
						class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<div>
							<text-input-component
								:custom-class="inputClass"
								type="number"
								name="threshold_min_leads"
								label="Número mínimo de leads para enviar"
								v-model="localCall.threshold_min_leads"
								placeholder="Ej: 10" />
						</div>
					</div>

					<!-- Cron expression (solo si strategy = cron) -->
					<div v-if="localCall.email_send_strategy === 'cron'" 
						class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<text-input-component
							:custom-class="inputClass"
							type="text"
							name="cron_expression"
							label="Expresión Cron para envío programado"
							v-model="localCall.cron_expression"
							placeholder="Ej: */15 * * * * (cada 15 minutos)" />
					</div>

					<!-- Capacidad máxima de envío -->
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4 -mb-4">
						<div>
							<text-input-component
								:custom-class="inputClass"
								type="number"
								name="cap_max_leads"
								label="Máximo de leads a enviar por ciclo"
								v-model="localCall.cap_max_leads"
								placeholder="Ej: 100" />
						</div>
						<div>
							<text-input-component
								:custom-class="inputClass"
								type="number"
								name="cap_min_leads"
								label="Mínimo de leads a enviar por ciclo (opcional)"
								v-model="localCall.cap_min_leads"
								placeholder="Ej: 10" />
						</div>
					</div>

					<!-- Método de distribución de correos -->
					<select-input-component
						class="uk-margin-remove"
						:custom-class="inputClass"
						name="email_distribution_method"
						label="Método de distribución de emails"
						v-model="localCall.email_distribution_method">
						<option value="all">Enviar a todos los correos</option>
						<option value="random">Enviar aleatoriamente a uno</option>
						<option value="roundrobin">Enviar de forma secuencial (round robin)</option>
					</select-input-component>

					<!-- Control de estado del envío -->
					<select-input-component
						:custom-class="inputClass"
						name="send_control"
						label="Control de Envío"
						v-model="localCall.send_control">
						<option value="automatic">Envío automático</option>
						<option value="manual">Requiere revisión manual antes de enviar</option>
					</select-input-component>

				</div>


				<div v-if="localCall.type === 'api'" >
					<h3 class="mb-4 text-lg font-semibold pt-4">
						Headers
					</h3>
					<headers-input-component v-model="localCall.headers" />
				</div>

				<div v-if="['api', 'database'].includes(localCall.type)">
					<h3 class="mb-4 text-lg font-semibold border-t border-gray-200 pt-4">
						Tipo de autenticación
					</h3>
					<auth-config-component 
						v-model="localCall.auth" 
						:integration-type="localCall.type" />
				</div>

				<div>
					<h3 class="mt-6 mb-4 text-lg font-semibold border-t border-gray-200 pt-4">
						Mapeo de Campos
					</h3>
					<mapping-fields-component 
						class="mb-4"
						v-model="localCall.mapping"/>

					<div class="border rounded-md">
						

						<div
							class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer"
							@click="collapsedParseObject = !collapsedParseObject">
							<span class="text-sm font-semibold">
								{{ __deals('Global Object - Custom code processor') }}
							</span>
							<i :class="['fa-solid', collapsedParseObject ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
						</div>
						<div
							v-show="!collapsedParseObject" 
							class="p-4 space-y-4">

							<!-- Ver si se debe procesar en código -->
							<select-input-component
								:custom-class="inputClass"
								label="¿Procesar en código?"
								v-model="localCall.use_custom_code">
								<option :value="1">Sí</option>
								<option :value="0" selected>No</option>
							</select-input-component>

							<div
								v-if="localCall.use_custom_code" 
								class="text-sm text-gray-600 bg-white border rounded-md p-3">
								<label class="block font-medium text-gray-700 mb-1">Vista previa del objeto enviado:</label>
								<pre class="text-xs overflow-auto bg-gray-100"><code>{{ generatePhpFullObject(localCall.mapping) }}</code></pre>
							</div>
							<code-mirror-component
								v-if="localCall.use_custom_code"
								lang="javascript"
								v-model="localCall.parse_object"
								placeholder="// Aquí puedes procesar el objeto final antes de enviarlo" />
						</div>
					</div>
				</div>

				<div>
					<h3 class="mt-6 mb-4 text-lg font-semibold border-t border-gray-200 pt-4">
						Validación de Respuesta
					</h3>
					<response-validator-component v-model="localCall.response_validation" />
				</div>

				<div>
					<!-- Detener ejecución si falla -->
					<select-input-component
						:custom-class="inputClass"
						name="stop_on_error"
						label="Detener ejecución si falla"
						v-model="localCall.stop_on_error">
						<option value="yes">Sí</option>
						<option value="no">No</option>
					</select-input-component>

					<!-- Detener si es válida -->
					<select-input-component
						:custom-class="inputClass"
						name="stop_on_success"
						label="Detener ejecución si es válida"
						v-model="localCall.stop_on_success">
						<option value="yes">Sí</option>
						<option value="no">No</option>
					</select-input-component>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import {
	TextInputComponent,
	SelectInputComponent,
	TagsInputComponent,
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
		TagsInputComponent,
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
		},
		collapsedState: {
			type: Boolean,
			default: false
		},
	},
	emits: ['update:modelValue', 'remove'],
	data() {
		return {
			collapsed: this.index === 0 ? false : true,
			collapsedParseObject: true
		}
	},
	watch: {
		collapsedState(val) {
			this.collapsed = val
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
		},
	}
}
</script>
