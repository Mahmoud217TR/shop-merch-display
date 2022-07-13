@extends('layouts.app')

@section('title','About')

@section('content')
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="fw-bold mb-3">About {{ config('app.name') }}</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates dicta dolor laborum neque tempore explicabo omnis fuga eligendi exercitationem dolores nemo libero ex, molestias excepturi commodi! Inventore vel laboriosam aperiam excepturi deleniti quisquam labore asperiores voluptatem rem, enim quos laudantium optio dolore maiores. Officiis itaque expedita reprehenderit asperiores mollitia soluta nesciunt porro facilis maiores commodi ducimus, placeat qui, autem blanditiis! Quaerat inventore in vitae praesentium aut quisquam debitis fuga, aperiam rem facilis animi iste sequi labore laboriosam dignissimos? Tempore, unde? Quisquam, sequi repellendus! Ratione autem error a perferendis voluptatum distinctio pariatur quos cumque. Minima optio quidem nihil voluptates facere ipsa?
                </p>
            </div>
            <div class="col-md-4 offset-md-2">
                <img src="{{ asset('images/about.svg') }}" style="width:100%" alt="about">
            </div>
        </div>
    </div>
@endsection