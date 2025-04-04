<template>	
	<form id="dealAdGroupFilterForm" @submit.prevent="onSubmit">
		<div class="uk-flex uk-flex-left uk-child-width-1-3@m uk-child-width-1-1@s" uk-grid>

			<!-- ID -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="id"
					label="ID"
					placeholder="ID del grupo"
					v-model="id" />
			</div>

			<!-- NAME -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="name"
					label="Nombre"
					placeholder="Nombre del grupo"
					v-model="name" />
			</div>

			<!-- PLATFORM ID -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="platform_id"
					label="Plataforma"
					v-model="platform_id" />
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
					<option value="ended">Finalizado</option>
				</select-input-component>
			</div>

			<!-- START DATE -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="start_date"
					label="Desde"
					placeholder="YYYY-MM-DD"
					v-model="start_date" />
			</div>

			<!-- END DATE -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="end_date"
					label="Hasta"
					placeholder="YYYY-MM-DD"
					v-model="end_date" />
			</div>

			<!-- DEAL AD CAMPAIGN ID -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="deal_ad_campaign_id"
					label="Campaña"
					placeholder="ID de campaña"
					v-model="deal_ad_campaign_id" />
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
				platform_id: '',
				status: '',
				start_date: '',
				end_date: '',
				deal_ad_campaign_id: '',
			}
		},

		methods: {

			onSubmit() {
				this.$emit('submit', {
					id: this.id,
					name: this.name,
					platform_id: this.platform_id,
					status: this.status,
					start_date: this.start_date,
					end_date: this.end_date,
					deal_ad_campaign_id: this.deal_ad_campaign_id,
				});
			},

			resetForm() {
				this.id = null;
				this.name = '';
				this.platform_id = '';
				this.status = '';
				this.start_date = '';
				this.end_date = '';
				this.deal_ad_campaign_id = '';
				this.onSubmit();
			}
		}
	}
</script>
