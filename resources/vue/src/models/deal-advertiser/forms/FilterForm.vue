<template>
    <form :id="formId" @submit.prevent="applyFilters">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            <!-- Nombre legal -->
            <text-input-component
                :custom-class="inputClass"
                type="text"
                name="legal_name"
                label="Nombre legal"
                placeholder="Buscar por nombre legal"
                v-model="filters.legal_name" />

            <!-- VAT / RFC / NIT -->
            <text-input-component
                :custom-class="inputClass"
                type="text"
                name="vat_number"
                label="Identificación fiscal"
                placeholder="RFC, VAT, NIT..."
                v-model="filters.vat_number" />

            <!-- País -->
            <text-input-component
                :custom-class="inputClass"
                type="text"
                name="country"
                label="País"
                placeholder="Ej: México, Colombia"
                v-model="filters.country" />

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

            <!-- Estado -->
            <select-input-component
                :custom-class="inputClass"
                name="status"
                label="Estado"
                v-model="filters.status">
                <option value="">Todos</option>
                <option value="active">Activo</option>
                <option value="inactive">Inactivo</option>
                <option value="suspended">Suspendido</option>
                <option value="blacklisted">Lista negra</option>
            </select-input-component>

            <!-- Fecha de última factura desde -->
            <text-input-component
                :custom-class="inputClass"
                type="date"
                name="invoice_from"
                label="Desde (Facturado)"
                v-model="filters.invoice_from" />

            <!-- Fecha de última factura hasta -->
            <text-input-component
                :custom-class="inputClass"
                type="date"
                name="invoice_to"
                label="Hasta (Facturado)"
                v-model="filters.invoice_to" />

        </div>

        <div class="flex justify-between mt-6">
            <button-component
                :custom-class="buttonClass"
                value="Aplicar filtros"
                @click="applyFilters" />

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
    name: 'DealAdvertiserFilterForm',
    components: {
        TextInputComponent,
        SelectInputComponent,
        ButtonComponent,
    },
    props: {
        formId: {
            type: String,
            default: 'dealAdvertiserFilterForm'
        }
    },
    emits: ['filter'],
    data() {
        return {
            inputClass: 'mb-4',
            buttonClass: '',
            filters: {
                legal_name: '',
                vat_number: '',
                country: '',
                currency: '',
                status: '',
                invoice_from: '',
                invoice_to: '',
            }
        }
    },
    methods: {
        applyFilters() {
            this.$emit('filter', { ...this.filters })
        },
        resetFilters() {
            this.filters = {
                legal_name: '',
                vat_number: '',
                country: '',
                currency: '',
                status: '',
                invoice_from: '',
                invoice_to: '',
            }
            this.applyFilters()
        }
    }
}
</script>
