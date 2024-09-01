

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delele-stop-btn').forEach(button => {
        button.addEventListener('click', function () {
            const stopId = this.getAttribute('data-stopdelit-id');
            const stopElement = document.getElementById(`stop-${stopId}`);
            const closeButton = document.querySelector(`#deleteStopModal-${stopId} .close`);
            

            // console.log(stopId, 'stopid');
            // console.log(stopElement, 'stopelement');

            if (stopElement) {  // Verifica che stopElement non sia null
                axios.delete(`/admin/destroy/${stopId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    }
                })
                .then(response => {
                    if (response.data.status === 'success') {
                        stopElement.remove();  // Rimuove l'elemento dal DOM solo se esiste
                        if (closeButton) {
                            closeButton.click();  // Triggera il click sul bottone con classe "miauu" per chiudere il modale
                        }
                        
                    } else {
                        console.error('Errore:', response.data.message);
                    }
                })
                .catch(error => {
                    console.error('Errore:', error.response ? error.response.data : error.message);
                });
            } else {
                console.error('Errore: Impossibile trovare l\'elemento da eliminare.');
            }
        });
    });
});

