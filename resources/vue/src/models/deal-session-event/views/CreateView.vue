<template>

	<div>

		<breadcrumb-component 
			:pages="[
				{ link: $router.resolve({ name: 'AdminDealSessionEvents' }).fullPath, title: 'DealSessionEvents'},
				{ link: $router.resolve({ name: 'AdminCreateDealSessionEvent' }).fullPath, title: 'Crear DealSessionEvents'}
			]"/>
			
		<div class="flex justify-center items-center mt-8">
			
			<div class="max-w-2xl w-full">
				
				<div class="card bg-white dark:bg-slate-600 border rounded-lg px-8 pt-6 pb-8 mb-4 dark:border-slate-800">

					<h2 class="text-4xl font-bold dark:text-white mb-6">Crear DealSessionEvents</h2>
					
					<create-form 
						@submit="formSubmit"/>

				</div>

			</div>

		</div>

	</div>

</template>

<script>

	import { getPolicy } from '@models/deal-session-event'
	import CreateForm from '@models/deal-session-event/forms/CreateForm.vue'

	export default {

		components: {
			
			CreateForm

		},
		
		emits: ['updateData'],

		mounted(){

			this.fetchCreatePolicy();

		},

		methods: {

			fetchCreatePolicy() {

				getPolicy('create').then( res => {

					if(!res.data.create) {

						// this.$router.push({name: "NotAuthorized" });
						
					}

                });

			},

			formSubmit(payload) {	

				this.$emit('updateData', payload);

				this.$router.push({

					name: "AdminShowDealSessionEvent", 

					params: { 

						id: payload.data.id 

					} 

				});

			}

		}

	}

</script>