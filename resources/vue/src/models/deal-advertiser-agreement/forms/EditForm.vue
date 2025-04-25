<template>
	<form :id="formId" @submit.prevent>
		<WizardForm
			v-if="agreement"
			:agreement="agreement"
			mode="edit"
			@submit="$emit('submit', $event)" />
	</form>
</template>

<script>
	import { showModel } from '@dealsModels/deal-advertiser-agreement'
	import WizardForm from './WizardForm.vue'

	export default {
		components: { WizardForm },
		props: {
			formId: {
				type: String,
				default: 'editDealForm'
			},
			dealAdvertiserAgreementId: {
				type: [String, Number],
				required: true
			}
		},
		emits: ['submit'],
		data() {
			return {
				agreement: null
			}
		},
		async mounted() {
			let res = await showModel(this.dealAdvertiserAgreementId);
			res = this.formatAlertsPayload(res);
			res = this.formatIntegrationPayload(res);
			this.agreement = res;
		},
		methods: {
			formatAlertsPayload(agreement) {
				if (agreement.payload?.alerts?.emails) {
					// Validar JSON antes de parsear
					try {
						JSON.parse(agreement.payload.alerts.emails);
					} catch (e) {
						agreement.payload.alerts.emails = '[]'; // or handle the error as needed
					}
					agreement.payload.alerts.emails = JSON.parse(agreement.payload.alerts.emails);
				}
				if (agreement.payload?.alerts?.phones) {
					// Validar JSON antes de parsear
					try {
						JSON.parse(agreement.payload.alerts.phones);
					} catch (e) {
						agreement.payload.alerts.phones = '[]'; // or handle the error as needed
					}
					agreement.payload.alerts.phones = JSON.parse(agreement.payload.alerts.phones);
				}
				return agreement;
			},
			formatIntegrationPayload(agreement) {
				if( agreement.payload?.integration?.calls) {
					console.log(agreement.payload.integration);

					agreement.payload.integration.calls = JSON.parse(agreement.payload.integration.calls);
				} else {
					agreement.payload = {
						...agreement.payload,
						integration: {
							calls: [],
						}
					}
				}
				return agreement;
			}
		}
	}
</script>
