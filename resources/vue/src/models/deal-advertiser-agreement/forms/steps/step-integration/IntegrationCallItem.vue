<template>
	<div class="border rounded-lg p-4 bg-white shadow-sm relative space-y-6">
		<div class="flex justify-between items-center mb-2">
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
                :title="'Eliminar header'"
                @click="$emit('remove')">
                <i class="fa-solid fa-trash"></i>
            </button>
		</div>

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
                Headers
            </h3>
            <headers-input-component v-model="localCall.headers" />
        </div>


		<!-- AUTENTICACIÓN -->
		<div>
			<h3 class="mb-4 text-lg font-semibold border-t border-gray-200 pt-4">
                Autenticación
            </h3>
			<auth-config-component v-model="localCall.auth" />
		</div>

		<!-- MAPEO -->
		<div>
            <h3 class="mb-4 text-lg font-semibold border-t border-gray-200 pt-4">
                Mapeo de Campos
            </h3>
			<mapping-fields-component v-model="localCall.mapping" />
		</div>

	</div>
</template>

<script>
import {
	TextInputComponent,
	SelectInputComponent,
	ButtonComponent,
} from 'innoboxrr-form-elements'

import HeadersInputComponent from './HeadersInputComponent.vue'
import AuthConfigComponent from './AuthConfigComponent.vue'
import MappingFieldsComponent from './MappingFieldsComponent.vue'

export default {
	name: 'IntegrationCallItem',
	components: {
		TextInputComponent,
		SelectInputComponent,
		ButtonComponent,

        HeadersInputComponent,
		AuthConfigComponent,
		MappingFieldsComponent
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
		addHeader() {
			if (!this.localCall.headers) this.localCall.headers = []
			this.localCall.headers.push({ key: '', value: '' })
		},
		removeHeader(index) {
			this.localCall.headers.splice(index, 1)
		}
	}
}
</script>
