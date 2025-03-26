<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-advertiser-agreement-postback="dealAdvertiserAgreementPostback" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-advertiser-agreement-postback="dealAdvertiserAgreementPostback" />
	    				
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

	import { showModel } from '@models/deal-advertiser-agreement-postback'
	import ModelCard from '@models/deal-advertiser-agreement-postback/widgets/ModelCard.vue'
	import ModelProfile from '@models/deal-advertiser-agreement-postback/widgets/ModelProfile.vue'

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

				dealAdvertiserAgreementPostbackId: this.$route.params.id,

				dealAdvertiserAgreementPostback: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAdvertiserAgreementPostback');

			},

			items() {

				if(this.$route.name == 'AdminShowDealAdvertiserAgreementPostback') {

					return [
						{ text: 'DealAdvertiserAgreementPostbacks', path: '/admin/deal-advertiser-agreement-postback'},
						{ text: this.deal-advertiser-agreement-postback.name ?? 'DealAdvertiserAgreementPostback', path: '/admin/deal-advertiser-agreement-postback/' + this.deal-advertiser-agreement-postback.id}
					];

				} else if(this.$route.name == 'AdminEditDealAdvertiserAgreementPostback') {

					return [
						{ text: 'DealAdvertiserAgreementPostbacks', path: '/admin/deal-advertiser-agreement-postback'},
						{ text: this.deal-advertiser-agreement-postback.name ?? 'DealAdvertiserAgreementPostback' , path: '/admin/deal-advertiser-agreement-postback/' + this.deal-advertiser-agreement-postback.id},
						{ text: 'Editar deal-advertiser-agreement-postback', path: '/admin/deal-advertiser-agreement-postback/' + this.deal-advertiser-agreement-postback.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchDealAdvertiserAgreementPostback()

				this.dataLoaded = true;
				
				this.title = this.dealAdvertiserAgreementPostback.name;

				document.title = this.title;

			},

			async fetchDealAdvertiserAgreementPostback() {

				let res = await showModel(this.dealAdvertiserAgreementPostbackId);

				this.dealAdvertiserAgreementPostback = res;

            },

		}

	}

</script>