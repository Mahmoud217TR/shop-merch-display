<template>
    <!-- Modal -->
    <div class="modal fade" id="productModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">{{modalTitle}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form ref="modal-form" class="container" @submit.prevent="submitForm()">
                <div class="modal-body">
                <p v-if="!modalDisplayform">{{ modalBodyText }}</p>
                    <input type="text" hidden name="id" id="id" ref="id">

                    <div v-if="modalDisplayform" class="container">
                        <div class="row">
                            <div class="col">
                                <label for="category">Category:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select id="category" class="form-select" required ref="category">
                                    <option>Category</option>
                                    <option v-for="category in categories" :value="category.id ">{{ category.name }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="name">Name:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input id='name' type="text" class="form-control" required ref="name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="price">Price:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input id='price' type="number" min="0" class="form-control" required ref="price">
                            </div>
                        </div>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" ref='modal-close-button'>Close</button>
                    <button type="submit" class="btn btn-primary">{{ modalButtonText }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Controls & Display -->
    <div class="container-fluid">
        <!-- Controls -->
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Sort By</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Category</a></li>
                        <li><a class="dropdown-item" href="#">Name</a></li>
                        <li><a class="dropdown-item" href="#">Price</a></li>
                    </ul>
                    <input type="text" class="form-control bg-white" aria-label="Text input with dropdown button" placeholder="Search...">
                </div>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal" @click="createForm()">
                    Add new Product
                </button>
            </div>
        </div>
        <!-- Display -->
        <div class="row">
            <div class="col">
                <table class="table table-dark table-striped-columns">
                    <tbody>
                        <tr>
                            <th class="col-1" scope="col">ID</th>
                            <th class="col-3" scope="col">Category</th>
                            <th class="col-4" scope="col-md-6">Name</th>
                            <th class="col-3" scope="col">Price</th>
                            <th class="col-1" scope="col">Options</th>
                        </tr>
                        <tr v-for="product in products">
                            <td>{{ product.id }}</td>
                            <td>{{ product.category }}</td>
                            <td>{{ product.name }}</td>
                            <td>{{ product.price }}</td>
                            <td>
                                <button class="btn btn-sm btn-success me-2 my-1"><i class="bi bi-pencil-fill"></i></button>
                                <button class="btn btn-sm btn-danger my-1"><i class="bi bi-trash3-fill"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['indexUri','storeUri','updateUri','destroyUri'],
        data() {
            return {
                products: [],
                categories: [],
                modalState: null,
                modalTitle: null,
                modalButtonText: null,
                modalDisplayform: null,
                modalBodyText: null,
            }
        },
        methods: {
            getProducts(){
                axios.get(this.indexUri).then(response => {
                    this.products = response.data.products;
                    this.categories = response.data.categories;
                });
            },
            createForm(){
                this.initModal("Add a new Product", "Add", true, 'create');
            },
            initModal(title, buttonText, displayForm, state){
                this.modalTitle = title;
                this.modalButtonText = buttonText;
                this.modalDisplayform = displayForm;
                this.modalState = state;
            },
            submitForm(){
                switch(this.modalState){
                    case 'create':{
                        this.createNewProduct();
                        break;
                    }
                    case 'update':{
                        break;
                    }
                    case 'delete':{
                        break;
                    }
                    default:{
                        // Do nothing
                    }
                }
            },
            createNewProduct(){
                axios.post(this.storeUri,{
                    name: this.$refs.name.value,
                    price: this.$refs.price.value,
                    category_id: this.$refs.category.value,
                }).then(response => {
                    if(response.data.code == 200){
                        this.getProducts();
                        this.discardForm();
                    }
                });
            },
            discardForm(){
                this.$refs['modal-form'].reset();
                this.$refs['modal-close-button'].click();
            }
        },
        mounted() {
            this.getProducts()
        },
    }
</script>
