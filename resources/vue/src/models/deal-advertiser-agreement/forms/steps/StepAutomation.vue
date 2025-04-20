<template>
    <div class="space-y-6">

        <!-- PAUSA AUTOMÁTICA -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.pause = !collapsed.pause">
                <span class="text-sm font-semibold">Pause Settings</span>
                <i :class="['fa-solid', collapsed.pause ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.pause" class="p-4 space-y-4">
                <text-input-component
                    :custom-class="inputClass"
                    type="date"
                    name="pause_until"
                    label="Pause until"
                    placeholder="Select a date"
                    :help="__deals('Temporarily pause the deal until this date. Useful for breaks or scheduled pauses.')"
                    v-model="localAgreement.payload.automation.pause_until" />

                <textarea-input-component
                    :custom-class="inputClass"
                    name="pause_reason"
                    label="Pause reason"
                    placeholder="E.g. Campaign maintenance, budget adjustment, low conversion"
                    :help="__deals('Provide a reason for the pause. This helps in identifying the cause for reporting or auditing.')"
                    v-model="localAgreement.payload.automation.pause_reason" />
            </div>
        </div>

        <!-- COSTOS Y PERFORMANCE -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.costs = !collapsed.costs">
                <span class="text-sm font-semibold">Performance Thresholds</span>
                <i :class="['fa-solid', collapsed.costs ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.costs" class="p-4 space-y-4">
                <template v-for="metric in performanceMetrics" :key="metric.name">
                    <text-input-component
                        :custom-class="inputClass"
                        type="number"
                        :name="metric.name"
                        :label="metric.label"
                        :placeholder="metric.placeholder"
                        :help="__deals(metric.help)"
                        :steps="metric.step"
                        validators="decimal"
                        v-model="localAgreement.payload.automation[metric.name]" />

                    <div class="grid grid-cols-3 gap-4">
						<div 
							v-for="level in ['warn', 'critical', 'pause']"
							:key="metric.name + '_' + level">
							<text-input-component
								:custom-class="inputClass"
								type="number"
								:name="metric.name + '_' + level"
								:label="'Threshold (' + level + ')'"
								:placeholder="'E.g. ' + metric.thresholds[level]"
								:steps="metric.step"
								validators="decimal"
								v-model="localAgreement.payload.automation[metric.name + '_' + level]" />
						</div>
                    </div>
                </template>
            </div>
        </div>

        <!-- CLIENT/INTEGRATION -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.client = !collapsed.client">
                <span class="text-sm font-semibold">
					Client & Integration Monitoring
				</span>
                <i :class="['fa-solid', collapsed.client ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.client" class="p-4 space-y-4">
                <select-input-component
                    :custom-class="inputClass"
                    name="require_client_postback"
                    label="Client must send postback"
                    :help="__deals('If enabled, the deal can pause if postback is missing or not received in time.')"
                    v-model="localAgreement.payload.automation.require_client_postback">
                    <option :value="true">Yes</option>
                    <option :value="false">No</option>
                </select-input-component>

				<!-- Tolerancia de omisión de postback -->
				<text-input-component
					v-if="localAgreement.payload.automation.require_client_postback"
					:custom-class="inputClass"
					type="number"
					name="postback_tolerance_hours"
					label="Postback tolerance (hours)"
					placeholder="E.g. 24"
					:help="__deals('Defines the time limit for receiving postbacks from the client.')"
					validators="integer"
					v-model="localAgreement.payload.automation.postback_tolerance_hours" />

				<!-- Porcentaje de tolernacia minimo de postback -->
				<text-input-component
					v-if="localAgreement.payload.automation.require_client_postback"
					:custom-class="inputClass"
					type="number"
					name="postback_tolerance_percentage"
					label="Postback tolerance (%)"
					placeholder="E.g. 80"
					:help="__deals('Defines the minimum percentage of postbacks that must be received.')"
					v-model="localAgreement.payload.automation.postback_tolerance_percentage" />

                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="max_integration_errors"
                    label="Max integration errors before pause"
                    placeholder="E.g. 5"
                    :help="__deals('Defines how many failed integration attempts are tolerated before pausing the deal.')"
                    validators="integer"
                    v-model="localAgreement.payload.automation.max_integration_errors" />

                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="max_rejection_rate"
                    label="Max rejection rate (%)"
                    placeholder="E.g. 20"
                    :help="__deals('Percentage of leads rejected by the client. High rates may indicate poor quality.')"
                    :steps="0.1"
                    validators="decimal"
                    v-model="localAgreement.payload.automation.max_rejection_rate" />
            </div>
        </div>

		<!-- CAP & DISTRIBUTION SETTINGS -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.cap = !collapsed.cap">
                <span class="text-sm font-semibold">Cap & Distribution Settings</span>
                <i :class="['fa-solid', collapsed.cap ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>

            <div v-show="!collapsed.cap" class="p-4 space-y-6">

                <!-- CAP METHOD -->
                <select-input-component
                    :custom-class="inputClass"
                    name="cap_type"
                    label="Cap type"
                    :help="__deals('Define the cap type to use: daily, weekly, monthly, or per day.')"
                    v-model="localAgreement.payload.automation.cap_type">
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                    <option value="custom">Custom per day</option>
                </select-input-component>

                <!-- CUSTOM PER DAY -->
                <div v-if="localAgreement.payload.automation.cap_type === 'custom'" class="space-y-4">
                    <div v-for="day in daysOfWeek" :key="day.key" class="grid grid-cols-6 gap-4 items-end">
						<div>
							<text-input-component
								:custom-class="inputClass"
								type="number"
								:label="day.label"
								:help="__deals('Define the maximum number of leads allowed for ' + day.label)"
								:placeholder="'E.g. 100'"
								:name="'cap_' + day.key"
								validators="integer"
								v-model="localAgreement.payload.automation['cap_' + day.key]" />
						</div>
						<div>
							<text-input-component
								:custom-class="inputClass"
								type="time"
								:label="'Start'"
								:name="'cap_' + day.key + '_start'"
								v-model="localAgreement.payload.automation['cap_' + day.key + '_start']" />
						</div>
						<div>
							<text-input-component
								:custom-class="inputClass"
								type="time"
								:label="'End'"
								:name="'cap_' + day.key + '_end'"
								v-model="localAgreement.payload.automation['cap_' + day.key + '_end']" />
						</div>
						<div v-for="level in ['warn', 'critical', 'pause']" :key="'cap_' + day.key + '_' + level">
							<text-input-component
								:custom-class="inputClass"
								type="number"
								:label="'T. (' + level + ')' "
								:name="'cap_' + day.key + '_' + level"
								:placeholder="'E.g. 80'"
								validators="integer"
								v-model="localAgreement.payload.automation['cap_' + day.key + '_' + level]" />
						</div>
                    </div>
                </div>

                <!-- STATIC CAPS -->
                <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <text-input-component
                        :custom-class="inputClass"
                        type="number"
                        name="cap_value"
                        label="Cap limit"
                        placeholder="Ej: 100"
                        :help="__deals('Total number of leads allowed based on selected cap type.')"
                        validators="integer"
                        v-model="localAgreement.payload.automation.cap_value" />

                    <div class="grid grid-cols-3 gap-4">
                        <div v-for="level in ['warn', 'critical', 'pause']" :key="'cap_value_' + level">
							<div>
								<text-input-component
									:custom-class="inputClass"
									type="number"
									:label="'T. (' + level + ')'"
									:name="'cap_value_' + level"
									:placeholder="'E.g. 80'"
									validators="integer"
									v-model="localAgreement.payload.automation['cap_value_' + level]" />
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import {
    TextInputComponent,
    TextareaInputComponent,
    SelectInputComponent
} from 'innoboxrr-form-elements'

