<template>	
	<form id="dealAdPlatformFilterForm" @submit.prevent="onSubmit">
		<div class="uk-flex uk-flex-left uk-child-width-1-3@m uk-child-width-1-1@s" uk-grid>

			<!-- ID -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="id"
					label="ID"
					v-model="id" />
			</div>

			<!-- NAME -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="name"
					label="Nombre"
					v-model="name" />
			</div>

			<!-- API KEY -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="api_key"
					label="API Key"
					v-model="api_key" />
			</div>

			<!-- ACCOUNT ID -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="account_id"
					label="Account ID"
					v-model="account_id" />
			</div>

			<!-- STATUS -->
			<div>
				<select-input-component
					name="status"
					label="Estatus"
					v-model="status">
					<option value="">Todos</option>
					<option value="connected">Conectado</option>
					<option value="disconnected">Desconectado</option>
					<option value="error">Error</option>
				</select-input-component>
			</div>

			<!-- INTEGRATION TYPE -->
			<div>
				<select-input-component
					name="integration_type"
					label="Tipo de integración"
					v-model="integration_type">
					<option value="">Todos</option>
					<option value="api">API</option>
					<option value="manual">Manual</option>
				</select-input-component>
			</div>

			<!-- LAST SYNC AT -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="last_sync_at"
					label="Última sincronización"
					placeholder="YYYY-MM-DD"
					v-model="last_sync_at" />
			</div>

			<!-- DEAL ID -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="deal_id"
					label="ID del Deal"
					v-model="deal_id" />
			</div>

		</div>

		<div class="uk-flex uk-flex-right uk-child-width-auto@m uk-child-width-1-1@m" uk-grid>
			<div>
				<button :class="buttonClass">
					{{ __('Buscar') }}
				</button>
			</div>
			<div>
				<button 
					:class="buttonClass + ' bg-gray-400'"
					@click.prevent="resetForm()">
					{{ __('Resetear') }}
				</button>
			</div>
		</div>
	</form>
</template>

<script>

	import {
		TextInputComponent,
		SelectInputComponent,
	} from 'innoboxrr-form-elements'

	export default {

		components: {
			TextInputComponent,
			SelectInputComponent,
		},

		emits: ['submit'],

		data() {
			return {
				id: null,
				name: '',
				api_key: '',
				account_id: '',
				status: '',
				integration_type: '',
				last_sync_at: '',
				deal_id: '',
			}
		},

		methods: {

			onSubmit() {
				this.$emit('submit', {
					id: this.id,
					name: this.name,
					api_key: this.api_key,
					account_id: this.account_id,
					status: this.status,
					integration_type: this.integration_type,
					last_sync_at: this.last_sync_at,
					deal_id: this.deal_id,
				});
			},

			resetForm() {
				this.id = null;
				this.name = '';
				this.api_key = '';
				this.account_id = '';
				this.status = '';
				this.integration_type = '';
				this.last_sync_at = '';
				this.deal_id = '';
				this.onSubmit();
			}
		}
	}
</script>
