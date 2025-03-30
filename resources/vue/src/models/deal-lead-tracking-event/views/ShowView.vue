<template>

	<div v-if="dataLoaded">

	    
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

	import { showModel } from '@dealsModels/deal-lead-tracking-event'
	import ModelCard from '@dealsModels/deal-lead-tracking-event/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-lead-tracking-event/widgets/ModelProfile.vue'

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