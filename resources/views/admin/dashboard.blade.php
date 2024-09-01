@extends('layouts.admin')
@section('content')
        <div class="container">
            <a id="btnFormStop">
                <i id="icon-btn-form-stop"
                    class="fs-1 fa-solid fa-circle-plus mb-2 d-flex align-items-center my-fa-circle-plus position-relative z-2">
                    <span role="button" class="border-0 ms-3 fs-3 fw-bold content-btn">Aggiungi un viaggio</span></i>
            </a>
            <x-formCard />
            <div class="row">
                <div class="col text-center mb-5">
                    <h2 class="display-4 text-center font-weight-bolder text-black">
                        {{ __('Dashboard') }}
                    </h2>
                    <p class="lead">Eccoti qui nella tua dashboard</p>
                </div>
            </div>

            <div class="row justify-content-center mb-4 text-center">
                <div class="col-12 col-lg-6">
                    <div class="my-card-user">
                        <div class="my-card-header"><strong>{{ __('Ciao viaggiatore!') }}</strong></div>

                        <div class="my-card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div>
                                {{ __('Finalmente sei qui') }} <strong>{{ $user->name }}!</strong>
                            </div>
                            <div>
                                Ti sei loggato con la mail: {{ $user->email }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-cardDashboard :user="$user" :tripsCount="$tripsCount" :totalRatingCount="$totalRatingCount" :totalRatingAvg="$totalRatingAvg" :allStops="$allStops"
                :tripCountries="$tripCountries" :stopCities="$stopCities" :tripCities="$tripCities" />
        </div>
@endsection
@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnForm = document.getElementById('btnFormStop');
        const showForm = document.getElementById("create-form");
        getBtnToggle(btnForm, showForm);
    })
</script>
