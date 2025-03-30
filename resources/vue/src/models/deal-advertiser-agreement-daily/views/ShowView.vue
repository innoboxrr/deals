<template>

	<div v-if="dataLoaded">

	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-advertiser-agreement-daily="dealAdvertiserAgreementDaily" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-advertiser-agreement-daily="dealAdvertiserAgreementDaily" />
	    				
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

	import { showModel } from '@dealsModels/deal-advertiser-agreement-daily'
	import ModelCard from '@dealsModels/deal-advertiser-agreement-daily/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-advertiser-agreement-daily/widgets/ModelProfile.vue'

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

				dealAdvertiserAgreementDailyId: this.$route.params.id,

				dealAdvertiserAgreementDaily: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAdvertiserAgreementDaily');

			},

		},

		methods: {

			async fetchData() {

				await this.fetchDealAdvertiserAgreementDaily()

				this.dataLoaded = true;
				
				this.title = this.dealAdvertiserAgreementDaily.name;

				document.title = this.title;

			},

			async fetchDealAdvertiserAgreementDaily() {

				let res = await showModel(this.dealAdvertiserAgreementDailyId);

				this.dealAdvertiserAgreementDaily = res;

            },

		}

	}

</script>