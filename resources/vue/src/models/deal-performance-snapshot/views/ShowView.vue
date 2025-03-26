<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-performance-snapshot="dealPerformanceSnapshot" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-performance-snapshot="dealPerformanceSnapshot" />
	    				
	    			</div>

	    			<div v-else>
	    				
	    				<router-view @updateData="fetchData"></router-view>

	    			</div>

	    		</div>

	    	</div>

	    </div>

	</div>

</template>

<script>

	import { showModel } from '@dealsModels/deal-performance-snapshot'
	import ModelCard from '@dealsModels/deal-performance-snapshot/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-performance-snapshot/widgets/ModelProfile.vue'

	export default {

		components: {

			ModelCard,

			ModelProfile

		},

		mounted() {

			this.fetchData();

		},

		data() {
		
			return {

				dataLoaded: false,

				title: undefined,

				dealPerformanceSnapshotId: this.$route.params.id,

				dealPerformanceSnapshot: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealPerformanceSnapshot');

			},

			items() {

				if(this.$route.name == 'AdminShowDealPerformanceSnapshot') {

					return [
						{ text: 'DealPerformanceSnapshots', path: '/admin/deal-performance-snapshot'},
						{ text: this.deal-performance-snapshot.name ?? 'DealPerformanceSnapshot', path: '/admin/deal-performance-snapshot/' + this.deal-performance-snapshot.id}
					];

				} else if(this.$route.name == 'AdminEditDealPerformanceSnapshot') {

					return [
						{ text: 'DealPerformanceSnapshots', path: '/admin/deal-performance-snapshot'},
						{ text: this.deal-performance-snapshot.name ?? 'DealPerformanceSnapshot' , path: '/admin/deal-performance-snapshot/' + this.deal-performance-snapshot.id},
						{ text: 'Editar deal-performance-snapshot', path: '/admin/deal-performance-snapshot/' + this.deal-performance-snapshot.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchDealPerformanceSnapshot()

				this.dataLoaded = true;
				
				this.title = this.dealPerformanceSnapshot.name;

				document.title = this.title;

			},

			async fetchDealPerformanceSnapshot() {

				let res = await showModel(this.dealPerformanceSnapshotId);

				this.dealPerformanceSnapshot = res;

            },

		}

	}

</script>