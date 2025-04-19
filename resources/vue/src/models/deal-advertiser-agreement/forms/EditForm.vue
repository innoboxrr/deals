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
			dealAdvertiserAgreementId: {
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
			showModel(this.dealAdvertiserAgreementId).then(res => {
				this.deal = res
			})
		}
	}
</script>
