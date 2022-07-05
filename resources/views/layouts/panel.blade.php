@extends('layouts.app')

@section('content')
    <aside>
        <div class="offcanvas offcanvas-start p-3 text-white bg-dark" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="dashboard">
            <div class="d-flex mb-3 mb-md-0 me-md-auto align-items-center justify-content-between">
              <a href="/" class="d-flex align-items-center text-white text-decoration-none">
                <img src="{{ asset('images/logo.svg') }}" alt="logo" width="40" height="40" class="bg-light rounded-circle me-3">
                <span class="fs-4">{{ config('app.name', 'Laravel') }}</span>
            </a>
            <button type="button" class="btn-close btn-close-white d-md-none " data-bs-dismiss="offcanvas" aria-label="Close"></button>  
            </div>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link @activeroute('home')">
                      <i class="bi bi-house-fill me-2"></i><span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.category') }}" class="nav-link @activeroute('admin.category')">
                      <i class="bi bi-inboxes-fill me-2"></i><span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.product') }}" class="nav-link @activeroute('admin.product')">
                      <i class="bi bi-box2-fill me-2"></i><span>Products</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link @activeroute('admin.settings')">
                      <i class="bi bi-gear-fill me-2"></i><span>Settings</span>
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle fs-3 me-2"></i>
                    <strong>{{ auth()->user()->name }}</strong>
                </a>
              <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <form action="{{ route('logout') }}" method="post" id="logout-form">
                  @csrf
                </form>
                <li><a class="dropdown-item" href="#" onclick="document.getElementById('logout-form').submit()">Sign out</a></li>
              </ul>
            </div>
        </div>
    </aside>
    <div id="board" class="pt-3">
        @yield('board')
    </div>
@endsection