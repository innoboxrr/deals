<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-session-event="dealSessionEvent" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-session-event="dealSessionEvent" />
	    				
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

	import { showModel } from '@dealsModels/deal-session-event'
	import ModelCard from '@dealsModels/deal-session-event/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-session-event/widgets/ModelProfile.vue'

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

				dealSessionEventId: this.$route.params.id,

				dealSessionEvent: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealSessionEvent');

			},

			items() {

				if(this.$route.name == 'AdminShowDealSessionEvent') {

					return [
						{ text: 'DealSessionEvents', path: '/admin/deal-session-event'},
						{ text: this.deal-session-event.name ?? 'DealSessionEvent', path: '/admin/deal-session-event/' + this.deal-session-event.id}
					];

				} else if(this.$route.name == 'AdminEditDealSessionEvent') {

					return [
						{ text: 'DealSessionEvents', path: '/admin/deal-session-event'},
						{ text: this.deal-session-event.name ?? 'DealSessionEvent' , path: '/admin/deal-session-event/' + this.deal-session-event.id},
						{ text: 'Editar deal-session-event', path: '/admin/deal-session-event/' + this.deal-session-event.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchDealSessionEvent()

				this.dataLoaded = true;
				
				this.title = this.dealSessionEvent.name;

				document.title = this.title;

			},

			async fetchDealSessionEvent() {

				let res = await showModel(this.dealSessionEventId);

				this.dealSessionEvent = res;

            },

		}

	}

</script>