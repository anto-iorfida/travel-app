@props(['trip'])
<section id="card-show" class="row row-cols-2 mb-5 mt-5">
    <div class="col mb-4">
        <div class="card meteo-card text-dark card-has-bg click-col">
            <div class="card-img-overlay d-flex flex-column">
                <div class="card-body text-center">
                    <img class="weather-icon" src="" alt="Weather icon">
                </div>
                <div class="card-footer">
                    <div class="media">
                        <div class="media-body text-center">
                            <div class="temp mt-4 mb-2 fw-bold"></div>
                            <div class="city fw-bold"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col mb-4">
        <div class="card text-dark card-has-bg click-col">
            <div class="card-img-overlay d-flex flex-column details-card">
                <div class="d-flex flex-grow-1">
                    <small class="card-meta mb-2">Date di viaggio</small>
                    <h4 class="card-title mt-0 ">
                        <i class="fa-solid fa-plane-departure"></i>
                        <span>Partenza:</span>
                        {{ $trip->start_date }}
                    </h4>
                </div>
                <div class="card-footer">
                    <div class="media d-flex justify-content-end">
                        <div class="media-body">
                            <h4 class="card-title mt-0 ">
                                <i class="fa-solid fa-plane-arrival"></i>
                                <span>Ritorno:</span>
                                {{ $trip->end_date }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>