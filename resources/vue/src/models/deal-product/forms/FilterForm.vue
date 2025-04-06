<template>	
	<form id="dealProductFilterForm" @submit.prevent="onSubmit">
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

			<!-- Nombre -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="name"
					label="Nombre"
					placeholder="Nombre del producto"
					v-model="name" />
			</div>

			<!-- Categoría -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="category"
					label="Categoría"
					placeholder="Ej. seguros, salud"
					v-model="category" />
			</div>

			<!-- Marca -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="brand"
					label="Marca"
					placeholder="Marca o proveedor"
					v-model="brand" />
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
					{{ __('Restablecer') }}
				</button>
			</div>
		</div>
	</form>
</template>

<script>
	import { TextInputComponent } from 'innoboxrr-form-elements'

	export default {
		components: {
			TextInputComponent
		},

		emits: ['submit'],

		data() {
			return {
				id: null,
				name: null,
				category: null,
				brand: null,
			}
		},

		methods: {
			onSubmit() {
				this.$emit('submit', this.$data);
			},

			resetForm() {
				this.id = null;
				this.name = null;
				this.category = null;
				this.brand = null;
				this.onSubmit();
			}
		}
	}
</script>
