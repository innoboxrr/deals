<template>

    <!-- Status -->
    <select-input-component
        :custom-class="inputClass"
        name="gatewayType"
        :label="__deals('Gateway Type')"
        validators="required"
        v-model="gatewayType">
        <option value="landing">Landing</option>
        <option value="form">Form</option>
        <option value="endpoint">Endpoint</option>
        <option disabled value="embed">Embed</option>
    </select-input-component>

    <div>
        <model-search-input-component 
            custom-class="bg-gray-50 rounded-lg text-sm py-0.5 border border-gray-300"
            label-str="Buscar Deal por nombre o ID"
            placeholder-str="Escribe para buscar"
            :route="gatewaysRoute"
            q="name"
            :externalFilters="{
                deal_id: localDeal.id,
                type: gatewayType,
            }"
            :get-option-label="option => `${option.name} (ID: ${option.id} - Type: ${getGatewayType(option.type)})`"
            @submit="setGateway" />
    </div>
</template>

<script>
    import {
        SelectInputComponent,
        ModelSearchInputComponent
    } from 'innoboxrr-form-elements'

    export default {
        name: 'StepGateway',
        components: {
            SelectInputComponent,
            ModelSearchInputComponent,
        },
        props: {
            modelValue: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                gatewayType: 'landing',
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
                    
                    this.$emit('validated', true)
                },
                deep: true,
                immediate: true
            }
        }
    }
</script>
