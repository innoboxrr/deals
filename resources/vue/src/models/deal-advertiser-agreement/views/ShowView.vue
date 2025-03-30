<template>

	<div v-if="dataLoaded">

	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-advertiser-agreement="dealAdvertiserAgreement" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-advertiser-agreement="dealAdvertiserAgreement" />
	    				
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

	import { showModel } from '@dealsModels/deal-advertiser-agreement'
	import ModelCard from '@dealsModels/deal-advertiser-agreement/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-advertiser-agreement/widgets/ModelProfile.vue'

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

				dealAdvertiserAgreementId: this.$route.params.id,

				dealAdvertiserAgreement: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAdvertiserAgreement');

			},

		},

		methods: {

			async fetchData() {

				await this.fetchDealAdvertiserAgreement()

				this.dataLoaded = true;
				
				this.title = this.dealAdvertiserAgreement.name;

				document.title = this.title;

			},

			async fetchDealAdvertiserAgreement() {

				let res = await showModel(this.dealAdvertiserAgreementId);

				this.dealAdvertiserAgreement = res;

            },

		}

	}

</script>