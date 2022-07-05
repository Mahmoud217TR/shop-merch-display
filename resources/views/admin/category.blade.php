@extends('layouts.panel')

@section('title','Categories')

@section('board')
<div class="container">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1><i class="bi bi-inboxes-fill me-2"></i><span>Categories</span></h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <hr>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <categories-component index-uri="{{ route('category.index') }}" store-uri="{{ route('category.store') }}"
            update-uri="{{ route('category.update') }}" destroy-uri="{{ route('category.destroy') }}"
            search-uri="{{ route('category.search') }}"></categories-component>
        </div>
    </div>
</div>
@endsection
