<template>
	<div class="uk-grid-small" uk-grid>
		<!-- Categoría -->
		<div class="uk-width-1-2@s">
			<select-input-component
				:custom-class="inputClass"
				name="category"
				label="Categoría"
				v-model="internalValue.category"
			>
				<option disabled value="">Selecciona una categoría</option>
				<option 
					v-for="(subs, cat) in categoryOptions" 
					:key="cat" 
					:value="cat">
					{{ cat }}
				</option>
			</select-input-component>
		</div>

		<!-- Subcategoría -->
		<div class="uk-width-1-2@s">
			<select-input-component
				:custom-class="inputClass"
				name="sub_category"
				label="Subcategoría"
				v-model="internalValue.sub_category"
			>
				<option disabled value="">Selecciona una subcategoría</option>
				<option 
					v-for="sub in subCategoryOptions" 
					:key="sub" 
					:value="sub">
					{{ sub }}
				</option>
			</select-input-component>
		</div>
	</div>
</template>

<script>
import { categoryData } from '@dealsModels/deal-product'
import { SelectInputComponent } from 'innoboxrr-form-elements'

export default {
	components: {
		SelectInputComponent
	},

	props: {
		modelValue: {
			type: Object,
			default: () => ({
				category: '',
				sub_category: ''
			})
		},
	},

	data() {
		return {
			categoryOptions: categoryData,
		}
	},

	computed: {
		internalValue: {
			get() {
				return this.modelValue
			},
			set(val) {
				this.$emit('update:modelValue', val)
			}
		},

		subCategoryOptions() {
			return this.internalValue.category
				? this.categoryOptions[this.internalValue.category]
				: []
		}
	}
}
</script>
