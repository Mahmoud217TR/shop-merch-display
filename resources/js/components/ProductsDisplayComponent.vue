<template>
    <div class="row mb-3">
        <div class="col-md-4 offset-md-8">
            <div class="d-flex">
                <input class="form-control" list="datalistOptions" id="search" placeholder="Type to search...">
                <datalist id="datalistOptions">
                    
                </datalist>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 mb-3" v-for="product in products">
            <div class="card">
                <img src="https://via.placeholder.com/150x100.png" class="card-img-top" alt="product">
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
    </div>
</template>
<script>
export default {
    props:['productsUri'],
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
    },
    created() {
        this.getProducts()
    },
}
</script>