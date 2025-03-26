<template>

	<div id="AdminDealAssignmentsWrapper">

		<div v-if="isHome" class="uk-section uk-section-xsmall">
			
			<breadcrumb-component 
				:pages="[
					{ link: $router.resolve({ name: 'AdminDealAssignments' }).fullPath, title: 'DealAssignments'}
				]"/>
				
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
	
	import DataTable from '@models/deal-assignment/widgets/DataTable.vue'

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

				return (this.$route.name == 'AdminDealAssignments');

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