<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
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

			items() {

				if(this.$route.name == 'AdminShowDealRouter') {

					return [
						{ text: 'DealRouters', path: '/admin/deal-router'},
						{ text: this.deal-router.name ?? 'DealRouter', path: '/admin/deal-router/' + this.deal-router.id}
					];

				} else if(this.$route.name == 'AdminEditDealRouter') {

					return [
						{ text: 'DealRouters', path: '/admin/deal-router'},
						{ text: this.deal-router.name ?? 'DealRouter' , path: '/admin/deal-router/' + this.deal-router.id},
						{ text: 'Editar deal-router', path: '/admin/deal-router/' + this.deal-router.id + '/edit'}	
					];

				}

			}

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