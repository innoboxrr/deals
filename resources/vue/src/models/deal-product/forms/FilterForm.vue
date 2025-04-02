<template>	
	<form :id="formId" @submit.prevent="onSubmit">
		<div class="uk-flex uk-flex-left uk-child-width-1-4@m uk-child-width-1-1@s" uk-grid>
			
            <!-- ID -->
            <div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="id"
					label="ID"
					placeholder="ID" 
					v-model="filters.id" />
			</div>

            <!-- NAME -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="name"
					label="Nombre"
					placeholder="Nombre del producto"
					:min_length="3"
					validators="length"
					v-model="filters.name" />
			</div>

            <!-- PRICE MIN -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="number"
					name="price_min"
					label="Precio mínimo"
					placeholder="Desde"
					validators="decimal"
					v-model="filters.price_min" />
			</div>

            <!-- PRICE MAX -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="number"
					name="price_max"
					label="Precio máximo"
					placeholder="Hasta"
					validators="decimal"
					v-model="filters.price_max" />
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
					@click.prevent="resetForm">
					{{ __('Resetear') }}
				</button>
			</div>
		</div>
	</form>
</template>

<script>
	import { 
		TextInputComponent
	} from 'innoboxrr-form-elements'

	export default {

		components: {
			TextInputComponent,
		},

		props: {
			formId: {
				type: String,
				default: 'dealProductFilterForm'
			},
		},

		emits: ['submit'],

		data() {
			return {
				filters: {
					id: null,
					name: '',
					price_min: '',
					price_max: '',
				}
			}
		},

		methods: {

			onSubmit() {
				this.$emit('submit', this.filters);
			},

			resetForm() {
				this.filters = {
					id: null,
					name: '',
					price_min: '',
					price_max: '',
				}
				this.onSubmit();
			}
		}
	}
</script>
