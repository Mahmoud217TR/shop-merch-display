@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col">
            <h1 class="text-center fw-bold">Our Products</h1>
        </div>
    </div>
    <div class="row row-cols-md-3">
        @forelse ( $products as $product )
            <div class="col mb-3">
                <div class="card">
                    <div class="card-header">
                        <p class="card-title">{{ $product->name }}</p>
                    </div>
                    <div class="card-body">
                        <p class="card-content">{{ $product->category->name }}</p>
                    </div>
                    <div class="card-footer">
                        Price: <span class="text-success">{{ $product->price }}</span>
                    </div>
                </div>
            </div>
        @empty
            <p class="display-5 text-center mt-5"> No products yet!</p>
        @endforelse
    </div>
</div>
@endsection