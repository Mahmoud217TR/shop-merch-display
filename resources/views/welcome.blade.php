@extends('layouts.app')

@section('content')
<div class="container-fluid main-carousel">
    <div class="row mb-5">
        <div class="col px-0">
            @include('carousel')
        </div>
    </div>
</div>
<div class="container">
    <div class="row mb-3">
        <div class="col">
            <h1 class="text-center fw-bold">Our Products</h1>
        </div>
    </div>
    <div class="row">
        <div class="col"></div>
    </div>
    @include('products.index')
</div>
@endsection