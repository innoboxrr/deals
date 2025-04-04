<template>	
	<form id="dealAdCampaignRuleFilterForm" @submit.prevent="onSubmit">
		<div class="uk-flex uk-flex-left uk-child-width-1-3@m uk-child-width-1-1@s" uk-grid>

			<!-- ID -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="id"
					label="ID"
					placeholder="ID de regla"
					v-model="id" />
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

			<!-- CONDITION TYPE -->
			<div>
				<select-input-component
					name="condition_type"
					label="Condición"
					v-model="condition_type">
					<option value="">Todas</option>
					<option value="cost_per_lead_greater_than">Costo por lead mayor a</option>
					<option value="conversion_rate_lower_than">Tasa de conversión menor a</option>
					<option value="click_through_rate_lower_than">CTR menor a</option>
					<option value="impressions_lower_than">Impresiones menores a</option>
					<option value="spent_amount_greater_than">Gasto mayor a</option>
					<option value="total_conversions_greater_than">Conversiones mayores a</option>
				</select-input-component>
			</div>

			<!-- ACTION -->
			<div>
				<select-input-component
					name="action"
					label="Acción"
					v-model="action">
					<option value="">Todas</option>
					<option value="pause">Pausar</option>
					<option value="notify">Notificar</option>
					<option value="increase_budget">Aumentar presupuesto</option>
					<option value="decrease_budget">Reducir presupuesto</option>
					<option value="change_bid">Cambiar puja</option>
					<option value="optimize_for_conversions">Optimizar para conversiones</option>
				</select-input-component>
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
				deal_ad_campaign_id: '',
				condition_type: '',
				action: '',
			}
		},

		methods: {

			onSubmit() {
				this.$emit('submit', {
					id: this.id,
					deal_ad_campaign_id: this.deal_ad_campaign_id,
					condition_type: this.condition_type,
					action: this.action,
				});
			},

			resetForm() {
				this.id = null;
				this.deal_ad_campaign_id = '';
				this.condition_type = '';
				this.action = '';
				this.onSubmit();
			}
		}
	}
</script>
