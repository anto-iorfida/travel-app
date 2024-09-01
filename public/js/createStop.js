document.addEventListener('DOMContentLoaded', function () {

    const cityInputs = document.querySelectorAll('city');
    const countryInputs = document.querySelectorAll('country');
    const streetInputs = document.querySelectorAll('street');
    const forms = document.querySelectorAll('#form-stop');
    const names = document.querySelectorAll('#name');
    const timeStarts = document.querySelectorAll('#time_start');
    const timeEnds = document.querySelectorAll('#time_end');
    const descriptions = document.querySelectorAll('#description');
    const images = document.querySelectorAll('#image');
    // const messages = document.querySelectorAll('messages');

    const latCountryInputs = document.querySelectorAll('latCountry');
    const lonCountryInputs = document.querySelectorAll('lonCountry');
    const latCityInputs = document.querySelectorAll('latCity');
    const lonCityInputs = document.querySelectorAll('lonCity');
    const latStreetInputs = document.querySelectorAll('latStreet');
    const lonStreetInputs = document.querySelectorAll('lonStreet');

        forms.forEach((form, formIndex) => {
            console.log(`Form Index: ${formIndex}`);
        });


     
    // forms.addEventListener('submit', e => {
    //     e.preventDefault();

    //     const isValid = validateInputs();

    //     if (isValid) {
    //         form.submit(); // Invia il form se è valido
    //     }
    // });

    // const setSuccess = element => {
    //     const inputControl = element.parentElement;
    //     const errorDisplay = inputControl.querySelectorAll('.error');
    //     errorDisplay.innerText = '';
    //     inputControl.classList.add('success');
    //     inputControl.classList.remove('error');
    // };

    // const setError = (element, message) => {
    //     const inputControl = element.parentElement;
    //     const errorDisplay = inputControl.querySelectorAll('.error');

    //     errorDisplay.innerHTML = message;
    //     inputControl.classList.add('error');
    //     inputControl.classList.remove('success');
    // };

    // const validateInputs = () => {
    //     let isValid = true;

    //     const nameValue = name.value.trim();
    //     const streetValue = streetInput.value.trim();
    //     const descriptionValue = description.value.trim();
    //     const timeStartValue = timeStart.value.trim();
    //     const timeEndValue = timeEnd.value.trim();
    //     const ratingValue = rating.value.trim();
    //     const imageFile = image.files[0];

    //     if (nameValue === '') {
    //         setError(name, 'Il titolo è obbligatorio');
    //         isValid = false;
    //     } else if (nameValue.length <= 3) {
    //         setError(name, 'Il campo titolo deve essere almeno di 3 caratteri');
    //         isValid = false;
    //     } else {
    //         setSuccess(name);
    //     }

    //     if (descriptionValue !== '' && descriptionValue.length < 5) {
    //         setError(description, 'La descrizione deve essere di almeno 5 caratteri se fornita');
    //         isValid = false;
    //     } else {
    //         setSuccess(description);
    //     }

    //     if (streetValue === '') {
    //         setError(streetInput, 'La destinazione è obbligatoria');
    //         isValid = false;
    //     } else {
    //         setSuccess(streetInput);
    //     }

    //     if (ratingValue === '') {
    //         setError(rating, 'La valutazione è obbligatoria');
    //         isValid = false;
    //     } else {
    //         setSuccess(rating);
    //     }

    //     if (imageFile && !['image/jpeg', 'image/png', 'image/gif', 'image/webp'].includes(imageFile.type)) {
    //         setError(image, 'Se fornito, il file deve essere un\'immagine (JPEG, PNG, GIF, WEBP)');
    //         isValid = false;
    //     } else {
    //         setSuccess(image);
    //     }

    //     if (timeStartValue === '') {
    //         setError(timeStart, 'L\'orario di inizio è obbligatorio');
    //         isValid = false;
    //     } else if (!/^\d{2}:\d{2}$/.test(timeStartValue)) {
    //         setError(timeStart, 'L\'orario di inizio deve essere nel formato HH:mm');
    //         isValid = false;
    //     } else {
    //         setSuccess(timeStart);
    //     }

    //     if (timeEndValue === '') {
    //         setError(timeEnd, 'L\'orario di fine è obbligatorio');
    //         isValid = false;
    //     } else if (!/^\d{2}:\d{2}$/.test(timeEndValue)) {
    //         setError(timeEnd, 'L\'orario di fine deve essere nel formato HH:mm');
    //         isValid = false;
    //     } else if (new Date(`1970-01-01T${timeEndValue}:00Z`) <= new Date(`1970-01-01T${timeStartValue}:00Z`)) {
    //         setError(timeEnd, 'L\'orario di fine deve essere successivo a quello di inizio');
    //         isValid = false;
    //     } else {
    //         setSuccess(timeEnd);
    //     }

    //     return isValid;
    // };

    // Assuming that these functions are for demo purposes and should be replaced with actual API requests
    // countryInput.addEventListener('input', function () {
    //     const query = countryInput.value.trim().toLowerCase();
    //     if (query.length > 0) {
    //         // Replace with actual API request to get lat/lon
    //         latCountryInput.value = 45.96937700;
    //         lonCountryInput.value = 8.97064700;
    //         console.log(
    //             'paese:' + query,
    //             'lat:' + latCountryInput.value,
    //             'lon:' + lonCountryInput.value
    //         );
    //     }
    // });

    // cityInput.addEventListener('input', function () {
    //     const query = cityInput.value.trim().toLowerCase();
    //     if (query.length > 0) {
    //         // Replace with actual API request to get lat/lon
    //         latCityInput.value = 45.96937700;
    //         lonCityInput.value = 8.97064700;
    //         console.log(
    //             'city:' + query,
    //             'lat:' + latCityInput.value,
    //             'lon:' + lonCityInput.value
    //         );
    //     }
    // });

    // streetInput.addEventListener('input', function () {
    //     const query = streetInput.value.trim().toLowerCase();
    //     if (query.length > 0) {
    //         // Replace with actual API request to get lat/lon
    //         latStreetInput.value = 45.96937700;
    //         lonStreetInput.value = 8.97064700;
    //         console.log(
    //             'street:' + query,
    //             'lat:' + latStreetInput.value,
    //             'lon:' + lonStreetInput.value
    //         );
    //     }
    // });
});
