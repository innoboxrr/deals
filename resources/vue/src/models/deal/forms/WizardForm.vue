<template>
    <div class="w-full max-w-screen-xl mx-auto">

        <h2 class="text-2xl font-bold">
            {{ mode == 'edit' ? __deals('Edit Deal') : __deals('Create Deal') }}
        </h2>
        <p class="text-gray-400 mb-4">
            {{ __deals('Fill out the fields to create a new agreement') }}
        </p>

        <div class="flex flex-col md:flex-row gap-6 items-start">

            <ol class="space-y-4 w-full md:w-[250px] shrink-0">
                <li
                    v-for="(step, i) in steps"
                    :key="i"
                    @click="goToStep(i)"
                    class="cursor-pointer">
                    <div
                        class="w-full p-4 border rounded-lg flex items-center justify-between gap-2"
                        :class="[
                            stepClass(step),
                            step.active ? 'ring-2 ring-offset-1 ring-blue-500' : '',
                        ]"
                        role="alert">
                        <h3
                            class="text-sm md:text-base"
                            :class="step.active ? 'font-bold' : 'font-medium'">
                            {{ step.title }}
                        </h3>
                        <svg v-if="step.completed" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M1 5.917 5.724 10.5 15 1.5" />
                        </svg>
                        <svg v-else-if="step.active" class="rtl:rotate-180 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </div>
                </li>
                <button-component
                    v-if="mode === 'create'"
                    @click="resetLocal"
                    value="Reiniciar" />
            </ol>

            <!-- Step Content -->
            <div class="flex-1 w-full space-y-6">
                <!-- Dynamic Step -->
                <component
                    :is="currentComponent"
                    :model-value="deal"
                    :mode="mode"
                    @update:modelValue="deal = $event"
                    @validated="onStepValidated" />

                <!-- Navigation -->
                <div class="flex flex-wrap gap-2 justify-between">
                    <div v-if="stepIndex > 0">
                        <button-component
                            @click="prevStep"
                            value="Anterior" />
                    </div>
                    <div v-if="!isLastStep">
                        <button-component
                            :disabled="!steps[stepIndex].valid"
                            @click="nextStep"
                            value="Siguiente" />
                    </div>
                    <div v-else>
                        <button-component
                            :disabled="!steps[stepIndex].valid"
                            @click="submit"
                            :value="mode === 'edit' ? 'Actualizar' : 'Crear'" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import StepGeneral from './steps/StepGeneral.vue'
    import StepAutomation from './steps/StepAutomation.vue'
    import StepHypothesis from './steps/StepHypothesis.vue'
    import StepAlerts from './steps/StepAlerts.vue'
    import StepSegmentation from './steps/StepSegmentation.vue'
    import StepProduct from './steps/StepProduct.vue'
    import StepGateway from './steps/StepGateway.vue'
    import { ButtonComponent } from 'innoboxrr-form-elements'
    import { createModel, updateModel } from '@dealsModels/deal'

    export default {
        components: {
            StepGeneral,
            StepAutomation,
            StepHypothesis,
            StepAlerts,
            StepSegmentation,
            StepProduct,
            StepGateway,
            ButtonComponent,
        },
        props: {
            deal: {
                type: Object,
                required: true
            },
            mode: {
                type: String,
                default: 'create'
            }
        },
        emits: ['submit', 'loadDraft'],
        data() {
            return {
                stepIndex: 0,
                steps: [
                    { title: '1. Información General', component: 'StepGeneral', valid: false, completed: false, active: true, create: true, edit: true },
                    { title: '2. Automatización', component: 'StepAutomation', valid: false, completed: false, active: false, create: true, edit: true },
                    { title: '3. Hipótesis', component: 'StepHypothesis', valid: false, completed: false, active: false, create: true, edit: true },
                    { title: '4. Alertas', component: 'StepAlerts', valid: false, completed: false, active: false, create: true, edit: true },
                    { title: '5. Segmentación', component: 'StepSegmentation', valid: false, completed: false, active: false, create: true, edit: true },
                    { title: '6. Product', component: 'StepProduct', valid: false, completed: false, active: false, create: false, edit: true },
                    { title: '7. Gateway', component: 'StepGateway', valid: false, completed: false, active: false, create: false, edit: true },
                ],
                storageKey: null,
                hasChanges: false
            }
        },
        computed: {
            currentComponent() {
                return this.steps[this.stepIndex].component
            },
            isLastStep() {
                return this.stepIndex === this.steps.length - 1
            }
        },
        watch: {
            deal: {
                handler(newVal) {
                    this.hasChanges = true
                    if (this.mode === 'create' && this.storageKey) {
                        localStorage.setItem(this.storageKey, JSON.stringify(newVal))
                    }
                },
                deep: true
            }
        },
        mounted() {
            if (this.mode === 'create') {
                const url = new URL(window.location.href)
                let id = url.searchParams.get('draft')
                if (!id) {
                    id = crypto.randomUUID()
                    url.searchParams.set('draft', id)
                    window.history.replaceState({}, '', url)
                }
                this.storageKey = `draft_deal_${id}`

                const saved = localStorage.getItem(this.storageKey)
                if (saved) {
                    this.$emit('loadDraft', JSON.parse(saved))
                }
            }
            window.addEventListener('beforeunload', this.handleExit)
        },
        beforeUnmount() {
            window.removeEventListener('beforeunload', this.handleExit)
        },
        methods: {
            stepClass(step) {
                if (step.completed) return 'text-green-700 border-green-300 bg-green-50 dark:border-green-800 dark:text-green-400 dark:bg-gray-800'
                if (step.active) return 'text-blue-700 border-blue-300 bg-blue-100 dark:border-blue-800 dark:text-blue-400 dark:bg-gray-800'
                return 'text-gray-900 border-gray-300 bg-gray-100 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800'
            },
            onStepValidated(valid) {
                const step = this.steps[this.stepIndex]
                step.valid = valid
                step.completed = valid
            },
            nextStep() {
                this.steps[this.stepIndex].active = false
                this.stepIndex++
                this.steps[this.stepIndex].active = true
            },
            prevStep() {
                this.steps[this.stepIndex].active = false
                this.stepIndex--
                this.steps[this.stepIndex].active = true
            },
            goToStep(index) {
                this.steps[this.stepIndex].active = false
                this.stepIndex = index
                this.steps[this.stepIndex].active = true
            },
            submit() {
                const payload = {
                    name: this.deal.name,
                    description: this.deal.description,
                    ...this.deal.payload
                }
                const handler = this.mode === 'edit'
                    ? updateModel(this.deal.id, payload)
                    : createModel(payload)

                handler.then(res => {
                    if (this.storageKey) localStorage.removeItem(this.storageKey)
                    this.$emit('submit', res)
                }).catch(error => {
                    if (error?.response?.status === 422) {
                        // manejar errores si se desea
                    }
                })
            },
            handleExit(e) {
                if (this.mode === 'create' && this.hasChanges) {
                    e.preventDefault()
                    e.returnValue = ''
                    return ''
                }
            },
            resetLocal() {
                if (this.storageKey) {
                    localStorage.removeItem(this.storageKey)
                    window.location.reload()
                }
            }
        }
    }
</script>
