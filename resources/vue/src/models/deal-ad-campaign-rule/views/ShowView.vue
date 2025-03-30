<template>

	<div v-if="dataLoaded">
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-ad-campaign-rule="dealAdCampaignRule" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-ad-campaign-rule="dealAdCampaignRule" />
	    				
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

	import { showModel } from '@dealsModels/deal-ad-campaign-rule'
	import ModelCard from '@dealsModels/deal-ad-campaign-rule/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-ad-campaign-rule/widgets/ModelProfile.vue'

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

				dealAdCampaignRuleId: this.$route.params.id,

				dealAdCampaignRule: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAdCampaignRule');

			},

		},

		methods: {

			async fetchData() {

				await this.fetchDealAdCampaignRule()

				this.dataLoaded = true;
				
				this.title = this.dealAdCampaignRule.name;

				document.title = this.title;

			},

			async fetchDealAdCampaignRule() {

				let res = await showModel(this.dealAdCampaignRuleId);

				this.dealAdCampaignRule = res;

            },

		}

	}

</script>