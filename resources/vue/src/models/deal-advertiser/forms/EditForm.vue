<template>
    <form :id="formId" @submit.prevent="onSubmit">

        <h2 class="text-2xl font-bold">
            {{ __deals('Edit advertiser') }}
        </h2>
        <p class="text-gray-400 mb-4">
            {{ __deals('Update the fields to edit the advertiser') }}
        </p>

        <!-- COMPANY -->
        <h3 class="text-lg font-semibold mt-6 mb-2">Datos de la empresa</h3>
        <text-input-component 
            :custom-class="inputClass" 
            type="text"
            name="company_name" 
            label="Nombre legal" 
            validators="required length" 
            :min_length="3" 
            v-model="advertiser.payload.company.name" />

        <text-input-component 
            :custom-class="inputClass" 
            type="text"
            name="tax_number" 
            label="Número fiscal (VAT / RFC / NIT)" 
            v-model="advertiser.payload.company.tax_number" />

        <text-input-component 
            :custom-class="inputClass" 
            type="text"
            name="tax_type" 
            label="Régimen fiscal" 
            v-model="advertiser.payload.company.tax_type" />

        <text-input-component 
            :custom-class="inputClass" 
            type="text"
            name="cfdi_use" 
            label="Uso de CFDI" 
            v-model="advertiser.payload.company.cfdi_use" />

        <!-- BILLING -->
        <h3 class="text-lg font-semibold mt-6 mb-2">Facturación</h3>

        <text-input-component 
            :custom-class="inputClass" 
            type="text"
            name="payment_terms" 
            label="Términos de pago" 
            v-model="advertiser.payload.billing.payment_terms" />

        <!-- ADDRESS -->
        <h3 class="text-lg font-semibold mt-6 mb-2">Domicilio fiscal</h3>

        <text-input-component 
            :custom-class="inputClass" 
            type="text"
            name="address" 
            label="Dirección" 
            v-model="advertiser.payload.address.address" />

        <text-input-component 
            :custom-class="inputClass" 
            type="text"
            name="city" 
            label="Ciudad" 
            v-model="advertiser.payload.address.city" />

        <text-input-component 
            :custom-class="inputClass"
            type="text" 
            name="state" 
            label="Estado / Provincia" 
            v-model="advertiser.payload.address.state" />

        <text-input-component 
            :custom-class="inputClass" 
            type="text"
            name="zip" 
            label="Código Postal" 
            v-model="advertiser.payload.address.zip" />

        <text-input-component 
            :custom-class="inputClass" 
            type="text"
            name="country" 
            label="País" 
            v-model="advertiser.payload.address.country" />

        <text-input-component 
            :custom-class="inputClass" 
            type="text"
            name="proof_of_address_url" 
            label="URL comprobante domicilio" 
            v-model="advertiser.payload.address.proof_of_address_url" />

        <!-- CONTACTS -->
        <h3 class="text-lg font-semibold mt-6 mb-2">Contactos fiscales o administrativos</h3>

        <dynamic-group-input-component 
            class="my-4" 
            label="Contactos" 
            v-model="advertiser.payload.contacts" 
            :inputs-config="[
                {
                    key: 'name', 
                    type: 'text', 
                    attributes: { 
                        type: 'text',
                        name: 'name', 
                        label: 'Nombre', 
                        customClass: inputClass 
                    }
                },
                {
                    key: 'email', 
                    type: 'text', 
                    attributes: {
                        type: 'text', 
                        name: 'email', 
                        label: 'Correo', 
                        validators: 'email', 
                        customClass: inputClass 
                    }
                },
                {
                    key: 'phone', 
                    type: 'text', 
                    attributes: { 
                        type: 'text',
                        name: 'phone', 
                        label: 'Teléfono', 
                        customClass: inputClass 
                    }
                },
                {
                    key: 'position', 
                    type: 'text', 
                    attributes: { 
                        type: 'text',
                        name: 'position', 
                        label: 'Cargo', 
                        customClass: inputClass 
                    }
                }
            ]" 
        />

        <!-- CONTRACTS -->
        <h3 class="text-lg font-semibold mt-6 mb-2">Contratos</h3>

        <dynamic-group-input-component 
            class="my-4" 
            label="Contratos" 
            v-model="advertiser.payload.contracts" 
            :inputs-config="[
                {
                    key: 'number', 
                    type: 'text', 
                    attributes: { 
                        type: 'text',
                        name: 'number', 
                        label: 'Número', 
                        customClass: inputClass 
                    }
                },
                {
                    key: 'start_date', 
                    type: 'text', 
                    attributes: { 
                        type: 'date', 
                        name: 'start_date', 
                        label: 'Inicio', 
                        customClass: inputClass 
                    }
                },
                {
                    key: 'end_date', 
                    type: 'text', 
                    attributes: { 
                        type: 'date', 
                        name: 'end_date', 
                        label: 'Fin', 
                        customClass: inputClass 
                    }
                },
                {
                    key: 'url', 
                    type: 'text', 
                    attributes: { 
                        name: 'url', 
                        label: 'URL', 
                        validators: 'url', 
                        customClass: inputClass 
                    }
                }
            ]" 
        />

        <!-- RESTO DEL FORMULARIO OMITIDO POR BREVEDAD -->
         <!-- WEB -->
        <h3 class="text-lg font-semibold mt-6 mb-2">Presencia Web</h3>

        <text-input-component 
            v-for="field in ['website', 'linkedin', 'twitter', 'facebook', 'instagram', 'youtube', 'tiktok', 'pinterest', 'snapchat', 'twitch', 'whatsapp', 'telegram', 'discord']" 
            :key="field" 
            type="text"
            :custom-class="inputClass" 
            name="field" :label="field.charAt(0).toUpperCase() + field.slice(1)" 
            v-model="advertiser.payload.web[field]" />

        <!-- BANK -->
        <h3 class="text-lg font-semibold mt-6 mb-2">Información Bancaria</h3>

        <text-input-component 
            :custom-class="inputClass" 
            type="text"
            name="bank_name" 
            label="Banco" 
            v-model="advertiser.payload.bank.bank_name" />

        <text-input-component 
            :custom-class="inputClass" 
            type="text"
            name="bank_account" 
            label="Cuenta" 
            v-model="advertiser.payload.bank.bank_account" />

        <text-input-component 
            :custom-class="inputClass" 
            type="text"
            name="bank_iban" 
            label="IBAN" 
            v-model="advertiser.payload.bank.bank_iban" />

        <text-input-component 
            :custom-class="inputClass"
            type="text" 
            name="bank_swift" 
            label="SWIFT" 
            v-model="advertiser.payload.bank.bank_swift" />


        <!-- COMPLIANCE -->
        <h3 class="text-lg font-semibold mt-6 mb-2">Cumplimiento</h3>

        <select-input-component 
            :custom-class="inputClass" 
            name="verified" 
            label="¿Verificado?" 
            v-model="advertiser.payload.compliance.verified">
            <option value="">Selecciona</option>
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select-input-component>

        <text-input-component 
            :custom-class="inputClass" 
            type="date" 
            name="verification_date" 
            label="Fecha de verificación" 
            v-model="advertiser.payload.compliance.verification_date" />

        <text-input-component 
            :custom-class="inputClass" 
            type="text"
            name="verification_method" 
            label="Método de verificación" 
            v-model="advertiser.payload.compliance.verification_method" />


        <!-- SETTINGS -->
        <h3 class="text-lg font-semibold mt-6 mb-2">Configuraciones</h3>

        <select-input-component 
            :custom-class="inputClass" 
            name="settings_currency" 
            label="Moneda" 
            v-model="advertiser.payload.settings.currency">
            <option value="">Selecciona una moneda</option>
            <option value="MXN">MXN</option>
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
        </select-input-component>

        <text-input-component 
            :custom-class="inputClass" 
            type="text"
            name="settings_language" 
            label="Idioma" 
            v-model="advertiser.payload.settings.language" />

        <timezone-select-input-component 
            custom-class="bg-gray-50 rounded-lg text-sm py-0.5"
            name="timezone" 
            label="Zona horaria" 
            v-model="advertiser.payload.settings.timezone" />

        <!-- STATUS -->
        <select-input-component 
            :custom-class="inputClass" 
            validators="required" 
            name="status" 
            label="Estado del anunciante" 
            v-model="advertiser.status">
            <option value="">Selecciona un estado</option>
            <option value="active">Activo</option>
            <option value="inactive">Inactivo</option>
            <option value="suspended">Suspendido</option>
            <option value="blacklisted">Lista negra</option>
        </select-input-component>

        <button-component 
            :custom-class="buttonClass" 
            :disabled="disabled" 
            :value="__deals('Update')" />

    </form>
