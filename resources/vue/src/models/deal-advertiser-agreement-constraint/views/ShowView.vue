<template>

	<div v-if="dataLoaded">

	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-advertiser-agreement-constraint="dealAdvertiserAgreementConstraint" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-advertiser-agreement-constraint="dealAdvertiserAgreementConstraint" />
	    				
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

	import { showModel } from '@dealsModels/deal-advertiser-agreement-constraint'
	import ModelCard from '@dealsModels/deal-advertiser-agreement-constraint/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-advertiser-agreement-constraint/widgets/ModelProfile.vue'

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

				dealAdvertiserAgreementConstraintId: this.$route.params.id,

				dealAdvertiserAgreementConstraint: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAdvertiserAgreementConstraint');

			},

		},

		methods: {

			async fetchData() {

				await this.fetchDealAdvertiserAgreementConstraint()

				this.dataLoaded = true;
				
				this.title = this.dealAdvertiserAgreementConstraint.name;

				document.title = this.title;

			},

			async fetchDealAdvertiserAgreementConstraint() {

				let res = await showModel(this.dealAdvertiserAgreementConstraintId);

				this.dealAdvertiserAgreementConstraint = res;

            },

		}

	}

</script>