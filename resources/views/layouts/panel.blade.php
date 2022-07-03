@extends('layouts.app')

@section('content')
    <aside>
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="dashboard">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Dashboard</h5>
              <button type="button" class="btn-close d-md-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
            </div>
          </div>
    </aside>
    <div id="board">
        @yield('board')
    </div>
@endsection