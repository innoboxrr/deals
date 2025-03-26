<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-product="dealProduct" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-product="dealProduct" />
	    				
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

	import { showModel } from '@models/deal-product'
	import ModelCard from '@models/deal-product/widgets/ModelCard.vue'
	import ModelProfile from '@models/deal-product/widgets/ModelProfile.vue'

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

				dealProductId: this.$route.params.id,

				dealProduct: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealProduct');

			},

			items() {

				if(this.$route.name == 'AdminShowDealProduct') {

					return [
						{ text: 'DealProducts', path: '/admin/deal-product'},
						{ text: this.deal-product.name ?? 'DealProduct', path: '/admin/deal-product/' + this.deal-product.id}
					];

				} else if(this.$route.name == 'AdminEditDealProduct') {

					return [
						{ text: 'DealProducts', path: '/admin/deal-product'},
						{ text: this.deal-product.name ?? 'DealProduct' , path: '/admin/deal-product/' + this.deal-product.id},
						{ text: 'Editar deal-product', path: '/admin/deal-product/' + this.deal-product.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchDealProduct()

				this.dataLoaded = true;
				
				this.title = this.dealProduct.name;

				document.title = this.title;

			},

			async fetchDealProduct() {

				let res = await showModel(this.dealProductId);

				this.dealProduct = res;

            },

		}

	}

</script>