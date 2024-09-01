@extends('layouts.app')

@section('content')

    <body class="overflow-y-hidden">
        <section id="login-scss">
            <div class="wrapper">
                <div class="background">
                    <div class="shape"></div>
                    <div class="shape"></div>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h3>Login Here</h3>

                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="row my-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check d-flex flex-column">
                                <input class="form-check-input my-check" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label mt-0" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit">Log In</button>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </form>
            </div>

        </section>
    </body>
@endsection
