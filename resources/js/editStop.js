

// document.querySelectorAll('#form-edit-stop').forEach((form) => {
    
//     // Gestione submit del form
//     form.addEventListener('submit', (e) => {
//         e.preventDefault();
//     //    id univoco per gli elementi 
//     const id = form.getAttribute('data-stop-update-id');

//     // Input per creare tappa 
//     const cityInput = form.querySelector('#city');
//     const countryInput = form.querySelector('#country');
//     const streetInput = form.querySelector('#street');
//     const name = form.querySelector('#name');
//     const timeStart = form.querySelector('#time_start');
//     const timeEnd = form.querySelector('#time_end');
//     const description = form.querySelector('#description');
//     const image = form.querySelector('#image');

//     // Input hidden per le coordinate di paese città e strada 
//     const latCountryInput = form.querySelector('#latCountry');
//     const lonCountryInput = form.querySelector('#lonCountry');
//     const latCityInput = form.querySelector('#latCity');
//     const lonCityInput = form.querySelector('#lonCity');
//     const latStreetInput = form.querySelector('#latStreet');
//     const lonStreetInput = form.querySelector('#lonStreet');

//     // Suggerimenti per strada, città e paese 
//     const countrySuggestions = form.querySelector('#countrySuggestions');
//     const citySuggestions = form.querySelector('#citySuggestions');
//     const streetSuggestions = form.querySelector('#streetSuggestions');

//     let latCountryInputValue = null;
//     let lonCountryInputValue = null;
//     let countryCodeValue = null;
//     let cityCodeValue = null;
//     let cityCountrySubdivisionCod = null;
//     let selectedCity = null;
//     let streetCodeValue = null;
//     let streetSubdivisonValue = null;
//     const setSuccess = (element) => {
//         const inputControl = element.parentElement;
//         const errorDisplay = inputControl.querySelector('.error');
//         errorDisplay.innerText = '';
//         inputControl.classList.add('success');
//         inputControl.classList.remove('error');
//     };

//     // const setError = (element, message) => {
//     //     const inputControl = element.parentElement;
//     //     const errorDisplay = inputControl.querySelector('.error');
//     //     errorDisplay.innerText = message;
//     //     inputControl.classList.add('error');
//     //     inputControl.classList.remove('success');
//     // };

//     // const validateInputs = () => {
//     //     let isValid = true;

//     //     const nameValue = name.value.trim();
//     //     const streetValue = streetInput.value.trim();
//     //     const descriptionValue = description.value.trim();
//     //     const timeStartValue = timeStart.value.trim();
//     //     const timeEndValue = timeEnd.value.trim();
//     //     const imageFile = image.files[0];

//     //     if (nameValue === '') {
//     //         setError(name, 'Il titolo è obbligatorio');
//     //         isValid = false;
//     //     } else if (nameValue.length <= 3) {
//     //         setError(name, 'Il campo titolo deve essere almeno di 3 caratteri');
//     //         isValid = false;
//     //     } else {
//     //         setSuccess(name);
//     //     }

//     //     if (descriptionValue !== '' && descriptionValue.length < 5) {
//     //         setError(description, 'La descrizione deve essere di almeno 5 caratteri se fornita');
//     //         isValid = false;
//     //     } else {
//     //         setSuccess(description);
//     //     }

//     //     if (streetValue === '') {
//     //         setError(streetInput, 'La destinazione è obbligatoria');
//     //         isValid = false;
//     //     } else {
//     //         setSuccess(streetInput);
//     //     }

//     //     if (imageFile && !['image/jpeg', 'image/png', 'image/gif', 'image/webp'].includes(imageFile.type)) {
//     //         setError(image, 'Se fornito, il file deve essere un\'immagine (JPEG, PNG, GIF, WEBP)');
//     //         isValid = false;
//     //     } else {
//     //         setSuccess(image);
//     //     }

//     //     // if (timeStartValue === '') {
//     //     //     setError(timeStart, 'L\'orario di inizio è obbligatorio');
//     //     //     isValid = false;
//     //     // } else if (!/^\d{2}:\d{2}$/.test(timeStartValue)) {
//     //     //     setError(timeStart, 'L\'orario di inizio deve essere nel formato HH:mm');
//     //     //     isValid = false;
//     //     // } else {
//     //     //     setSuccess(timeStart);
//     //     // }

