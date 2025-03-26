<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-ad="dealAd" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-ad="dealAd" />
	    				
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

	import { showModel } from '@models/deal-ad'
	import ModelCard from '@models/deal-ad/widgets/ModelCard.vue'
	import ModelProfile from '@models/deal-ad/widgets/ModelProfile.vue'

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

				dealAdId: this.$route.params.id,

				dealAd: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAd');

			},

			items() {

				if(this.$route.name == 'AdminShowDealAd') {

					return [
						{ text: 'DealAds', path: '/admin/deal-ad'},
						{ text: this.deal-ad.name ?? 'DealAd', path: '/admin/deal-ad/' + this.deal-ad.id}
					];

				} else if(this.$route.name == 'AdminEditDealAd') {

					return [
						{ text: 'DealAds', path: '/admin/deal-ad'},
						{ text: this.deal-ad.name ?? 'DealAd' , path: '/admin/deal-ad/' + this.deal-ad.id},
						{ text: 'Editar deal-ad', path: '/admin/deal-ad/' + this.deal-ad.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchDealAd()

				this.dataLoaded = true;
				
				this.title = this.dealAd.name;

				document.title = this.title;

			},

			async fetchDealAd() {

				let res = await showModel(this.dealAdId);

				this.dealAd = res;

            },

		}

	}

</script>