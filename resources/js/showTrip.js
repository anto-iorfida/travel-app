// funzione generale 
function showDetails() {
    const containerTripShow = document.querySelectorAll('#trip-show');

    containerTripShow.forEach(container => {
        const latCountry = container.getAttribute('data-lat-country-show');
        const lonCountry = container.getAttribute('data-lon-country');
        const latCity = container.getAttribute('data-lat-city-show'); // Corrected attribute name
        const lonCity = container.getAttribute('data-lon-city-show');
        let country = container.getAttribute('data-trip-country');
        let city = container.getAttribute('data-trip-city');

        let selectedLat = city && country ? latCity : latCountry;
        let selectedLon = city && country ? lonCity : lonCountry;
        let selectedPoint = city || country;
        let radius;
        if (selectedPoint = city) {
            radius = 20000;
        } else if (selectedPoint = country) {
            radius = 100000000
        }

        // funzione che fa partire la chiamata api per il meteo 
        MeteoApi(container, selectedLat, selectedLon)

        // funzione che mostra la mappa in pagina 
        mapShow(container, selectedLat, selectedLon)

        // funzione che fa partire la chiamata API TOMTOM 
        detailsPOI('tourist%20attraction', selectedLat, selectedLon, selectedPoint, radius)
    });
}

function mapShow(container, selectedLat, selectedLon) {
    const mapContainer = container.querySelector('.map'); // Using class selector
    if (mapContainer) {
        tt.setProductInfo('Your App Name', 'Your App Version');
        let map = tt.map({
            key: 'tNdeH4PSEGzxLQ1CKK0HdCagLd1BsXSc',
            container: mapContainer,
            center: [selectedLon, selectedLat],
            zoom: 15
        });

        let marker = new tt.Marker()
            .setLngLat([selectedLon, selectedLat])
            .addTo(map);

        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());
    } else {
        console.error('Map container not found!');
    }
}
function MeteoApi(container, selectedLat, selectedLon) {
    // chiamata per il meteo 
    // chiamata fetch meteo 
    const tempElement = container.querySelector('.temp');
    const cityElement = container.querySelector('.city');
    const weatherIconElement = container.querySelector('.weather-icon');

    fetch(
        `https://api.openweathermap.org/data/2.5/weather?lat=${selectedLat}&lon=${selectedLon}&lang=it&units=metric&appid=461c50c5aad0a7a4b9f77424415c5924`
    )
        .then(response => response.json())
        .then(data => {

            console.log(data)
            tempElement.innerHTML = `${data.main.temp} °C`;
            cityElement.innerHTML = `${data.name}`;
            if (data.weather[0].main === "Clouds") {
                weatherIconElement.src = '/img/wheater/clouds.png';
            } else if (data.weather[0].main === "Clear") {
                weatherIconElement.src = '/img/wheater/clear.png';
            } else if (data.weather[0].main === "Rain") {
                weatherIconElement.src = '/img/wheater/rain.png';
            } else if (data.weather[0].main === "Drizzle") {
                weatherIconElement.src = '/img/wheater/drizzle.png';
            } else if (data.weather[0].main === "Mist") {
                weatherIconElement.src = '/img/wheater/mist.png';
            } else if (data.weather[0].main === "Snow") {
                weatherIconElement.src = '/img/wheater/snow.png';
            } else if (data.weather[0].main === "Thunderstorm") {
                weatherIconElement.src = '/img/wheater/storm.png';
            }

            // Imposta l'icona nel tuo elemento HTML
            weatherIconElement.alt = data.weather[0].description; // Descrizione dell'icona
        })
        .catch(error => console.error('Errore:', error)); // Gestione errori.
}

function detailsPOI(name, selectedLat, selectedLon, point, radius) {
    const apiKey = 'tNdeH4PSEGzxLQ1CKK0HdCagLd1BsXSc';
    fetch(`https://api.tomtom.com/search/2/poiSearch/${name}.json?key=${apiKey}&lat=${selectedLat}&lon=${selectedLon}&language=it-IT&radius=${radius}&limit=5`)
        .then(response => response.json())
        .then(data => {
            const div = document.createElement('div');
            div.innerHTML = `<h3>POSTI DA VISITARE SUGGERITI DAI NOSTRI SERVER</h3>`;
            const ul = document.createElement('ul');
            div.classList.add('fs-3', 'thought');
            const button = document.createElement('button');
            button.innerHTML = `<i class="fa-solid fa-x"></i>`;
            button.classList.add('bg-danger', 'w-100', 'rounded-pill', 'text-white', 'py-3');
            button.addEventListener('click', function () {
                div.remove();
            });

            if (data.results && data.results.length > 0) {
                // Aggiungi <ul> al <div> solo una volta
                div.append(ul);
                div.append(button);

                // Log delle categorie per comprendere meglio i risultati
                data.results.forEach(result => {

                    const li = document.createElement('li');
                    li.classList.add('py-1', 'border-bottom');
                    li.style.cursor = 'pointer';
                    li.innerHTML = `${result.poi.name}`;

                    // Crea un nuovo `showLi` per ogni `li`
                    const showLi = document.createElement('div');
                    showLi.classList.add('d-none');
                    showLi.innerHTML = `<div class="d-flex align-items-center gap-1"><i class="fa-solid fa-map-pin"></i>${result.address.freeformAddress}</div>`;

                    li.addEventListener('click', function () {
                        showLi.classList.toggle('d-none');
                        showLi.classList.add('show-li')

                        div.classList.add('no-animation')
                        if (this) {
                            setTimeout(function () {
                                div.classList.remove('no-animation')
                            }, 5000)
                        }

                        li.append(showLi); // Aggiungi `showLi` solo al `li` cliccato
                    });

                    ul.append(li);
                });

                // Aggiungi <div> al body una sola volta
                setTimeout(function () {
                    document.querySelector('body').append(div);
                }, 5000);

            } else {
                console.log('Nessun risultato trovato.');
            }
        })
        .catch(error => {
            console.error('Errore nella richiesta:', error);
        });
}


document.addEventListener('DOMContentLoaded', function () {
    showDetails();

    // // variabile per inizializzare il timer 
    // let timer;

    // // funzione che fa uscire un alert 
    // function Myalert() {
    //     return alert('ricorda di usare le note');
    // }

    // // funzione che parte al click del singolo accordion 
    // function cliccaAccordion() {
    //     let tempo = 5000;
    //     timer = setTimeout(Myalert, tempo);
    // }

    // // funzione che stoppa il timer se l'utente clicca prima del tempo 
    // function cliccato() {
    //     clearTimeout(timer);
    //     return
    // }

    // // Seleziona tutti i contenitori degli accordions
    // const accordionContainers = document.querySelectorAll('#stops-container');

    // accordionContainers.forEach(container => {
    //     // Seleziona tutti gli accordions all'interno del contenitore
    //     const accordions = container.querySelectorAll('.my-accordion');

    //     accordions.forEach((accordion) => {
    //         // bottone che apre la modale per aggiungere le note 
    //         const btnNotes = accordion.querySelector('#btn-notes');

    //         // Imposta il timer quando l'accordion viene cliccato
    //         accordion.addEventListener('click', function () {
    //             cliccaAccordion();
    //             if(btnNotes){
    //                   btnNotes.addEventListener('click',cliccato)
    //             }
    //         });
    //             // Stoppa il timer quando viene cliccato il bottone per aggiungere le note
    //             btnNotes.addEventListener('click', function () {
    //                 cliccato();
    //             });
    //     });
    // });
});






