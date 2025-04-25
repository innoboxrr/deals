<template>
    <div>
        <!-- Emails para alertas -->
        <dynamic-group-input-component
            class="mb-6"
            label="Correos electrónicos para alertas"
            v-model="localAgreement.payload.alerts.emails"
            :inputs-config="[{
                key: 'value',
                type: 'text',
                attributes: {
                    name: 'email',
                    type: 'email',
                    label: 'Correo',
                    placeholder: 'ejemplo@correo.com',
                    validators: 'email',
                    customClass: inputClass
                }
            }]" />

        <!-- WhatsApp / teléfonos -->
        <dynamic-group-input-component
            class="mb-6"
            label="Números de WhatsApp para alertas"
            v-model="localAgreement.payload.alerts.phones"
            :inputs-config="[{
                key: 'value',
                type: 'text',
                attributes: {
                    name: 'phone',
                    type: 'number',
                    label: 'Teléfono',
                    placeholder: '+521234567890',
                    validators: 'phone',
                    customClass: inputClass
                }
            }]" />

        <!-- Futuro: webhooks / Slack -->
        <!--
        <text-input-component
            :custom-class="inputClass"
            type="url"
            name="slack_webhook"
            label="Slack Webhook URL"
            v-model="localAgreement.payload.alerts.slack_webhook" />
        -->
    </div>
</template>

<script>
    import {
        DynamicGroupInputComponent,
        TextInputComponent
    } from 'innoboxrr-form-elements'

    export default {
        name: 'StepAlerts',
        components: {
            DynamicGroupInputComponent,
            TextInputComponent
        },
        props: {
            modelValue: {
                type: Object,
                required: true
            }
        },
        data() {
            return {}
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
                    const hasEmails = val.payload?.alerts?.emails?.length
                    const hasPhones = val.payload?.alerts?.phones?.length
                    this.$emit('validated', hasEmails > 0 || hasPhones > 0)
                },
                deep: true,
                immediate: true
            }
        }
    }
</script>
