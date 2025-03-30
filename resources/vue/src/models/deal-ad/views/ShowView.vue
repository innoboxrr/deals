<template>

	<div v-if="dataLoaded">
	    
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

	import { showModel } from '@dealsModels/deal-ad'
	import ModelCard from '@dealsModels/deal-ad/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-ad/widgets/ModelProfile.vue'

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