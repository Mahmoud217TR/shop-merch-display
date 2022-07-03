@extends('layouts.panel')

@section('board')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <products-component products-uri="{{ route('product.index') }}"></products-component>
        </div>
    </div>
</div>
@endsection
