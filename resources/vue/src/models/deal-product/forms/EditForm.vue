<template>
	
	<form :id="formId" @submit.prevent="onSubmit">

		<text-input-component
			class="jsValidator"
			type="text"
			name="name"
			label="Nombre"
			placeholder="Escribe un nombre"
			validators="required"
			v-model="dealProduct.name" />

		<textarea-input-component
			class="jsValidator"
			name="description"
			label="Descripción"
			placeholder="Escribe una descripción"
			validators="required"
			v-model="dealProduct.description" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />
        
    </form>
</template>

<script>

    import { showModel, updateModel } from '@dealsModels/deal-product'
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
                default: 'editDealProductForm'
            },
            dealProductId: {
                type: [Number, String],
                required: true
            }
        },

        emits: ['submit'],

        data() {
            return {
                dealProduct: {
                    name: '',
                    description: '',
                    deal_id: null,
                },
                disabled: false,
                JSValidator: undefined,
            }
        },

        async mounted() {
            await this.fetchData()
            this.JSValidator = new JSValidator(this.formId).init()
            this.JSValidator.status = true
        },

        methods: {

            async fetchData() {
                await this.fetchDealProduct()
            },

            async fetchDealProduct() {
                try {
                    const res = await showModel(this.dealProductId)
                    this.dealProduct = res
                } catch (error) {
                    console.error('Error al obtener dealProduct:', error)
                }
            },

            async onSubmit() {
                if (this.JSValidator.status) {
                    this.disabled = true
                    try {
                        const res = await updateModel(this.dealProduct.id, {
                            name: this.dealProduct.name,
                            description: this.dealProduct.description,
                            deal_id: this.dealProduct.deal_id
                        })
                        this.$emit('submit', res)
                        setTimeout(() => { this.disabled = false }, 2500)
                    } catch (error) {
                        this.disabled = false
                        if (error.response?.status === 422) {
                            this.JSValidator
                                .appendExternalErrors(error.response.data.errors)
                        } else {
                            console.error('Error al actualizar:', error)
                        }
                    }
                } else {
                    this.disabled = false
                }
            }
        }
	}
</script>
