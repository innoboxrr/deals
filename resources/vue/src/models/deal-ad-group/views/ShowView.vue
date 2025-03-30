<template>

	<div v-if="dataLoaded">
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-ad-group="dealAdGroup" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-ad-group="dealAdGroup" />
	    				
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

	import { showModel } from '@dealsModels/deal-ad-group'
	import ModelCard from '@dealsModels/deal-ad-group/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-ad-group/widgets/ModelProfile.vue'

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

				dealAdGroupId: this.$route.params.id,

				dealAdGroup: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAdGroup');

			},

		},

		methods: {

			async fetchData() {

				await this.fetchDealAdGroup()

				this.dataLoaded = true;
				
				this.title = this.dealAdGroup.name;

				document.title = this.title;

			},

			async fetchDealAdGroup() {

				let res = await showModel(this.dealAdGroupId);

				this.dealAdGroup = res;

            },

		}

	}

</script>