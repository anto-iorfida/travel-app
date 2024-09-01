import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import { constant, result, toUpper } from 'lodash';
import './editStop';
import './deleteStop';
import './displayTel';
import './note';
import './ratingStar';
import './suggestionPoint';
import './createStop';
import './showTrip';
import.meta.glob([
    '../img/**'
]);


// logica della modale per la softdelete ****NON TOCCARE****
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.js-confirm-delete');
    const confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    const tripTitleElement = document.getElementById('trip-title');
    const deleteForm = document.getElementById('delete-form');

    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const tripId = this.getAttribute('data-trip-id');
            const tripTitle = this.getAttribute('data-trip-title');

            tripTitleElement.textContent = tripTitle;
            deleteForm.action = `/admin/trips/${tripId}`;

            confirmDeleteModal.show();
        });
    });
});

function getBtnToggle(btn, element) {
    element.classList.add('d-none');
    btn.addEventListener('click', function () {
        element.classList.toggle("d-none");
    });
}
function getShowElement(btns, elements, className, icons,scrollElements) {
    btns.forEach((btn, btnIndex) => {
        btn.addEventListener('click', function () {
            icons.forEach((icon, iconIndex) => {
                if (btnIndex === iconIndex) {
                    if (icon.classList.contains('fa-circle-plus')) {
                        icon.classList.remove('fa-circle-plus', 'my-fa-circle-plus')
                        icon.classList.add('fa-circle-minus', 'my-fa-circle-minus')
                        if (window.location.href.includes('/admin/trips/')) {
                            scrollElements.forEach((scrollElement,scrollElementIndex)=>{
                                if(scrollElementIndex === btnIndex){
                                    var $scrollElement = $(scrollElement);
                                    $('html, body').animate({
                                        scrollTop:$scrollElement.offset().top

                                    },10);
                                }
                            })
                        }
                    } else {
                        icon.classList.remove('fa-circle-minus', 'my-fa-circle-minus')
                        icon.classList.add('fa-circle-plus', 'my-fa-circle-plus')
                    }
                }
            });
            elements.forEach((element, elementIndex) => {
                if (btnIndex === elementIndex) {
                    element.classList.toggle(className);
                }
            });
        });
    });
}



window.getBtnToggle = getBtnToggle;
window.getShowElement = getShowElement;

function getMatchScore(query, name) {
    const lowerQuery = query.toLowerCase();
    const lowerName = name.toLowerCase();
    return lowerName.indexOf(lowerQuery);
}
// funzione globale per il formato del text 
window.getMatchScore = getMatchScore;

