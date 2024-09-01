
    // Seleziona l'elemento della lista delle schede principali.
    const mainTabs = document.querySelector(".main-tabs");

    // Seleziona il cerchio del cursore dello slider principale.
    const mainSliderCircle = document.querySelector(".main-slider-circle");

    // Seleziona tutti i pulsanti rotondi all'interno delle schede principali.
    const roundButtons = document.querySelectorAll(".round-button");

    // Seleziona l'elemento con la classe .main, che potrebbe essere utilizzato per cambiare lo sfondo.
    const mainElement = document.querySelector(".main");

    // Definisce un oggetto contenente diverse palette di colori con varianti.
    const colors = {
        blue: {
            50: {
                value: "#e3f2fd"
            },
            100: {
                value: "#bbdefb"
            }
        },
        green: {
            50: {
                value: "#e8f5e9"
            },
            100: {
                value: "#c8e6c9"
            }
        },
        purple: {
            50: {
                value: "#fffffl"
            },
            100: {
                value: "#d4dfed"
            }
        },
        orange: {
            50: {
                value: "#ffe0b2"
            },
            100: {
                value: "#ffe0b2"
            }
        },
        red: {
            50: {
                value: "#ffebee"
            },
            100: {
                value: "#ffcdd2"
            }
        }
    };

    // Funzione per ottenere il valore del colore dato un nome e una variante.
    const getColor = (color, variant) => {
        return colors[color][variant].value;
    };

    // Funzione per gestire l'attivazione di una scheda, rimuovendo la classe "active" da tutte le schede e aggiungendola solo alla scheda selezionata.
    const handleActiveTab = (tabs, event, className) => {
        tabs.forEach((tab) => {
            tab.classList.remove(className);
        });

        if (!event.target.classList.contains(className)) {
            event.target.classList.add(className);
        }
    };

    // Recupera il colore e la traslazione salvati nel localStorage e applica questi valori al caricamento della pagina.
    const applySavedSettings = () => {
        const savedColor = localStorage.getItem('selectedColor');
        const savedTranslateValue = localStorage.getItem('translateValue');

        if (savedColor && savedTranslateValue) {
            const root = document.documentElement;
            root.style.setProperty("--translate-main-slider", savedTranslateValue);
            root.style.setProperty("--main-slider-color", getColor(savedColor, 50));
            root.style.setProperty("--background-color", getColor(savedColor, 100));

            if (mainElement) {
                mainElement.style.backgroundColor = getColor(savedColor, 50);
            }

            // Attiva il pulsante corrispondente
            roundButtons.forEach(button => {
                if (button.dataset.color === savedColor) {
                    handleActiveTab(roundButtons, {
                        target: button
                    }, "active");
                }
            });
        }
    };

    // Aggiunge un gestore di eventi per il click sulle schede principali.
    mainTabs.addEventListener("click", (event) => {
        // Seleziona l'elemento radice (root) del documento per modificare le variabili CSS globali.
        const root = document.documentElement;

        // Ottiene il colore target e il valore di traslazione dal dataset dell'elemento cliccato.
        const targetColor = event.target.dataset.color;
        const targetTranslateValue = event.target.dataset.translateValue;

        // Verifica se l'elemento cliccato ha la classe "round-button".
        if (event.target.classList.contains("round-button")) {
            // Rimuove temporaneamente l'animazione di jello dal cerchio dello slider.
            mainSliderCircle.classList.remove("animate-jello");
            void mainSliderCircle.offsetWidth; // Forza il reflow per resettere l'animazione.
            mainSliderCircle.classList.add("animate-jello"); // Riapplica l'animazione di jello.

            // Aggiorna le variabili CSS per lo slider principale e il colore di sfondo.
            root.style.setProperty("--translate-main-slider", targetTranslateValue);
            root.style.setProperty("--main-slider-color", getColor(targetColor, 50));
            root.style.setProperty("--background-color", getColor(targetColor, 100));

            // Cambia il colore di sfondo dell'elemento .main, se esiste.
            if (mainElement) {
                mainElement.style.backgroundColor = getColor(targetColor, 50);
            }

            // Salva le preferenze dell'utente nel localStorage.
            localStorage.setItem('selectedColor', targetColor);
            localStorage.setItem('translateValue', targetTranslateValue);

            // Gestisce l'attivazione della scheda, rimuovendo la classe "active" da tutte le schede e aggiungendola solo alla scheda cliccata.
            handleActiveTab(roundButtons, event, "active");
        }
    });

    // Applica le impostazioni salvate quando la pagina viene caricata.
    applySavedSettings();

