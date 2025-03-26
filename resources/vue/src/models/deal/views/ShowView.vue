<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal="deal" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal="deal" />
	    				
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

	import { showModel } from '@dealsModels/deal'
	import ModelCard from '@dealsModels/deal/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal/widgets/ModelProfile.vue'

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

				dealId: this.$route.params.id,

				deal: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDeal');

			},

			items() {

				if(this.$route.name == 'AdminShowDeal') {

					return [
						{ text: 'Deals', path: '/admin/deal'},
						{ text: this.deal.name ?? 'Deal', path: '/admin/deal/' + this.deal.id}
					];

				} else if(this.$route.name == 'AdminEditDeal') {

					return [
						{ text: 'Deals', path: '/admin/deal'},
						{ text: this.deal.name ?? 'Deal' , path: '/admin/deal/' + this.deal.id},
						{ text: 'Editar deal', path: '/admin/deal/' + this.deal.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchDeal()

				this.dataLoaded = true;
				
				this.title = this.deal.name;

				document.title = this.title;

			},

			async fetchDeal() {

				let res = await showModel(this.dealId);

				this.deal = res;

            },

		}

	}

</script>