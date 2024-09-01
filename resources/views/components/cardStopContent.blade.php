@props(['event'])
<section id="cardStopContent">
    <div class="p-2">
        <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3 text-white">


            <div class="col">
                <div class="card-stop l-bg-green-dark border-0 text-white">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-solid fa-earth-europe"></i></div>
                        <div class="mb-2">
                            <h2 class="card-title">Location</h2>
                        </div>
                        <div class="d-flex">
                            <div>
                                <h3 class="d-flex align-items-center pb-1">
                                    {{ $event->country }} - {{ $event->city }}
                                </h3>
                                <span class="fs-5">{{ $event->street }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card-stop l-bg-blue-dark border-0 text-white">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-solid fa-quote-right"></i></div>
                        <div class="mb-2">
                            <h2 class="card-title">Descrizione tappa</h2>
                        </div>
                        <div class="d-flex">
                            @if ($event->description)
                                <p class="d-flex align-items-center pb-1">
                                    {{ $event->description }}
                                </p>
                            @else
                                <a href="" class="ms-edit-stop  text-dark fs-4 fw-semibold rounded-pill" data-toggle="modal"
                                    data-target="#editStopModal-{{ $event->id }}">
                                    Aggiugni una descrizione!
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card-stop l-bg-cherry border-0 text-white">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-solid fa-burger"></i></div>
                        <div class="mb-2">
                            <h2 class="card-title">Cibi da provare</h2>
                        </div>
                        <div class="d-flex">
                            @if ($event->foods)
                            <p class="d-flex align-items-center pb-1">
                                {{ $event->foods }}
                            </p>
                        @else
                            <a href="" class="ms-edit-stop  text-dark fs-4 fw-semibold rounded-pill" data-toggle="modal"
                                data-target="#editStopModal-{{ $event->id }}">
                                Aggiugni i piatti o il cibo che preferisci!
                            </a>
                        @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card-stop l-bg-orange-dark border-0 text-white">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-solid fa-lightbulb"></i></div>
                        <div class="mb-2">
                            <h2 class="card-title">Curiosità</h2>
                        </div>
                        <div class="d-flex">
                            @if ($event->curiosities )
                            <p class="d-flex align-items-center pb-1">
                                {{ $event->curiosities }}
                            </p>
                        @else
                            <a href="" class="ms-edit-stop  text-dark fs-4 fw-semibold rounded-pill" data-toggle="modal"
                                data-target="#editStopModal-{{ $event->id }}">
                                Aggiugni le curiosità che preferisci!
                            </a>
                        @endif
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
