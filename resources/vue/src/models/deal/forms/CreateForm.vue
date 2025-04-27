<template>
	<form :id="formId" @submit.prevent>
		<WizardForm
			:deal="deal"
			mode="create"
			@submit="$emit('submit', $event)"
			@loadDraft="value => deal = value" />
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
			}
		},
		emits: ['submit'],
		data() {
			return {
				deal: {
					name: '',
					description: '',
					payload: {
						max_cpl: '',
						snapshot_cron_interval: '',
						investment_fee: '',
						min_advertisers: '',
						max_advertisers: '',
						access_type: '',
						queue: 'default',
						automation_thresholds: {
							min_ctr: '',
							max_cpl: '',
							max_cpa: '',
						},
						hypothesis: {
							ctr: '',
							cpl: '',
							cpa: '',
							conversion_rate: '',
							leads_per_day: ''
						},
						alerts: {
							emails: [],
							phones: []
						},
						segmentation: {
							min_age: '',
							max_age: '',
							genders: [],
							languages: [],
							interests: [],
							locations: [],
							devices: [],
							platforms: [],
							behaviors: [],
						}
					}
				}
			}
		}
	}
</script>