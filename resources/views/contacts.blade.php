@extends('layouts.app')

@section('title','Contacts')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="contact-container dark-contact-container active-container">
                    <div class="contact-name">
                        <h2>Marlo</h2>
                    </div>
                    <div class="contacts">
                        <div class="contact">
                            <p class="contact-info">0912345678</p>
                        </div>
                        <div class="contact">
                            <p class="contact-info">@Someone</p>
                        </div>
                        <div class="contact">
                            <p class="contact-info">@other</p>
                        </div>
                        <div class="contact">
                            <p class="contact-info">@Test</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection