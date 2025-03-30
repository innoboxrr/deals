<template>

	<div v-if="dataLoaded">

	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-router="dealRouter" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-router="dealRouter" />
	    				
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

	import { showModel } from '@dealsModels/deal-router'
	import ModelCard from '@dealsModels/deal-router/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-router/widgets/ModelProfile.vue'

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

				dealRouterId: this.$route.params.id,

				dealRouter: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealRouter');

			},

		},

		methods: {

			async fetchData() {

				await this.fetchDealRouter()

				this.dataLoaded = true;
				
				this.title = this.dealRouter.name;

				document.title = this.title;

			},

			async fetchDealRouter() {

				let res = await showModel(this.dealRouterId);

				this.dealRouter = res;

            },

		}

	}

</script>