//     //     // if (timeEndValue === '') {
//     //     //     setError(timeEnd, 'L\'orario di fine è obbligatorio');
//     //     //     isValid = false;
//     //     // } else if (!/^\d{2}:\d{2}$/.test(timeEndValue)) {
//     //     //     setError(timeEnd, 'L\'orario di fine deve essere nel formato HH:mm');
//     //     //     isValid = false;
//     //     // } else if (new Date(`1970-01-01T${timeEndValue}:00Z`) <= new Date(`1970-01-01T${timeStartValue}:00Z`)) {
//     //     //     setError(timeEnd, 'L\'orario di fine deve essere successivo a quello di inizio');
//     //     //     isValid = false;
//     //     // } else {
//     //     //     setSuccess(timeEnd);
//     //     // }

//     //     return isValid;
//     // };

//     // // Gestione input per la ricerca di Paese
//     // countryInput.addEventListener('input', function () {
//     //     let query = countryInput.value.trim().toLowerCase();
//     //     if (cityInput.value && countryCodeValue !== cityCodeValue) {
//     //         cityInput.value = '';
//     //     }
//     //     // Se il paese viene cancellato, resettare il campo città
//     //     if (query === '') {
//     //         cityInput.value = '';
//     //         streetInput.value = "";
//     //         latCityInput.value = '';
//     //         lonCityInput.value = '';
//     //         streetCodeValue = "";
//     //         selectedCity = null; // Resetta la selezione della città
//     //         countryCodeValue = null; // Resetta il countryCode del paese
//     //         cityCodeValue = null; // Resetta il countryCode della città
//     //     }

//     //     if (query.length > 0) {
//     //         let fetchUrl = (`https://api.tomtom.com/search/2/search/${query}.json?key=Lb3Y9TzHCIBgIZGwPcaOlJA0onuuVdnP&language=it-IT&typeahead=true&idxSet=Geo`);

//     //         fetch(fetchUrl)
//     //             .then(response => response.json())
//     //             .then(data => {
//     //                 countrySuggestions.innerHTML = '';
//     //                 citySuggestions.innerHTML = '';

//     //                 const countries = new Set();
//     //                 const suggestions = [];

//     //                 data.results.forEach(result => {
//     //                     const country = result.address.country;
//     //                     if (country && !countries.has(country) && country.toLowerCase().includes(query)) {
//     //                         countries.add(country);
//     //                         suggestions.push({
//     //                             country: result.address.country,
//     //                             countryCode: result.address.countryCode,
//     //                             lat: result.position.lat,
//     //                             lon: result.position.lon,
//     //                             score: getMatchScore(query, country)
//     //                         });
//     //                     }
//     //                 });

//     //                 suggestions.sort((a, b) => a.score - b.score);

//     //                 if (suggestions.length > 0) {
//     //                     suggestions.forEach(suggestion => {
//     //                         const suggestionElem = document.createElement('a');
//     //                         suggestionElem.href = "#";
//     //                         suggestionElem.classList.add('list-group-item', 'list-group-item-action', 'd-flex', 'align-items-center', 'my-suggestion');

//     //                         const countryText = document.createElement('span');
//     //                         countryText.innerHTML = `
//     //                         <i class="fa-solid fa-earth-americas"></i>
//     //                         ${suggestion.country}
//     //                         `;
//     //                         countryText.classList.add('d-flex', 'align-items-center', 'gap-2');
//     //                         suggestionElem.appendChild(countryText);

//     //                         suggestionElem.addEventListener('click', function (e) {
//     //                             e.preventDefault();
//     //                             countryInput.value = suggestion.country;
//     //                             latCountryInput.value = suggestion.lat;
//     //                             lonCountryInput.value = suggestion.lon;
//     //                             latCountryInputValue = suggestion.lat;
//     //                             lonCountryInputValue = suggestion.lon;
//     //                             countryCodeValue = suggestion.countryCode;
//     //                             cityInput.value = "";
//     //                             citySuggestions.innerHTML = '';
//     //                             countrySuggestions.innerHTML = '';

