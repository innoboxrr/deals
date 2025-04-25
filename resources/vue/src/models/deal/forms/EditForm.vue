<template>
	<form :id="formId" @submit.prevent>
		<WizardForm
			v-if="deal"
			:deal="deal"
			mode="edit"
			@submit="$emit('submit', $event)" />
	</form>
</template>

<script>
	import { showModel } from '@dealsModels/deal'
	import WizardForm from './WizardForm.vue'

	export default {
		components: { WizardForm },
		props: {
			formId: {
				type: String,
				default: 'editDealForm'
			},
			dealId: {
				type: [String, Number],
				required: true
			}
		},
		emits: ['submit'],
		data() {
			return {
				deal: null
			}
		},
		mounted() {
			showModel(this.dealId).then(res => {
				res = this.formatAlertsPayload(res);
				this.deal = res
			})
		},
		methods: {
			formatAlertsPayload(deal) {
				if (deal.payload?.alerts?.emails) {
					// Validar JSON antes de parsear
					try {
						JSON.parse(deal.payload.alerts.emails);
					} catch (e) {
						deal.payload.alerts.emails = '[]'; // or handle the error as needed
					}
					deal.payload.alerts.emails = JSON.parse(deal.payload.alerts.emails);
				}
				if (deal.payload?.alerts?.phones) {
					// Validar JSON antes de parsear
					try {
						JSON.parse(deal.payload.alerts.phones);
					} catch (e) {
						deal.payload.alerts.phones = '[]'; // or handle the error as needed
					}
					deal.payload.alerts.phones = JSON.parse(deal.payload.alerts.phones);
				}
				return deal;
			}
		}
	}
</script>
