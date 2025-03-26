<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
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

	import { showModel } from '@models/deal-ad-campaign-rule'
	import ModelCard from '@models/deal-ad-campaign-rule/widgets/ModelCard.vue'
	import ModelProfile from '@models/deal-ad-campaign-rule/widgets/ModelProfile.vue'

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

			items() {

				if(this.$route.name == 'AdminShowDealAdCampaignRule') {

					return [
						{ text: 'DealAdCampaignRules', path: '/admin/deal-ad-campaign-rule'},
						{ text: this.deal-ad-campaign-rule.name ?? 'DealAdCampaignRule', path: '/admin/deal-ad-campaign-rule/' + this.deal-ad-campaign-rule.id}
					];

				} else if(this.$route.name == 'AdminEditDealAdCampaignRule') {

					return [
						{ text: 'DealAdCampaignRules', path: '/admin/deal-ad-campaign-rule'},
						{ text: this.deal-ad-campaign-rule.name ?? 'DealAdCampaignRule' , path: '/admin/deal-ad-campaign-rule/' + this.deal-ad-campaign-rule.id},
						{ text: 'Editar deal-ad-campaign-rule', path: '/admin/deal-ad-campaign-rule/' + this.deal-ad-campaign-rule.id + '/edit'}	
					];

				}

			}

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