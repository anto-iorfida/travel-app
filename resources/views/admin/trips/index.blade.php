@extends('layouts.admin')

@section('content')
    <section class="trip-index" >
        <div class="container">
            <div class="row">
                <div class="col text-center mb-5">
                    <h1 class="display-4 font-weight-bolder text-black mt-5">Esplora i tuoi viaggi</h1>
                    <p class="lead text-dark">Qui trovi tutte le card dei viaggi creati da te</p>
                </div>
            </div>
            <div class="row">

                @foreach ($trips as $trip)
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4 position-relative">
                        <a href="{{ route('admin.trips.show', ['trip' => $trip->id]) }}" class="link-offset-2 link-underline link-underline-opacity-0 ">
                            <article class="card">
                                @if ($trip->thumb)
                                    <img class="card__background w-100" src="{{ asset('storage/' . $trip->thumb) }}">
                                @elseif($trip->country && file_exists(public_path('img/country/' . $trip->country . '.png')))
                                    <img class="card__background w-100" style="object-position: center"
                                        src="{{ asset('img/country/' . $trip->country . '.png') }}">
                                @else
                                    <img class="card__background w-100" style="object-position: center"
                                        src="{{ asset('img/default.png') }}">
                                @endif
                        
                                <div class="card__content w-100">
                                    <div class="card__content--container">
                                        <h2 class="card__title pt-3">
                                            {{ $trip->title }}
                                        </h2>
                                    </div>
                                    <div class="d-flex mt-3 gap-2">
                                        <a type="button" class="btn btn-primary rounded-pill ms-index"
                                            href="{{ route('admin.trips.edit', ['trip' => $trip->id]) }}"
                                            onclick="event.stopPropagation();">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a type="button"
                                            class="btn btn-danger js-confirm-delete rounded-pill ms-index"
                                            data-trip-id="{{ $trip->id }}" data-trip-title="{{ $trip->title }}"
                                            onclick="event.stopPropagation();">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Modale per cestinare -->
    <div class="modal fade p-0 mt-3 " id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Conferma Eliminazione</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sei sicuro di cestinare questo viaggio: <strong id="trip-title"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <form id="delete-form" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="modal-confirm-deletion" class="btn btn-danger">Cestina</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

