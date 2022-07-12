<template>
    <div class="row mb-3">
        <div class="col-md-4 offset-md-8">
            <div class="d-flex">
                <input class="form-control" list="datalistOptions" id="search" placeholder="Type to search..." ref="search" @keyup="search()">
                <datalist id="datalistOptions">
                    
                </datalist>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-3 col-md-4 col-sm-6 mb-3" v-for="product in products">
            <div class="card slide-bottom">
                <img :src="product.image" class="card-img-top bg-secondary" width="200" height="100" alt="product">
                <div class="card-body">
                    <h5 class="card-title">{{ product.name }}</h5>
                    <p class="card-text">
                        <span class="text-primary fw-bold">Category: {{ product.category_name }}</span>
                        <br>
                        <span class="text-success fw-bold">Price: {{ product.price }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col" v-if="products.length < 1">
            <p class="display-5 text-center slide-bottom" style="padding-top: 10rem; padding-bottom: 10rem;">
                No Products
            </p>
        </div>
    </div>
</template>
<script>
export default {
    props:['productsUri', 'searchUri'],
    data() {
        return {
            products: [],
        }
    },
    methods: {
        getProducts(){
            axios.get(this.productsUri).then(response => {
                this.products = response.data.products;
            });
        },
        search(){
            axios.get(this.searchUri,{
                    params:{
                        keyword: this.$refs.search.value,
                    }
                }).then(response => {
                    this.products = response.data.products;
            });
        },
    },
    created() {
        this.getProducts()
    },
}
</script>