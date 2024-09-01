
// function initializeRatingHandlers() {
    window.initializeRatingHandlers = function() {

        const formsRatings = document.querySelectorAll('.form-rating');
    
        formsRatings.forEach((formRating) => {
            // Per ogni modulo di valutazione trovato, esegue la seguente funzione.
            const labels = formRating.querySelectorAll('fieldset label');
            // Seleziona tutte le etichette di input all'interno del modulo di valutazione.
            const showValue = formRating.querySelector('.rating-value');
            // Seleziona l'elemento che mostra il valore della valutazione.
            const review = formRating.querySelector('.review');
            // Seleziona l'elemento del textarea per la recensione.
            const stopId = formRating.querySelector('input[name="stop_id"]').value;
            // Ottiene il valore dell'input nascosto 'stop_id' dal modulo.
    
            const ratingCardWrapper = document.getElementById(`ratingCardWrapper-${stopId}`);
            // Seleziona l'elemento che mostra la card di valutazione, basandosi su 'stop_id'.
            const ratingComponentWrapper = document.getElementById(`ratingComponentWrapper-${stopId}`);
            // Seleziona l'elemento che contiene il modulo di valutazione, basandosi su 'stop_id'.
    
            labels.forEach((label) => {
                // Per ogni etichetta all'interno del modulo di valutazione, esegue la seguente funzione.
                label.addEventListener('click', function () {
                    // Aggiunge un listener per l'evento di clic su ciascuna etichetta.
                    const labelFor = this.getAttribute('for');
                    // Ottiene l'attributo 'for' dell'etichetta cliccata (che corrisponde all'ID dell'input di valutazione).
                    const star = formRating.querySelector(`#${labelFor}`);
                    // Seleziona l'input di valutazione corrispondente all'ID ottenuto.
                    if (star) {
                        star.checked = true;
                        // Se l'input di valutazione esiste, lo seleziona.
                        showValue.innerHTML = star.value;
                        // Aggiorna il contenuto di 'showValue' con il valore dell'input selezionato.
                    }
                });
            });
    
    
            formRating.addEventListener('submit', e => {
                e.preventDefault();
    
                if (validateInputs()) {
                    // Se la validazione degli input ha successo, esegue la seguente funzione.
                    const url = formRating.getAttribute('data-url-rating');
                    // Ottiene l'URL per inviare la valutazione dal modulo.
                    const formData = new FormData(formRating);
                    // Crea un oggetto FormData con i dati del modulo.
    
                    axios.post(url, formData , {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                        }
                    })
                        .then(response => {
                            if (response.data.status === 'success') {
                                if (ratingComponentWrapper) {
                                    if (ratingComponentWrapper.classList.contains('d-none')){
                                        ratingComponentWrapper.classList.remove('d-none');
                                    }else{
                                        ratingComponentWrapper.classList.add('d-none');
                                    }
                                }
    
                                if (ratingCardWrapper) {
                                    // Estrae il valore numerico della valutazione da 'showValue'.
                                    const ratingValue = parseInt(showValue.innerText, 10)
                                    updateRatingCard(ratingValue, review.value, stopId);
    
    
                                    // Rimuove la classe 'd-none'
                                    ratingCardWrapper.classList.remove('d-none');
    
                                    // Forza il reflow del layout
                                    const _ = ratingCardWrapper.offsetHeight;
    
                                    // Aggiorna la card con la nuova valutazione
                                } else {
                                    console.error(`ratingCardWrapper con ID ratingCardWrapper-${stopId} non trovato.`);
                                }
                            } else {
                                console.error('Errore server:', response.data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Errore:', error);
                            alert(`Errore: ${error.message}`);
                        });
                }
            });
    
            const validateInputs = () => {
                // Funzione per validare gli input del modulo.
                let isValid = true;
                // Variabile per indicare se il modulo è valido.
                const rating = formRating.querySelector('input[name="rating"]:checked');
                // Seleziona l'input di valutazione selezionato.
                const reviewValue = review.value.trim();
                // Ottiene e pulisce il valore della recensione.
    
                if (!rating) {
                    setError(formRating.querySelector('input[name="rating"]'), 'La valutazione è obbligatoria');
                    // Se nessuna valutazione è selezionata, imposta un errore e aggiorna lo stato di validazione.
                    isValid = false;
                } else {
                    // Se una valutazione è selezionata, imposta lo stato di successo.
                    setSuccess(rating);
                }
    
                if (reviewValue !== '' && reviewValue.length < 3) {
                    setError(review, 'La descrizione deve essere di almeno 3 caratteri se fornita');
                    isValid = false;
                } else {
                    setSuccess(review);
                }
    
                return isValid;
            };
            // Funzione per aggiornare la card di valutazione.
            const updateRatingCard = (ratingValue, reviewText, stopId) => {
    
                for (let i = 1; i <= 5; i++) {
                    const starElement = document.querySelector(`#ratingCardWrapper-${stopId} .star__item:nth-child(${i})`);
                    if (starElement) {
                        if (i <= ratingValue) {
                            starElement.classList.add('gold');
                        } else {
                            starElement.classList.remove('gold');
                        }
                    }
                }
                // Aggiorna il contenuto del paragrafo con la recensione fornita.
                const ratingReviewElement = document.querySelector(`#ratingCardWrapper-${stopId} p`);
                if (ratingReviewElement) {
                    ratingReviewElement.textContent = reviewText;
                }
            };
    
            // Funzione per impostare lo stato di successo di un elemento.
            const setSuccess = (element) => {
                const inputControl = element.parentElement;
                inputControl.classList.add('success');
                inputControl.classList.remove('error');
            };
            // Funzione per impostare lo stato di errore di un elemento.
            const setError = (element, message) => {
                const inputControl = element.parentElement;
                const errorDisplay = inputControl.querySelector('.error');
                if (errorDisplay) errorDisplay.innerText = message;
                inputControl.classList.add('error');
                inputControl.classList.remove('success');
            };
    
                // Aggiungi un listener al bottone "ciao" per eliminare la valutazione
                const deleteButton = ratingCardWrapper.querySelector('.delete-rating-btn');
                deleteButton.addEventListener('click', function () {
                    axios.delete(`/admin/stops/${stopId}/rating`, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => {
                        if (response.data.status === 'success') {
                            ratingCardWrapper.classList.add('d-none'); // Rimuove la card dal DOM
                                if(ratingComponentWrapper){     
                                       ratingComponentWrapper.classList.remove('d-none');
                                    }else{
                                        ratingComponentWrapper.classList.add('d-none');
                                        ratingCardWrapper.classList.remove('d-none');
                                    }        
                        } else {
                            console.error('Errore server:', response.data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Errore:', error);
                        alert(`Errore: ${error.message}`);
                    });
                });
        });

};

document.addEventListener('DOMContentLoaded', function () {

    initializeRatingHandlers();
});

