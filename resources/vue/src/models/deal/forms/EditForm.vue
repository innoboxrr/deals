<template>
	<form :id="formId" @submit.prevent>
		<deal-wizard
			v-if="deal"
			:deal="deal"
			mode="edit"
			@submit="$emit('submit', $event)" />
	</form>
</template>

<script>
	import { showModel } from '@dealsModels/deal'
	import DealWizard from './DealWizardForm.vue'

	export default {
		components: { DealWizard },
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
				this.deal = res
			})
		}
	}
</script>
