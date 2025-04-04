<template>

    <form id="dealAdvertiserAgreementConstraintFilterForm" @submit.prevent="onSubmit">

        <div class="uk-flex uk-flex-left uk-child-width-1-3@m uk-child-width-1-1@s" uk-grid>

            <!-- KEY -->
            <div>
                <select-input-component
                    name="key"
                    label="Campo"
                    v-model="key">
                    <option value="">Todos</option>
                    <option value="estado">Estado</option>
                    <option value="edad_maxima">Edad máxima</option>
                    <option value="edad_minima">Edad mínima</option>
                    <option value="rango_de_edad">Rango de edad</option>
                    <option value="genero">Género</option>
                    <option value="ubicacion">Ubicación</option>
                    <option value="intereses">Intereses</option>
                    <option value="plataforma">Plataforma</option>
                    <option value="dispositivo">Dispositivo</option>
                    <option value="tipo_de_anuncio">Tipo de anuncio</option>
                    <option value="fecha_inicio">Fecha de inicio</option>
                    <option value="fecha_fin">Fecha de fin</option>
                    <option value="presupuesto_maximo">Presupuesto máximo</option>
                    <option value="cpc_maximo">CPC máximo</option>
                    <option value="cpm_maximo">CPM máximo</option>
                    <option value="conversiones_maximas">Conversiones máximas</option>
                    <option value="tiempo_minimo">Tiempo mínimo</option>
                </select-input-component>
            </div>

            <!-- OPERATOR -->
            <div>
                <select-input-component
                    name="operator"
                    label="Operador"
                    v-model="operator">
                    <option value="">Todos</option>
                    <option value="=">=</option>
                    <option value="!=">!=</option>
                    <option value=">">&gt;</option>
                    <option value=">=">&gt;=</option>
                    <option value="<">&lt;</option>
                    <option value="<=">&lt;=</option>
                    <option value="IN">IN</option>
                    <option value="NOT IN">NOT IN</option>
                    <option value="LIKE">LIKE</option>
                    <option value="NOT LIKE">NOT LIKE</option>
                    <option value="BETWEEN">BETWEEN</option>
                    <option value="NOT BETWEEN">NOT BETWEEN</option>
                </select-input-component>
            </div>

            <!-- VALUE -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="value"
                    label="Valor"
                    v-model="value" />
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
                key: '',
                operator: '',
                value: '',
                deal_advertiser_agreement_id: '',
            }
        },

        methods: {

            onSubmit() {
                this.$emit('submit', {
                    key: this.key,
                    operator: this.operator,
                    value: this.value,
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
