@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card border-0 bg-light px-4 py-2">
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{ __('Email') }}:</label>

                            <input id="email" type="email" class="form-control
                                @error('email') is-invalid @else border-0 @enderror"
                                name="email" placeholder="Tu email ..."
                                value="{{ old('email') }}" required autocomplete="email"
                                autofocus
                            >

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}:</label>

                            <input id="password" type="password" class="form-control
                                @error('password') is-invalid @else border-0 @enderror"
                                name="password" required autocomplete="current-password"
                                placeholder="Tu contraseña ..."
                            >

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" id="login-btn" class="btn btn-primary btn-block">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
