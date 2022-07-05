@extends('layouts.panel')

@section('board')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card bg-dark text-white">
                <div class="card-header"><div class="fw-bold">Highest Products Prices</div></div>

                <div class="card-body">
                    <bar-chart-component width='400' height='300' label='Highest Products Prices' 
                    v-bind:data='@json($productChart["data"])' v-bind:colors='@json($productChart["colors"])'
                    v-bind:labels='@json($productChart["labels"])'></bar-chart-component>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-dark text-white">
                <div class="card-header"><div class="fw-bold">Categories</div> </div>

                <div class="card-body">
                    <pie-chart-component width='400' height='300' label='Categoies' 
                    v-bind:data='@json($categoryChart["data"])' v-bind:colors='@json($categoryChart["colors"])'
                    v-bind:labels='@json($categoryChart["labels"])'></pie-chart-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
