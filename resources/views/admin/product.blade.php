@extends('layouts.panel')

@section('title','Products')

@section('board')
<div class="container">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1><i class="bi bi-box2-fill me-2"></i><span>Products</span></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <hr>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <products-component index-uri="{{ route('product.index') }}" store-uri="{{ route('product.store') }}"
            update-uri="{{ route('product.update') }}" destroy-uri="{{ route('product.destroy') }}"
            search-uri="{{ route('product.search') }}" excel-uri="{{ route('product.export') }}"></products-component>
        </div>
    </div>
</div>
@endsection
