@extends('layouts.panel')

@section('board')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <chart-component width='400' height='200' label='Test Chart' 
                    v-bind:data='@json($categoryChart["data"])' v-bind:colors='@json($categoryChart["colors"])'
                    v-bind:labels='@json($categoryChart["labels"])'></chart-component>
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