//     //                             console.log(
//     //                                 'siamo i valori cambiati :',
//     //                                 countryInput.value,
//     //                                 latCountryInput.value,
//     //                                 lonCountryInput.value
//     //                             );
//     //                         });
//     //                         countrySuggestions.appendChild(suggestionElem);
//     //                     });
//     //                 } else {
//     //                     const noResults = document.createElement('div');
//     //                     noResults.textContent = 'Nessun paese trovato.';
//     //                     noResults.classList.add('list-group-item', 'list-group-item-action');
//     //                     countrySuggestions.appendChild(noResults);
//     //                 }
//     //             })
//     //             .catch(error => console.error('Errore nel recupero dei suggerimenti di paesi:', error));
//     //     } else {
//     //         countrySuggestions.innerHTML = '';
//     //     }
//     // });

//     // // Gestione input per la ricerca di Città
//     // cityInput.addEventListener('input', function () {
//     //     const query = cityInput.value.trim().toLowerCase();
//     //     let cityCountryCode = countryCodeValue || null;

//     //     if (query.length === 0) {
//     //         cityInput.value = "";
//     //         lonCityInput.value = "";
//     //         latCityInput.value = "";
//     //         selectedCity = null; // Resetta la selezione della città
//     //         streetInput.value = "";
//     //         lonStreetInput.value = "";
//     //         latStreetInput.value = "";
//     //         streetCodeValue = null;
//     //         streetSubdivisonValue = null;
//     //     }

//     //     if (query.length > 0) {
//     //         let fetchUrl = `https://api.tomtom.com/search/2/search/${query}.json?key=Lb3Y9TzHCIBgIZGwPcaOlJA0onuuVdnP&language=it-IT`;

//     //         if (cityCountryCode) {
//     //             fetchUrl += `&countrySet=${cityCountryCode}`;
//     //         }
//     //         fetch(fetchUrl)
//     //             .then(response => response.json())
//     //             .then(data => {
//     //                 citySuggestions.innerHTML = '';
//     //                 const cities = new Set();
//     //                 const suggestions = [];

//     //                 data.results.forEach(result => {
//     //                     const city = result.address.municipality;
//     //                     if (city && !cities.has(city) && city.toLowerCase().includes(query)) {
//     //                         cities.add(city);
//     //                         suggestions.push({
//     //                             freeformAddress: result.address.freeformAddress,
//     //                             country: result.address.country,
//     //                             countryCode: result.address.countryCode,
//     //                             countrySubdivisionCode: result.address.countrySubdivisionCode,
//     //                             lat: result.position.lat,
//     //                             lon: result.position.lon,
//     //                             score: getMatchScore(query, city)
//     //                         });
//     //                     }
//     //                 });

//     //                 suggestions.sort((a, b) => a.score - b.score);

//     //                 if (suggestions.length > 0) {
//     //                     suggestions.forEach(suggestion => {
//     //                         const suggestionElem = document.createElement('a');
//     //                         suggestionElem.href = "#";
//     //                         suggestionElem.classList.add('list-group-item', 'list-group-item-action', 'd-flex', 'align-items-center', 'my-suggestion');

//     //                         const cityText = document.createElement('span');
//     //                         cityText.innerHTML = `
//     //                         <i class="fa-solid fa-location-dot"></i>
//     //                         ${suggestion.freeformAddress}`;
//     //                         cityText.classList.add('d-flex', 'align-items-center', 'gap-3');
//     //                         suggestionElem.appendChild(cityText);

//     //                         suggestionElem.addEventListener('click', function (e) {
//     //                             e.preventDefault();

//     //                             cityInput.value = suggestion.freeformAddress;
//     //                             latCityInput.value = suggestion.lat;
//     //                             lonCityInput.value = suggestion.lon;
//     //                             cityCodeValue = suggestion.countryCode;
//     //                             selectedCity = suggestion.freeformAddress; // Imposta la città selezionata
//     //                             cityCountrySubdivisionCod = suggestion.countrySubdivisionCode;
//     //                             citySuggestions.innerHTML = '';

