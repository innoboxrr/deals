<template>	
	<form id="dealAdPerformanceSnapshotFilterForm" @submit.prevent="onSubmit">
		<div class="uk-flex uk-flex-left uk-child-width-1-3@m uk-child-width-1-1@s" uk-grid>

			<!-- ID -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="id"
					label="ID"
					placeholder="ID del snapshot"
					v-model="id" />
			</div>

			<!-- DEAL AD ID -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="deal_ad_id"
					label="ID del anuncio"
					v-model="deal_ad_id" />
			</div>

			<!-- IMPRESSIONS -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="number"
					name="impressions"
					label="Impresiones"
					v-model="impressions" />
			</div>

			<!-- CLICKS -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="number"
					name="clicks"
					label="Clicks"
					v-model="clicks" />
			</div>

			<!-- LEADS -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="number"
					name="leads"
					label="Leads"
					v-model="leads" />
			</div>

			<!-- SPEND -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="number"
					name="spend"
					label="Gasto"
					v-model="spend" />
			</div>

			<!-- CPL -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="number"
					name="cpl"
					label="Costo por Lead (CPL)"
					v-model="cpl" />
			</div>

			<!-- FROM DATE -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="from_date"
					label="Desde"
					placeholder="YYYY-MM-DD"
					v-model="from_date" />
			</div>

			<!-- TO DATE -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="to_date"
					label="Hasta"
					placeholder="YYYY-MM-DD"
					v-model="to_date" />
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
	} from 'innoboxrr-form-elements'

	export default {

		components: {
			TextInputComponent,
		},

		emits: ['submit'],

		data() {
			return {
				id: null,
				deal_ad_id: '',
				impressions: '',
				clicks: '',
				leads: '',
				spend: '',
				cpl: '',
				from_date: '',
				to_date: '',
			}
		},

		methods: {

			onSubmit() {
				this.$emit('submit', {
					id: this.id,
					deal_ad_id: this.deal_ad_id,
					impressions: this.impressions,
					clicks: this.clicks,
					leads: this.leads,
					spend: this.spend,
					cpl: this.cpl,
					from_date: this.from_date,
					to_date: this.to_date,
				});
			},

			resetForm() {
				this.id = null;
				this.deal_ad_id = '';
				this.impressions = '';
				this.clicks = '';
				this.leads = '';
				this.spend = '';
				this.cpl = '';
				this.from_date = '';
				this.to_date = '';
				this.onSubmit();
			}
		}
	}
</script>
