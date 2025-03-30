<template>

	<div v-if="dataLoaded">
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-ad-platform="dealAdPlatform" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-ad-platform="dealAdPlatform" />
	    				
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

	import { showModel } from '@dealsModels/deal-ad-platform'
	import ModelCard from '@dealsModels/deal-ad-platform/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-ad-platform/widgets/ModelProfile.vue'

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

				dealAdPlatformId: this.$route.params.id,

				dealAdPlatform: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAdPlatform');

			},

		},

		methods: {

			async fetchData() {

				await this.fetchDealAdPlatform()

				this.dataLoaded = true;
				
				this.title = this.dealAdPlatform.name;

				document.title = this.title;

			},

			async fetchDealAdPlatform() {

				let res = await showModel(this.dealAdPlatformId);

				this.dealAdPlatform = res;

            },

		}

	}

</script>