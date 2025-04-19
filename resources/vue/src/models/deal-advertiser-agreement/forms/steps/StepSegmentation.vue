<template>
    <div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 -mb-6">
            <div>
                <!-- Edad mínima -->
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="min_age"
                    label="Edad mínima"
                    validators="integer"
                    v-model="localDeal.payload.segmentation.min_age" />
            </div>
            <div>
                <!-- Edad máxima -->
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="max_age"
                    label="Edad máxima"
                    validators="integer"
                    v-model="localDeal.payload.segmentation.max_age" />
            </div>
        </div>

        <!-- Géneros -->
        <select-input-component
            :custom-class="inputClass"
            name="genders"
            label="Géneros objetivo"
            multiple
            v-model="localDeal.payload.segmentation.genders">
            <option value="male">Masculino</option>
            <option value="female">Femenino</option>
            <option value="other">Otro</option>
        </select-input-component>

        <!-- Idiomas -->
        <select-input-component
            :custom-class="inputClass"
            name="languages"
            label="Idiomas objetivo"
            multiple
            v-model="localDeal.payload.segmentation.languages">
            <option value="es">Español</option>
            <option value="en">Inglés</option>
            <option value="pt">Portugués</option>
            <option value="fr">Francés</option>
        </select-input-component>

        <!-- Intereses -->
        <tags-input-component
            :custom-class="inputClass"
            name="interests"
            label="Intereses"
            placeholder="Ej: tecnología, viajes"
            v-model="localDeal.payload.segmentation.interests" />

        <!-- Ubicaciones -->
        <tags-input-component
            :custom-class="inputClass"
            name="locations"
            label="Ubicaciones objetivo"
            placeholder="Ej: CDMX, México, Bogotá"
            v-model="localDeal.payload.segmentation.locations" />

        <!-- Dispositivos -->
        <select-input-component
            :custom-class="inputClass"
            name="devices"
            label="Dispositivos"
            multiple
            v-model="localDeal.payload.segmentation.devices">
            <option value="mobile">Móvil</option>
            <option value="desktop">Escritorio</option>
            <option value="tablet">Tablet</option>
        </select-input-component>

        <!-- Plataformas -->
        <select-input-component
            :custom-class="inputClass"
            name="platforms"
            label="Plataformas"
            multiple
            v-model="localDeal.payload.segmentation.platforms">
            <option value="facebook">Facebook</option>
            <option value="google">Google</option>
            <option value="tiktok">TikTok</option>
            <option value="instagram">Instagram</option>
        </select-input-component>

        <!-- Comportamientos -->
        <tags-input-component
            :custom-class="inputClass"
            name="behaviors"
            label="Comportamientos"
            placeholder="Ej: compradores frecuentes, early adopters"
            v-model="localDeal.payload.segmentation.behaviors" />
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
            TagsInputComponent,
        },
        props: {
            modelValue: {
                type: Object,
                required: true
            }
        },
        data() {
            return {}
        },
        computed: {
            localDeal: {
                get() {
                    return this.modelValue
                },
                set(val) {
                    this.$emit('update:modelValue', val)
                }
            }
        },
        watch: {
            localDeal: {
                handler(val) {
                    const seg = val.payload?.segmentation
                    const valid = seg &&
                        (seg.min_age || seg.max_age || seg.genders?.length || seg.languages?.length || seg.interests?.length || seg.locations?.length)
                    this.$emit('validated', !!valid)
                },
                deep: true,
                immediate: true
            }
        }
    }
</script>