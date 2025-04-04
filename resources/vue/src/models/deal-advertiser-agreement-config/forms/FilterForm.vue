<template>
	
	<form id="dealAdvertiserAgreementConfigFilterForm" @submit.prevent="onSubmit">
		
        <div class="uk-flex uk-flex-left uk-child-width-1-3@m uk-child-width-1-1@s" uk-grid>

            <!-- PRIORITY -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="priority"
                    label="Prioridad"
                    v-model="priority" />
            </div>

            <!-- CAP PER DAY -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="cap_per_day"
                    label="Cap por día"
                    v-model="cap_per_day" />
            </div>

            <!-- CAP PER WEEK -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="cap_per_week"
                    label="Cap por semana"
                    v-model="cap_per_week" />
            </div>

            <!-- MAX CAP -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="max_cap"
                    label="Cap máximo"
                    v-model="max_cap" />
            </div>

            <!-- MONTHLY CAP -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="monthly_cap"
                    label="Cap mensual"
                    v-model="monthly_cap" />
            </div>

            <!-- DISTRIBUTION PER MINUTE -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="distribution_per_minute"
                    label="Distribución por minuto"
                    v-model="distribution_per_minute" />
            </div>

            <!-- DISTRIBUTION TYPE -->
            <div>
                <select-input-component
                    name="distribution_type"
                    label="Tipo de distribución"
                    v-model="distribution_type">
                    <option value="">Todos</option>
                    <option value="even">Equitativa</option>
                    <option value="burst">Explosiva</option>
                    <option value="drip">Constante</option>
                </select-input-component>
            </div>

            <!-- AUTO PAUSE THRESHOLD -->
            <div>
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="auto_pause_threshold"
                    label="Umbral para auto pausa"
                    v-model="auto_pause_threshold" />
            </div>

            <!-- SCHEDULE -->
            <div>
                <textarea-input-component
                    :custom-class="inputClass"
                    name="schedule"
                    label="Horario"
                    v-model="schedule" />
            </div>

            <!-- TARGET AUDIENCE -->
            <div>
                <textarea-input-component
                    :custom-class="inputClass"
                    name="target_audience"
                    label="Audiencia objetivo"
                    v-model="target_audience" />
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
		TextareaInputComponent,
		SelectInputComponent,
	} from 'innoboxrr-form-elements'

	export default {

		components: {
			TextInputComponent,
			TextareaInputComponent,
			SelectInputComponent,
		},

		emits: ['submit'],

		data() {
			return {
				priority: '',
				schedule: '',
				cap_per_day: '',
				cap_per_week: '',
				max_cap: '',
				monthly_cap: '',
				distribution_per_minute: '',
				distribution_type: '',
				target_audience: '',
				auto_pause_threshold: '',
				deal_advertiser_agreement_id: '',
			}
		},

		methods: {

			onSubmit() {
				this.$emit('submit', {
					priority: this.priority,
					schedule: this.schedule,
					cap_per_day: this.cap_per_day,
					cap_per_week: this.cap_per_week,
					max_cap: this.max_cap,
					monthly_cap: this.monthly_cap,
					distribution_per_minute: this.distribution_per_minute,
					distribution_type: this.distribution_type,
					target_audience: this.target_audience,
					auto_pause_threshold: this.auto_pause_threshold,
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
