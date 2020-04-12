@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card border-0 bg-light px-4 py-2">
                {{-- <div class="card-header">{{ __('Register') }}</div> --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Username:</label>

                            <input id="name" type="text" class="form-control
                                @error('name') is-invalid @else border-0 @enderror"
                                name="name" placeholder="Tu nombre de usuario ..."
                                value="{{ old('name') }}" required autocomplete="name"
                                autofocus
                            >

                            @error('name')
                                <span dusk="validation-errors" class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="first_name">Nombre:</label>

                            <input id="first_name" type="text" class="form-control
                                @error('first_name') is-invalid @else border-0 @enderror"
                                name="first_name" placeholder="Tu nombre  ..."
                                value="{{ old('first_name') }}" required autocomplete="first_name"
                            >

                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="last_name">Apellido:</label>

                            <input id="last_name" type="text" class="form-control
                                @error('last_name') is-invalid @else border-0 @enderror"
                                name="last_name" placeholder="Tu apellido  ..."
                                value="{{ old('last_name') }}" required autocomplete="last_name"
                            >

                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

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
                            <label for="password_confirmation">Repite la contraseña:</label>

                            <input id="password_confirmation" type="password" class="form-control border-0"
                                name="password_confirmation" required autocomplete="current-password"
                                placeholder="Repite tu contraseña ..."
                            >
                        </div>

                        <div class="form-group">
                            <button dusk="register-btn" class="btn btn-primary btn-block">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
