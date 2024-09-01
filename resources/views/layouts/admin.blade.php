<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
        integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    {{-- link font awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- axios cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    {{-- link ajax  --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
    <!-- Usando Vite -->
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <!-- =============== Navigation ================ -->
    {{-- QUA AGGIUNTO ID CONTENT-CONTAINER PER VISUALIZARE API DEL CLICK --}}
    <div class="my-container" id="content-container">
        <div class="navigation">
            <ul>
                {{-- logo della sidebar --}}
                <li class="my-2 mb-5">
                    <img id="logo" src="{{ asset('img/logo.png') }}" class="icon-image" alt="">
                </li>
                {{-- /logo della sidebar --}}

                    <li class="{{ Route::currentRouteName() == 'admin.dashboard' ? 'hovered curvet curveb' : '' }}" id="dashboard-link"
                    style="{{ Route::currentRouteName() == 'admin.dashboard' ? 'background-color: #E3F2FD;color: black;' : '' }}" >
                        <a href="{{ route('admin.dashboard') }}" class="icon fs-5" 
                        style="{{ Route::currentRouteName() == 'admin.dashboard' ? 'color: black;' : '' }}" >
                            <i class="fa-solid fa-house-user"></i><span class="ms-span">Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ Route::currentRouteName() == 'admin.trips.index' ? 'hovered curvet curveb' : '' }}"  id="trip-index-link" 
                    style="{{ Route::currentRouteName() == 'admin.trips.index' ? 'background-color: #E3F2FD;color: black;' : '' }}">
                        <a href="{{ route('admin.trips.index') }}" class="icon fs-5"
                        style="{{ Route::currentRouteName() == 'admin.trips.index' ? 'color: black;' : '' }}">
                            <i class="fa-solid fa-plane"></i><span class="ms-span">Viaggi</span>
                        </a>
                    </li>
                    <li class="{{ Route::currentRouteName() == 'admin.trips.create' ? 'hovered curvet curveb' : '' }}"
                    style="{{ Route::currentRouteName() == 'admin.trips.create' ? 'background-color: #E3F2FD;color: black;' : '' }}">
                        <a href="{{ route('admin.trips.create') }}" class="icon fs-5"
                        style="{{ Route::currentRouteName() == 'admin.trips.create' ? 'color: black;' : '' }}">
                            <i class="fa-solid fa-circle-plus"></i><span class="ms-span">Aggiungi viaggio</span>
                        </a>
                    </li>
                    <li class="{{ Route::currentRouteName() == 'admin.garbage' ? 'hovered curvet curveb' : '' }}"
                    style="{{ Route::currentRouteName() == 'admin.garbage' ? 'background-color: #E3F2FD;color: black;' : '' }}">
                        <a href="{{ route('admin.garbage') }}" class="icon fs-5"
                        style="{{ Route::currentRouteName() == 'admin.garbage' ? 'color: black;' : '' }}">
                            <i class="fa-solid fa-trash-can"></i><span class="ms-span">Cestino</span>
                        </a>
                    </li>
                    <li class="{{ Route::currentRouteName() == 'profile' ? 'hovered curvet curveb' : '' }}"
                    style="{{ Route::currentRouteName() == 'profile' ? 'background-color: #E3F2FD;color: black;' : '' }}">
                        <a href="{{ route('profile.edit') }}" class="icon fs-5"
                        style="{{ Route::currentRouteName() == 'profile' ? 'color: black;' : '' }}">
                            <i class="fa-solid fa-user-gear"></i><span class="ms-span">Profilo</span>
                        </a>
                    </li>
                </ul>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main position-relative my-padding-display-tel">{{-- questa classe qua --}}
            {{-- wave  --}}
            <img class="wave position-absolute w-100" style="height: 300px ; z-index:0" src="{{ asset('img/wave.png') }}">
            <div class="topbar">
                <div class="toggle">
                    {{-- <ion-icon name="menu-outline"></ion-icon> --}}
                    <i name="menu-outline" class="fa-solid fa-down-left-and-up-right-to-center"></i>
                </div>

                <div class="user">
                    {{-- <img src="{{ asset('img/logo-black.png') }}" alt="logo"> --}}
                                       
                </div>
            </div>
            <div class="px-4">
                @yield('content')
            </div>

        </div>
    </div>
    </div>

    @extends('layouts.displaytel')


    <script>
        // Seleziona tutti gli elementi <li> all'interno dell'elemento con la classe .navigation e li memorizza in una variabile.
        let list = document.querySelectorAll(".navigation li");
        let logo = document.getElementById("logo");

        // Funzione per gestire l'aggiunta della classe "hovered" all'elemento <li> attualmente sotto il mouse.
        function activeLink() {
            // Rimuove la classe "hovered" da tutti gli elementi della lista.
            list.forEach((item) => {
                item.classList.remove("hovered");
            });
            // Aggiunge la classe "hovered" all'elemento <li> che ha attivato l'evento mouseover (quello su cui si trova il mouse).
            this.classList.add("hovered");
        }

        // Aggiunge un gestore di eventi "mouseover" a ciascun elemento della lista, che chiama la funzione activeLink.
        list.forEach((item) => item.addEventListener("mouseover", activeLink));

        // Seleziona l'elemento con la classe .toggle, che presumibilmente è un pulsante o un controllo per attivare/disattivare il menu.
        let toggle = document.querySelector(".toggle");
        // Seleziona l'elemento con la classe .navigation, che è probabilmente un menu di navigazione.
        let navigation = document.querySelector(".navigation");
        // Seleziona l'elemento con la classe .main, che potrebbe essere il contenuto principale della pagina o una sezione collegata al menu.
        let main = document.querySelector(".main");

        // Aggiunge un gestore di eventi di clic all'elemento .toggle.
        toggle.onclick = function() {
            // Alterna la classe "active" sull'elemento .navigation, mostrando o nascondendo il menu di navigazione.
            navigation.classList.toggle("active");
            // Alterna la classe "active" sull'elemento .main, che potrebbe cambiare l'aspetto del contenuto principale o del layout quando il menu viene mostrato/nascosto.
            main.classList.toggle("active");

            // Cambia l'immagine del logo in base alla presenza della classe 'active'
            if (navigation.classList.contains("active")) {
                logo.src = "{{ asset('img/logo-small.png') }}"; // Nuova immagine quando attivo
                logo.classList.add('logo-small');
            } else {
                logo.src = "{{ asset('img/logo.png') }}"; // Immagine originale quando inattivo
                logo.classList.remove('logo-small');
            }
        };
    </script>
    <!-- ====== ionicons ======= -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    {{-- @stack('scripts') --}}
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
</body>

</html>
