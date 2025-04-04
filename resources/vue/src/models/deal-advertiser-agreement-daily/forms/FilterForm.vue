<template>

    <form id="dealAdvertiserAgreementDailyFilterForm" @submit.prevent="onSubmit">
        
        <div class="uk-flex uk-flex-left uk-child-width-1-3@m uk-child-width-1-1@s" uk-grid>

            <!-- DATE -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="date"
                    label="Fecha"
                    placeholder="YYYY-MM-DD"
                    v-model="date" />
            </div>

            <!-- START HOUR -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="start_hour"
                    label="Hora de inicio"
                    placeholder="HH:mm"
                    v-model="start_hour" />
            </div>

            <!-- END HOUR -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="end_hour"
                    label="Hora de término"
                    placeholder="HH:mm"
                    v-model="end_hour" />
            </div>

            <!-- CPL -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="cpl"
                    label="CPL"
                    v-model="cpl" />
            </div>

            <!-- BUDGET -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="budget"
                    label="Presupuesto"
                    v-model="budget" />
            </div>

            <!-- SPENT -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="spent"
                    label="Gastado"
                    v-model="spent" />
            </div>

            <!-- PROGRESS -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="progress"
                    label="Progreso (%)"
                    v-model="progress" />
            </div>

            <!-- LEADS ASSIGNED -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="leads_assigned"
                    label="Leads asignados"
                    v-model="leads_assigned" />
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
                date: '',
                start_hour: '',
                end_hour: '',
                cpl: '',
                budget: '',
                spent: '',
                progress: '',
                leads_assigned: '',
            }
        },

        methods: {

            onSubmit() {
                this.$emit('submit', {
                    date: this.date,
                    start_hour: this.start_hour,
                    end_hour: this.end_hour,
                    cpl: this.cpl,
                    budget: this.budget,
                    spent: this.spent,
                    progress: this.progress,
                    leads_assigned: this.leads_assigned,
                });
            },

            resetForm() {
                Object.assign(this.$data, this.$options.data());
                this.onSubmit();
            }
        }
    }
</script>
