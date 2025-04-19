<template>
	<div class="space-y-6">
		<draggable
			v-model="localMapping"
			handle=".drag-handle"
			item-key="index"
			animation="200"
			class="space-y-2">

			<template #item="{ element, index }">
				<div class="border rounded-lg bg-gray-50 overflow-hidden">

					<!-- HEADER colapsable -->
                    <div
                        class="flex justify-between items-start px-4 py-3 bg-gray-50 border-b border-gray-200 rounded-t-md cursor-pointer hover:bg-gray-100 transition"
                        @click="toggleCollapse(index)">
                        
                        <!-- Info del mapeo -->
                        <div class="flex items-center gap-3 text-sm font-medium text-gray-800">
                            <i class="fa-solid fa-grip-lines drag-handle text-gray-400 text-base cursor-move"></i>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2">
                                <span class="truncate max-w-[200px] sm:max-w-none">
                                    {{ element.source || 'Sin source' }}
                                </span>
                                <span class="text-gray-400">
                                    →
                                </span>
                                <span class="truncate max-w-[200px] sm:max-w-none">
                                    {{ element.target || 'Sin target' }}
                                </span>
                            </div>

                            <span
                                v-if="element.required"
                                class="text-green-600 text-xs font-semibold bg-green-50 px-2 py-0.5 rounded-full border border-green-200 ml-1">
                                Requerido
                            </span>
                        </div>

                        <!-- Acciones -->
                        <div class="flex items-center space-x-2 text-gray-400">
                            <!-- Duplicar -->
                            <button
                                @click.stop="duplicateField(index)"
                                title="Duplicar campo"
                                class="hover:text-blue-500 transition mr-2">
                                <i class="fa-solid fa-clone"></i>
                            </button>

                            <!-- Eliminar -->
                            <button
                                @click.stop="removeField(index)"
                                title="Eliminar campo"
                                class="hover:text-red-500 transition">
                                <i class="fa-solid fa-trash mr-2"></i>
                            </button>

                            <!-- Colapsar -->
                            <button
                                title="Expandir/Colapsar"
                                class="hover:text-gray-600 transition">
                                <i
                                    :class="[
                                        'fa-solid',
                                        collapsed[index] ? 'fa-chevron-down' : 'fa-chevron-up'
                                    ]"></i>
                            </button>
                        </div>
                    </div>

					<!-- BODY -->
					<div v-show="!collapsed[index]" class="p-4 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 -mb-4">
                            <div>
                                <!-- Campo interno -->
                                <select-input-component
                                    :custom-class="inputClass"
                                    label="Campo interno (source)"
                                    v-model="element.source">
                                    <option 
                                        v-for="field in internalFields" 
                                        :key="field.value" 
                                        :value="field.value">
                                        {{ field.label }}
                                    </option>
                                </select-input-component>
                            </div>
                            <div>
                                <!-- Campo externo -->
                                <text-input-component
                                    :custom-class="inputClass"
                                    type="text"
                                    label="Campo externo (target)"
                                    v-model="element.target" />
                            </div>
                        </div>

                        <!-- Formato -->
						<select-input-component
							:custom-class="inputClass"
							label="Formato"
							v-model="element.format">
							<option value="">Sin formato</option>
							<option v-for="format in getFormatsBySource(element.source)" :key="format.value" :value="format.value">
								{{ format.label }}
							</option>
						</select-input-component>

						<!-- Value opcional si el formato lo requiere -->
						<text-input-component
							v-if="formatRequiresValue(element.format)"
							:custom-class="inputClass"
							type="text"
							label="Valor del formato (opcional)"
							placeholder="Ej: 999 999 9999"
							v-model="element.value" />

						<div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 -mb-4">
                            <div>
                                <select-input-component
                                    :custom-class="inputClass"
                                    label="¿Requerido?"
                                    v-model="element.required">
                                    <option :value="true">Sí</option>
                                    <option :value="false">No</option>
                                </select-input-component>
                            </div>
                            <div>
                                <text-input-component
                                    :custom-class="inputClass"
                                    type="text"
                                    label="Regex (opcional)"
                                    placeholder="Ej: ^.+@.+$"
                                    v-model="element.regex" />
                            </div>
						</div>

						<!-- Fallback -->
						<textarea-input-component
							:custom-class="inputClass"
							label="Fallback (valor de respaldo)"
							placeholder="Cada línea representa un valor alterno"
							v-model="element.fallback" />

                        <!-- VISTA PREVIA DE LA ASIGNACIÓN PHP -->
                        <div class="text-sm text-gray-600 bg-white border rounded-md p-3">
                            <label class="block font-medium text-gray-700 mb-1">Vista previa del objeto:</label>
                            <pre class="text-xs overflow-auto bg-gray-100"><code>{{ generatePhpObjectPreview(element) }}</code></pre>
                        </div>

                        <!-- Code personalizado -->
						<code-mirror-component
							lang="javascript"
							v-model="element.code"
							placeholder="// Puedes formatear este campo aquí" />

					</div>
				</div>
			</template>
		</draggable>

		<!-- AGREGAR -->
		<div>
			<button
				type="button"
				class="text-sm text-blue-600 hover:underline font-medium"
				@click="addField">
				+ Agregar campo
			</button>
		</div>
	</div>
