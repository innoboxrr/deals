<template>
	
	<form id="dealAdvertiserAgreementFilterForm" @submit.prevent="onSubmit">

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
					<option value="draft">Borrador</option>
					<option value="active">Activo</option>
					<option value="paused">Pausado</option>
					<option value="pending_payment">Pago pendiente</option>
					<option value="cancelled">Cancelado</option>
					<option value="completed">Completado</option>
				</select-input-component>
			</div>

			<!-- START DATE -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="start_date"
					label="Fecha de inicio"
					placeholder="YYYY-MM-DD"
					v-model="start_date" />
			</div>

			<!-- END DATE -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="end_date"
					label="Fecha de término"
					placeholder="YYYY-MM-DD"
					v-model="end_date" />
			</div>

			<!-- AUTORENEWAL -->
			<div>
				<select-input-component
					name="autorenewal"
					label="Renovación automática"
					v-model="autorenewal">
					<option value="">Todas</option>
					<option :value="1">Sí</option>
					<option :value="0">No</option>
				</select-input-component>
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

			<!-- DEAL ADVERTISER ID -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="deal_advertiser_id"
					label="ID del Anunciante"
					v-model="deal_advertiser_id" />
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
				start_date: '',
				end_date: '',
				autorenewal: '',
				deal_id: '',
				deal_advertiser_id: '',
			}
		},

		methods: {

			onSubmit() {
				this.$emit('submit', {
					id: this.id,
					status: this.status,
					start_date: this.start_date,
					end_date: this.end_date,
					autorenewal: this.autorenewal,
					deal_id: this.deal_id,
					deal_advertiser_id: this.deal_advertiser_id,
				});
			},

			resetForm() {
				this.id = null;
				this.status = '';
				this.start_date = '';
				this.end_date = '';
				this.autorenewal = '';
				this.deal_id = '';
				this.deal_advertiser_id = '';
				this.onSubmit();
			}
		}
	}
</script>
