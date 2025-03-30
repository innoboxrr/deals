<template>
	
	<form :id="formId" @submit.prevent="onSubmit">      

		<text-input-component
			class="jsValidator"
			type="text"
			name="name"
			label="Nombre"
			placeholder="Escribe un nombre"
			validators="required"
			v-model="name" />

		<textarea-input-component
			class="jsValidator"
			name="description"
			label="Descripción"
			placeholder="Escribe una descripción"
			validators="required"
			v-model="description" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />
        
    </form>
</template>

<script>

    import { createModel } from '@dealsModels/deal-product'
    import JSValidator from 'innoboxrr-js-validator'
    import {
        TextInputComponent,
        TextareaInputComponent,
        ButtonComponent,
    } from 'innoboxrr-form-elements'
	
	export default {

        components: {
            TextInputComponent,
            TextareaInputComponent,
            ButtonComponent,
        },

        props: {
        	formId: {
        		type: String,
        		default: 'createDealProductForm',
        	},
			dealId: {
				type: [String, Number],
				required: true
			}
        },

        emits: ['submit'],

        data() {
            return {
                name: '',
                description: '',
                disabled: false,
                JSValidator: undefined,
            }
        },

        mounted() {
            this.fetchData();
            this.JSValidator = new JSValidator(this.formId).init();
        },

        methods: {

            fetchData() {},

            onSubmit() {
                if(this.JSValidator.status) {
                    this.disabled = true;
                    createModel({
                        name: this.name,
                        description: this.description,
                        deal_id: this.dealId
                    }).then( res => {
                        this.$emit('submit', res);
                        setTimeout(() => { this.disabled = false; }, 2500);
                    }).catch(error => {
                        this.disabled = false;
                        if(error.response.status == 422)
                            this.JSValidator
                                .appendExternalErrors(error.response.data.errors);
                    });
                } else {
                    this.disabled = false;
                }
            }
        }
	}
</script>
