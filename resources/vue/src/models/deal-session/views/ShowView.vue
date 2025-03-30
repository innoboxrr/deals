<template>

	<div v-if="dataLoaded">

	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-session="dealSession" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-session="dealSession" />
	    				
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

	import { showModel } from '@dealsModels/deal-session'
	import ModelCard from '@dealsModels/deal-session/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-session/widgets/ModelProfile.vue'

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

				dealSessionId: this.$route.params.id,

				dealSession: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealSession');

			},

		},

		methods: {

			async fetchData() {

				await this.fetchDealSession()

				this.dataLoaded = true;
				
				this.title = this.dealSession.name;

				document.title = this.title;

			},

			async fetchDealSession() {

				let res = await showModel(this.dealSessionId);

				this.dealSession = res;

            },

		}

	}

</script>