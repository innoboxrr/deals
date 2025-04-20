<template>
	<form :id="formId" @submit.prevent>
		<WizardForm
			:agreement="agreement"
			:advertiser-id="advertiserId"
			mode="create"
			@submit="$emit('submit', $event)"
			@loadDraft="value => agreement = value" />
	</form>
</template>

<script>
	import WizardForm from './WizardForm.vue'

	export default {
		components: { WizardForm },
		props: {
			formId: {
				type: String,
				default: 'createDealForm'
			},
			advertiserId: {
				type: [String, Number],
				required: true	
			},
		},
		emits: ['submit'],
		data() {
			return {
				agreement: {
					status: 'draft',
					deal_id: '',
					deal_advertiser_id: '',
					payload: {
						general: {
							start_date: '',
							end_date: '',
							contract_terms: '',
							completion_notes: '',
						},
						billings: {
							autorenewal: false,
							currency: 'USD',
							management_fee: '',
							budget: '',
							budget_fee: '',
							net_budget: '',
							budget_spent: 0
						},
						estimate_metrics: {
							ctr: '',
							cpl: '',
							cpa: '',
							conversion_rate: '',
							leads_per_day: '',
							roi: '',
						},
						automation: {
							pause_until: '',
							pause_reason: '',
							cpc: '',
							cpm: ''
						},
						alerts: {
							emails: [],
							phones: [],
						},
						segmentation: {
							platforms: [],
							interests: [],
							devices: [],
							states: [],
							min_age: '',
							max_age: '',
							genders: [],
						},
						integration: {
							calls: []
						},
						postback: {
							token: ''
						},
						distribution: {
							current_cpl: '',
							current_cpa: '',
							current_ctr: '',
							current_cpm: '',
							current_cpc: '',
							current_leads_assigned: '',
							current_roi: '',
						}
					}
				}
			}
		}
	}
</script>