@extends('layouts.panel')

@section('title','Settings')

@section('board')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="fw-bold"><i class="bi bi-gear-fill me-2"></i><span>Settings</span></h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <hr>
            </div>
        </div>
        @include('admin.settings.user')
        <div class="row">
            <div class="col">
                <hr>
            </div>
        </div>
    </div>
@endsection