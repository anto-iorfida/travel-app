window.searchPOISuggestion = function(){

    const sections = document.querySelectorAll('.section-show-stop');
    
    sections.forEach(section => {
        const hotelIcon = section.querySelector('.hotel-btn');
        const restaurantIcon = section.querySelector('.restaurant-btn');
        const pizzaIcon = section.querySelector('.pizza-btn');
        const barIcon = section.querySelector('.bar-btn');
        const museoIcon = section.querySelector('.museo-btn');
        const centriBenessereIcon = section.querySelector('.centri-benessere-btn');
        const turistaIcon = section.querySelector('.turista-btn');
        const container = section.querySelector('.suggestions-all ul');
        const btnClosedSuggestion = section.querySelector('.btn-closed-suggestion')
        // Memorizza i risultati dell'API in un oggetto
        let poiResults = {};
    
        function fetchPOIs(categoryName, lat, lon, radius) {
            const apiKey = 'tNdeH4PSEGzxLQ1CKK0HdCagLd1BsXSc';
            const limit = 15;
            const url = `https://api.tomtom.com/search/2/categorySearch/${categoryName}.json?key=${apiKey}&lat=${lat}&lon=${lon}&radius=${radius}&limit=${limit}&language=it-IT&sortBy=distance`;
    
            if (poiResults[categoryName]) {
                console.log(`Mostrando risultati salvati per ${categoryName}`);
                displayResults(poiResults[categoryName], lat, lon);
                return;
            }
    
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.results) {
                        poiResults[categoryName] = data.results.slice(0, limit);
                        displayResults(poiResults[categoryName], lat, lon);
                    } else {
                        console.log('Nessun risultato trovato.');
                        container.innerHTML = "<li>Nessun risultato trovato.</li>";
                    }
                })
                .catch(error => {
                    console.error('Errore nella richiesta API:', error);
                });
        }
    
        function displayResults(results, lat, lon) {
            container.innerHTML = "";
            container.style.height = "0px";
            container.innerHTML = `<h3>Risultati n:${results.length}</h3>`;
            container.style.height = "550px";
    
            results.forEach((result, index) => {
                const metri = result.dist;
                const chilometri = metri / 1000;
                const chilometriArrotondati = chilometri > 1 ? chilometri.toFixed(2) : null;
                const Result = chilometri > 1
                    ? `${parseFloat(chilometriArrotondati)} Km`
                    : `${Math.round(metri)} Metri`;
    
                const myLi = document.createElement('li');
                const divFirst = document.createElement('div');
                divFirst.classList.add('d-flex', 'align-items-center', 'gap-5', 'fw-medium', 'my-li');
                divFirst.innerHTML = `<div class="d-flex align-items-center gap-2"><i class="fa-solid fa-street-view my-hover-icon"></i>${result.poi.name}</div>
                        <div class="d-none d-lg-block"> Distante: ${Result}</div>`;
                myLi.append(divFirst);
    
                const suggestion = document.createElement('div');
                suggestion.classList.add('my-card', 'd-none');
    
                const uniqueMapId = `map-${index}`; // ID unico per ciascuna mappa
                suggestion.innerHTML = `
                        <div class="my-bg-content">
                            ${result.poi.phone ? `<div><i class="fa-solid fa-square-phone-flip"></i>: ${result.poi.phone}</div>` : ''}
                            ${result.poi.url ? `<a href="https://${result.poi.url}" class="my-a-url" target="_blank"><i class="fa-solid fa-globe"></i>: ${result.poi.url}</a>` : ''}
                            <div><i class="fa-solid fa-road"></i>: ${result.address.freeformAddress || 'Indirizzo non disponibile'}</div>
                            <div><i class="fa-solid fa-map-pin"></i>: dista ${Result}</div>
                            <div class="mt-2">MAPPA</div>
                            <div id="${uniqueMapId}" class="rounded mb-4 map ms-auto me-auto"></div>
                        </div>
                    `;
                divFirst.addEventListener('click', function () {
                    if (suggestion.classList.contains('d-none')) {
                        divFirst.classList.add('my-bg-click-li');
                        suggestion.classList.remove('d-none');
                        myLi.appendChild(suggestion);
                        // Inizializzazione della mappa con ID unico
                        const mapContainer = suggestion.querySelector(`#${uniqueMapId}`);
                        const map = tt.map({
                            key: 'tNdeH4PSEGzxLQ1CKK0HdCagLd1BsXSc',
                            container: mapContainer,
                            center: [result.position.lon, result.position.lat],
                            zoom: 15
                        });
                        map.addControl(new tt.FullscreenControl());
                        map.addControl(new tt.NavigationControl());
                        const marker = new tt.Marker()
                            .setLngLat([result.position.lon, result.position.lat])
                            .addTo(map);
                    } else {
                        suggestion.classList.add('d-none');
                        divFirst.classList.remove('my-bg-click-li');
                    }
                });
    
                container.appendChild(myLi);
                if (container.innerHTML.length > 1) {
                    btnClosedSuggestion.classList.add('d-block')
                    btnClosedSuggestion.classList.remove('d-none')
                    btnClosedSuggestion.addEventListener('click', function () {
                        container.innerHTML = ""
                        btnClosedSuggestion.classList.add('d-none')
                        container.style.height = "0px";
                        btnClosedSuggestion.classList.remove('d-block')
                    })
                } else {
                    btnClosedSuggestion.classList.add('d-none')
                    btnClosedSuggestion.classList.remove('d-block')
                }
            });
        }
    
    
        // Event listeners per le icone
        if (hotelIcon) {
            hotelIcon.addEventListener('click', function (e) {
                e.preventDefault();
                const lat = hotelIcon.getAttribute('data-lat');
                const lon = hotelIcon.getAttribute('data-lon');
                fetchPOIs('hotel', lat, lon, 25000);
            });
        } else {
            console.error('Hotel icon not found!');
        }
    
        if (restaurantIcon) {
            restaurantIcon.addEventListener('click', function (e) {
                e.preventDefault();
                const lat = restaurantIcon.getAttribute('data-lat');
                const lon = restaurantIcon.getAttribute('data-lon');
                fetchPOIs('ristorante', lat, lon, 10000);
            });
        } else {
            console.error('Restaurant icon not found!');
        }
    
        if (pizzaIcon) {
            pizzaIcon.addEventListener('click', function (e) {
                e.preventDefault();
                const lat = pizzaIcon.getAttribute('data-lat');
                const lon = pizzaIcon.getAttribute('data-lon');
                fetchPOIs('pizzeria', lat, lon, 10000);
            });
        } else {
            console.error('Pizza icon not found!');
        }
    
        if (barIcon) {
            barIcon.addEventListener('click', function (e) {
                e.preventDefault();
                const lat = barIcon.getAttribute('data-lat');
                const lon = barIcon.getAttribute('data-lon');
                fetchPOIs('bar', lat, lon, 10000);
            });
        } else {
            console.error('Bar icon not found!');
        }
    
        if (museoIcon) {
            museoIcon.addEventListener('click', function (e) {
                e.preventDefault();
                const lat = museoIcon.getAttribute('data-lat');
                const lon = museoIcon.getAttribute('data-lon');
                fetchPOIs('museo', lat, lon, 50000);
            });
        } else {
            console.error('Museo icon not found!');
        }
    
        if (centriBenessereIcon) {
            centriBenessereIcon.addEventListener('click', function (e) {
                e.preventDefault();
                const lat = centriBenessereIcon.getAttribute('data-lat');
                const lon = centriBenessereIcon.getAttribute('data-lon');
                fetchPOIs('spa', lat, lon, 10000);
            });
        } else {
            console.error('Centri Benessere icon not found!');
        }
    
        if (turistaIcon) {
            turistaIcon.addEventListener('click', function (e) {
                e.preventDefault();
                const lat = turistaIcon.getAttribute('data-lat');
                const lon = turistaIcon.getAttribute('data-lon');
                fetchPOIs('important tourist attraction', lat, lon, 10000);
            });
        } else {
            console.error('Turista icon not found!');
        }
    
    });
}


document.addEventListener('DOMContentLoaded', function () {
    searchPOISuggestion();
});
