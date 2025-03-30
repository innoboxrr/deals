<template>

	<div v-if="dataLoaded">

	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-assignment="dealAssignment" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-assignment="dealAssignment" />
	    				
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

	import { showModel } from '@dealsModels/deal-assignment'
	import ModelCard from '@dealsModels/deal-assignment/widgets/ModelCard.vue'
	import ModelProfile from '@dealsModels/deal-assignment/widgets/ModelProfile.vue'

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

				dealAssignmentId: this.$route.params.id,

				dealAssignment: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealAssignment');

			},

		},

		methods: {

			async fetchData() {

				await this.fetchDealAssignment()

				this.dataLoaded = true;
				
				this.title = this.dealAssignment.name;

				document.title = this.title;

			},

			async fetchDealAssignment() {

				let res = await showModel(this.dealAssignmentId);

				this.dealAssignment = res;

            },

		}

	}

</script>