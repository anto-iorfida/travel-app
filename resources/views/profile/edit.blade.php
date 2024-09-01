@extends('layouts.app')
@section('content')

<div class="container">
    <div class="d-flex py-3 justify-content-evenly align-items-center ">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Profile') }}
        </h2>
        <a class="btn btn-secondary " href="{{ route('admin.trips.index') }}">HOME</a>
    </div>
    <div class="card p-4 mb-4 bg-white shadow rounded-lg">

        @include('profile.partials.update-profile-information-form')

    </div>

    <div class="card p-4 mb-4 bg-white shadow rounded-lg">


        @include('profile.partials.update-password-form')

    </div>

    <div class="card p-4 mb-4 bg-white shadow rounded-lg">


        @include('profile.partials.delete-user-form')

    </div>
</div>

@endsection

