@extends('layouts.panel')

@section('title','Products')

@section('board')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <products-component index-uri="{{ route('product.index') }}" store-uri="{{ route('product.store') }}"
            update-uri="{{ route('product.update') }}" destroy-uri="{{ route('product.destroy') }}"
            search-uri="{{ route('product.search') }}" excel-uri="{{ route('product.export') }}"></products-component>
        </div>
    </div>
</div>
@endsection
