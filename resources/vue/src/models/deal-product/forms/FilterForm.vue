<template>	
	<form id="dealProductFilterForm" @submit.prevent="onSubmit">
		<div class="uk-flex uk-flex-left uk-child-width-1-4@m uk-child-width-1-1@s" uk-grid>
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="id"
					label="ID"
					placeholder="ID" 
					v-model="id" />
			</div>

			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="name"
					label="Nombre"
					placeholder="Nombre"
					v-model="name" />
			</div>

			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="description"
					label="Descripción"
					placeholder="Descripción"
					v-model="description" />
			</div>

			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="deal_id"
					label="Deal ID"
					placeholder="ID del Deal"
					v-model="deal_id" />
			</div>
		</div>

		<div class="uk-flex uk-flex-right uk-child-width-auto@m uk-child-width-1-1@m" uk-grid>
			<div>
				<button :class="buttonClass">
					{{ __('Search') }}
				</button>
			</div>
			<div>
				<button 
					:class="buttonClass + ' bg-gray-400'"
					@click.prevent="resetForm()">
					{{ __('Reset') }}
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
				name: null,
				description: null,
				deal_id: null,
			}
		},

		methods: {

			onSubmit() {
				this.$emit('submit', {
					id: this.id,
					name: this.name,
					description: this.description,
					deal_id: this.deal_id,
				});
			},

			resetForm() {
				this.id = null;
				this.name = null;
				this.description = null;
				this.deal_id = null;
				this.onSubmit();
			}
		}
	}
</script>
