<template>
    <form :id="formId" @submit.prevent="onFilter">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            
            <!-- Nombre del Deal -->
            <text-input-component
                :custom-class="inputClass"
                type="text"
                name="name"
                label="Nombre"
                placeholder="Buscar por nombre"
                v-model="filters.name" />

            <!-- Tipo de Deal -->
            <select-input-component
                :custom-class="inputClass"
                name="type"
                label="Tipo de Deal"
                v-model="filters.type">
                <option value="">Todos</option>
                <option value="lead_gen">Generación de leads</option>
                <option value="ecommerce">E-commerce</option>
                <option value="branding">Branding</option>
                <option value="content">Contenido</option>
            </select-input-component>

            <!-- Estado del Deal -->
            <select-input-component
                :custom-class="inputClass"
                name="status"
                label="Estado"
                v-model="filters.status">
                <option value="">Todos</option>
                <option value="draft">Borrador</option>
                <option value="active">Activo</option>
                <option value="paused">Pausado</option>
                <option value="archived">Archivado</option>
            </select-input-component>

            <!-- Fecha de inicio -->
            <text-input-component
                :custom-class="inputClass"
                type="date"
                name="start_date_from"
                label="Desde (Inicio)"
                v-model="filters.start_date_from" />

            <!-- Fecha de fin -->
            <text-input-component
                :custom-class="inputClass"
                type="date"
                name="start_date_to"
                label="Hasta (Inicio)"
                v-model="filters.start_date_to" />

            <!-- Moneda -->
            <select-input-component
                :custom-class="inputClass"
                name="currency"
                label="Moneda"
                v-model="filters.currency">
                <option value="">Todas</option>
                <option value="MXN">MXN</option>
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
            </select-input-component>
        </div>

        <div class="flex justify-between mt-6">
            <button-component
                :custom-class="buttonClass"
                value="Aplicar filtros"
                @click="onFilter" />

            <button-component
                variant="secondary"
                value="Limpiar"
                @click="resetFilters" />
        </div>
    </form>
</template>

<script>
import {
    TextInputComponent,
    SelectInputComponent,
    ButtonComponent,
} from 'innoboxrr-form-elements'

export default {
    name: 'DealFilterForm',
    components: {
        TextInputComponent,
        SelectInputComponent,
        ButtonComponent,
    },
    props: {
        formId: {
            type: String,
            default: 'dealFilterForm',
        }
    },
    emits: ['filter'],
    data() {
        return {
            inputClass: 'mb-4',
            buttonClass: '',
            filters: {
                name: '',
                type: '',
                status: '',
                start_date_from: '',
                start_date_to: '',
                currency: '',
            }
        }
    },
    methods: {
        onFilter() {
            this.$emit('filter', { ...this.filters })
        },
        resetFilters() {
            this.filters = {
                name: '',
                type: '',
                status: '',
                start_date_from: '',
                start_date_to: '',
                currency: '',
            }
            this.onFilter()
        }
    }
}
</script>
