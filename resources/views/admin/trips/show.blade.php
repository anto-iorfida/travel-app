@extends('layouts.admin')
@section('content')
    <section id="trip-show" class="trip-show" data-trip-country="{{ $trip->country }}" data-trip-city="{{ $trip->city }}"
        data-lat-country-show="{{ $trip->latCountry }}" data-lon-country="{{ $trip->lonCountry }}"
        data-lon-city-show="{{ $trip->lonCity }}" data-lat-city-show="{{ $trip->latCity }}">
        <div class="row mt-3">
            <h1 class="text-center mt-3">{{ $trip->title }}</h1>
            <x-cardShow :trip="$trip" />

            <div class="accordion " id="accordionExample" style="padding-bottom: 126px;">
                @foreach ($daysRange as $date)
                    <details class="accordion mb-2">
                        <summary id="activeAccordion" class="accordion-btn color-blue fs-2 fw-bold">
                            Giorno {{ $loop->iteration }}: {{ $date->format('d M Y') }}
                        </summary>
                        <div class="accordion-content p-2 px-3 pt-3" id="my-accordion-create">
                            <div class="d-flex align-items-center">
                                <!--bottone modale -->
                                <a id="btnFormStop" data-toggle="modal"
                                    data-target="#formStopModal-{{ $trip->id }}-{{ $date->format('d-M-Y') }}">

                                    <i id="icon-btn-form-stop"
                                        class="fa-solid fa-circle-plus mb-2 d-flex align-items-center my-fa-circle-plus">
                                        <span role="button" class="pointer border-0 ms-3 fs-3 fw-bold content-btn">AGGIUNGI
                                            TAPPA</span>
                                    </i>
                                </a>
                                <!--/bottone modale -->
                            </div>
                            <!-- modale -->
                            <div class="modal fade my-bg-modal "
                                id="formStopModal-{{ $trip->id }}-{{ $date->format('d-M-Y') }}" tabindex="-1"
                                role="dialog" aria-labelledby="formStopModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <button type="button" class="close py-3 bg-light fs-2" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <x-formAddStop :date="$date->format('Y-m-d')" :tripId="$trip->id" :index="$loop->index"
                                            :trip="$trip" />
                                    </div>
                                </div>
                            </div>
                            <!-- /modale -->

                            <div id="stops-container" class="stops-container" data-index="{{ $loop->index }}">
                                @if (isset($events[$date->format('d M Y')]))
                                    @foreach ($events[$date->format('d M Y')] as $event)
                                        <!-- Assicurati di includere un attributo che permetta l'ordinamento -->

                                        <x-accordionStops :event="$event">
                                            <!-- Existing stops are rendered here -->

                                        </x-accordionStops>
                                    @endforeach
                            </div>
                        @else
                            <p>Nessun evento per questa data.</p>
                @endif
            </div>
            </details>
            @endforeach
        </div>
        <!-- mappa-->
        <div>
            <h3>Visualizza la mappa</h3>
            <div id="map" class="rounded mb-4 mt-3 map " style="height: 400px; width: 100%;"></div>
        </div>
        <!-- /mappa-->
        </div>

    </section>
@endsection
@stack('scripts')

<!-- modale -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- /modale -->

<!-- Librerie di TomTom -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps-web.min.js"></script>
<link rel="stylesheet" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps.css">
@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
