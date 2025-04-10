<template>
    <div>
      <!-- Edad mínima -->
      <text-input-component
        :custom-class="inputClass"
        type="number"
        name="min_age"
        label="Edad mínima"
        validators="integer"
        v-model="localDeal.payload.segmentation.min_age" />
  
      <!-- Edad máxima -->
      <text-input-component
        :custom-class="inputClass"
        type="number"
        name="max_age"
        label="Edad máxima"
        validators="integer"
        v-model="localDeal.payload.segmentation.max_age" />
  
      <!-- Géneros -->
      <tags-input-component
        :custom-class="inputClass"
        name="genders"
        label="Géneros objetivo"
        placeholder="Ej: male, female, other"
        v-model="localDeal.payload.segmentation.genders" />
  
      <!-- Idiomas -->
      <tags-input-component
        :custom-class="inputClass"
        name="languages"
        label="Idiomas objetivo"
        placeholder="Ej: es, en, pt"
        v-model="localDeal.payload.segmentation.languages" />
  
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
      <tags-input-component
        :custom-class="inputClass"
        name="devices"
        label="Dispositivos"
        placeholder="Ej: mobile, desktop, tablet"
        v-model="localDeal.payload.segmentation.devices" />
  
      <!-- Plataformas -->
      <tags-input-component
        :custom-class="inputClass"
        name="platforms"
        label="Plataformas"
        placeholder="Ej: facebook, google, tiktok"
        v-model="localDeal.payload.segmentation.platforms" />
  
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
    TagsInputComponent
  } from 'innoboxrr-form-elements'
  
  export default {
    name: 'StepSegmentation',
    components: {
      TextInputComponent,
      TagsInputComponent,
    },
    props: {
      modelValue: {
        type: Object,
        required: true
      }
    },
    data() {
      return {
        inputClass: 'mb-4'
      }
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
  