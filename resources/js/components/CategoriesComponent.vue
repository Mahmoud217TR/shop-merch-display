<template>
    <!-- Modal -->
    <div class="modal fade" id="categoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">{{modal.title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form ref="modal-form" class="container" @submit.prevent="submitForm()">
                <div class="modal-body">
                    <p v-if="!modal.displayform">{{ modal.bodyText }}</p>
                    <input type="text" hidden name="id" :value="input.id" ref="id">

                    <div v-if="modal.displayform" class="container">
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
                    </ul>
                    <input type="text" class="form-control bg-white" aria-label="Text input with dropdown button"
                    placeholder="Search..." @keyup="searchProducts()" ref="keyword">
                </div>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#categoryModal" @click="createForm()">
                    Add new Category
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
                            <th class="col-5" scope="col">Category</th>
                            <th class="col-5" scope="col">Count</th>
                            <th class="col-1" scope="col">Options</th>
                        </tr>
                        <tr v-for="category in categories">
                            <td>{{ category.id }}</td>
                            <td>{{ category.name }}</td>
                            <td>{{ category.count }}</td>
                            <td>
                                <button class="btn btn-sm btn-success me-2 my-1" data-bs-toggle="modal" data-bs-target="#categoryModal" @click="editForm(category.id)">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <button class="btn btn-sm btn-danger my-1" data-bs-toggle="modal" data-bs-target="#categoryModal" @click="deleteForm(category.id)">
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
        props:['indexUri','storeUri','updateUri','destroyUri','searchUri'],
        data() {
            return {
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
                },
                errors: {
                    name: null,
                },
                search: {
                    keyword: null,
                }
            }
        },
        methods: {
            getCategories(){
                axios.get(this.indexUri).then(response => {
                    this.categories = response.data.categories;
                });
            },
            createForm(){
                this.initModal("Add a new Category", "Add", true, 'create', 'primary');
                this.initForm();
            },
            editForm(categoryId){
                let category =  this.categories.find(category => category.id === categoryId);
                this.initModal("Editing Category "+category.name, "Update", true, 'update', 'success');
                this.initForm(category.id, category.name);
                this.clearErrors();
            },
            deleteForm(categoryId){
                let category =  this.categories.find(category => category.id === categoryId);
                this.initModal("Deleting Category "+category.name, "Delete", false, 'delete', 'danger',"Are you sure you want to delete this category with it's prouducts?");
                this.initForm(category.id);
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
            initForm(id = "", name = ""){
                this.input.id = id
                this.input.name = name
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
                }).then(response => {
                    if(response.data.code == 200){
                        this.getCategories();
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
                }).then(response => {
                    if(response.data.code == 200){
                        this.getCategories();
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
                    this.getCategories();
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
                this.errors.name = "";
            },
            searchProducts(order='', orderType='ASC'){
                axios.get(this.searchUri,{
                    params:{
                        keyword: this.$refs.keyword.value,
                        order: order,
                        type: orderType,
                    }
                }).then(response => {
                    this.categories = response.data.categories;
                });
            }
        },
        mounted() {
            this.getCategories()
        },
    }
</script>
