<template>

	<div v-if="dataLoaded">

	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-alert="dealAlert" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-alert="dealAlert" />
	    				
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

	import { showModel } from '@dealsModels/deal-alert'
	import ModelCard from '@dealsModels/deal-alert/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-alert/widgets/ModelProfile.vue'

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

				dealAlertId: this.$route.params.id,

				dealAlert: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAlert');

			},

		},

		methods: {

			async fetchData() {

				await this.fetchDealAlert()

				this.dataLoaded = true;
				
				this.title = this.dealAlert.name;

				document.title = this.title;

			},

			async fetchDealAlert() {

				let res = await showModel(this.dealAlertId);

				this.dealAlert = res;

            },

		}

	}

</script>