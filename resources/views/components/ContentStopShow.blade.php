@props(['event'])
{{-- @dump($event) --}}

<section id="contentStop">
    <header>
    <x-suggestionStop :event="$event" />
    <div class="d-flex justify-content-between p-4">
        <h2><span class="fw-bold">Info tappa</span> - {{ $event->name }}</h2>
    </div>
</header>
<main>
    <div class="px-4">
        {{-- qua dentro tutte le card della show della tappa --}}
        <x-cardStopContent :event="$event" />
        <div id="map"></div>
    </div>
</main>
<footer class="">
    {{-- bottone per richiamare modale di note --}}
    <div class="container text-center my-4">
        <a href="" id="btn-notes" class="btn ms-btn-note ml-2" data-toggle="modal"
            data-target="#notesStopModal-{{ $event->id }}">Aggiungi note</a>
    </div>

    {{-- questa è la modale che apre la funzione per inserire una nuova nota!  --}}
    <x-modals.modalNotes :event="$event">
        {{-- questo è il componente nota  --}}
        <x-noteCard :event="$event" />
    </x-modalNotes>

    {{-- container con valutazione --}}
    <div id="ratingComponentWrapper" class="my-bg-rating py-5">
        <img class="wave position-absolute w-100" style="height: 300px ; z-index:0" src="{{ asset('img/wave-pink.png') }}">
        <x-ratingCard :event="$event" :trip="$event->id_trip" :stop="$event->id" />
    </div>
</footer>
</section>


@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
