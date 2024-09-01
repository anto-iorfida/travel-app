<section id="section-edit-stop">
    <div class="container my-bg-edit">
        <h1>Modifica Tappa</h1>
        <form id="form-edit-stop" data-stop-update-id={{ $stop->id }} action="{{ route('admin.stops.update', ['id' => $stop->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="day" value="{{ $stop->day }}">
            <input type="hidden" name="id_trip" value="{{ $stop->id_trip }}">

            <div class="row media991px">
                <div class="form-group col">
                    <label for="name">Nome evento:*</label>
                    <input type="text" id="name" name="name" class="form-control"
                        value="{{ old('name', $stop->name) }}">
                    <div class="error text-danger"></div>
                </div>
                <div class="form-group col">
                    <label for="country">Paese:</label>
                    <input type="text" id="country" name="country" class="form-control"
                        value="{{ old('country', $stop->country) }}">
                    <div class="error text-danger"></div>
                    <input type="hidden" id="latCountry" name="latCountry" class="form-control" value="{{ old('latCountry', $stop->latCountry) }}">
                    <input type="hidden" id="lonCountry" name="lonCountry" class="form-control" value="{{ old('lonCountry', $stop->lonCountry) }}">
                    <div id="countrySuggestions" class="list-group position-absolute fs-3 bg-secondary">
                    </div>
                    <div class="invalid-feedback" id="countryError"></div>
                </div>
            </div>

            <div class="row media991px">
                <div class="form-group col">
                    <label for="street">Via:*</label>
                    <input type="text" id="street" name="street" class="form-control"
                        value="{{ old('street', $stop->street) }}">
                    <div class="error text-danger"></div>
                    <input type="hidden" id="latStreet" name="latStreet" class="form-control" value="{{ old('latStreet', $stop->latStreet) }}">
                    <input type="hidden" id="lonStreet" name="lonStreet" class="form-control" value="{{ old('lonStreet', $stop->lonStreet) }}">
                    <div id="streetSuggestions" class="list-group position-absolute fs-3 bg-secondary">
                    </div>
                    <div class="invalid-feedback" id="streetError"></div>
                </div>
                <div class="form-group col">
                    <label for="city">Città:</label>
                    <input type="text" id="city" name="city" class="form-control"
                        value="{{ old('city', $stop->city) }}">
                    <div class="error text-danger"></div>
                    <input type="hidden" id="latCity" name="latCity" class="form-control" value="{{ old('latCity', $stop->latCity) }}">
                    <input type="hidden" id="lonCity" name="lonCity" class="form-control" value="{{ old('lonCity', $stop->lonCity) }}">
                    <div id="citySuggestions" class="list-group position-absolute fs-3 bg-secondary">
                    </div>
                    <div class="invalid-feedback" id="cityError"></div>
                </div>
            </div>

            <div class="row media991px">
                <div class="form-group col">
                    <label for="time_start">Ora inizio:*</label>
                    <input type="time" id="time_start" name="time_start" class="form-control"
                        value="{{ old('time_start', $stop->time_start) }}">
                    <div class="error text-danger"></div>
                </div>
                <div class="form-group col">
                    <label for="time_end">Ora fine:*</label>
                    <input type="time" id="time_end" name="time_end" class="form-control"
                        value="{{ old('time_end', $stop->time_end) }}">
                    <div class="error text-danger"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="image">Immagine:</label>
                <input type="file" id="image" name="image" class="form-control">
                @if ($stop->image)
                    <img src="{{ asset('storage/' . $stop->image) }}" alt="Immagine Tappa" style="max-width: 200px;">
                @endif
                <div class="error text-danger"></div>
            </div>

            <div class="row media991px">
                <div class="form-group col">
                    <label for="foods">Cibi:</label>
                    <input type="text" id="foods" name="foods" class="form-control"
                        value="{{ old('foods', $stop->foods) }}">
                    <div class="error text-danger"></div>
                </div>
                <div class="form-group col">
                    <label for="curiosities">Curiosità:</label>
                    <input type="text" id="curiosities" name="curiosities" class="form-control"
                        value="{{ old('curiosities', $stop->curiosities) }}">
                    <div class="error text-danger"></div>
                </div>
            </div>

            <div class="row media991px">
                <div class="form-group col">
                    <label for="description">Descrizione:</label>
                    <textarea id="description" name="description" class="form-control">{{ old('description', $stop->description) }}</textarea>
                    <div class="error text-danger"></div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Aggiorna Tappa</button>
        </form>
    </div>
</section>
