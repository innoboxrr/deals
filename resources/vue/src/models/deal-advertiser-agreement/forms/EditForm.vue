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
			this.agreement = res
		}
	}
</script>
