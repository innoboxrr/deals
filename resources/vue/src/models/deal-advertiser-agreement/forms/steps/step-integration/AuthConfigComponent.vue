<template>
	<div class="space-y-4">

		<!-- TIPO DE AUTENTICACIÓN -->
		<select-input-component
			:custom-class="inputClass"
			name="auth_type"
			label="Tipo de autenticación"
			v-model="localAuth.type">
			<option value="none">Ninguna</option>
			<option v-if="integrationType == 'api'" value="api_key">API Key</option>
			<option v-if="integrationType == 'api'" value="basic">Basic Auth</option>
			<option v-if="integrationType == 'api'" value="oauth" disabled>OAuth 2.0 (Comming soon)</option>
			<option v-if="integrationType == 'database'" value="db_connection">Conexión a base de datos</option>
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
		<div 
			v-if="localAuth.type === 'basic'" 
			class="grid grid-cols-1 md:grid-cols-2 gap-4">
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

		<!-- DB CONNECTION -->
		<div v-if="localAuth.type === 'db_connection'" class="space-y-3">

			<!-- Tipo de motor/SGBD -->
			<select-input-component
				:custom-class="inputClass"
				name="db_driver"
				label="Motor de Base de Datos"
				v-model="localAuth.db_driver">
				<option value="mysql">MySQL</option>
				<option value="mariadb">MariaDB</option>
				<option value="pgsql">PostgreSQL</option>
				<option value="sqlsrv">SQL Server</option>
				<option value="sqlite">SQLite</option>
				<option value="oracle">Oracle</option>
			</select-input-component>

			<!-- Host -->
			<text-input-component
				:custom-class="inputClass"
				type="text"
				name="db_host"
				label="Host (IP o dominio)"
				v-model="localAuth.db_host"
				placeholder="127.0.0.1 o db.miempresa.com" />

			<!-- Puerto -->
			<text-input-component
				:custom-class="inputClass"
				type="text"
				name="db_port"
				label="Puerto"
				v-model="localAuth.db_port"
				placeholder="Ej: 3306 para MySQL, 5432 para PostgreSQL" />

			<!-- Nombre de la base de datos -->
			<text-input-component
				:custom-class="inputClass"
				type="text"
				name="db_database"
				label="Nombre de la Base de Datos"
				v-model="localAuth.db_database" />

			<!-- Usuario -->
			<text-input-component
				:custom-class="inputClass"
				type="text"
				name="db_username"
				label="Usuario"
				v-model="localAuth.db_username" />

			<!-- Contraseña -->
			<text-input-component
				:custom-class="inputClass"
				type="password"
				name="db_password"
				label="Contraseña"
				v-model="localAuth.db_password" />

			<!-- Charset -->
			<text-input-component
				:custom-class="inputClass"
				type="text"
				name="db_charset"
				label="Charset (opcional)"
				v-model="localAuth.db_charset"
				placeholder="utf8mb4, utf8, etc." />

			<!-- Collation -->
			<text-input-component
				:custom-class="inputClass"
				type="text"
				name="db_collation"
				label="Collation (opcional)"
				v-model="localAuth.db_collation"
				placeholder="utf8mb4_unicode_ci, etc." />

			<!-- SSL CA (opcional) -->
			<text-input-component
				:custom-class="inputClass"
				type="text"
				name="db_ssl_ca"
				label="Ruta CA SSL (opcional)"
				v-model="localAuth.db_ssl_ca"
				placeholder="/ruta/a/ca.pem" />

			<!-- Socket (opcional) -->
			<text-input-component
				:custom-class="inputClass"
				type="text"
				name="db_socket"
				label="Ruta Socket (opcional)"
				v-model="localAuth.db_socket"
				placeholder="/var/run/mysqld/mysqld.sock" />

			<!-- Timezone (opcional) -->
			<text-input-component
				:custom-class="inputClass"
				type="text"
				name="db_timezone"
				label="Zona Horaria (opcional)"
				v-model="localAuth.db_timezone"
				placeholder="Ej: America/Mexico_City" />

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
		}, 
		integrationType: {
			type: String,
			required: true,
			default: 'api'
		},
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