export default {
    name: 'StepAutomation',
    components: {
        TextInputComponent,
        TextareaInputComponent,
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
                pause: false,
                costs: true,
                client: true,
				cap: true
            },
            performanceMetrics: [
                {
                    name: 'cpc',
                    label: 'CPC threshold (Cost per Click)',
                    placeholder: 'E.g. 2.5',
                    help: 'Define a maximum CPC allowed before triggering alerts or pausing. Ideal range: $0.5 - $2.5',
                    step: 0.01,
                    thresholds: { warn: 1.5, critical: 2.0, pause: 2.5 }
                },
                {
                    name: 'cpm',
                    label: 'CPM threshold (Cost per 1000 impressions)',
                    placeholder: 'E.g. 10.00',
                    help: 'Set the max CPM to monitor campaign efficiency. Ideal range: $5 - $15.',
                    step: 0.01,
                    thresholds: { warn: 10, critical: 15, pause: 20 }
                },
                {
                    name: 'min_ctr',
                    label: 'Minimum CTR (%)',
                    placeholder: 'E.g. 1.5',
                    help: 'Minimum expected click-through rate before alerting underperformance. Healthy range: 1.5% - 4%.',
                    step: 0.01,
                    thresholds: { warn: 2, critical: 1.5, pause: 1 }
                },
                {
                    name: 'min_conversion_rate',
                    label: 'Minimum Conversion Rate (%)',
                    placeholder: 'E.g. 2.5',
                    help: 'Expected minimum conversion from traffic. Healthy campaigns often reach 3% - 10%.',
                    step: 0.01,
                    thresholds: { warn: 3, critical: 2, pause: 1 }
                },
                {
                    name: 'min_leads',
                    label: 'Minimum daily leads',
                    placeholder: 'E.g. 10',
                    help: 'Minimum leads expected per day. Can trigger alerts if under threshold.',
                    step: 1,
                    thresholds: { warn: 15, critical: 10, pause: 5 }
                },
                {
                    name: 'max_leads',
                    label: 'Maximum daily leads',
                    placeholder: 'E.g. 100',
                    help: 'Optional limit to control traffic or lead quality saturation.',
                    step: 1,
                    thresholds: { warn: 100, critical: 120, pause: 150 }
                }
            ],
			daysOfWeek: [
                { key: 'monday', label: 'Monday' },
				{ key: 'tuesday', label: 'Tuesday' },
				{ key: 'wednesday', label: 'Wednesday' },
				{ key: 'thursday', label: 'Thursday' },
				{ key: 'friday', label: 'Friday' },
				{ key: 'saturday', label: 'Saturday' },
				{ key: 'sunday', label: 'Sunday' }
            ]
        }
    },
    computed: {
        localAgreement: {
            get() {
                return this.modelValue
            },
            set(value) {
                this.$emit('update:modelValue', value)
            }
        }
    },
    watch: {
        localAgreement: {
            handler(val) {
                const a = val.payload?.automation
                const valid = Object.values(a || {}).some(v => v !== '' && v !== undefined)
                this.$emit('validated', valid)
            },
            deep: true,
            immediate: true
        }
    }
}
</script>
