<template>
    <div>
      <!-- Snapshot Cron -->
      <text-input-component
        :custom-class="inputClass"
        type="text"
        name="snapshot_cron_interval"
        label="Frecuencia de snapshots"
        placeholder="Ej: 0 0 * * *"
        validators="required"
        v-model="localDeal.payload.snapshot_cron_interval" />
      <p class="-mt-5 text-xs text-right">
        Visita <a href='https://crontab.guru/' target="_blank" class="underline text-blue-500">Cron Guru</a> para aprender más
      </p>
  
      <!-- Pausa automática -->
      <select-input-component
        :custom-class="inputClass"
        name="auto_pause_campaigns_on_threshold"
        label="¿Pausar campañas automáticamente si se violan umbrales?"
        v-model="localDeal.payload.auto_pause_campaigns_on_threshold"
        validators="required">
        <option :value="1">Sí</option>
        <option :value="0">No</option>
      </select-input-component>
  
      <!-- Umbral mínimo de CTR -->
      <text-input-component
        :custom-class="inputClass"
        type="number"
        name="min_ctr"
        label="CTR mínimo (%)"
        placeholder="Ej: 1.5"
        validators="decimal"
        v-model="localDeal.payload.automation_thresholds.min_ctr" />
  
      <!-- Umbral máximo de CPL -->
      <text-input-component
        :custom-class="inputClass"
        type="number"
        name="max_cpl"
        label="CPL máximo"
        placeholder="Ej: 30"
        validators="decimal"
        v-model="localDeal.payload.automation_thresholds.max_cpl" />
  
      <!-- Umbral máximo de CPA -->
      <text-input-component
        :custom-class="inputClass"
        type="number"
        name="max_cpa"
        label="CPA máximo"
        placeholder="Ej: 50"
        validators="decimal"
        v-model="localDeal.payload.automation_thresholds.max_cpa" />
    </div>
  </template>
  
  <script>
  import {
    TextInputComponent,
    SelectInputComponent,
  } from 'innoboxrr-form-elements'
  
  export default {
    name: 'StepAutomation',
    components: {
      TextInputComponent,
      SelectInputComponent,
    },
    props: {
      modelValue: {
        type: Object,
        required: true
      }
    },
    data() {
      return {
        inputClass: 'mb-4',
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
          const valid = !!val.payload?.snapshot_cron_interval &&
                        val.payload?.auto_pause_campaigns_on_threshold !== ''
          this.$emit('validated', valid)
        },
        deep: true,
        immediate: true
      }
    }
  }
  </script>
  