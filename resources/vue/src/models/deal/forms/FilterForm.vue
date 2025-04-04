<template>	
	<form id="dealFilterForm" @submit.prevent="onSubmit">
		<div class="uk-flex uk-flex-left uk-child-width-1-4@m uk-child-width-1-1@s" uk-grid>

			<!-- ID -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="id"
					label="ID"
					placeholder="ID"
					v-model="id" />
			</div>

			<!-- NAME -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="name"
					label="Nombre"
					placeholder="Nombre del Deal"
					v-model="name" />
			</div>

			<!-- MAX CPL -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="number"
					name="max_cpl"
					label="CPL Máximo"
					placeholder="Ej. 10.5"
					v-model="max_cpl" />
			</div>

			<!-- SNAPSHOT UNIT -->
			<div>
				<select-input-component
					name="snapshot_performnace_frenquency_unit"
					label="Unidad de Frecuencia"
					v-model="snapshot_performnace_frenquency_unit">
					<option value="">Cualquiera</option>
					<option value="minutes">Minutos</option>
					<option value="hours">Horas</option>
					<option value="days">Días</option>
				</select-input-component>
			</div>

			<!-- DEAL PRODUCT ID -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="deal_product_id"
					label="ID Producto"
					placeholder="ID del producto"
					v-model="deal_product_id" />
			</div>

			<!-- WORKSPACE ID -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="workspace_id"
					label="ID del Workspace"
					placeholder="ID del workspace"
					v-model="workspace_id" />
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
				max_cpl: '',
				snapshot_performnace_frenquency_unit: '',
				deal_product_id: '',
				workspace_id: '',
			}
		},

		methods: {

			onSubmit() {
				this.$emit('submit', {
					id: this.id,
					name: this.name,
					max_cpl: this.max_cpl,
					snapshot_performnace_frenquency_unit: this.snapshot_performnace_frenquency_unit,
					deal_product_id: this.deal_product_id,
					workspace_id: this.workspace_id,
				});
			},

			resetForm() {
				this.id = null;
				this.name = '';
				this.max_cpl = '';
				this.snapshot_performnace_frenquency_unit = '';
				this.deal_product_id = '';
				this.workspace_id = '';
				this.onSubmit();
			}
		}
	}
</script>
