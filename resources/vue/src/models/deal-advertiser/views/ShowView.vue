<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-advertiser="dealAdvertiser" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-advertiser="dealAdvertiser" />
	    				
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

	import { showModel } from '@models/deal-advertiser'
	import ModelCard from '@models/deal-advertiser/widgets/ModelCard.vue'
	import ModelProfile from '@models/deal-advertiser/widgets/ModelProfile.vue'

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

				dealAdvertiserId: this.$route.params.id,

				dealAdvertiser: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAdvertiser');

			},

			items() {

				if(this.$route.name == 'AdminShowDealAdvertiser') {

					return [
						{ text: 'DealAdvertisers', path: '/admin/deal-advertiser'},
						{ text: this.deal-advertiser.name ?? 'DealAdvertiser', path: '/admin/deal-advertiser/' + this.deal-advertiser.id}
					];

				} else if(this.$route.name == 'AdminEditDealAdvertiser') {

					return [
						{ text: 'DealAdvertisers', path: '/admin/deal-advertiser'},
						{ text: this.deal-advertiser.name ?? 'DealAdvertiser' , path: '/admin/deal-advertiser/' + this.deal-advertiser.id},
						{ text: 'Editar deal-advertiser', path: '/admin/deal-advertiser/' + this.deal-advertiser.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchDealAdvertiser()

				this.dataLoaded = true;
				
				this.title = this.dealAdvertiser.name;

				document.title = this.title;

			},

			async fetchDealAdvertiser() {

				let res = await showModel(this.dealAdvertiserId);

				this.dealAdvertiser = res;

            },

		}

	}

</script>