</template>

<script>
import {
    TextInputComponent,
    TextareaInputComponent,
    SelectInputComponent,
    TimezoneSelectInputComponent,
    ButtonComponent,
    DynamicGroupInputComponent,
} from 'innoboxrr-form-elements'

import { updateModel, showModel } from '@dealsModels/deal-advertiser'

export default {
    components: {
        TextInputComponent,
        TextareaInputComponent,
        SelectInputComponent,
        TimezoneSelectInputComponent,
        ButtonComponent,
        DynamicGroupInputComponent,
    },
    props: {
        formId: {
            type: String,
            default: 'editDealAdvertiserForm'
        },
        advertiserId: {
            type: [String, Number],
            required: true
        }
    },
    emits: ['submit'],
    data() {
        return {
            advertiser: {
                id: null,
                agent_id: null,
                status: '',
                payload: {
                    settings: {
                        currency: '',
                        language: '',
                        timezone: ''
                    },
                    company: {
                        name: '',
                        tax_number: '',
                        tax_type: '',
                        cfdi_use: ''
                    },
                    billing: {
                        payment_terms: ''
                    },
                    address: {
                        address: '',
                        city: '',
                        state: '',
                        zip: '',
                        country: '',
                        proof_of_address_url: ''
                    },
                    contacts: [],
                    contracts: [],
                    web: {
                        website: '',
                        linkedin: '',
                        twitter: '',
                        facebook: '',
                        instagram: '',
                        youtube: '',
                        tiktok: '',
                        pinterest: '',
                        snapchat: '',
                        twitch: '',
                        whatsapp: '',
                        telegram: '',
                        discord: ''
                    },
                    bank: {
                        bank_name: '',
                        bank_account: '',
                        bank_iban: '',
                        bank_swift: ''
                    },
                    last_invoice: {
                        number: '',
                        date: '',
                        amount: ''
                    },
                    compliance: {
                        verified: '',
                        verification_date: '',
                        verification_method: ''
                    },
                    activity: {
                        total_spent: '',
                        campaigns_count: '',
                        last_active: ''
                    },
                    notes: ''
                }
            },
            disabled: false,
        }
    },
    async mounted() {
        await this.fetchAdvertiser()
    },
    methods: {
        async fetchAdvertiser() {
            let res = await showModel(this.advertiserId)

            // Formatear contracts
            res.payload.contracts = JSON.parse(res.payload.contracts);
            res.payload.contracts = res.payload.contracts.map(contract => {
                return {
                    number: contract.number,
                    start_date: contract.start_date,
                    end_date: contract.end_date,
                    url: contract.url
                }
            });

            // Formatear contacts
            res.payload.contacts = JSON.parse(res.payload.contacts);
            res.payload.contacts = res.payload.contacts.map(contact => {
                return {
                    name: contact.name,
                    email: contact.email,
                    phone: contact.phone,
                    position: contact.position
                }
            });

            this.advertiser = res;
        },
        onSubmit() {
            this.disabled = true
            updateModel(this.advertiser.id, {
                status: this.advertiser.status,
                ...this.advertiser.payload
            })
            .then(res => {
                this.$emit('submit', res)
                setTimeout(() => { this.disabled = false }, 2500)
            })
            .catch(() => {
                this.disabled = false
            })
        }
    }
}
</script>
