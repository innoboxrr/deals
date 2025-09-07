<template>
	<div>
		<div class="flex justify-center items-center mt-8">	
			<div class="max-w-2xl w-full">
				<div class="card bg-white dark:bg-slate-600 border rounded-lg px-8 pt-6 pb-8 mb-4 dark:border-slate-800">
					<page-header 
						:title="__deals('Create Product')" 
						:description="__deals('Fill the form to create a new product')"/>
					<create-form 
						@submit="formSubmit"/>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

	import { getPolicy } from '@dealsModels/deal-product'
	import CreateForm from '@dealsModels/deal-product/forms/CreateForm.vue'
	import PageHeader from '@dealsComponents/partials/PageHeader.vue'

	export default {
		components: {
			CreateForm,
			PageHeader
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
					name: "AdminShowDealProduct", 
					params: { 
						id: payload.data.id 
					} 
				});
			}
		}
	}
</script>