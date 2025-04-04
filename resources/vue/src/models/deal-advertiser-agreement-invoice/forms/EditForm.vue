<template>

    <form :id="formId" @submit.prevent="onSubmit">

        <!-- STATUS -->
        <select-input-component
            name="status"
            label="Estatus"
            validators="required"
            v-model="invoice.status">
            <option value="draft">Borrador</option>
            <option value="pending">Pendiente</option>
            <option value="paid">Pagada</option>
            <option value="cancelled">Cancelada</option>
        </select-input-component>

        <!-- FROM DATE -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="from_date"
            label="Fecha de inicio"
            placeholder="YYYY-MM-DD"
            validators="required date"
            v-model="invoice.from_date" />

        <!-- TO DATE -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="to_date"
            label="Fecha de término"
            placeholder="YYYY-MM-DD"
            validators="required date"
            v-model="invoice.to_date" />

        <!-- MANAGEMENT FEE -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="management_fee"
            label="Costo de administración"
            validators="decimal"
            v-model="invoice.management_fee" />

        <!-- AD SPEND -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="ad_spend"
            label="Gasto en publicidad"
            validators="decimal"
            v-model="invoice.ad_spend" />

        <!-- TAX -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="tax"
            label="Impuesto"
            validators="decimal"
            v-model="invoice.tax" />

        <!-- TOTAL -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="total"
            label="Total"
            validators="decimal"
            v-model="invoice.total" />

        <!-- DEAL ADVERTISER (nombre incompleto en el esquema) -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="deal_advertiser_"
            label="ID del Anunciante (¿revisar nombre?)"
            v-model="invoice.deal_advertiser_" />

        <!-- DEAL ADVERTISER AGREEMENT ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="deal_advertiser_agreement_id"
            label="ID del Acuerdo"
            validators="required"
            v-model="invoice.deal_advertiser_agreement_id" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />

    </form>

</template>

<script>

    import { showModel, updateModel } from '@models/deal-advertiser-agreement-invoice'
    import JSValidator from 'innoboxrr-js-validator'
    import {
        TextInputComponent,
        SelectInputComponent,
        ButtonComponent,
    } from 'innoboxrr-form-elements'

	export default {

        components: {
            TextInputComponent,
            SelectInputComponent,
            ButtonComponent,
        },

        props: {
            formId: {
                type: String,
                default: 'editDealAdvertiserAgreementInvoiceForm'
            },
            invoiceId: {
                type: [Number, String],
                required: true
            }
        },

        emits: ['submit'],

        data() {
            return {
                invoice: {
                    status: '',
                    from_date: '',
                    to_date: '',
                    management_fee: '',
                    ad_spend: '',
                    tax: '',
                    total: '',
                    deal_advertiser_: '',
                    deal_advertiser_agreement_id: '',
                },
                disabled: false,
                JSValidator: undefined,
            }
        },

        mounted() {
            this.fetchData()
            this.JSValidator = new JSValidator(this.formId).init()
            this.JSValidator.status = true
        },

        methods: {

            fetchData() {
                showModel(this.invoiceId).then(res => {
                    this.invoice = res
                })
            },

            onSubmit() {
                if (this.JSValidator.status) {
                    this.disabled = true
                    updateModel(this.invoice.id, {
                        status: this.invoice.status,
                        from_date: this.invoice.from_date,
                        to_date: this.invoice.to_date,
                        management_fee: this.invoice.management_fee,
                        ad_spend: this.invoice.ad_spend,
                        tax: this.invoice.tax,
                        total: this.invoice.total,
                        deal_advertiser_: this.invoice.deal_advertiser_,
                        deal_advertiser_agreement_id: this.invoice.deal_advertiser_agreement_id,
                    }).then(res => {
                        this.$emit('submit', res)
                        setTimeout(() => { this.disabled = false }, 2500)
                    }).catch(error => {
                        this.disabled = false
                        if (error?.response?.status === 422)
                            this.JSValidator.appendExternalErrors(error.response.data.errors)
                    })
                } else {
                    this.disabled = false
                }
            }
        }
	}
</script>
