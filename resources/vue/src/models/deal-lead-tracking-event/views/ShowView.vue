<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-lead-tracking-event="dealLeadTrackingEvent" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-lead-tracking-event="dealLeadTrackingEvent" />
	    				
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

	import { showModel } from '@models/deal-lead-tracking-event'
	import ModelCard from '@models/deal-lead-tracking-event/widgets/ModelCard.vue'
	import ModelProfile from '@models/deal-lead-tracking-event/widgets/ModelProfile.vue'

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

				dealLeadTrackingEventId: this.$route.params.id,

				dealLeadTrackingEvent: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealLeadTrackingEvent');

			},

			items() {

				if(this.$route.name == 'AdminShowDealLeadTrackingEvent') {

					return [
						{ text: 'DealLeadTrackingEvents', path: '/admin/deal-lead-tracking-event'},
						{ text: this.deal-lead-tracking-event.name ?? 'DealLeadTrackingEvent', path: '/admin/deal-lead-tracking-event/' + this.deal-lead-tracking-event.id}
					];

				} else if(this.$route.name == 'AdminEditDealLeadTrackingEvent') {

					return [
						{ text: 'DealLeadTrackingEvents', path: '/admin/deal-lead-tracking-event'},
						{ text: this.deal-lead-tracking-event.name ?? 'DealLeadTrackingEvent' , path: '/admin/deal-lead-tracking-event/' + this.deal-lead-tracking-event.id},
						{ text: 'Editar deal-lead-tracking-event', path: '/admin/deal-lead-tracking-event/' + this.deal-lead-tracking-event.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchDealLeadTrackingEvent()

				this.dataLoaded = true;
				
				this.title = this.dealLeadTrackingEvent.name;

				document.title = this.title;

			},

			async fetchDealLeadTrackingEvent() {

				let res = await showModel(this.dealLeadTrackingEventId);

				this.dealLeadTrackingEvent = res;

            },

		}

	}

</script>