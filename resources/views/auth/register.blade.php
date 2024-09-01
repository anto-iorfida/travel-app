@extends('layouts.app')

@section('content')
<div class="  parkside">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="background">
                <div class="shape"></div>
                <div class="shape"></div>
            </div>
            <div class="myCard">
                <div class="card-header">
                    <h2>{{ __('Register') }}</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="my-2 my-lg-0 row d-flex flex-column">
                            <label for="name" class="col col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="my-2 my-lg-0 row d-flex flex-column">
                            <label for="email" class="col col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="my-2 my-lg-0 row d-flex flex-column">
                            <label for="password" class="col col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="my-2 my-lg-0 row d-flex flex-column">
                            <label for="password-confirm" class="col col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="my-2 my-lg-0 row mb-0">
                            <div class="col offset">
                                <button type="submit" class="buttonRegister">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