</template>

<script>
import draggable from 'vuedraggable'
import {
	TextInputComponent,
	SelectInputComponent,
	TextareaInputComponent,
	ButtonComponent,
	CodeMirrorComponent
} from 'innoboxrr-form-elements'
import Swal from 'sweetalert2'
import { internalFields, formatsWithValue, formatLabels } from './field-options.js'


export default {
	name: 'MappingFieldsComponent',
	components: {
		draggable,
		TextInputComponent,
		SelectInputComponent,
		TextareaInputComponent,
		ButtonComponent,
		CodeMirrorComponent
	},
	props: {
		modelValue: {
			type: Array,
			required: true
		}
	},
	emits: ['update:modelValue'],
	data() {
		return {
			collapsed: [],
			internalFields,
			formatsWithValue,
            formatLabels,
		}
	},
	computed: {
		localMapping: {
			get() {
				if (!Array.isArray(this.collapsed) || this.collapsed.length !== this.modelValue.length) {
					this.collapsed = this.modelValue.map(() => true)
				}
				return this.modelValue
			},
			set(val) {
				this.$emit('update:modelValue', val)
			}
		}
	},
	methods: {
		addField() {
			this.localMapping.push({
				source: '',
				target: '',
				required: false,
				regex: '',
				format: '',
				value: '',
				fallback: '',
				code: '',
                code: this.defaultCodeTemplate()
			})
			this.collapsed.push(false)
		},
		removeField(index) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Este campo será eliminado permanentemente.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.localMapping.splice(index, 1)
                    this.collapsed.splice(index, 1)
                    Swal.fire({
                        title: 'Eliminado',
                        text: 'El campo ha sido eliminado correctamente.',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    })
                }
            })
        },
		toggleCollapse(index) {
			this.collapsed[index] = !this.collapsed[index]
		},
        duplicateField(index) {
            const copy = JSON.parse(JSON.stringify(this.localMapping[index]));
            this.localMapping.splice(index + 1, 0, copy);
            this.collapsed.splice(index + 1, 0, false);
        },
		getFormatsBySource(source) {
			const field = this.internalFields.find(f => f.value === source)
			if (!field || !field.formats) return []
			return field.formats.map(f => ({ value: f, label: this.formatLabel(f) }))
		},
		formatLabel(format) {
			const labels = this.formatLabels;
			return labels[format] || format
		},
		formatRequiresValue(format) {
			return this.formatsWithValue.includes(format)
		},
        defaultCodeTemplate() {
            return [
                'function parseObject($object, $lead) {',
                '    // Puedes modificar el valor aquí usando object y lead',
                '    return $object;',
                '}'
            ].join('\n')
        },
        generatePhpObjectPreview(field) {
            if (!field || !field.target || !field.source) return '// Incompleto'

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

            const parts = field.target.split('.')
            const value = `'{{${field.source}}}'`

            return `$object = ${buildNested(parts, value)};`
        }
	}
}
</script>
