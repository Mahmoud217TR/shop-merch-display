@extends('layouts.app')

@section('content')
    <aside>
        <div class="offcanvas offcanvas-start p-3 text-white bg-dark" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="dashboard">
            <div class="d-flex mb-3 mb-md-0 me-md-auto align-items-center justify-content-between">
              <a href="/" class="d-flex align-items-center text-white text-decoration-none">
                <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
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
                    <a href="#" class="nav-link @activeroute('dashboard')">
                      <i class="bi bi-speedometer2 me-2"></i><span>Dashboard</span>
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
              <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1" style="">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
              </ul>
            </div>
        </div>
    </aside>
    <div id="board" class="pt-3">
        @yield('board')
    </div>
@endsection