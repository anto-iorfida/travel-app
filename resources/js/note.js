// aggiunta nota 

// function initializeNoteHandlers() {
    window.initializeNoteHandlers = function() {
        // Seleziona tutti i moduli di nota
        const forms = document.querySelectorAll('#form-notes');
       
        // console.log('FORMSok',forms);
    
    
        forms.forEach(form => {
            // Trova il contenitore delle note associato a questo modulo
            const notesWrapper = form.closest('.notes-container').querySelector('.my-wrap-note');
            // console.log('notesrapperok',notesWrapper);
    
    
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Previeni il comportamento di invio predefinito
    
                const textField = form.querySelector('#text');
                const textValue = textField.value.trim();
                const error = form.querySelector('.error')
                // console.log(error);
                
    
                // Validazione lato client
                if (textValue.length < 3) {
                    if (error) {
                        error.innerText = "Il contenuto devo contenere almeno 3 caratteri";
                    }
                }else{
                    error.innerText = "";
                }
    
    
                const formData = new FormData(form); // Ottieni i dati del modulo
    
                // console.log('Form Data:', Array.from(formData.entries())); // Log dei dati del modulo
    
                axios.post(form.action, formData, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Include il token CSRF
                        'Accept': 'application/json',
                    }
                })
                    .then(response => {
                        const data = response.data;
    
                        if (data.status === 'success') {
                            // Crea un nuovo elemento per la nuova nota
                            const noteElement = document.createElement('div');
                            noteElement.className = 'my-col d-flex flex-column align-items-center';
                            noteElement.setAttribute('data-note-id', data.note.id);
                            // noteElement.textContent = data.note.text; // Imposta il testo della nota
                            noteElement.innerHTML = `
                            <p class="mb-0 flex-grow-1 my-p-note">${data.note.text}</p>
                            <div class="d-flex gap-5 mb-3 my-fa-delete-left">
                                <i class="fa-solid fa-delete-left"></i>
                            </div>
                        `;
                            notesWrapper.appendChild(noteElement); // Aggiungi la nuova nota al wrapper
    
                            // Ricollega l'evento click sull'icona di eliminazione
                            attachDeleteListener(noteElement.querySelector('.my-fa-delete-left'));
    
                            // Pulisci il campo di testo del modulo
                            textField.value = '';
                        } else {
                            console.error('Error:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error.response ? error.response.data : error.message);
                    });
            });
        });
        // Funzione per collegare l'evento click (// eliminazione nota)
        function attachDeleteListener(icon) {
            icon.addEventListener('click', function () {
                const noteElement = this.closest('.my-col');
                const noteId = noteElement.getAttribute('data-note-id');
    
                axios.delete(`/admin/notes/${noteId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    }
                })
                    .then(response => {
                        if (response.data.status === 'success') {
                            noteElement.remove();
                        } else {
                            console.error('Errore:', response.data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Errore:', error.response ? error.response.data : error.message);
                    });
            });
        }
    
        // Inizialmente collega l'evento click a tutte le icone di eliminazione già presenti
        document.querySelectorAll('.fa-delete-left').forEach(icon => {
            attachDeleteListener(icon);
        });

}




document.addEventListener('DOMContentLoaded', function () {
    initializeNoteHandlers();
});


// eliminazione nota NON ELIMINARE LASCIARE IN CASO DI PROBLEMI DI ELIMINAZIONE NOTE
// document.addEventListener('DOMContentLoaded', function () {
// document.querySelectorAll('.fa-delete-left').forEach(icon => {
//     icon.addEventListener('click', function () {
//         const noteElement = this.closest('.alert');
//         const noteId = noteElement.getAttribute('data-note-id');

//         // if (confirm('Sei sicuro di voler eliminare questa nota?')) {
//         axios.delete(`/admin/notes/${noteId}`, {  // URL corretto per la rotta di eliminazione
//             headers: {
//                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//                 'Accept': 'application/json',
//             }
//         })
//             .then(response => {
//                 if (response.data.status === 'success') {
//                     noteElement.remove();  // Rimuove la nota dal DOM
//                 } else {
//                     console.error('Errore:', response.data.message);
//                 }
//             })
//             .catch(error => {
//                 console.error('Errore:', error.response ? error.response.data : error.message);
//             });
//         // }
//     });
// });
// });





