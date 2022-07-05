<div class="row">
    <div class="ms-4 col">
        <h2><i class="bi bi-person-circle me-2"></i> User Settings</h2>
    </div>
</div>
<div class="row">
    <div class="col ms-4">
        <form method="POST" action="#">
            @csrf

            <div class="row">
                <div class="col">
                    <label for="name" class="col-md-4 col-form-label fw-bold">{{ __('Name:') }}</label>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="email" class="col-md-4 col-form-label fw-bold">{{ __('Email Address:') }}</label>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->user()->email }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <label for="password" class="col-md-4 col-form-label fw-bold">{{ __('Password') }}</label>
                </div>
            </div>
            <div class="row mb-3">

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">
                        {{ __('Update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>