<template>
	<div v-if="dataLoaded">
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

	import { showModel } from '@dealsModels/deal-product'
	import ModelCard from '@dealsModels/deal-product/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-product/widgets/ModelProfile.vue'

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