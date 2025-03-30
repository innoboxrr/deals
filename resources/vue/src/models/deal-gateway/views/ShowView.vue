<template>

	<div v-if="dataLoaded">

	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-gateway="dealGateway" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-gateway="dealGateway" />
	    				
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

	import { showModel } from '@dealsModels/deal-gateway'
	import ModelCard from '@dealsModels/deal-gateway/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-gateway/widgets/ModelProfile.vue'

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

				dealGatewayId: this.$route.params.id,

				dealGateway: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealGateway');

			},

		},

		methods: {

			async fetchData() {

				await this.fetchDealGateway()

				this.dataLoaded = true;
				
				this.title = this.dealGateway.name;

				document.title = this.title;

			},

			async fetchDealGateway() {

				let res = await showModel(this.dealGatewayId);

				this.dealGateway = res;

            },

		}

	}

</script>