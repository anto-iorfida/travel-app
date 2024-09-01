@props(['event', 'trip', 'stop'])
{{-- contenitore stelle --}}
@php
    $firstRating = $event->ratings->first();
    $ratingValue = $firstRating ? $firstRating->rating : 0;
    $reviewText = $firstRating ? $firstRating->review : '';
@endphp

<div id="ratingCardWrapper-{{ $event->id }}" class="{{ $firstRating ? '' : 'd-none' }}">
    <section id="star-values">
        <h3 class="text-center fs-1">La tua recensione</h3>
        <span class="star__container">
            <div class="rating_star">
                @for ($i = 1; $i <= 5; $i++)
                    <label class="star__item {{ $i <= $ratingValue ? 'gold' : '' }}"
                        for="star-{{ $event->id }}-{{ $i }}">
                        <span class="visuhide"><i class="fa-solid fa-star"></i></span>
                    </label>
                @endfor
            </div>
            <button class="delete-rating-btn"><i class="fa-solid fa-pen"></i></button>
        </span>
        <p id="rating-review-{{ $event->id }}" class="mb-0">{{ $reviewText }}</p>
    </section>
</div>
{{--/ contenitore stelle --}}

{{-- contenitore form --}}
<div class="my-wrapper-star {{ $firstRating ? 'd-none' : '' }}" id="ratingComponentWrapper-{{ $stop }}">
    <div class="rating-wrap">
        <h2 class="text-white">Aggiungi una recensione</h2>
        <div class="center">
            <form data-url-rating="{{ route('admin.ratings.store') }}" class="form-rating d-flex flex-column">
                <fieldset class="rating ms-auto me-auto">
                    <input type="radio" id="star5" name="rating" value="5" class="star-input" />
                    <label for="star5" class="full" title="Awesome"></label>
                    <input type="radio" id="star4" name="rating" value="4" class="star-input" />
                    <label for="star4" class="full"></label>
                    <input type="radio" id="star3" name="rating" value="3" class="star-input" />
                    <label for="star3" class="full"></label>
                    <input type="radio" id="star2" name="rating" value="2" class="star-input" />
                    <label for="star2" class="full"></label>
                    <input type="radio" id="star1" name="rating" value="1" class="star-input" />
                    <label for="star1" class="full"></label>
                    <input type="hidden" name="trip_id" value="{{ $trip }}">
                    <input type="hidden" name="stop_id" value="{{ $stop }}">
                </fieldset>
                <header>
                    <div></div>
                </header>
                <div class="textarea d-none">
                    <textarea name="review" id="review" class="review" cols="30"></textarea>
                </div>
                <h4 id="rating-value" class="rating-value" class="my-3"></h4>
                <div class="my-btn my-3">
                    <div>
                        <button type="submit" id="submit-btn" class="">Vota</button>
                    </div>
                </div>
                <div class="error text-danger fs-4"></div>
            </form>
        </div>
    </div>
</div>
{{-- /contenitore form --}}


<style>
    .gold {
        color: rgb(255, 244, 41);
    }
</style>

