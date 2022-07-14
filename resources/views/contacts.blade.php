@extends('layouts.app')

@section('title','Contacts')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <contact-component name='Contact Name' 
                contact1='0912345678' contact2='@telegram'
                contact3='@facbook' contact4='@twitter'></contact-component>
            </div>
        </div>
    </div>
@endsection