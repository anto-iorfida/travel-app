@extends('layouts.admin')
@section('content')
    <section class="trip-index">
        <div class="container">
            <div class="row">
                <div class="col text-center mb-5">
                    <h1 class="display-4 font-weight-bolder text-black mt-5">Cestino viaggi</h1>
                    <p class="lead text-black">Puoi vedere i viaggi che hai cestinato</p>
                </div>
            </div>
            <div class="row">
                @if ($trips->isEmpty())
                    <h2 class="text-black">Non ci sono viaggi nel cestino</h2>
                @endif
                @if (!$trips->isEmpty())

                <div class="mb-5">
                    @if ($trips->count() > 1)
                    <div class="d-flex justify-content-end">
                        <form action="{{ route('admin.garbages.restoreall') }}" method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-success rounded-pill">
                                <i class="fa-solid fa-recycle"></i>
                                 Ripristina tutte le card
                            </button>
                        </form>
                    </div>
                    @endif
                </div>


                    @foreach ($trips as $trip)
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4 position-relative">
                        <article class="card">
                            @if ($trip->thumb)
                                <!-- Mostra l'immagine caricata dall'utente -->
                                <img class="card__background" src="{{ asset('storage/' . $trip->thumb) }}">
                            @elseif($trip->country && file_exists(public_path('img/country/' . $trip->country . '.png')))
                                <!-- Mostra l'immagine specifica per il paese se non è stata caricata un'immagine -->
                                <img class="card__background" style="object-position: center"
                                    src="{{ asset('img/country/' . $trip->country . '.png') }}">
                            @else
                                <!-- Mostra l'immagine di default se non è stata caricata un'immagine e non esiste un'immagine specifica per il paese -->
                                <img class="card__background" style="object-position: center"
                                    src="{{ asset('img/default.png') }}">
                            @endif

                            <div class="card__content w-100">
                                <div class="card__content--container">
                                    <h2 class="card__title pt-3">
                                        <a class="link-light link-underline-opacity-0"
                                            href="{{ route('admin.trips.show', ['trip' => $trip->id]) }}">
                                            {{ $trip->title }}
                                        </a>
                                    </h2>
                                </div>
                                <div class="d-flex mt-3 gap-2">
                                        @if ($trip->trashed())
                                        <form action="{{ route('admin.garbages.restore', $trip->id) }}"
                                        method="POST">
                                        @csrf
                                            <button type="submit" class="btn btn-success ms-index rounded-pill">
                                                <i class="fa-solid fa-recycle"></i>
                                            </button>
                                        </form>
                                    @endif
                                    </div class="d-flex">
                                </div>
                            </article>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </section>



@endsection
