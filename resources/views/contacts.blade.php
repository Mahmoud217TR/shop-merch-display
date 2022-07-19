@extends('layouts.app')

@section('title','Contacts')

@section('content')
    <div class="container-fluid contacts-container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="fw-bold">Contacts</h1>
            </div>
        </div>
        <div class="row slide-bottom">
            <div class="col-md-6 d-flex justify-content-center">
                <contact-component name='Contact Name' 
                    contact1='0912345678' contact2='@telegram'
                    contact3='@facbook' contact4='@twitter'>
                </contact-component>
            </div>
        </div>
    </div>
@endsection