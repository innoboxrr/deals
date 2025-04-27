<template>
    <div>
        <!-- DATOS GENERALES -->
        <h3 class="text-lg font-semibold mb-2">
            Datos Generales
        </h3>

        <!-- NAME -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="name"
            label="Nombre del Deal"
            placeholder="Ej: Oferta de Verano"
            validators="required length"
            min_length="3"
            v-model="localDeal.name" />

        <!-- DESCRIPTION -->
        <textarea-input-component
            :custom-class="inputClass"
            name="description"
            label="Descripción"
            placeholder="Describe brevemente el Deal"
            validators="required length"
            min_length="3"
            v-model="localDeal.description" />

        <!-- CURRENCY -->
        <select-input-component
            :custom-class="inputClass"
            name="currency"
            label="Moneda"
            validators="required"
            v-model="localDeal.payload.currency">
            <option value="">Selecciona una moneda</option>
            <option value="MXN">MXN</option>
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
        </select-input-component>

        <!-- OBJECTIVE -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="objective"
            label="Objetivo principal"
            placeholder="Ej: Generar leads calificados"
            validators="length"
            min_length="3"
            v-model="localDeal.payload.objective" />

        <!-- TYPE -->
        <select-input-component
            :custom-class="inputClass"
            name="type"
            label="Tipo de Deal"
            validators="required"
            v-model="localDeal.payload.type">
            <option value="">Selecciona una opción</option>
            <option value="lead_gen">Generación de leads</option>
            <option value="ecommerce" disabled>E-commerce (próximamente)</option>
            <option value="branding" disabled>Branding (próximamente)</option>
            <option value="content" disabled>Contenido (próximamente)</option>
        </select-input-component>

        <!-- CONFIGURACIÓN DE PARTICIPANTES -->
        <h3 class="text-lg font-semibold mt-6 mb-2">
            Participación de Anunciantes
        </h3>

        <!-- COSTO ADMIN POR ANUNCIANTE -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="admin_fee"
            label="Costo administrativo por anunciante"
            placeholder="Ej: 500"
            validators="decimal"
            v-model="localDeal.payload.admin_fee_per_advertiser" />

        <!-- INVERSIÓN MÍNIMA -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="min_investment"
            label="Inversión mínima por anunciante"
            placeholder="Ej: 1000"
            validators="decimal"
            v-model="localDeal.payload.min_investment_per_advertiser" />

        <!-- INVERSIÓN MÍNIMA -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="investment_fee"
            help="Esto determina el % de comisión que se le cobrará al anunciante en función de su inversión"
            label="Comisión por inversión (%)"
            placeholder="Ej: 30, para 30%"
            :min_length="0"
            :max_length="100"
            validators="required length"
            v-model="localDeal.payload.investment_fee" />

        <!-- MIN/MAX ADVERTISERS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 -mb-6">
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="min_advertisers"
                    label="Mínimo de anunciantes"
                    validators="integer"
                    v-model="localDeal.payload.min_advertisers" />
            </div>
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    help="Zero para ilimitado"
                    name="max_advertisers"
                    label="Máximo de anunciantes"
                    validators="integer"
                    v-model="localDeal.payload.max_advertisers" />        
            </div>
        </div>

        <!-- ACCESO AL DEAL -->
        <select-input-component
            :custom-class="inputClass"
            name="access_type"
            label="Tipo de acceso al Deal"
            validators="required"
            v-model="localDeal.payload.access_type">
            <option value="">Selecciona un tipo</option>
            <option value="automatic">Acceso automático (self-service)</option>
            <option value="manual">Acceso manual (validación interna)</option>
            <option value="invite">Por invitación</option>
        </select-input-component>

        <!-- MÁXIMO CPL DE CAMPAÑA -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="max_cpl"
            label="Costo por Lead máximo (CPL)"
            placeholder="Ej: 30"
            validators="required"
            v-model="localDeal.payload.max_cpl" />

        <!-- CONFIGURACIÓN AVANZADA -->
        <h3 class="text-lg font-semibold mt-6 mb-2">
            Configuraciones Avanzadas
        </h3>

        <!-- SNAPSHOT CRON -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="snapshot_cron_interval"
            label="Frecuencia de snapshots"
            placeholder="Ej: 0 * * * * para cada hora"
            validators="required"
            v-model="localDeal.payload.snapshot_cron_interval" />
        <p class="-mt-4 mb-4 text-xs text-right">
            Visita <a href='https://crontab.guru/' target="_blank" class="underline text-blue-500">Cron Guru</a> para más info
        </p>

        <!-- Umbral mínimo de CTR -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="queue"
            label="Nombre de la cola de procesamiento"
            placeholder="Ej: default"
            v-model="localDeal.payload.queue" />

        <!-- DATES -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 -mb-6">
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="date"
                    name="start_date"
                    label="Fecha de inicio"
                    validators="required"
                    v-model="localDeal.payload.start_date" />
            </div>
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="date"
                    name="end_date"
                    help="Dejar vacío para campañas sin fecha de finalización"
                    label="Fecha de finalización"
                    validators="required"
                    v-model="localDeal.payload.end_date" />
            </div>
        </div>

        <!-- COUNTRIES -->
        <tags-input-component
            :custom-class="inputClass"
            help="Especifica los países donde se puede promocionar el Deal"
            name="restricted_countries"
            label="Países restringidos"
            placeholder="Ej: CU, IR, RU"
            v-model="localDeal.payload.restricted_countries" />
    </div>
</template>
  
<script>
    import {
        TextInputComponent,
        TextareaInputComponent,
        SelectInputComponent,
        TagsInputComponent,
    } from 'innoboxrr-form-elements'

    export default {
        name: 'StepGeneral',
        components: {
            TextInputComponent,
            TextareaInputComponent,
            SelectInputComponent,
            TagsInputComponent,
        },
        props: {
            modelValue: {
                type: Object,
                required: true
            },
            mode: {
                type: String,
                default: 'create'
            }
        },
        data() {
            return {}
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
                    const valid =
                        val.name?.length >= 3 &&
                        val.description?.length >= 3 &&
                        val.payload?.type &&
                        val.payload?.currency &&
                        val.payload?.queue &&
                        val.payload?.start_date &&
                        val.payload?.snapshot_cron_interval &&
                        val.payload?.access_type
                    this.$emit('validated', valid)
                },
                deep: true,
                immediate: true
            }
        }
    }
</script>
