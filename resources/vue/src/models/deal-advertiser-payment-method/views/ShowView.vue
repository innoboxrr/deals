<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
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

	import { showModel } from '@models/deal-advertiser-payment-method'
	import ModelCard from '@models/deal-advertiser-payment-method/widgets/ModelCard.vue'
	import ModelProfile from '@models/deal-advertiser-payment-method/widgets/ModelProfile.vue'

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

			items() {

				if(this.$route.name == 'AdminShowDealAdvertiserPaymentMethod') {

					return [
						{ text: 'DealAdvertiserPaymentMethods', path: '/admin/deal-advertiser-payment-method'},
						{ text: this.deal-advertiser-payment-method.name ?? 'DealAdvertiserPaymentMethod', path: '/admin/deal-advertiser-payment-method/' + this.deal-advertiser-payment-method.id}
					];

				} else if(this.$route.name == 'AdminEditDealAdvertiserPaymentMethod') {

					return [
						{ text: 'DealAdvertiserPaymentMethods', path: '/admin/deal-advertiser-payment-method'},
						{ text: this.deal-advertiser-payment-method.name ?? 'DealAdvertiserPaymentMethod' , path: '/admin/deal-advertiser-payment-method/' + this.deal-advertiser-payment-method.id},
						{ text: 'Editar deal-advertiser-payment-method', path: '/admin/deal-advertiser-payment-method/' + this.deal-advertiser-payment-method.id + '/edit'}	
					];

				}

			}

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