//     //                             // Chiamata API per aggiornare la latitudine e longitudine del paese
//     //                             if (!cityCountryCode) {
//     //                                 fetch(`https://api.tomtom.com/search/2/search/${cityCodeValue}.json?key=Lb3Y9TzHCIBgIZGwPcaOlJA0onuuVdnP&countrySet=${cityCodeValue}&limit=1&language=it-IT`)
//     //                                     .then(response => response.json())
//     //                                     .then(data => {
//     //                                         data.results.forEach(result => {
//     //                                             latCountryInputValue = result.position.lat;
//     //                                             lonCountryInputValue = result.position.lon;
//     //                                             // Aggiorna il paese se non è già impostato
//     //                                             if (countryInput.value === '' || countryCodeValue !== cityCodeValue) {
//     //                                                 countryInput.value = suggestion.country;
//     //                                                 latCountryInput.value = result.position.lat;
//     //                                                 lonCountryInput.value = result.position.lon;
//     //                                                 latCountryInputValue = result.position.lat;
//     //                                                 lonCountryInputValue = result.position.lon;
//     //                                                 countryCodeValue = result.address.countryCode;
//     //                                             }
//     //                                             console.log('info country:     ' + latCountryInputValue, lonCountryInputValue, countryCodeValue);
//     //                                             console.log('city:             ' + latCityInput.value, lonCityInput.value, cityCodeValue);
//     //                                         });
//     //                                     })
//     //                                     .catch(error => console.error('Errore nella ricerca del paese:', error));
//     //                             }
//     //                         });

//     //                         citySuggestions.appendChild(suggestionElem);
//     //                     });
//     //                 } else {
//     //                     cityInput.classList.remove('color-input', 'text-warning');
//     //                     const noResults = document.createElement('div');
//     //                     noResults.textContent = 'Nessuna città trovata.';
//     //                     noResults.classList.add('list-group-item', 'list-group-item-action');
//     //                     citySuggestions.appendChild(noResults);
//     //                 }
//     //             })
//     //             .catch(error => console.error('Errore nel recupero dei suggerimenti di città:', error));
//     //     } else {
//     //         citySuggestions.innerHTML = '';
//     //     }
//     // });

//     // // Gestione input per la ricerca di Strada
//     // streetInput.addEventListener('input', function () {

//     //     const query = streetInput.value.trim();
//     //     let streetCountryCode = countryCodeValue || cityCodeValue || null;
//     //     let streetCountrySubdivisionCode = cityCountrySubdivisionCod || null;

//     //     // console.log('Query:', query);
//     //     // console.log('Country Code:', streetCountryCode);
//     //     // console.log('Subdivision Code:', streetCountrySubdivisionCode);

//     //     if (query.length > 0) {
//     //         let fetchUrl = `https://api.tomtom.com/search/2/search/${query}.json?key=Lb3Y9TzHCIBgIZGwPcaOlJA0onuuVdnP&language=it-IT&limit=5`;
//     //         if (streetCountryCode) {
//     //             fetchUrl += `&countrySet=${streetCountryCode}`;
//     //         }

//     //         fetch(fetchUrl)
//     //             .then(response => response.json())
//     //             .then(data => {
//     //                 streetSuggestions.innerHTML = '';
//     //                 // console.log('Total results:', data.results.length);

//     //                 let displayedResults = 0;

//     //                 data.results.forEach(result => {
//     //                     let shouldDisplay = true;

//     //                     // Filtra per countrySubdivisionCode se disponibile
//     //                     if (streetCountrySubdivisionCode && result.address.countrySubdivisionCode !== streetCountrySubdivisionCode) {
//     //                         shouldDisplay = false;
//     //                     }

//     //                     // Se il filtro non è attivo, escludi risultati generici con solo country o municipality
//     //                     if (!streetCountrySubdivisionCode &&
//     //                         (!result.address.streetName && !result.address.postalCode)) {
//     //                         shouldDisplay = false;
//     //                     }

//     //                     if (shouldDisplay) {
//     //                         displayedResults++;
//     //                         const suggestion = document.createElement('a');
//     //                         suggestion.href = "#";
//     //                         suggestion.classList.add('list-group-item', 'list-group-item-action');
//     //                         suggestion.textContent = result.address.freeformAddress;

