<template>
    <!-- Modal -->
    <div class="modal fade" id="productModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">{{modal.title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form ref="modal-form" class="container" @submit.prevent="submitForm()">
                <div class="modal-body">
                <p v-if="!modal.displayform">{{ modal.bodyText }}</p>
                    <input type="text" hidden name="id" :value="input.id" ref="id">

                    <div v-if="modal.displayform" class="container">
                        <div class="row">
                            <div class="col">
                                <label for="category_id">Category:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select id="category_id" class="form-select" required ref="category_id" >
                                    <option value="0">Category</option>
                                    <option v-for="category in categories" :value="category.id" :selected="category.id==input.category_id">{{ category.name }}</option>
                                </select>
                                <span v-if="errors.category_id" class="text-danger fw-bold" role="alert">
                                        {{errors.category_id}}
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="name">Name:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input id='name' type="text" class="form-control" required :value="input.name" ref="name">
                                <span v-if="errors.name" class="text-danger fw-bold" role="alert">
                                        {{errors.name}}
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="price">Price:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input id='price' type="number" min="0" step="any" class="form-control" required :value="input.price" ref="price">
                                <span v-if="errors.price" class="text-danger fw-bold" role="alert">
                                        {{errors.price}}
                                </span>
                            </div>
                        </div>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" ref='modal-close-button'>Close</button>
                    <button type="submit" class="btn" :class="'btn-'+modal.btn_class">{{ modal.buttonText }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Controls & Display -->
    <div class="container-fluid">
        <!-- Controls -->
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Sort By</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" @click="searchProducts('id','ASC')">ID ASC</a></li>
                        <li><a class="dropdown-item" href="#" @click="searchProducts('id','DESC')">ID DESC</a></li>
                        <li><a class="dropdown-item" href="#" @click="searchProducts('name','ASC')">Name ASC</a></li>
                        <li><a class="dropdown-item" href="#" @click="searchProducts('name','DESC')">Name DESC</a></li>
                        <li><a class="dropdown-item" href="#" @click="searchProducts('price','ASC')">Price ASC</a></li>
                        <li><a class="dropdown-item" href="#" @click="searchProducts('price','DESC')">Price DESC</a></li>
                    </ul>
                    <input type="text" class="form-control bg-white" aria-label="Text input with dropdown button"
                    placeholder="Search..." @keyup="searchProducts()" ref="keyword">
                </div>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#productModal" @click="createForm()">
                    Add new Product
                </button>
                <a :href="excelUri" class="btn btn-success me-2"><i class="bi bi-file-spreadsheet-fill"></i></a>
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
                            <td>{{ product.category_name }}</td>
                            <td>{{ product.name }}</td>
                            <td>{{ product.price }}</td>
                            <td>
                                <button class="btn btn-sm btn-success me-2 my-1" data-bs-toggle="modal" data-bs-target="#productModal" @click="editForm(product.id)">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <button class="btn btn-sm btn-danger my-1" data-bs-toggle="modal" data-bs-target="#productModal" @click="deleteForm(product.id)">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
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
        props:['indexUri','storeUri','updateUri','destroyUri','searchUri','excelUri'],
        data() {
            return {
                products: [],
                categories: [],
                modal: {
                    state: null,
                    title: null,
                    buttonText: null,
                    displayform: null,
                    btn_class: null,
                    bodyText: null,
                },
                input: {
                    id: 0,
                    name: null,
                    price: null,
                    category_id: 0,
                },
                errors: {
                    name: null,
                    price: null,
                    category_id: null,
                },
                search: {
                    keyword: null,
                }
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
                this.initModal("Add a new Product", "Add", true, 'create', 'primary');
                this.initForm();
            },
            editForm(productId){
                let product =  this.products.find(product => product.id === productId);
                this.initModal("Editing Product "+product.name, "Update", true, 'update', 'success');
                this.initForm(product.id, product.name, product.price, product.category_id);
                this.clearErrors();
            },
            deleteForm(productId){
                let product =  this.products.find(product => product.id === productId);
                this.initModal("Deleting Product "+product.name, "Delete", false, 'delete', 'danger',"Are you sure you want to delete this product?");
                this.initForm(product.id);
                this.clearErrors();
            },
            initModal(title, buttonText, displayForm, state, btn_class, bodyText){
                this.modal.title = title;
                this.modal.buttonText = buttonText;
                this.modal.displayform = displayForm;
                this.modal.state = state;
                this.modal.btn_class = btn_class;
                this.modal.bodyText = bodyText
            },
            initForm(id = "", name = "", price = "", category_id = 0,){
                this.input.id = id
                this.input.name = name
                this.input.price = price
                this.input.category_id = category_id
            },
            submitForm(){
                this.clearErrors();
                switch(this.modal.state){
                    case 'create':{
                        this.createNewProduct();
                        break;
                    }
                    case 'update':{
                        this.updateProduct();
                        break;
                    }
                    case 'delete':{
                        this.removeProduct();
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
                    category_id: this.$refs.category_id.value,
                }).then(response => {
                    if(response.data.code == 200){
                        this.getProducts();
                        this.discardForm();
                    }else{
                        this.displayErrors(response.data.errors)
                    }
                });
            },
            updateProduct(){
                axios.patch(this.updateUri,{
                    id: this.$refs.id.value,
                    name: this.$refs.name.value,
                    price: this.$refs.price.value,
                    category_id: this.$refs.category_id.value,
                }).then(response => {
                    if(response.data.code == 200){
                        this.getProducts();
                        this.discardForm();
                    }else{
                        this.displayErrors(response.data.errors)
                    }
                });
            },
            removeProduct(){
                axios.delete(this.updateUri,{ data:{
                    id: this.$refs.id.value,
                }}).then(response => {
                    this.getProducts();
                    this.discardForm();
                    console.log(response.data)
                });
            },
            discardForm(){
                this.$refs['modal-form'].reset();
                this.$refs['modal-close-button'].click();
            },
            displayErrors(errors){
                for(var [key, value] of Object.entries(errors)){
                    this.errors[key] = value[0]
                }
            },
            clearErrors(){
                this.errors.category_id = "";
                this.errors.name = "";
                this.errors.price = "";
            },
            searchProducts(order='', orderType='ASC'){
                axios.get(this.searchUri,{
                    params:{
                        keyword: this.$refs.keyword.value,
                        order: order,
                        type: orderType,
                    }
                }).then(response => {
                    this.products = response.data.products;
                });
            }
        },
        mounted() {
            this.getProducts()
        },
    }
</script>
