<template>
    <!-- Modal -->
    <div class="modal fade" id="productModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
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
                        <li><a class="dropdown-item" href="#">Name</a></li>
                        <li><a class="dropdown-item" href="#">Price</a></li>
                    </ul>
                    <input type="text" class="form-control bg-white" aria-label="Text input with dropdown button" placeholder="Search...">
                </div>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">
                    Add new Product
                </button>
            </div>
        </div>
        <!-- Display -->
        <div class="row">
            <div class="col">
                
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
