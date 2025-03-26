<template>

	<div id="AdminDealAdGroupsWrapper">

		<div v-if="isHome" class="uk-section uk-section-xsmall">
			
			<breadcrumb-component 
				:pages="[
					{ link: $router.resolve({ name: 'AdminDealAdGroups' }).fullPath, title: 'DealAdGroups'}
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
	
	import DataTable from '@models/deal-ad-group/widgets/DataTable.vue'

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

				return (this.$route.name == 'AdminDealAdGroups');

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