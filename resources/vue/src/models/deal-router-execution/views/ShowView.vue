<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-router-execution="dealRouterExecution" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-router-execution="dealRouterExecution" />
	    				
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

	import { showModel } from '@dealsModels/deal-router-execution'
	import ModelCard from '@dealsModels/deal-router-execution/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-router-execution/widgets/ModelProfile.vue'

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

				dealRouterExecutionId: this.$route.params.id,

				dealRouterExecution: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealRouterExecution');

			},

			items() {

				if(this.$route.name == 'AdminShowDealRouterExecution') {

					return [
						{ text: 'DealRouterExecutions', path: '/admin/deal-router-execution'},
						{ text: this.deal-router-execution.name ?? 'DealRouterExecution', path: '/admin/deal-router-execution/' + this.deal-router-execution.id}
					];

				} else if(this.$route.name == 'AdminEditDealRouterExecution') {

					return [
						{ text: 'DealRouterExecutions', path: '/admin/deal-router-execution'},
						{ text: this.deal-router-execution.name ?? 'DealRouterExecution' , path: '/admin/deal-router-execution/' + this.deal-router-execution.id},
						{ text: 'Editar deal-router-execution', path: '/admin/deal-router-execution/' + this.deal-router-execution.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchDealRouterExecution()

				this.dataLoaded = true;
				
				this.title = this.dealRouterExecution.name;

				document.title = this.title;

			},

			async fetchDealRouterExecution() {

				let res = await showModel(this.dealRouterExecutionId);

				this.dealRouterExecution = res;

            },

		}

	}

</script>