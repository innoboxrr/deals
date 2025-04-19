<template>
	<div class="space-y-4">

		<!-- TIPO DE AUTENTICACIÓN -->
		<select-input-component
			:custom-class="inputClass"
			name="auth_type"
			label="Tipo de autenticación"
			v-model="localAuth.type">
			<option value="none">Ninguna</option>
			<option value="api_key">API Key</option>
			<option value="basic">Basic Auth</option>
			<option value="oauth">OAuth 2.0</option>
		</select-input-component>

		<!-- API KEY -->
		<text-input-component
			v-if="localAuth.type === 'api_key'"
			:custom-class="inputClass"
			type="text"
			name="api_key"
			label="API Key"
			v-model="localAuth.api_key" />

		<!-- BASIC AUTH -->
		<div v-if="localAuth.type === 'basic'" class="grid grid-cols-1 md:grid-cols-2 gap-4">
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="username"
					label="Usuario"
					v-model="localAuth.username" />
			</div>
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="password"
					name="password"
					label="Contraseña"
					v-model="localAuth.password" />
			</div>
		</div>

		<!-- OAUTH -->
		<div v-if="localAuth.type === 'oauth'" class="space-y-3">
			<text-input-component
				:custom-class="inputClass"
				type="text"
				name="token_url"
				label="Token URL"
				validators="url"
				v-model="localAuth.oauth.token_url" />

			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <text-input-component
                        :custom-class="inputClass"
                        type="text"
                        name="refresh_token"
                        label="Refresh Token"
                        v-model="localAuth.oauth.refresh_token" />
                </div>
                <div>
                    <text-input-component
                        :custom-class="inputClass"
                        type="text"
                        name="expiration"
                        label="Fecha/Hora de expiración"
                        placeholder="Ej: 2025-12-01T15:30:00Z"
                        v-model="localAuth.oauth.expiration" />
                </div>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <text-input-component
                        :custom-class="inputClass"
                        type="text"
                        name="client_id"
                        label="Client ID"
                        v-model="localAuth.oauth.client_id" />
                </div>
                <div>
                    <text-input-component
                        :custom-class="inputClass"
                        type="text"
                        name="client_secret"
                        label="Client Secret"
                        v-model="localAuth.oauth.client_secret" />
                </div>
			</div>

            <!-- Current token -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <text-input-component
                        :custom-class="inputClass"
                        type="text"
                        name="access_token"
                        label="Access Token Actual"
                        v-model="localAuth.oauth.access_token" />
                </div>
                <div>
                    <text-input-component
                        :custom-class="inputClass"
                        type="text"
                        name="token_type"
                        label="Tipo de Token Actual"
                        v-model="localAuth.oauth.token_type" />
                </div>
            </div>
		</div>
	</div>
</template>

<script>
import {
	TextInputComponent,
	SelectInputComponent,
    CodeMirrorComponent
} from 'innoboxrr-form-elements'

export default {
	name: 'AuthConfigComponent',
	components: {
		TextInputComponent,
		SelectInputComponent,
        CodeMirrorComponent
	},
	props: {
		modelValue: {
			type: Object,
			required: true
		}
	},
	emits: ['update:modelValue'],
	computed: {
		localAuth: {
			get() {
				return this.modelValue
			},
			set(val) {
				this.$emit('update:modelValue', val)
			}
		}
	}
}
</script>
