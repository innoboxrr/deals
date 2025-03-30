<template>

	<div v-if="dataLoaded">

	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-advertiser-agreement-integration="dealAdvertiserAgreementIntegration" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-advertiser-agreement-integration="dealAdvertiserAgreementIntegration" />
	    				
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

	import { showModel } from '@dealsModels/deal-advertiser-agreement-integration'
	import ModelCard from '@dealsModels/deal-advertiser-agreement-integration/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-advertiser-agreement-integration/widgets/ModelProfile.vue'

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

				dealAdvertiserAgreementIntegrationId: this.$route.params.id,

				dealAdvertiserAgreementIntegration: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAdvertiserAgreementIntegration');

			},

		},

		methods: {

			async fetchData() {

				await this.fetchDealAdvertiserAgreementIntegration()

				this.dataLoaded = true;
				
				this.title = this.dealAdvertiserAgreementIntegration.name;

				document.title = this.title;

			},

			async fetchDealAdvertiserAgreementIntegration() {

				let res = await showModel(this.dealAdvertiserAgreementIntegrationId);

				this.dealAdvertiserAgreementIntegration = res;

            },

		}

	}

</script>