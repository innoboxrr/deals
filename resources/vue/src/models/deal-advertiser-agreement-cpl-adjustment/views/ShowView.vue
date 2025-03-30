<template>

	<div v-if="dataLoaded">

	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-advertiser-agreement-cpl-adjustment="dealAdvertiserAgreementCplAdjustment" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-advertiser-agreement-cpl-adjustment="dealAdvertiserAgreementCplAdjustment" />
	    				
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

	import { showModel } from '@dealsModels/deal-advertiser-agreement-cpl-adjustment'
	import ModelCard from '@dealsModels/deal-advertiser-agreement-cpl-adjustment/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-advertiser-agreement-cpl-adjustment/widgets/ModelProfile.vue'

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

				dealAdvertiserAgreementCplAdjustmentId: this.$route.params.id,

				dealAdvertiserAgreementCplAdjustment: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAdvertiserAgreementCplAdjustment');

			},

		},

		methods: {

			async fetchData() {

				await this.fetchDealAdvertiserAgreementCplAdjustment()

				this.dataLoaded = true;
				
				this.title = this.dealAdvertiserAgreementCplAdjustment.name;

				document.title = this.title;

			},

			async fetchDealAdvertiserAgreementCplAdjustment() {

				let res = await showModel(this.dealAdvertiserAgreementCplAdjustmentId);

				this.dealAdvertiserAgreementCplAdjustment = res;

            },

		}

	}

</script>