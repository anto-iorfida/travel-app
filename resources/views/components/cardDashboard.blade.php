@props([
    'user',
    'tripsCount',
    'totalRatingCount',
    'totalRatingAvg',
    'allStops',
    'tripCountries',
    'stopCities',
    'tripCities',
])
<section id="cardDashboard">
    <div class="container">
        <div class="row">
            <h2 class="fs-1 text-center">I tuoi Record</h2>
            <div class="col-md-6 col-xl-4 my-2">
                <div class="card card-1">
                    <h3 class="fs-1">Viaggi</h3>
                    <p class=" paragrafo">Complimenti <strong class="fs-2">{{ $user->name }}</strong> hai realizzato
                        un totale di <span class="countTrip ">{{ $tripsCount }}</span> Viaggi.</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 my-2">
                <div class="card card-3">
                    <h3 class="fs-1">Tappe</h3>
                    <p class="paragrafo">
                    <ul>
                        <li class="paragrafo p-1">Tappe totali realizzate: <span
                                class="countTrip">{{ $allStops }}</span></li>
                    </ul>
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 my-2">
                <div class="card card-2 ">
                    <h3 class="fs-1">Recensioni</h3>
                    <ul>
                        <li class="paragrafo p-1">Recensioni totali: <span
                                class="countTrip ">{{ $totalRatingCount }}</span></li>
                        <li class="paragrafo p-1">Media Recensioni: <span
                                class="countTrip ">{{ $totalRatingAvg }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <h2 class="fs-1 text-center">Le tue preferenze</h2>
            <div class="col-md-6 col-xl-6 my-2">
                <div class="card card-4 ">
                    <h3 class="fs-1">Paesi</h3>
                    <div class="fw-bold fs-5 text-secondary">Paesi visitati</div>
                    <ul class="w-75 overflow-y-auto">
                        @foreach ($tripCountries as $item)
                            <li class="paragrafo">{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-xl-6 my-2">
                <div class="card card-5 ">
                    <h3 class="fs-1">Città</h3>
                    <div class="fw-bold fs-5 text-secondary">Città visitate</div>
                    <ul class="w-75 overflow-y-auto">
                        @foreach ($tripCities as $item)
                            @if ($item)
                                <li class="paragrafo">{{ $item }}</li>
                            @endif
                        @endforeach
                        @foreach ($stopCities as $item)
                            @if ($item)
                                <li class="paragrafo">{{ $item }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
