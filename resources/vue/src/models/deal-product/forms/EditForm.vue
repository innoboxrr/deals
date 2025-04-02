<template>
	
	<form :id="formId" @submit.prevent="onSubmit">      

        <!-- NAME -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="name"
            label="Nombre"
            placeholder="Nombre del producto"
            validators="required length"
            :min_length="3"
            v-model="dealProduct.name" />

        <!-- DESCRIPTION -->
        <textarea-input-component
            :custom-class="inputClass"
            name="description"
            label="Descripción"
            placeholder="Descripción del producto"
            validators="required length"
            :min_length="3"
            v-model="dealProduct.description" />

        <!-- IMAGE UPLOAD -->
        <div>
            <label class="uk-form-label">Imagen</label>
            <file-input-component 
                :upload-url="fileUploadUrl"
                :auto-upload="true"
                :show-top-preview="true"
                :hide-on-max-files-reached="true"
                :valid-mimes="[ 'image/jpeg', 'image/png' ]"
                message="Da clic o arrastra una imagen para subir"
                @updateFileList="onImageUpload" />
        </div>

        <!-- PRICE -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="price"
            label="Precio"
            placeholder="Precio del producto"
            validators="required decimal"
            v-model="dealProduct.payload.price" />

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
        FileInputComponent,
        ButtonComponent,
    } from 'innoboxrr-form-elements'
    
	export default {
        components: {
            TextInputComponent,
            TextareaInputComponent,
            FileInputComponent,
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
                    payload: {
                        image: '',
                        price: '',
                    }
                },
                disabled: false,
                JSValidator: undefined,
            }
        },

        mounted() {
            this.fetchData(); 
            this.JSValidator = new JSValidator(this.formId).init();
            this.JSValidator.status = true;
        },

        methods: {

            fetchData() {
                this.fetchDealProduct();
            },

            fetchDealProduct() {
                showModel(this.dealProductId).then(res => {
                    this.dealProduct = res;
                });
            },

            onImageUpload(files) {
                if (files?.[0]?.path) {
                    this.dealProduct.payload.image = files[0].path;
                }
            },

            onSubmit() {
                if (this.JSValidator.status) {
                    this.disabled = true;
                    updateModel(this.dealProduct.id, {
                        name: this.dealProduct.name,
                        description: this.dealProduct.description,
                        image: this.dealProduct.payload.image,
                        price: this.dealProduct.payload.price,
                    }).then(res => {
                        this.$emit('submit', res);
                        setTimeout(() => { this.disabled = false; }, 2500);
                    }).catch(error => {
                        this.disabled = false;
                        if (error?.response?.status === 422)
                            this.JSValidator.appendExternalErrors(error.response.data.errors);
                    });
                } else {
                    this.disabled = false;
                }
            }
        }
	}
</script>
