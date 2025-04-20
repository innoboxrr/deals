<template>
    <div class="space-y-6">

        <!-- CONFIGURACIÓN DE FACTURACIÓN -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.billing = !collapsed.billing">
                <span class="text-sm font-semibold">Billing Settings</span>
                <i :class="['fa-solid', collapsed.billing ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.billing" class="p-4 space-y-4">
                <select-input-component
                    :custom-class="inputClass"
                    name="autorenewal"
                    label="¿Renovar automáticamente?"
                    validators="required"
                    v-model="localAgreement.payload.billings.autorenewal">
                    <option :value="true">Sí</option>
                    <option :value="false">No</option>
                </select-input-component>

                <select-input-component
                    :custom-class="inputClass"
                    name="currency"
                    label="Moneda"
                    validators="required"
                    v-model="localAgreement.payload.billings.currency">
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="MXN">MXN</option>
                    <option value="COP">COP</option>
                </select-input-component>

                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="management_fee"
                    label="Costo de administración"
                    placeholder="Ej: 500"
                    validators="decimal"
                    v-model="localAgreement.payload.billings.management_fee" />

                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="budget"
                    label="Presupuesto"
                    placeholder="Ej: 10000"
                    validators="decimal"
                    v-model="localAgreement.payload.billings.budget" />

                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="budget_fee"
                    label="Comisión sobre presupuesto (%)"
                    placeholder="Ej: 30"
                    validators="decimal"
                    v-model="localAgreement.payload.billings.budget_fee" />

                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="net_budget"
                    label="Presupuesto Neto"
                    placeholder="Ej: 7000"
                    validators="decimal"
                    :readonly="true"
                    v-model="localAgreement.payload.billings.net_budget" />

                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="budget_spent"
                    label="Gasto real"
                    placeholder="Ej: 6800"
                    validators="decimal"
                    :readonly="true"
                    v-model="localAgreement.payload.billings.budget_spent" />
            </div>
        </div>

        <!-- INFORMACIÓN ADICIONAL -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.extra = !collapsed.extra">
                <span class="text-sm font-semibold">Additional Info</span>
                <i :class="['fa-solid', collapsed.extra ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.extra" class="p-4 space-y-4">
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="payment_terms"
                    label="Términos de pago (días)"
                    placeholder="Ej: 30"
                    validators="integer"
                    v-model="localAgreement.payload.billings.payment_terms" />

                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="invoice_reference"
                    label="Referencia de factura"
                    placeholder="Ej: INV-2024-0001"
                    v-model="localAgreement.payload.billings.invoice_reference" />

                <!-- Nombre de contacto -->
                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="billing_name"
                    label="Nombre de contacto"
                    placeholder="Ej: Juan Pérez"
                    v-model="localAgreement.payload.billings.billing_name" />

                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="billing_contact"
                    label="Contacto de facturación"
                    placeholder="Ej: billing@client.com"
                    v-model="localAgreement.payload.billings.billing_contact" />

                <!-- Teléfono de contacto -->
                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="billing_phone"
                    label="Teléfono de contacto"
                    placeholder="Ej: +52 55 1234 5678"
                    v-model="localAgreement.payload.billings.billing_phone" />

            </div>
        </div>

    </div>
</template>

<script>
import {
    TextInputComponent,
    SelectInputComponent
} from 'innoboxrr-form-elements'

export default {
    name: 'StepBillingAgreement',
    components: {
        TextInputComponent,
        SelectInputComponent
    },
    props: {
        modelValue: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            collapsed: {
                billing: false,
                extra: true
            }
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
                const b = val.payload?.billings
                const valid = b &&
                    b.autorenewal !== '' &&
                    b.management_fee !== '' &&
                    b.budget !== '' &&
                    b.budget_fee !== '' &&
                    b.net_budget !== '' &&
                    b.budget_spent !== ''
                this.$emit('validated', valid)
            },
            deep: true,
            immediate: true
        },
        'localAgreement.payload.billings.budget_fee': function (newVal) {
            const fee = this.localAgreement.payload?.billings;
            if (fee && fee.budget) {
                const feePercent = parseFloat(newVal) || 0;
                const budget = parseFloat(fee.budget) || 0;
                fee.net_budget = budget - (budget * (feePercent / 100));
            }
        },
        'localAgreement.payload.billings.budget': function (newVal) {
            const fee = this.localAgreement.payload?.billings;
            if (fee && fee.budget_fee) {
                const feePercent = parseFloat(fee.budget_fee) || 0;
                const budget = parseFloat(newVal) || 0;
                fee.net_budget = budget - (budget * (feePercent / 100));
            }
        },
    }
}
</script>