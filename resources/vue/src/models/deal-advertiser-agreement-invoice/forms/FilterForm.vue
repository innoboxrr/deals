<template>

    <form id="dealAdvertiserAgreementInvoiceFilterForm" @submit.prevent="onSubmit">
        
        <div class="uk-flex uk-flex-left uk-child-width-1-3@m uk-child-width-1-1@s" uk-grid>

            <!-- STATUS -->
            <div>
                <select-input-component
                    name="status"
                    label="Estatus"
                    v-model="status">
                    <option value="">Todos</option>
                    <option value="draft">Borrador</option>
                    <option value="pending">Pendiente</option>
                    <option value="paid">Pagada</option>
                    <option value="cancelled">Cancelada</option>
                </select-input-component>
            </div>

            <!-- FROM DATE -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="from_date"
                    label="Desde"
                    placeholder="YYYY-MM-DD"
                    v-model="from_date" />
            </div>

            <!-- TO DATE -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="to_date"
                    label="Hasta"
                    placeholder="YYYY-MM-DD"
                    v-model="to_date" />
            </div>

            <!-- MANAGEMENT FEE -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="management_fee"
                    label="Fee administrativo"
                    v-model="management_fee" />
            </div>

            <!-- AD SPEND -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="ad_spend"
                    label="Gasto publicitario"
                    v-model="ad_spend" />
            </div>

            <!-- TAX -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="tax"
                    label="Impuesto"
                    v-model="tax" />
            </div>

            <!-- TOTAL -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="total"
                    label="Total"
                    v-model="total" />
            </div>

            <!-- DEAL ADVERTISER (incompleto en esquema) -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="deal_advertiser_"
                    label="ID Anunciante (¿revisar nombre?)"
                    v-model="deal_advertiser_" />
            </div>

            <!-- DEAL ADVERTISER AGREEMENT ID -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="deal_advertiser_agreement_id"
                    label="ID del Acuerdo"
                    v-model="deal_advertiser_agreement_id" />
            </div>

        </div>

        <div class="uk-flex uk-flex-right uk-child-width-auto@m uk-child-width-1-1@m" uk-grid>
            <div>
                <button :class="buttonClass">
                    {{ __('Buscar') }}
                </button>
            </div>
            <div>
                <button 
                    :class="buttonClass + ' bg-gray-400'"
                    @click.prevent="resetForm()">
                    {{ __('Resetear') }}
                </button>
            </div>
        </div>

    </form>
</template>

<script>

    import {
        TextInputComponent,
        SelectInputComponent,
    } from 'innoboxrr-form-elements'

    export default {

        components: {
            TextInputComponent,
            SelectInputComponent,
        },

        emits: ['submit'],

        data() {
            return {
                status: '',
                from_date: '',
                to_date: '',
                management_fee: '',
                ad_spend: '',
                tax: '',
                total: '',
                deal_advertiser_: '',
                deal_advertiser_agreement_id: '',
            }
        },

        methods: {

            onSubmit() {
                this.$emit('submit', {
                    status: this.status,
                    from_date: this.from_date,
                    to_date: this.to_date,
                    management_fee: this.management_fee,
                    ad_spend: this.ad_spend,
                    tax: this.tax,
                    total: this.total,
                    deal_advertiser_: this.deal_advertiser_,
                    deal_advertiser_agreement_id: this.deal_advertiser_agreement_id,
                });
            },

            resetForm() {
                Object.assign(this.$data, this.$options.data());
                this.onSubmit();
            }
        }
    }
</script>
