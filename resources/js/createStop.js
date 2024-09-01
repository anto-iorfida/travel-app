

document.querySelectorAll('#form-stop').forEach((form) => {

    // Input per creare tappa 
    const cityInput = form.querySelector('#city');
    const countryInput = form.querySelector('#country');
    const streetInput = form.querySelector('#street');
    const name = form.querySelector('#name');
    const timeStart = form.querySelector('#time_start');
    const timeEnd = form.querySelector('#time_end');
    const description = form.querySelector('#description');
    const image = form.querySelector('#image');

    // Input hidden per le coordinate di paese città e strada 
    const latCountryInput = form.querySelector('#latCountry');
    const lonCountryInput = form.querySelector('#lonCountry');
    const latCityInput = form.querySelector('#latCity');
    const lonCityInput = form.querySelector('#lonCity');
    const latStreetInput = form.querySelector('#latStreet');
    const lonStreetInput = form.querySelector('#lonStreet');

    // Suggerimenti per strada, città e paese 
    const citySuggestions = form.querySelector('#citySuggestions');
    const streetSuggestions = form.querySelector('#streetSuggestions');

    let latCountryInputValue = null;
    let lonCountryInputValue = null;
    let countryCodeValue = null;
    let cityCodeValue = null;
    let cityCountrySubdivisionCod = null;
    let selectedCity = null;
    let streetCodeValue = null;
    let streetSubdivisonValue = null;
    const setSuccess = (element) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');
        errorDisplay.innerText = '';
        inputControl.classList.add('success');
        inputControl.classList.remove('error');
    };

    const setError = (element, message) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');
        errorDisplay.innerText = message;
        inputControl.classList.add('error');
        inputControl.classList.remove('success');
    };

    const validateInputs = () => {
        let isValid = true;

        const nameValue = name.value.trim();
        const streetValue = streetInput.value.trim();
        const descriptionValue = description.value.trim();
        const timeStartValue = timeStart.value.trim();
        const timeEndValue = timeEnd.value.trim();
        const imageFile = image.files[0];

        if (nameValue === '') {
            setError(name, 'Il titolo è obbligatorio');
            isValid = false;
        } else if (nameValue.length <= 3) {
            setError(name, 'Il campo titolo deve essere almeno di 3 caratteri');
            isValid = false;
        } else {
            setSuccess(name);
        }

        if (descriptionValue !== '' && descriptionValue.length < 5) {
            setError(description, 'La descrizione deve essere di almeno 5 caratteri se fornita');
            isValid = false;
        } else {
            setSuccess(description);
        }

        if (streetValue === '') {
            setError(streetInput, 'La destinazione è obbligatoria');
            isValid = false;
        } else {
            setSuccess(streetInput);
        }

        if (imageFile && !['image/jpeg', 'image/png', 'image/gif', 'image/webp'].includes(imageFile.type)) {
            setError(image, 'Se fornito, il file deve essere un\'immagine (JPEG, PNG, GIF, WEBP)');
            isValid = false;
        } else {
            setSuccess(image);
        }

        if (timeStartValue === '') {
            setError(timeStart, 'L\'orario di inizio è obbligatorio');
            isValid = false;
        } else if (!/^\d{2}:\d{2}$/.test(timeStartValue)) {
            setError(timeStart, 'L\'orario di inizio deve essere nel formato HH:mm');
            isValid = false;
        } else {
            setSuccess(timeStart);
        }

        if (timeEndValue === '') {
            setError(timeEnd, 'L\'orario di fine è obbligatorio');
            isValid = false;
        } else if (!/^\d{2}:\d{2}$/.test(timeEndValue)) {
            setError(timeEnd, 'L\'orario di fine deve essere nel formato HH:mm');
            isValid = false;
        } else if (new Date(`1970-01-01T${timeEndValue}:00Z`) <= new Date(`1970-01-01T${timeStartValue}:00Z`)) {
            setError(timeEnd, 'L\'orario di fine deve essere successivo a quello di inizio');
            isValid = false;
        } else {
            setSuccess(timeEnd);
        }

        return isValid;
    };

    // Gestione input per la ricerca di Città
    cityInput.addEventListener('input', function () {
        const query = cityInput.value.trim().toLowerCase();
        if (query.length === 0) {
            cityInput.value = "";
            lonCityInput.value = "";
            latCityInput.value = "";
            selectedCity = null; // Resetta la selezione della città
            streetInput.value = "";
            lonStreetInput.value = "";
            latStreetInput.value = "";
            streetCodeValue = null;
            streetSubdivisonValue = null;
        }

        if (query.length > 0) {
            let fetchUrl = `https://api.tomtom.com/search/2/search/${query}.json?key=Lb3Y9TzHCIBgIZGwPcaOlJA0onuuVdnP&language=it-IT`;

            fetch(fetchUrl)
                .then(response => response.json())
                .then(data => {
                    citySuggestions.innerHTML = '';
                    const cities = new Set();
                    const suggestions = [];
                    data.results.forEach(result => {
                        const city = result.address.municipality;
                        if (city && !cities.has(city) && city.toLowerCase().includes(query) && result.address.country === countryInput.value) {
                            cities.add(city);
                            suggestions.push({
                                freeformAddress: result.address.freeformAddress,
                                country: result.address.country,
                                countryCode: result.address.countryCode,
                                countrySubdivisionCode: result.address.countrySubdivisionCode,
                                lat: result.position.lat,
                                lon: result.position.lon,
                                score: getMatchScore(query, city)
                            });
                        }
                    });

                    suggestions.sort((a, b) => a.score - b.score);

                    if (suggestions.length > 0) {
                        suggestions.forEach(suggestion => {
                            const suggestionElem = document.createElement('a');
                            suggestionElem.href = "#";
                            suggestionElem.classList.add('list-group-item', 'list-group-item-action', 'd-flex', 'align-items-center', 'my-suggestion');

                            const cityText = document.createElement('span');
                            cityText.innerHTML = `
                            <i class="fa-solid fa-location-dot"></i>
                            ${suggestion.freeformAddress}`;
                            cityText.classList.add('d-flex', 'align-items-center', 'gap-3');
                            suggestionElem.appendChild(cityText);

                            suggestionElem.addEventListener('click', function (e) {
                                e.preventDefault();

                                cityInput.value = suggestion.freeformAddress;
                                latCityInput.value = suggestion.lat;
                                lonCityInput.value = suggestion.lon;
                                cityCodeValue = suggestion.countryCode;
                                selectedCity = suggestion.freeformAddress; // Imposta la città selezionata
                                cityCountrySubdivisionCod = suggestion.countrySubdivisionCode;
                                citySuggestions.innerHTML = '';
                            });

                            citySuggestions.appendChild(suggestionElem);
                        });
                    } else {
                        cityInput.classList.remove('color-input', 'text-warning');
                        const noResults = document.createElement('div');
                        noResults.textContent = 'Nessuna città trovata.';
                        noResults.classList.add('list-group-item', 'list-group-item-action');
                        citySuggestions.appendChild(noResults);
                    }
                })
                .catch(error => console.error('Errore nel recupero dei suggerimenti di città:', error));
        } else {
            citySuggestions.innerHTML = '';
        }
    });

    // Gestione input per la ricerca di Strada
    streetInput.addEventListener('input', function () {

        const query = streetInput.value.trim();
        let streetCountrySubdivisionCode = cityCountrySubdivisionCod || null;


        if (query.length > 0) {
            let fetchUrl = `https://api.tomtom.com/search/2/search/${query}.json?key=Lb3Y9TzHCIBgIZGwPcaOlJA0onuuVdnP&language=it-IT&limit=5`;

            fetch(fetchUrl)
                .then(response => response.json())
                .then(data => {
                    streetSuggestions.innerHTML = '';
                    // console.log('Total results:', data.results.length);

                    let displayedResults = 0;

                    data.results.forEach(result => {
                        let shouldDisplay = false
                        if(result.address.country === countryInput.value){
                             shouldDisplay = true;
                        }

                        // Filtra per countrySubdivisionCode se disponibile
                        if (streetCountrySubdivisionCode && result.address.countrySubdivisionCode !== streetCountrySubdivisionCode) {
                            shouldDisplay = false;
                        }

                        // Se il filtro non è attivo, escludi risultati generici con solo country o municipality
                        if (!streetCountrySubdivisionCode &&
                            (!result.address.streetName && !result.address.postalCode)) {
                            shouldDisplay = false;
                        }

                        if (shouldDisplay) {
                            displayedResults++;
                            const suggestion = document.createElement('a');
                            suggestion.href = "#";
                            suggestion.classList.add('list-group-item', 'list-group-item-action');
                            if (result.type === 'POI') {
                                suggestion.innerHTML = `
                                <div class="d-flex align-items-center gap-3">
                                    <div ><i class="fa-solid fa-house-flag text-secondary"></i></div>
                                   <div class="d-flex flex-column align-items-start gap-1">
                                      <div class="fw-semibold"> ${result.poi.name}</div>
                                      <div class="fs-4 text-secondary">${result.address.freeformAddress}</div>
                                  </div>
                                </div>`;
                            } else {
                                suggestion.innerHTML = ` 
                                <div class="d-flex align-items-center gap-3">
                                    <div ><i class="fa-solid fa-location-dot text-secondary"></i></div>
                                     <div class="d-flex flex-column align-items-start gap-1">
                                       <div class="fw-semibold"></i>${result.address.freeformAddress}</div>
                                      ${result.address.postalCode ? `<div class="text-secondary fs-4 text-start">${result.address.postalCode}  ${result.address.localName}</div> ` : ''}
                                      ${ !result.address.postalCode ? `<div class="text-secondary fs-4 text-start">${result.address.countrySecondarySubdivision},${result.address.country}</div> ` : ''}
                                    </div>
                                </div>`;
                               
                            }

                            suggestion.addEventListener('click', function (e) {
                                e.preventDefault();
                                streetInput.value = result.address.freeformAddress;
                                latStreetInput.value = result.position.lat;
                                lonStreetInput.value = result.position.lon;
                                streetCodeValue = result.address.countryCode;
                                streetSubdivisonValue = result.address.countrySubdivisionCode
                                streetSuggestions.innerHTML = '';
                                if (cityInput.value === '') {
                                    let fetchUrl = `https://api.tomtom.com/search/2/search/${result.address.municipality}.json?key=Lb3Y9TzHCIBgIZGwPcaOlJA0onuuVdnP&limit=1&language=it-IT&countrySet=${result.address.countryCode}`;
                                    fetch(fetchUrl)
                                        .then(response => response.json())
                                        .then(data => {
                                            data.results.forEach(result => {
                                                console.log('secondo risultato' + result)

                                                // Aggiorna la cittá se non è già impostato
                                               if (cityInput.value === "" || countryCodeValue !== cityCodeValue) {
                                                    cityInput.value = result.address.municipality;
                                                    latCityInput.value = result.position.lat;
                                                    lonCityInput.value = result.position.lon;
                                                    cityCodeValue = result.address.countryCode;
                                                    cityCountrySubdivisionCod = result.address.countrySubdivisionCode;
                                                    console.log(result)
                                                    // console.log('info country:     ' + latCountryInputValue, lonCountryInputValue, countryCodeValue);
                                                    console.log('city: ' + latCityInput.value, lonCityInput.value, cityCodeValue);
                                                }

                                            });
                                        })
                                        .catch(error => console.error('Errore nella ricerca del paese:', error));
                                }

                            });

                            streetSuggestions.appendChild(suggestion);
                        }
                    });

                    console.log('Displayed results:', displayedResults);

                    if (streetSuggestions.children.length === 0) {
                        const noResults = document.createElement('div');
                        noResults.textContent = 'Nessuna strada trovata.';
                        noResults.classList.add('list-group-item', 'list-group-item-action');
                        streetSuggestions.appendChild(noResults);
                    }
                })
                .catch(error => console.error('Errore nel recupero dei suggerimenti di strada:', error));
        } else {
            streetSuggestions.innerHTML = '';
        }
    });

    // Gestione submit del form
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        if (validateInputs()) {
            const url = form.getAttribute('data-url');
            axios.post(url, new FormData(form))
                .then(response => {
                    if (response.data.status === 'success') {
                        form.reset();
                        // console.log('Dati del form validati con successo.');

                        const successMessage = document.createElement('div');
                        successMessage.className = 'success-message';
                        successMessage.textContent = 'Tappa creata con successo!';
                        document.body.appendChild(successMessage);

                        Object.assign(successMessage.style, {
                            position: 'fixed',
                            top: '20px',
                            left: '50%',
                            transform: 'translateX(-50%)',
                            backgroundColor: '#28a745',
                            color: '#fff',
                            padding: '10px 20px',
                            borderRadius: '5px',
                            zIndex: 1000,
                            fontSize: '16px',
                            display: 'none'
                        });

                        $(successMessage).fadeIn();

                        const stopsContainerSelector = form.getAttribute('data-index');
                        const stopsContainer = document.querySelector(`.stops-container[data-index="${stopsContainerSelector}"]`);

                        setTimeout(() => {
                            successMessage.remove();
                            if (stopsContainer) {
                                stopsContainer.insertAdjacentHTML('beforeend', response.data.html);
                                const newElement = stopsContainer.lastElementChild;
                                if (newElement) {
                                    newElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                                }
                                // ------------
                                // chiudere la modale appena finito di creare tappa
                                // funziona solo una volta da risolvere
                                const modalId = document.querySelector('#btnFormStop').getAttribute('data-target').replace('#formStopModal-', '');
                                const closeButton = document.querySelector(`#formStopModal-${modalId} .close`);
                                console.log(modalId, 'ciao');
                                console.log(closeButton, 'ciaos');

                                if (closeButton) {
                                    closeButton.click();  // Triggera il click sul bottone per chiudere il modale
                                }
                                // -------------
                                // Ho scritto questa nuova funzione per gestire le note e la valutazione
                                window.initializeRatingHandlers();
                                window.initializeNoteHandlers();
                                window.searchPOISuggestion();
                                
                            } else {
                                console.error(`Contenitore non trovato con il selettore: ${stopsContainerSelector}`);
                            }
                        }, 2000);

                        // console.log(modalId,closeButton);

                        // -----------------------------------------------

                    } else {
                        console.error('Errore durante la validazione dei dati:', response.data.message);
                    }
                })
                .catch(error => {
                    if (error.response) {
                        if (error.response.status === 422) {
                            console.log('Errore 422');
                            const errorMessage = error.response.data.message;

                            if (errorMessage === 'L\'evento si sovrappone a un altro evento esistente.') {
                                const errorDisplay = document.createElement('div');
                                errorDisplay.className = 'error-message';
                                errorDisplay.textContent = errorMessage;
                                document.body.appendChild(errorDisplay);

                                Object.assign(errorDisplay.style, {
                                    position: 'fixed',
                                    top: '20px',
                                    left: '50%',
                                    transform: 'translateX(-50%)',
                                    backgroundColor: '#dc3545',
                                    color: '#fff',
                                    padding: '10px 20px',
                                    borderRadius: '5px',
                                    zIndex: 1000,
                                    fontSize: '16px',
                                    display: 'none'
                                });

                                $(errorDisplay).fadeIn();

                                setTimeout(() => {
                                    $(errorDisplay).fadeOut(() => {
                                        errorDisplay.remove();
                                    });
                                }, 3000);
                            } else {
                                console.log('Altri errori 422:', error.response.data);
                            }
                        } else {
                            console.log('Errore HTTP:', error.response.status, error.response.data);
                        }
                    } else if (error.request) {
                        console.error('Errore di rete:', error.request);
                    } else {
                        console.error('Errore nella richiesta:', error.message);
                    }
                });
        }
    });
});

