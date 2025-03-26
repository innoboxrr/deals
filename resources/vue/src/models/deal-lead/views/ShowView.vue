<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:deal-lead="dealLead" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:deal-lead="dealLead" />
	    				
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

	import { showModel } from '@models/deal-lead'
	import ModelCard from '@models/deal-lead/widgets/ModelCard.vue'
	import ModelProfile from '@models/deal-lead/widgets/ModelProfile.vue'

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

				dealLeadId: this.$route.params.id,

				dealLead: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowDealLead');

			},

			items() {

				if(this.$route.name == 'AdminShowDealLead') {

					return [
						{ text: 'DealLeads', path: '/admin/deal-lead'},
						{ text: this.deal-lead.name ?? 'DealLead', path: '/admin/deal-lead/' + this.deal-lead.id}
					];

				} else if(this.$route.name == 'AdminEditDealLead') {

					return [
						{ text: 'DealLeads', path: '/admin/deal-lead'},
						{ text: this.deal-lead.name ?? 'DealLead' , path: '/admin/deal-lead/' + this.deal-lead.id},
						{ text: 'Editar deal-lead', path: '/admin/deal-lead/' + this.deal-lead.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchDealLead()

				this.dataLoaded = true;
				
				this.title = this.dealLead.name;

				document.title = this.title;

			},

			async fetchDealLead() {

				let res = await showModel(this.dealLeadId);

				this.dealLead = res;

            },

		}

	}

</script>