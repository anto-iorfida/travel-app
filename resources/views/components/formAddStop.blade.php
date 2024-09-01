@props(['date', 'tripId', 'index','trip'])
<div class="container my-form-create card rounded-4" id="formStop">
    <h1 class="mb-3">Aggiungi una nuova tappa</h1>
    <div id="messages">

    </div>
    <form id="form-stop" class="form-stops position-relative col-10 ms-auto me-auto pb-5"
        data-url="{{ route('admin.stops.store') }} " data-index="{{ $index }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="day" value="{{ $date }}">
        <input type="hidden" name="id_trip" value="{{ $tripId }}">
        <div class="row media991px">
            <div class="form-group col-12 ">
                <label for="name">Nome evento:*</label>
                <input type="text" id="name" name="name" class="form-control">
                <div class="error fs-3 text-danger "></div>
            </div>
            <div class="form-group col">
                <input type="hidden" id="country" name="country" class="form-control" value="{{ $trip->country }}">
                <div class="error fs-3 text-danger "></div>
                <input type="hidden" id="latCountry" name="latCountry" class="form-control" value="{{ $trip->latCountry }}">
                <input type="hidden" id="lonCountry" name="lonCountry" class="form-control" value="{{ $trip->lonCountry }}">
            </div>
        </div>
        <div class="row media991px">
            <div class="form-group col">
                <label for="region">Luogo/via:*</label>
                <input type="text" id="street" name="street" class="form-control" value="{{ old('street') }}">
                <div class="error fs-3 text-danger "></div>
                <input type="hidden" id="latStreet" name="latStreet" class="form-control">
                <input type="hidden" id="lonStreet" name="lonStreet" class="form-control">
                <div id="streetSuggestions" class="list-group position-absolute fs-3 bg-secondary">
                </div>
                <div class="invalid-feedback" id="countryError"></div>
            </div>
            <div class="form-group col">
                <label for="city">Città:</label>
                <input type="text" id="city" name="city" class="form-control " value="{{ old('city') }}">
                <div class="error fs-3 text-danger "></div>
                <input type="hidden" id="latCity" name="latCity" class="form-control">
                <input type="hidden" id="lonCity" name="lonCity" class="form-control">
                <div id="citySuggestions" class="list-group position-absolute fs-3 bg-secondary">
                </div>
                <div class="invalid-feedback" id="cityError"></div>
            </div>
        </div>
        <div class="row media991px">
            <div class="form-group col">
                <label for="time_start">Start Time:*</label>
                <input type="time" id="time_start" name="time_start" class="form-control"
                    value="{{ old('time_start') }}">
                <div class="error fs-3 text-danger "></div>
            </div>
            <div class="form-group col">
                <label for="time_end">End Time:*</label>
                <input type="time" id="time_end" name="time_end" class="form-control "
                    value="{{ old('time_end') }}">
                <div class="error fs-3 text-danger "></div>
            </div>
        </div>

        <div class="row media991px">
            <div class="form-group col ">
                <label for="image">Immagine:</label>
                <input type="file" id="image" name="image" class="form-control">
                <div class="error fs-3 text-danger "></div>
            </div>
        </div>
        <div class="row media991px">
            <div class="form-group col">
                <label for="foods">Cibi:</label>
                <input type="text" id="foods" name="foods" class="form-control "
                    value="{{ old('foods') }}">
                <div class="error fs-3 text-danger "></div>
            </div>
            <div class="form-group col">
                <label for="curiosities">Curiosità:</label>
                <input type="text" id="curiosities" name="curiosities" class="form-control"
                    value="{{ old('curiosities') }}">
                <div class="error fs-3 text-danger "></div>
            </div>
        </div>
        <div class="row media991px">
            <div class="form-group col">
                <label for="description">Descrizione:</label>
                <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                <div class="error fs-3 text-danger "></div>
            </div>
        </div>

        <button type="submit" class="btn  mt-5">Salva Tappa</button>
    </form>
    <div id="stops-list"></div>
</div>
@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
{{-- <script>
    window.apiValidateStopUrl = '{{ route('api.validate.stop') }}';
    window.adminValidateStopUrl = '{{ route('admin.stops.store') }}';
</script> --}}
