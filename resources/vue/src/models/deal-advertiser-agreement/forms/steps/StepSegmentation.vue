<template>
	<div>

		<div class="grid grid-cols-1 md:grid-cols-2 gap-4 -mb-6">

            <div>
                <!-- MIN AGE -->
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="min_age"
                    label="Edad mínima"
                    validators="integer"
                    v-model="localAgreement.payload.segmentation.min_age" />
            </div>

            <div>
                <!-- MAX AGE -->
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="max_age"
                    label="Edad máxima"
                    validators="integer"
                    v-model="localAgreement.payload.segmentation.max_age" />
            </div>

		</div>

		<!-- GENDERS -->
		<select-input-component
			:custom-class="inputClass"
			name="genders"
			label="Géneros"
			multiple
			v-model="localAgreement.payload.segmentation.genders">
			<option value="male">Masculino</option>
			<option value="female">Femenino</option>
			<option value="other">Otro</option>
		</select-input-component>

		<!-- PLATFORMS -->
		<select-input-component
			:custom-class="inputClass"
			name="platforms"
			label="Plataformas"
			multiple
			v-model="localAgreement.payload.segmentation.platforms">
			<option value="facebook">Facebook</option>
			<option value="google">Google</option>
			<option value="instagram">Instagram</option>
			<option value="tiktok">TikTok</option>
			<option value="youtube">YouTube</option>
		</select-input-component>

		<!-- DEVICES -->
		<select-input-component
			:custom-class="inputClass"
			name="devices"
			label="Dispositivos"
			multiple
			v-model="localAgreement.payload.segmentation.devices">
			<option value="mobile">Móvil</option>
			<option value="desktop">Escritorio</option>
			<option value="tablet">Tablet</option>
		</select-input-component>

		<!-- INTERESTS -->
		<tags-input-component
			:custom-class="inputClass"
			name="interests"
			label="Intereses"
			placeholder="Ej: tecnología, viajes, salud"
			v-model="localAgreement.payload.segmentation.interests" />

		<!-- STATES -->
		<tags-input-component
			:custom-class="inputClass"
			name="states"
			label="Estados / Regiones"
			placeholder="Ej: CDMX, Jalisco, Bogotá"
			v-model="localAgreement.payload.segmentation.states" />

	</div>
</template>

<script>
import {
	TextInputComponent,
	SelectInputComponent,
	TagsInputComponent
} from 'innoboxrr-form-elements'

export default {
	name: 'StepSegmentation',
	components: {
		TextInputComponent,
		SelectInputComponent,
		TagsInputComponent
	},
	props: {
		modelValue: {
			type: Object,
			required: true
		}
	},
	computed: {
		localAgreement: {
			get() {
				return this.modelValue
			},
			set(val) {
				this.$emit('update:modelValue', val)
			}
		}
	},
	watch: {
		localAgreement: {
			handler(val) {
				const seg = val.payload?.segmentation
				const valid = !!(
					seg?.min_age ||
					seg?.max_age ||
					seg?.genders?.length ||
					seg?.platforms?.length ||
					seg?.devices?.length ||
					seg?.interests?.length ||
					seg?.states?.length
				)
				this.$emit('validated', valid)
			},
			deep: true,
			immediate: true
		}
	}
}
</script>
