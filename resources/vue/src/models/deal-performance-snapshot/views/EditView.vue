<template>

	<div class="flex justify-center items-center">
			
		<div class="max-w-2xl w-full">
			
			<div class="card bg-white dark:bg-slate-600 border rounded-lg px-8 pt-6 pb-8 mb-4 dark:border-slate-800">

				<edit-form 
					:key="$route.params.id"
					:deal-performance-snapshot-id="$route.params.id"
					@submit="formSubmit"/>

			</div>

		</div>

	</div>

</template>

<script>

	import { getPolicy } from '@dealsModels/deal-performance-snapshot'
	import EditForm from '@dealsModels/deal-performance-snapshot/forms/EditForm.vue'

	export default {

		components: {
			
			EditForm

		},

		emits: ['updateData'],

		mounted() {

			this.fetchEditPolicy();

		},

		methods: {

			fetchEditPolicy() {

				getPolicy('update', this.$route.params.id).then( res => {

					if(!res.data.update) {

						// this.$router.push({name: "NotAuthorized" });
						
					}

                });

			},

			formSubmit(payload) {	

				this.$emit('updateData', payload);

				this.$router.push({

					name: "AdminShowDealPerformanceSnapshot", 

					params: { 

						id: payload.data.id 

					} 

				});

			}

		}

	}

</script>