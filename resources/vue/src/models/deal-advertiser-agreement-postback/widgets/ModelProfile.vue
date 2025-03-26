<template>
	
	<div
		v-if="dataLoaded" 
		class="card bg-white dark:bg-slate-700 border rounded-lg px-8 pt-6 pb-8 mb-4 dark:border-slate-800">
		
		<dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
		
			<div class="sm:col-span-1">
				<dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</dt>
				<dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ dealAdvertiserAgreementPostback.id }}</dd>
			</div>
		
			<div class="sm:col-span-1">
				<dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Other</dt>
				<dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ dealAdvertiserAgreementPostback.other }}</dd>
			</div>
			<!-- Repite para otros campos como status, country_id, etc. -->
		
		</dl>

	</div>

</template>

<script>

	import { showModel } from '@models/deal-advertiser-agreement-postback'
	
	export default {

		props: {

			dealAdvertiserAgreementPostback: {
				type: Object,
				required: false,
			},

			dealAdvertiserAgreementPostbackId: {
				type: [Number, String],
				required: false
			}

		},

		data() {

			return {

				dataLoaded: false,

			}
		
		},

		created() {
	
	        // Asegurarse de que al menos uno de los dos props esté definido.
	        if (!this.dealAdvertiserAgreementPostback && !this.dealAdvertiserAgreementPostbackId) {
	
	            console.error("Se debe proporcionar 'dealAdvertiserAgreementPostback' o 'dealAdvertiserAgreementPostbackId'.");
	
	        }
	
	    },

		mounted() {

			if (!this.dealAdvertiserAgreementPostback && this.dealAdvertiserAgreementPostbackId) {

				this.fetchDealAdvertiserAgreementPostback();

			} else {

				this.dataLoaded = true;

			}

		},	

	    methods: {

			fetchDealAdvertiserAgreementPostback() {

				showModel(this.dealAdvertiserAgreementPostbackId).then( res => {

					this.dealAdvertiserAgreementPostback = res;

					this.dataLoaded = true;

				})

			},	

	    }

	}

</script>