<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
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

	import { showModel } from '@models/deal-advertiser-agreement-constraint'
	import ModelCard from '@models/deal-advertiser-agreement-constraint/widgets/ModelCard.vue'
	import ModelProfile from '@models/deal-advertiser-agreement-constraint/widgets/ModelProfile.vue'

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

			items() {

				if(this.$route.name == 'AdminShowDealAdvertiserAgreementConstraint') {

					return [
						{ text: 'DealAdvertiserAgreementConstraints', path: '/admin/deal-advertiser-agreement-constraint'},
						{ text: this.deal-advertiser-agreement-constraint.name ?? 'DealAdvertiserAgreementConstraint', path: '/admin/deal-advertiser-agreement-constraint/' + this.deal-advertiser-agreement-constraint.id}
					];

				} else if(this.$route.name == 'AdminEditDealAdvertiserAgreementConstraint') {

					return [
						{ text: 'DealAdvertiserAgreementConstraints', path: '/admin/deal-advertiser-agreement-constraint'},
						{ text: this.deal-advertiser-agreement-constraint.name ?? 'DealAdvertiserAgreementConstraint' , path: '/admin/deal-advertiser-agreement-constraint/' + this.deal-advertiser-agreement-constraint.id},
						{ text: 'Editar deal-advertiser-agreement-constraint', path: '/admin/deal-advertiser-agreement-constraint/' + this.deal-advertiser-agreement-constraint.id + '/edit'}	
					];

				}

			}

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