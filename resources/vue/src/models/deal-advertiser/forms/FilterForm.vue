<template>	
	<form id="dealAdvertiserFilterForm" @submit.prevent="onSubmit">
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

			<!-- STATUS -->
			<div>
				<select-input-component
					name="status"
					label="Estatus"
					v-model="status">
					<option value="">Todos</option>
					<option value="active">Activo</option>
					<option value="inactive">Inactivo</option>
					<option value="pending">Pendiente</option>
				</select-input-component>
			</div>

			<!-- AGENT ID -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="agent_id"
					label="ID del Agente"
					v-model="agent_id" />
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
				status: '',
				agent_id: '',
			}
		},

		methods: {

			onSubmit() {
				this.$emit('submit', {
					id: this.id,
					status: this.status,
					agent_id: this.agent_id,
				});
			},

			resetForm() {
				this.id = null;
				this.status = '';
				this.agent_id = '';
				this.onSubmit();
			}
		}
	}
</script>
