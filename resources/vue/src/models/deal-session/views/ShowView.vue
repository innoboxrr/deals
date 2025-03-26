<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
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

			items() {

				if(this.$route.name == 'AdminShowDealSession') {

					return [
						{ text: 'DealSessions', path: '/admin/deal-session'},
						{ text: this.deal-session.name ?? 'DealSession', path: '/admin/deal-session/' + this.deal-session.id}
					];

				} else if(this.$route.name == 'AdminEditDealSession') {

					return [
						{ text: 'DealSessions', path: '/admin/deal-session'},
						{ text: this.deal-session.name ?? 'DealSession' , path: '/admin/deal-session/' + this.deal-session.id},
						{ text: 'Editar deal-session', path: '/admin/deal-session/' + this.deal-session.id + '/edit'}	
					];

				}

			}

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