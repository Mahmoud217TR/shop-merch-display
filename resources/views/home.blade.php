@extends('layouts.panel')

@section('board')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <products-component index-uri="{{ route('product.index') }}" store-uri="{{ route('product.store') }}"
            update-uri="{{ route('product.update') }}" destroy-uri="{{ route('product.destroy') }}"
            search-uri="{{ route('product.search') }}"></products-component>
        </div>
    </div>
</div>
@endsection
