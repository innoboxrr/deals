<template>
	
	<form :id="formId" @submit.prevent="onSubmit">

        <!-- DEAL AD ID -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="deal_ad_id"
            label="ID del anuncio"
            validators="required"
            v-model="snapshot.deal_ad_id" />

        <!-- IMPRESSIONS -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="impressions"
            label="Impresiones"
            validators="integer"
            v-model="snapshot.impressions" />

        <!-- CLICKS -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="clicks"
            label="Clicks"
            validators="integer"
            v-model="snapshot.clicks" />

        <!-- LEADS -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="leads"
            label="Leads"
            validators="integer"
            v-model="snapshot.leads" />

        <!-- SPEND -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="spend"
            label="Gasto"
            validators="decimal"
            v-model="snapshot.spend" />

        <!-- CPL (CALCULADO) -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="cpl"
            label="Costo por lead (CPL)"
            readonly
            :value="snapshot.cpl" />

        <!-- FROM DATE -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="from_date"
            label="Desde"
            placeholder="YYYY-MM-DD"
            validators="required date"
            v-model="snapshot.from_date" />

        <!-- TO DATE -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="to_date"
            label="Hasta"
            placeholder="YYYY-MM-DD"
            validators="required date"
            v-model="snapshot.to_date" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />

    </form>

</template>

<script>

    import { showModel, updateModel } from '@dealsModels/deal-ad-performance-snapshot'
    import JSValidator from 'innoboxrr-js-validator'
    import {
        TextInputComponent,
        ButtonComponent,
    } from 'innoboxrr-form-elements'

	export default {

        components: {
            TextInputComponent,
            ButtonComponent,
        },

        props: {
            formId: {
                type: String,
                default: 'editDealAdPerformanceSnapshotForm'
            },
            snapshotId: {
                type: [Number, String],
                required: true
            }
        },

        emits: ['submit'],

        data() {
            return {
                snapshot: {
                    deal_ad_id: '',
                    impressions: '',
                    clicks: '',
                    leads: '',
                    spend: '',
                    cpl: '', // solo lectura
                    from_date: '',
                    to_date: '',
                },
                disabled: false,
                JSValidator: undefined,
            }
        },

        mounted() {
            this.fetchData(); 
            this.JSValidator = new JSValidator(this.formId).init();
            this.JSValidator.status = true;
        },

        methods: {

            fetchData() {
                showModel(this.snapshotId).then(res => {
                    this.snapshot = res;
                });
            },

            onSubmit() {
                if (this.JSValidator.status) {
                    this.disabled = true;
                    updateModel(this.snapshot.id, {
                        deal_ad_id: this.snapshot.deal_ad_id,
                        impressions: this.snapshot.impressions,
                        clicks: this.snapshot.clicks,
                        leads: this.snapshot.leads,
                        spend: this.snapshot.spend,
                        from_date: this.snapshot.from_date,
                        to_date: this.snapshot.to_date
                    }).then(res => {
                        this.$emit('submit', res);
                        setTimeout(() => { this.disabled = false; }, 2500);
                    }).catch(error => {
                        this.disabled = false;
                        if (error?.response?.status === 422)
                            this.JSValidator.appendExternalErrors(error.response.data.errors);
                    });
                } else {
                    this.disabled = false;
                }
            }
        }
	}
</script>
