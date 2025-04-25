<template>
	<form :id="formId" @submit.prevent="onSubmit">

        <h2 class="text-2xl font-bold">
            {{ __deals('Create Product') }}
        </h2>
        <p class="text-gray-400 mb-4">
            {{ __deals('Fill out the fields to create a new product.') }}
        </p>

		<!-- NOMBRE -->
		<text-input-component
			:custom-class="inputClass"
			type="text"
			name="name"
			label="Nombre"
			placeholder="Nombre del producto"
			validators="required length"
			min_length="3"
			v-model="dealProduct.name" />

		<!-- DESCRIPCIÓN -->
		<textarea-input-component
			:custom-class="inputClass"
			name="description"
			label="Descripción"
			placeholder="Descripción general"
			validators="required length"
			min_length="3"
			v-model="dealProduct.description" />

		<!-- IMAGEN PRINCIPAL -->
		<file-input-component
			:upload-url="fileUploadUrl"
			:auto-upload="true"
			:show-top-preview="true"
			:hide-on-max-files-reached="true"
			:valid-mimes="['image/jpeg', 'image/png']"
			message="Da clic o arrastra una imagen"
			@updateFileList="files => dealProduct.payload.general.image = files[0]?.path" />

		<!-- VIDEO -->
		<text-input-component
			:custom-class="inputClass"
			type="text"
			name="video_url"
			label="Video"
			placeholder="https://..."
			validators="url"
			v-model="dealProduct.payload.general.video_url" />

		<!-- ESLOGAN -->
		<text-input-component
			:custom-class="inputClass"
			type="text"
			name="tagline"
			label="Eslogan"
			placeholder="Eslogan corto"
			validators="length"
			min_length="3"
			v-model="dealProduct.payload.general.tagline" />

		<!-- GALERÍA -->
		<file-input-component
			:upload-url="fileUploadUrl"
			:auto-upload="true"
			:show-top-preview="true"
			:hide-on-max-files-reached="false"
			:valid-mimes="['image/jpeg', 'image/png']"
			:multiple="true"
			message="Arrastra o sube múltiples imágenes"
			@updateFileList="files => dealProduct.payload.general.gallery = files.map(f => f.path)" />

		<!-- FEATURES -->
		<dynamic-group-input-component
            class="my-4"
			label="Características"
			v-model="dealProduct.payload.general.features"
			:inputs-config="[
				{
					key: 'value',
					type: 'text',
					attributes: {
						type: 'text',
						name: 'feature',
						label: 'Característica',
						placeholder: 'Ej: Soporte 24/7',
						validators: 'length',
						min_length: 2,
						customClass: inputClass
					}
				}
			]" />

		<!-- BENEFICIOS -->
		<dynamic-group-input-component
            class="my-4"
			label="Beneficios"
			v-model="dealProduct.payload.general.benefits"
			:inputs-config="[
				{
					key: 'value',
					type: 'text',
					attributes: {
						type: 'text',
						name: 'benefit',
						label: 'Beneficio',
						placeholder: 'Ej: Ahorro garantizado',
						validators: 'length',
						min_length: 2,
						customClass: inputClass
					}
				}
			]" />

		<!-- CAMPOS SIMPLES -->
		<text-input-component v-for="field in [
			{ name: 'brand', label: 'Marca' },
			{ name: 'model', label: 'Modelo' },
			{ name: 'price_range', label: 'Rango de precio' },
			{ name: 'warranty', label: 'Garantía' },
			{ name: 'availability', label: 'Disponibilidad' },
		]"
		:key="field.name"
		:custom-class="inputClass"
		type="text"
		:name="field.name"
		:label="field.label"
		:placeholder="field.label"
		v-model="dealProduct.payload.product_details[field.name]" />

        <category-select-component v-model="dealProduct.payload.product_details" />

		<!-- MIN AGE -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="min_age"
			label="Edad mínima"
			validators="integer"
			v-model="dealProduct.payload.target_audience.min_age" />

		<!-- MAX AGE -->
		<text-input-component
			:custom-class="inputClass"
			type="number"
			name="max_age"
			label="Edad máxima"
			validators="integer"
			v-model="dealProduct.payload.target_audience.max_age" />

		<!-- GÉNERO -->
		<tags-input-component
            :custom-class="inputClass"
			name="gender"
			label="Género objetivo"
			placeholder="Ej: male, female"
			v-model="dealProduct.payload.target_audience.gender" />

		<!-- INTERESES -->
		<dynamic-group-input-component
            class="my-4"
			label="Intereses ideales"
			v-model="dealProduct.payload.target_audience.ideal_interests"
			:inputs-config="[
				{
					key: 'value',
					type: 'text',
					attributes: {
						name: 'interest',
						label: 'Interés',
						placeholder: 'Ej: Tecnología, Viajes',
						validators: 'length',
						min_length: 2,
						customClass: inputClass
					}
				}
			]" />

		<!-- CONTEXTO DE USO -->
		<textarea-input-component
			:custom-class="inputClass"
			name="usage_context"
			label="Contexto de uso"
			placeholder="Ej: Vacaciones, Trabajo remoto"
			v-model="dealProduct.payload.target_audience.usage_context" />

        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="key_message"
            label="Mensaje clave"
            placeholder="Mensaje clave"
            validators="length"
            min_length="3"
            v-model="dealProduct.payload.marketing.key_message" />

		<!-- DIFERENCIADORES -->
		<dynamic-group-input-component
            class="my-4"
			label="Diferenciadores"
			v-model="dealProduct.payload.marketing.differentiators"
			:inputs-config="[
				{
					key: 'value',
					type: 'text',
					attributes: {
						name: 'diff',
						label: 'Diferenciador',
						placeholder: 'Ej: Único en el mercado',
						validators: 'length',
						min_length: 2,
						customClass: inputClass
					}
				}
			]" />

		<!-- TESTIMONIOS -->
		<dynamic-group-input-component
            class="my-4"
			label="Testimonios"
			v-model="dealProduct.payload.marketing.testimonials"
			:inputs-config="[
				{
					key: 'author',
					type: 'text',
					attributes: {
						name: 'author',
						label: 'Autor',
						placeholder: 'Nombre del cliente',
						validators: 'length',
						min_length: 2,
						customClass: inputClass
					}
				},
				{
					key: 'message',
					type: 'textarea',
					attributes: {
						name: 'message',
						label: 'Mensaje',
						placeholder: 'Opinión o testimonio',
						validators: 'length',
						min_length: 5,
						customClass: inputClass
					}
				}
			]" />

		<button-component
			:custom-class="buttonClass"
			:disabled="disabled"
			value="Crear" />
	</form>
