<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
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

	import { showModel } from '@models/deal-advertiser-agreement-cpl-adjustment'
	import ModelCard from '@models/deal-advertiser-agreement-cpl-adjustment/widgets/ModelCard.vue'
	import ModelProfile from '@models/deal-advertiser-agreement-cpl-adjustment/widgets/ModelProfile.vue'

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

			items() {

				if(this.$route.name == 'AdminShowDealAdvertiserAgreementCplAdjustment') {

					return [
						{ text: 'DealAdvertiserAgreementCplAdjustments', path: '/admin/deal-advertiser-agreement-cpl-adjustment'},
						{ text: this.deal-advertiser-agreement-cpl-adjustment.name ?? 'DealAdvertiserAgreementCplAdjustment', path: '/admin/deal-advertiser-agreement-cpl-adjustment/' + this.deal-advertiser-agreement-cpl-adjustment.id}
					];

				} else if(this.$route.name == 'AdminEditDealAdvertiserAgreementCplAdjustment') {

					return [
						{ text: 'DealAdvertiserAgreementCplAdjustments', path: '/admin/deal-advertiser-agreement-cpl-adjustment'},
						{ text: this.deal-advertiser-agreement-cpl-adjustment.name ?? 'DealAdvertiserAgreementCplAdjustment' , path: '/admin/deal-advertiser-agreement-cpl-adjustment/' + this.deal-advertiser-agreement-cpl-adjustment.id},
						{ text: 'Editar deal-advertiser-agreement-cpl-adjustment', path: '/admin/deal-advertiser-agreement-cpl-adjustment/' + this.deal-advertiser-agreement-cpl-adjustment.id + '/edit'}	
					];

				}

			}

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