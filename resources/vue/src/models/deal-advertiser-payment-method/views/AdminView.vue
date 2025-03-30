<template>

	<div id="AdminDealAdvertiserPaymentMethodsWrapper">

		<div v-if="isHome" class="uk-section uk-section-xsmall">
				
			<data-table 
				:show-title="false"
				:hide-columns="hideColumns"
				:key="crudKey" />

		</div>

		<div v-else>

			<router-view @updateData="updateDatatable"></router-view>
			
		</div>

	</div>

</template>

<script>
	
	import DataTable from '@dealsModels/deal-advertiser-payment-method/widgets/DataTable.vue'

	export default {

		components: {

			DataTable

		},

		data() {

			return {

				title: undefined,

				crudKey: 0,

			}

		},

		computed: {

			isHome() {

				return (this.$route.name == 'AdminDealAdvertiserPaymentMethods');

			},

			hideColumns() {

				if(false) {

					this.updateDatatable();

					return [];

				}

				return [];

			}

		},

		methods: {

			updateDatatable() {

				++this.crudKey;

			},

		}

	}

</script>