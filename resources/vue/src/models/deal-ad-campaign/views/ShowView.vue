<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-ad-campaign="dealAdCampaign" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-ad-campaign="dealAdCampaign" />
	    				
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

	import { showModel } from '@models/deal-ad-campaign'
	import ModelCard from '@models/deal-ad-campaign/widgets/ModelCard.vue'
	import ModelProfile from '@models/deal-ad-campaign/widgets/ModelProfile.vue'

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

				dealAdCampaignId: this.$route.params.id,

				dealAdCampaign: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAdCampaign');

			},

			items() {

				if(this.$route.name == 'AdminShowDealAdCampaign') {

					return [
						{ text: 'DealAdCampaigns', path: '/admin/deal-ad-campaign'},
						{ text: this.deal-ad-campaign.name ?? 'DealAdCampaign', path: '/admin/deal-ad-campaign/' + this.deal-ad-campaign.id}
					];

				} else if(this.$route.name == 'AdminEditDealAdCampaign') {

					return [
						{ text: 'DealAdCampaigns', path: '/admin/deal-ad-campaign'},
						{ text: this.deal-ad-campaign.name ?? 'DealAdCampaign' , path: '/admin/deal-ad-campaign/' + this.deal-ad-campaign.id},
						{ text: 'Editar deal-ad-campaign', path: '/admin/deal-ad-campaign/' + this.deal-ad-campaign.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchDealAdCampaign()

				this.dataLoaded = true;
				
				this.title = this.dealAdCampaign.name;

				document.title = this.title;

			},

			async fetchDealAdCampaign() {

				let res = await showModel(this.dealAdCampaignId);

				this.dealAdCampaign = res;

            },

		}

	}

</script>