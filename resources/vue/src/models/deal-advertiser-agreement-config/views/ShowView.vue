<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-advertiser-agreement-config="dealAdvertiserAgreementConfig" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-advertiser-agreement-config="dealAdvertiserAgreementConfig" />
	    				
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

	import { showModel } from '@dealsModels/deal-advertiser-agreement-config'
	import ModelCard from '@dealsModels/deal-advertiser-agreement-config/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-advertiser-agreement-config/widgets/ModelProfile.vue'

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

				dealAdvertiserAgreementConfigId: this.$route.params.id,

				dealAdvertiserAgreementConfig: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAdvertiserAgreementConfig');

			},

			items() {

				if(this.$route.name == 'AdminShowDealAdvertiserAgreementConfig') {

					return [
						{ text: 'DealAdvertiserAgreementConfigs', path: '/admin/deal-advertiser-agreement-config'},
						{ text: this.deal-advertiser-agreement-config.name ?? 'DealAdvertiserAgreementConfig', path: '/admin/deal-advertiser-agreement-config/' + this.deal-advertiser-agreement-config.id}
					];

				} else if(this.$route.name == 'AdminEditDealAdvertiserAgreementConfig') {

					return [
						{ text: 'DealAdvertiserAgreementConfigs', path: '/admin/deal-advertiser-agreement-config'},
						{ text: this.deal-advertiser-agreement-config.name ?? 'DealAdvertiserAgreementConfig' , path: '/admin/deal-advertiser-agreement-config/' + this.deal-advertiser-agreement-config.id},
						{ text: 'Editar deal-advertiser-agreement-config', path: '/admin/deal-advertiser-agreement-config/' + this.deal-advertiser-agreement-config.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchDealAdvertiserAgreementConfig()

				this.dataLoaded = true;
				
				this.title = this.dealAdvertiserAgreementConfig.name;

				document.title = this.title;

			},

			async fetchDealAdvertiserAgreementConfig() {

				let res = await showModel(this.dealAdvertiserAgreementConfigId);

				this.dealAdvertiserAgreementConfig = res;

            },

		}

	}

</script>