//     //                         suggestion.addEventListener('click', function (e) {
//     //                             e.preventDefault();
//     //                             streetInput.value = result.address.freeformAddress;
//     //                             latStreetInput.value = result.position.lat;
//     //                             lonStreetInput.value = result.position.lon;
//     //                             streetCodeValue = result.address.countryCode;
//     //                             streetSubdivisonValue = result.address.countrySubdivisionCode
//     //                             streetSuggestions.innerHTML = '';

//     //                             console.log(result)
//     //                             console.log(streetCountryCode)

//     //                             if (!streetCountryCode) {
//     //                                 let fetchUrl = `https://api.tomtom.com/search/2/search/${result.address.municipality}.json?key=Lb3Y9TzHCIBgIZGwPcaOlJA0onuuVdnP&countrySet=${streetCodeValue}&limit=1&language=it-IT`;
//     //                                 fetch(fetchUrl)
//     //                                     .then(response => response.json())
//     //                                     .then(data => {
//     //                                         data.results.forEach(result => {
//     //                                             console.log('secondo risultato' + result)
//     //                                             latCountryInputValue = result.position.lat;
//     //                                             lonCountryInputValue = result.position.lon;
//     //                                             // Aggiorna il paese se non è già impostato
//     //                                             if (countryInput.value === '' || countryCodeValue !== cityCodeValue) {
//     //                                                 countryInput.value = result.address.country;
//     //                                                 latCountryInput.value = result.position.lat;
//     //                                                 lonCountryInput.value = result.position.lon;
//     //                                                 latCountryInputValue = result.position.lat;
//     //                                                 lonCountryInputValue = result.position.lon;
//     //                                                 countryCodeValue = result.address.countryCode;
//     //                                             } if (cityInput.value === "" || countryCodeValue !== cityCodeValue) {
//     //                                                 cityInput.value = result.address.municipality;
//     //                                                 latCityInput.value = result.position.lat;
//     //                                                 lonCityInput.value = result.position.lon;
//     //                                                 cityCodeValue = result.address.countryCode;
//     //                                                 cityCountrySubdivisionCod = result.address.countrySubdivisionCode;
//     //                                                 console.log(result)
//     //                                                 // console.log('info country:     ' + latCountryInputValue, lonCountryInputValue, countryCodeValue);
//     //                                                 console.log('city:             ' + latCityInput.value, lonCityInput.value, cityCodeValue);
//     //                                             }

//     //                                         });
//     //                                     })
//     //                                     .catch(error => console.error('Errore nella ricerca del paese:', error));
//     //                             }

//     //                         });

//     //                         streetSuggestions.appendChild(suggestion);
//     //                     }
//     //                 });

//     //                 console.log('Displayed results:', displayedResults);

//     //                 if (streetSuggestions.children.length === 0) {
//     //                     const noResults = document.createElement('div');
//     //                     noResults.textContent = 'Nessuna strada trovata.';
//     //                     noResults.classList.add('list-group-item', 'list-group-item-action');
//     //                     streetSuggestions.appendChild(noResults);
//     //                 }
//     //             })
//     //             .catch(error => console.error('Errore nel recupero dei suggerimenti di strada:', error));
//     //     } else {
//     //         streetSuggestions.innerHTML = '';
//     //     }
//     // });
//         // if (validateInputs()) {
//             const formData = new FormData(form); // Ottieni i dati del modulo
//             console.log('Dati del modulo:', Array.from(formData.entries()))

//             axios.put(form.action, formData, {
//                 headers: {
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//                     'Accept': 'application/json',
//                 }
//             })
//                 .then(response => {
//                     if (response.data.status === 'success') {
//                         // form.querySelectorAll('input[type="text"], input[type="hidden"], textarea').forEach((input) => {
//                         //     input.value = '';
//                         // });
//                         console.log('Dati del form validati con successo e modulo resettato.');

//                         console.log('tappa.nuova',response.data.tappa)
//                     } else {
//                         console.error('Errore durante la validazione dei dati:', response.data.message);
//                     }
//                 })
//                 .catch(error => {
//                     // Gestione degli errori come precedentemente
//                 });
//         // }
//     });
// });
