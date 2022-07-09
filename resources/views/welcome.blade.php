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
            <h1 class="fw-bold">Our Products</h1>
        </div>
    </div>
    
    <products-display-component products-uri="{{ route('welcome.products') }}" search-uri="{{ route('welcome.search') }}"></products-display-component>
</div>
@endsection