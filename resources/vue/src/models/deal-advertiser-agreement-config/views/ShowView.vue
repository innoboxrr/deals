<template>

	<div v-if="dataLoaded">

	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-advertiser-agreement-config="dealAdvertiserAgreementConfig" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-advertiser-agreement-config="dealAdvertiserAgreementConfig" />
	    				
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

	import { showModel } from '@dealsModels/deal-advertiser-agreement-config'
	import ModelCard from '@dealsModels/deal-advertiser-agreement-config/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-advertiser-agreement-config/widgets/ModelProfile.vue'

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

				dealAdvertiserAgreementConfigId: this.$route.params.id,

				dealAdvertiserAgreementConfig: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAdvertiserAgreementConfig');

			},

		},

		methods: {

			async fetchData() {

				await this.fetchDealAdvertiserAgreementConfig()

				this.dataLoaded = true;
				
				this.title = this.dealAdvertiserAgreementConfig.name;

				document.title = this.title;

			},

			async fetchDealAdvertiserAgreementConfig() {

				let res = await showModel(this.dealAdvertiserAgreementConfigId);

				this.dealAdvertiserAgreementConfig = res;

            },

		}

	}

</script>