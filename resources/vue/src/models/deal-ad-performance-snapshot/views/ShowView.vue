<template>

	<div v-if="dataLoaded">
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-ad-performance-snapshot="dealAdPerformanceSnapshot" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-ad-performance-snapshot="dealAdPerformanceSnapshot" />
	    				
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

	import { showModel } from '@dealsModels/deal-ad-performance-snapshot'
	import ModelCard from '@dealsModels/deal-ad-performance-snapshot/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-ad-performance-snapshot/widgets/ModelProfile.vue'

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

				dealAdPerformanceSnapshotId: this.$route.params.id,

				dealAdPerformanceSnapshot: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAdPerformanceSnapshot');

			},

		},

		methods: {

			async fetchData() {

				await this.fetchDealAdPerformanceSnapshot()

				this.dataLoaded = true;
				
				this.title = this.dealAdPerformanceSnapshot.name;

				document.title = this.title;

			},

			async fetchDealAdPerformanceSnapshot() {

				let res = await showModel(this.dealAdPerformanceSnapshotId);

				this.dealAdPerformanceSnapshot = res;

            },

		}

	}

</script>