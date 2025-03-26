<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
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

	import { showModel } from '@models/deal-alert'
	import ModelCard from '@models/deal-alert/widgets/ModelCard.vue'
	import ModelProfile from '@models/deal-alert/widgets/ModelProfile.vue'

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

			items() {

				if(this.$route.name == 'AdminShowDealAlert') {

					return [
						{ text: 'DealAlerts', path: '/admin/deal-alert'},
						{ text: this.deal-alert.name ?? 'DealAlert', path: '/admin/deal-alert/' + this.deal-alert.id}
					];

				} else if(this.$route.name == 'AdminEditDealAlert') {

					return [
						{ text: 'DealAlerts', path: '/admin/deal-alert'},
						{ text: this.deal-alert.name ?? 'DealAlert' , path: '/admin/deal-alert/' + this.deal-alert.id},
						{ text: 'Editar deal-alert', path: '/admin/deal-alert/' + this.deal-alert.id + '/edit'}	
					];

				}

			}

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