</template>

<script>
import { createModel } from '@dealsModels/deal-product'
import JSValidator from 'innoboxrr-js-validator'
import CategorySelectComponent from '@dealsModels/deal-product/components/CategorySelectComponent.vue'
import {
	TextInputComponent,
	TextareaInputComponent,
	FileInputComponent,
	ButtonComponent,
	TagsInputComponent,
	DynamicGroupInputComponent,
} from 'innoboxrr-form-elements'

export default {
	components: {
        CategorySelectComponent,
		TextInputComponent,
		TextareaInputComponent,
		FileInputComponent,
		ButtonComponent,
		TagsInputComponent,
		DynamicGroupInputComponent,
	},

	props: {
		formId: {
			type: String,
			default: 'createDealProductForm',
		},
		dealId: {
			type: [String, Number],
			default: null,
		}
	},

	emits: ['submit'],

	data() {
		return {
			disabled: false,
			JSValidator: undefined,
			dealProduct: {
				name: '',
				description: '',
				payload: {
                    general: {
                        image: null,
                        gallery: [],
                        video_url: null,
                        tagline: null,
                        features: [],
                        benefits: [],
                    },
                    product_details: {
                        category: null,
                        sub_category: null,
                        brand: null,
                        model: null,
                        price_range: null,
                        warranty: null,
                        availability: null,
                    },
                    target_audience: {
                        min_age: null,
                        max_age: null,
                        gender: [],
                        ideal_interests: [],
                        usage_context: null,
                    },
                    marketing: {
                        key_message: null,
                        differentiators: [],
                        testimonials: [],
                    }
                }
			}
		}
	},

	mounted() {
		this.JSValidator = new JSValidator(this.formId).init();
	},

	methods: {
		onSubmit() {
			if (this.JSValidator.status) {
				this.disabled = true;
				createModel({
					name: this.dealProduct.name,
					description: this.dealProduct.description,
					...this.dealProduct.payload,
					deal_id: this.dealId,
				}).then(res => {
					this.$emit('submit', res);
					setTimeout(() => { this.disabled = false }, 2500);
				}).catch(error => {
					this.disabled = false;
					if (error?.response?.status === 422) {
						this.JSValidator.appendExternalErrors(error.response.data.errors);
					}
				});
			} else {
				this.disabled = false;
			}
		}
	}
}
</script>
