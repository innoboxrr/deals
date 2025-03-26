<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-pixel-fire="dealPixelFire" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-pixel-fire="dealPixelFire" />
	    				
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

	import { showModel } from '@dealsModels/deal-pixel-fire'
	import ModelCard from '@dealsModels/deal-pixel-fire/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-pixel-fire/widgets/ModelProfile.vue'

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

				dealPixelFireId: this.$route.params.id,

				dealPixelFire: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealPixelFire');

			},

			items() {

				if(this.$route.name == 'AdminShowDealPixelFire') {

					return [
						{ text: 'DealPixelFires', path: '/admin/deal-pixel-fire'},
						{ text: this.deal-pixel-fire.name ?? 'DealPixelFire', path: '/admin/deal-pixel-fire/' + this.deal-pixel-fire.id}
					];

				} else if(this.$route.name == 'AdminEditDealPixelFire') {

					return [
						{ text: 'DealPixelFires', path: '/admin/deal-pixel-fire'},
						{ text: this.deal-pixel-fire.name ?? 'DealPixelFire' , path: '/admin/deal-pixel-fire/' + this.deal-pixel-fire.id},
						{ text: 'Editar deal-pixel-fire', path: '/admin/deal-pixel-fire/' + this.deal-pixel-fire.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchDealPixelFire()

				this.dataLoaded = true;
				
				this.title = this.dealPixelFire.name;

				document.title = this.title;

			},

			async fetchDealPixelFire() {

				let res = await showModel(this.dealPixelFireId);

				this.dealPixelFire = res;

            },

		}

	}

</script>