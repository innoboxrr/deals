<template>

    <div v-if="dataLoaded" class="flex flex-col gap-4">

        <!-- Si no hay producto. Mostrar form para crear producto -->
        <ProductCreateForm
            v-if="mode === 'create' && !product_id"
            :deal-id="localDeal.id"
            @submit="onProductCreated" />

        <!-- Si hay producto. Mostrar formulario para editar producto -->
        <ProductEditForm
            v-if="mode === 'edit' && product_id"
            :deal-product-id="product_id"
            @submit="onProductUpdated" /> 

    </div>
    
</template>

<script>
    import {  
        indexModel as indexProductModel,
        deleteModel as deleteModelProduct 
    } from '@dealsModels/deal-product'
    import ProductCreateForm from '@dealsModels/deal-product/forms/CreateForm.vue'
    import ProductEditForm from '@dealsModels/deal-product/forms/EditForm.vue'

    export default {
        name: 'StepGateway',
        components: {
            ProductCreateForm,
            ProductEditForm,
        },
        props: {
            modelValue: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                dataLoaded: false,
                mode: 'create',
                product_id: null,
                product: null,
            }
        },
        async mounted() {
            await this.fetchData();
            this.dataLoaded = true;
        },
        computed: {
            localDeal: {
                get() {
                    return this.modelValue
                },
                set(value) {
                    this.$emit('update:modelValue', value)
                }
            }
        },
        watch: {
            localDeal: {
                handler(val) {
                    this.$emit('validated', true)
                },
                deep: true,
                immediate: true
            }
        },
        methods: {
            fetchData() {
                if (this.localDeal.product) {
                    this.setProduct(this.localDeal.product);
                } else {
                    this.fetchProduct();
                }
            },
            async fetchProduct() {
                let res = await indexProductModel({
                    paginate: 0,
                    deal_id: this.localDeal.id,
                });
                if (res.length > 0) {
                    this.setProduct(res[0]);
                } else {
                    this.unsetProduct();
                }
            }, 
            setProduct(product) {
                this.product = product,
                this.product_id = product.id,
                this.mode = 'edit'
                this.$emit('validated', true)
            },
            unsetProduct() {
                this.product = null
                this.product_id = null
                this.mode = 'create'
                this.$emit('validated', false)
            },
            onProductCreated(product) {
                this.setProduct(product)
            },
            onProductUpdated(product) {
                this.setProduct(product)
            },
            onProductDeleted() {
                this.unsetProduct()
            }
        }
    }
</script>
