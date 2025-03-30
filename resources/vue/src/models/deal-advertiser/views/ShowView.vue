<template>

	<div v-if="dataLoaded">

	    
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

	import { showModel } from '@dealsModels/deal-advertiser'
	import ModelCard from '@dealsModels/deal-advertiser/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-advertiser/widgets/ModelProfile.vue'

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