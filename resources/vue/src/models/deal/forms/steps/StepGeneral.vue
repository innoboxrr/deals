<template>
    <div>
      <!-- NAME -->
      <text-input-component
        :custom-class="inputClass"
        type="text"
        name="name"
        label="Nombre del Deal"
        placeholder="Ej: Oferta de Verano"
        validators="required length"
        :min_length="3"
        v-model="localDeal.name" />
  
      <!-- DESCRIPTION -->
      <textarea-input-component
        :custom-class="inputClass"
        name="description"
        label="Descripción"
        placeholder="Describe brevemente el Deal"
        validators="required length"
        :min_length="3"
        v-model="localDeal.description" />
  
      <!-- OBJECTIVE -->
      <text-input-component
        :custom-class="inputClass"
        type="text"
        name="objective"
        label="Objetivo principal"
        placeholder="Ej: Generar leads calificados"
        validators="length"
        :min_length="3"
        v-model="localDeal.payload.objective" />
  
      <!-- TYPE -->
      <select-input-component
        :custom-class="inputClass"
        name="type"
        label="Tipo de Deal"
        validators="required"
        v-model="localDeal.payload.type">
        <option value="">Selecciona una opción</option>
        <option value="lead_gen">Generación de leads</option>
        <option value="ecommerce">E-commerce</option>
        <option value="branding">Branding</option>
        <option value="content">Contenido</option>
      </select-input-component>
  
      <!-- BUDGET -->
      <text-input-component
        :custom-class="inputClass"
        type="number"
        name="budget"
        label="Presupuesto estimado"
        placeholder="Ej: 5000"
        validators="decimal"
        v-model="localDeal.payload.budget" />
  
      <!-- CURRENCY -->
      <select-input-component
        :custom-class="inputClass"
        name="currency"
        label="Moneda"
        validators="required"
        v-model="localDeal.payload.currency">
        <option value="">Selecciona una moneda</option>
        <option value="MXN">MXN</option>
        <option value="USD">USD</option>
        <option value="EUR">EUR</option>
      </select-input-component>
  
      <!-- DATES -->
      <text-input-component
        :custom-class="inputClass"
        type="date"
        name="start_date"
        label="Fecha de inicio"
        validators="required"
        v-model="localDeal.payload.start_date" />
  
      <text-input-component
        :custom-class="inputClass"
        type="date"
        name="end_date"
        label="Fecha de finalización"
        validators="required"
        v-model="localDeal.payload.end_date" />
  
      <!-- VISIBILITY -->
      <tags-input-component
        :custom-class="inputClass"
        name="visibility_roles"
        label="Visible para roles"
        placeholder="admin, sales, marketing"
        v-model="localDeal.payload.visibility_roles" />
  
      <!-- COUNTRIES -->
      <tags-input-component
        :custom-class="inputClass"
        name="restricted_countries"
        label="Países restringidos"
        placeholder="Ej: CU, IR, RU"
        v-model="localDeal.payload.restricted_countries" />
    </div>
  </template>
  
  <script>
  import {
    TextInputComponent,
    TextareaInputComponent,
    SelectInputComponent,
    TagsInputComponent,
  } from 'innoboxrr-form-elements'
  
  export default {
    name: 'StepGeneral',
    components: {
      TextInputComponent,
      TextareaInputComponent,
      SelectInputComponent,
      TagsInputComponent,
    },
    props: {
      modelValue: {
        type: Object,
        required: true
      },
      mode: {
        type: String,
        default: 'create'
      }
    },
    data() {
      return {
        
      }
    },
    computed: {
      localDeal: {
        get() {
          return this.modelValue
        },
        set(value) {
          this.$emit('update:modelValue', value)
        }
      }
    },
    watch: {
      localDeal: {
        handler(val) {
          const valid =
            val.name?.length >= 3 &&
            val.description?.length >= 3 &&
            val.payload?.type &&
            val.payload?.currency &&
            val.payload?.start_date &&
            val.payload?.end_date
          this.$emit('validated', valid)
        },
        deep: true,
        immediate: true
      }
    }
  }
  </script>
  