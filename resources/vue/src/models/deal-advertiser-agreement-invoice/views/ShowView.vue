<template>

	<div v-if="dataLoaded">

	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-advertiser-agreement-invoice="dealAdvertiserAgreementInvoice" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-advertiser-agreement-invoice="dealAdvertiserAgreementInvoice" />
	    				
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

	import { showModel } from '@dealsModels/deal-advertiser-agreement-invoice'
	import ModelCard from '@dealsModels/deal-advertiser-agreement-invoice/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-advertiser-agreement-invoice/widgets/ModelProfile.vue'

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

				dealAdvertiserAgreementInvoiceId: this.$route.params.id,

				dealAdvertiserAgreementInvoice: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAdvertiserAgreementInvoice');

			},

		},

		methods: {

			async fetchData() {

				await this.fetchDealAdvertiserAgreementInvoice()

				this.dataLoaded = true;
				
				this.title = this.dealAdvertiserAgreementInvoice.name;

				document.title = this.title;

			},

			async fetchDealAdvertiserAgreementInvoice() {

				let res = await showModel(this.dealAdvertiserAgreementInvoiceId);

				this.dealAdvertiserAgreementInvoice = res;

            },

		}

	}

</script>