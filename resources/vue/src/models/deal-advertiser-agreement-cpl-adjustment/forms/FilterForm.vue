<template>

    <form id="dealAdvertiserAgreementCplAdjustmentFilterForm" @submit.prevent="onSubmit">

        <div class="uk-flex uk-flex-left uk-child-width-1-3@m uk-child-width-1-1@s" uk-grid>

            <!-- BEFORE -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="before"
                    label="CPL Antes"
                    v-model="before" />
            </div>

            <!-- AFTER -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="after"
                    label="CPL Después"
                    v-model="after" />
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
    } from 'innoboxrr-form-elements'

    export default {

        components: {
            TextInputComponent,
        },

        emits: ['submit'],

        data() {
            return {
                before: '',
                after: '',
                deal_advertiser_agreement_id: '',
            }
        },

        methods: {

            onSubmit() {
                this.$emit('submit', {
                    before: this.before,
                    after: this.after,
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
