<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
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

	import { showModel } from '@models/deal-advertiser-agreement-integration'
	import ModelCard from '@models/deal-advertiser-agreement-integration/widgets/ModelCard.vue'
	import ModelProfile from '@models/deal-advertiser-agreement-integration/widgets/ModelProfile.vue'

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

			items() {

				if(this.$route.name == 'AdminShowDealAdvertiserAgreementIntegration') {

					return [
						{ text: 'DealAdvertiserAgreementIntegrations', path: '/admin/deal-advertiser-agreement-integration'},
						{ text: this.deal-advertiser-agreement-integration.name ?? 'DealAdvertiserAgreementIntegration', path: '/admin/deal-advertiser-agreement-integration/' + this.deal-advertiser-agreement-integration.id}
					];

				} else if(this.$route.name == 'AdminEditDealAdvertiserAgreementIntegration') {

					return [
						{ text: 'DealAdvertiserAgreementIntegrations', path: '/admin/deal-advertiser-agreement-integration'},
						{ text: this.deal-advertiser-agreement-integration.name ?? 'DealAdvertiserAgreementIntegration' , path: '/admin/deal-advertiser-agreement-integration/' + this.deal-advertiser-agreement-integration.id},
						{ text: 'Editar deal-advertiser-agreement-integration', path: '/admin/deal-advertiser-agreement-integration/' + this.deal-advertiser-agreement-integration.id + '/edit'}	
					];

				}

			}

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