document.addEventListener('DOMContentLoaded', function () {
    // funzione e costanti per lo show del form della tappa  
    const btnFormStop = document.querySelectorAll('#btnFormStop');
    const iconBtnFormStop = document.querySelectorAll('#icon-btn-form-stop');
    const myAccordionCreate = document.querySelectorAll('#my-accordion-create');
    const formStop = document.querySelectorAll('#formStop');
    // getShowElement(btnFormStop, formStop, 'd-none', iconBtnFormStop,myAccordionCreate)

      
    const countryInput = document.getElementById('country');
    const cityInput = document.getElementById('city');
    const titleInput = document.getElementById('title');


    const countrySuggestions = document.getElementById('countrySuggestions');
    const citySuggestions = document.getElementById('citySuggestions');


    const latCountryInput = document.getElementById('latCountry');
    const lonCountryInput = document.getElementById('lonCountry');
    const latCityInput = document.getElementById('latCity');
    const lonCityInput = document.getElementById('lonCity');

    let latCountryInputValue = null;
    let lonCountryInputValue = null;
    let countryCodeValue = null;
    let cityCodeValue = null;
    titleInput.value = 'Viaggio in:'
    // titleInput.disabled = true;

    // Aggiusta l'input dei Paesi
    countryInput.addEventListener('input', function () {
        const query = countryInput.value.trim().toLowerCase();


        if (cityInput.value && countryCodeValue !== cityCodeValue) {
            cityInput.value = '';
        }

        if (query.length > 0) {
            fetch(`https://api.tomtom.com/search/2/search/${query}.json?key=tNdeH4PSEGzxLQ1CKK0HdCagLd1BsXSc&language=it-IT&typeahead=true&idxSet=Geo`)
                .then(response => response.json())
                .then(data => {
                    countrySuggestions.innerHTML = '';
                    citySuggestions.innerHTML = '';

                    const countries = new Set();
                    const suggestions = [];

                    data.results.forEach(result => {
                        const country = result.address.country;
                        if (country && !countries.has(country) && country.toLowerCase().includes(query)) {
                            countries.add(country);
                            suggestions.push({
                                country: result.address.country,
                                countryCode: result.address.countryCode,
                                lat: result.position.lat,
                                lon: result.position.lon,
                                score: getMatchScore(query, country)
                            });
                        }
                    });

                    suggestions.sort((a, b) => a.score - b.score);

                    if (suggestions.length > 0) {
                        suggestions.forEach(suggestion => {
                            const suggestionElem = document.createElement('a');
                            suggestionElem.href = "#";
                            suggestionElem.classList.add('list-group-item', 'list-group-item-action', 'd-flex', 'align-items-center', 'my-suggestion');

                            const countryText = document.createElement('span');
                            countryText.innerHTML = `
                            <i class="fa-solid fa-earth-americas"></i>
                            ${suggestion.country}
                            `;
                            countryText.classList.add('d-flex', 'align-items-center', 'gap-2');
                            suggestionElem.appendChild(countryText);

                            suggestionElem.addEventListener('click', function (e) {
                                e.preventDefault();
                                countryInput.value = suggestion.country;
                                latCountryInput.value = suggestion.lat;
                                lonCountryInput.value = suggestion.lon;
                                latCountryInputValue = suggestion.lat;
                                lonCountryInputValue = suggestion.lon;
                                countryCodeValue = suggestion.countryCode;
                                cityInput.value = "";
                                citySuggestions.innerHTML = '';
                                countrySuggestions.innerHTML = '';
                                let resultTitle = null;
                                // countryInput.classList.add('color-input', 'text-warning');
                                if (cityInput.value === '') {
                                    // Crea la stringa del titolo risultato
                                    let resultTitle = 'Viaggio in: ' + countryInput.value;

                                    // Imposta il valore dell'input titleInput con la stringa creata
                                    titleInput.value = resultTitle;

                                    // Aggiungi la classe di avviso al titleInput per evidenziarlo
                                    // titleInput.classList.add('text-warning', 'color-input');
                                } else {
                                    titleInput.value = 'Viaggio in: ' + cityInput.value + ' ,' + countryInput.value;
                                }

                            });
                            countrySuggestions.appendChild(suggestionElem);
                        });
                    } else {
                        // countryInput.classList.remove('color-input', 'text-warning');
                        // if (cityCodeValue) { cityInput.classList.remove('color-input', 'text-warning') };
                        // titleInput.classList.remove('color-input', 'text-warning');
                        const noResults = document.createElement('div');
                        noResults.textContent = 'Nessun paese trovato.';
                        noResults.classList.add('list-group-item', 'list-group-item-action');
                        countrySuggestions.appendChild(noResults);
                    }
                })
                .catch(error => console.error('Errore nel recupero dei suggerimenti di paesi:', error));
        } else {
            countrySuggestions.innerHTML = '';
        }
    });

    // Aggiusta l'input delle Città
    cityInput.addEventListener('input', function () {
        const query = cityInput.value.trim().toLowerCase();
        let cityCountryCode = countryCodeValue || null;

        if (query.length === 0) {
            cityInput.value = "";
            lonCityInput.value = "";
            latCityInput.value = "";
        }

        if (query.length > 0) {
            let fetchUrl = `https://api.tomtom.com/search/2/search/${query}.json?key=tNdeH4PSEGzxLQ1CKK0HdCagLd1BsXSc&language=it-IT&entityTypeSet=Municipality&limit=5`;

            if (cityCountryCode) {
                fetchUrl += `&countrySet=${cityCountryCode}`;
            }
            fetch(fetchUrl)
                .then(response => response.json())
                .then(data => {
                    citySuggestions.innerHTML = '';
                    const cities = new Set();
                    const suggestions = [];

                    data.results.forEach(result => {
                        const city = result.address.freeformAddress;
                        if (city && !cities.has(city) && city.toLowerCase().includes(query)) {
                            cities.add(city);
                            suggestions.push({
                                freeformAddress: result.address.freeformAddress,
                                country: result.address.country,
                                countryCode: result.address.countryCode,
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
                               <div class="d-flex align-items-center gap-3">
                                    <div ><i class="fa-solid fa-location-dot"></i></div>
                                     <div class="d-flex flex-column align-items-start gap-1">
                                       <div class="fw-semibold"></i>${suggestion.freeformAddress}</div>
                                       <div class=" fs-4 text-start">${suggestion.country}</div>
                                    </div>
                                </div>`;
                            cityText.classList.add('d-flex', 'align-items-center', 'gap-3');
                            suggestionElem.appendChild(cityText);

                            suggestionElem.addEventListener('click', function (e) {
                                e.preventDefault();

                                cityInput.value = suggestion.freeformAddress;
                                latCityInput.value = suggestion.lat;
                                lonCityInput.value = suggestion.lon;
                                cityCodeValue = suggestion.countryCode;
                                // chiamata api per salvare la latitudine e longitudine del country 
                                if (!cityCountryCode) {
                                    fetch(`https://api.tomtom.com/search/2/search/${cityCodeValue}.json?key=tNdeH4PSEGzxLQ1CKK0HdCagLd1BsXSc&countrySet=${cityCodeValue}&limit=1&language=it-IT`)
                                        .then(response => response.json())
                                        .then(data => {
                                            data.results.forEach(result => {

                                                latCountryInputValue = result.position.lat;
                                                lonCountryInputValue = result.position.lon;
                                                // Aggiorna il paese se non è già impostato
                                                if (countryInput.value === '' || countryCodeValue !== cityCodeValue) {
                                                    countryInput.value = suggestion.country;
                                                    latCountryInput.value = result.position.lat;
                                                    lonCountryInput.value = result.position.lon;
                                                    latCountryInputValue = result.position.lat;
                                                    lonCountryInputValue = result.position.lon;
                                                    countryCodeValue = result.address.countryCode;
                                                }
                                                console.log('info country:     ' + latCountryInputValue, lonCountryInputValue, countryCodeValue)
                                                console.log('city:             ' + latCityInput.value, lonCityInput.value, cityCodeValue)
                                            });

                                        })
                                        .catch(error => console.error('Errore nella ricerca del paese:', error));
                                };
                                if (query.length === 0) {
                                    titleInput.value = 'Viaggio in: ' + suggestion.country;
                                } else {
                                    titleInput.value = 'Viaggio in: ' + cityInput.value + ' , ' + suggestion.country;

                                }
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

});



//  chiamate api per rotte -------------------------------------------------------------------------------------------------------------------------------------
// Event delegation per gestire il click su link dinamici
// document.getElementById('content-container').addEventListener('click', function (event) {
//     // Controlla se il target dell'evento (l'elemento cliccato) o uno dei suoi antenati ha l'ID 'dashboard-link'
//     if (event.target.closest('#dashboard-link')) {
//         event.preventDefault(); // Impedisce l'azione predefinita del link, ovvero il comportamento di navigazione
//         fetchContent('http://127.0.0.1:8000/admin/dashboard'); // Chiama la funzione per caricare il contenuto della dashboard
//     }
//     // Controlla se il target dell'evento (l'elemento cliccato) o uno dei suoi antenati ha l'ID 'trip-index-link'
//     else if (event.target.closest('#trip-index-link')) {
//         event.preventDefault(); // Impedisce l'azione predefinita del link, ovvero il comportamento di navigazione
//         fetchContent('http://127.0.0.1:8000/admin/trips'); // Chiama la funzione per caricare il contenuto dei viaggi
//     }
// });

// // Funzione per caricare contenuti da un URL specificato e aggiornare la pagina
// function fetchContent(url) {
//     fetch(url) // Effettua una richiesta HTTP GET all'URL specificato
//         .then(response => {
//             if (!response.ok) { // Controlla se la risposta HTTP è andata a buon fine
//                 throw new Error('Network response was not ok'); // Genera un errore se la risposta non è OK
//             }
//             return response.text(); // Restituisce il corpo della risposta come testo
//         })
//         .then(html => {
//             document.getElementById('content-container').innerHTML = html; // Aggiorna il contenuto del container con l'HTML ricevuto

//             // Esegui gli script presenti nel contenuto HTML
//             const scriptTags = document.querySelectorAll('#content-container script'); // Seleziona tutti i tag <script> nel contenuto
//             scriptTags.forEach(script => { // Per ogni tag <script>
//                 const newScript = document.createElement('script'); // Crea un nuovo elemento <script>
//                 newScript.src = script.src; // Copia l'attributo src del tag script esistente
//                 newScript.innerHTML = script.innerHTML; // Copia il contenuto interno del tag script esistente
//                 document.body.appendChild(newScript); // Aggiunge il nuovo script al documento, eseguendolo
//             });

//             // Aggiorna l'URL del browser senza ricaricare la pagina
//             const newPath = url.replace('http://127.0.0.1:8000', ''); // Rimuove il prefisso dell'URL base per ottenere il percorso relativo
//             history.pushState(null, '', newPath); // Aggiorna l'URL visualizzato nel browser senza ricaricare la pagina
//         })
//         .catch(error => {
//             console.error('There was a problem with the fetch operation:', error); // Gestisce e mostra eventuali errori di rete
//         });
// }

// // Funzione per associare gli event listeners ai link specifici
// function attachEventListeners() {
//     document.getElementById('dashboard-link').addEventListener('click', function (event) {
//         event.preventDefault(); // Impedisce l'azione predefinita del link
//         fetchContent('http://127.0.0.1:8000/admin/dashboard'); // Chiama la funzione per caricare il contenuto della dashboard
//     });

//     document.getElementById('trip-index-link').addEventListener('click', function (event) {
//         event.preventDefault(); // Impedisce l'azione predefinita del link
//         fetchContent('http://127.0.0.1:8000/admin/trips'); // Chiama la funzione per caricare il contenuto dei viaggi
//     });
// }

// // Chiama questa funzione ogni volta che aggiorni il contenuto della pagina
// attachEventListeners(); // Associa gli event listeners ai link, per gestire il loro comportamento dopo ogni aggiornamento del contenuto

// /chiamate api per rotte -------------------------------------------------------------------------------------------------------------------------------------
