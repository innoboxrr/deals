<template>

	<div v-if="dataLoaded">

	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-advertiser-payment-method="dealAdvertiserPaymentMethod" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-advertiser-payment-method="dealAdvertiserPaymentMethod" />
	    				
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

	import { showModel } from '@dealsModels/deal-advertiser-payment-method'
	import ModelCard from '@dealsModels/deal-advertiser-payment-method/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-advertiser-payment-method/widgets/ModelProfile.vue'

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

				dealAdvertiserPaymentMethodId: this.$route.params.id,

				dealAdvertiserPaymentMethod: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAdvertiserPaymentMethod');

			},

		},

		methods: {

			async fetchData() {

				await this.fetchDealAdvertiserPaymentMethod()

				this.dataLoaded = true;
				
				this.title = this.dealAdvertiserPaymentMethod.name;

				document.title = this.title;

			},

			async fetchDealAdvertiserPaymentMethod() {

				let res = await showModel(this.dealAdvertiserPaymentMethodId);

				this.dealAdvertiserPaymentMethod = res;

            },

		}

	}

</script>