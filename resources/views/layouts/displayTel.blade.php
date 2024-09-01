<nav class="amazing-tabs" class="{{ Route::currentRouteName() }}">
    <div class="main-tabs-container">
        <div class="main-tabs-wrapper">
            <ul class="main-tabs">
                <li>
                    <a class="round-button" href = "{{ route('profile.edit') }}" data-translate-value="0" data-color="red">
                        <span class="avatar">
                            <img src="https://sd2.org/app/uploads/2021/04/pexels-pixabay-270348-1120x1032.jpg"
                                alt="user avatar" />
                        </span>
                    </a>
                </li>
                <li>
                    <a class="round-button gallery active" href="{{ route('admin.trips.index') }}"
                        style="--round-button-active-color: #2962ff " data-translate-value="100%" data-color="blue">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M482.3 192c34.2 0 93.7 29 93.7 64c0 36-59.5 64-93.7 64l-116.6 0L265.2 495.9c-5.7 10-16.3 16.1-27.8 16.1l-56.2 0c-10.6 0-18.3-10.2-15.4-20.4l49-171.6L112 320 68.8 377.6c-3 4-7.8 6.4-12.8 6.4l-42 0c-7.8 0-14-6.3-14-14c0-1.3 .2-2.6 .5-3.9L32 256 .5 145.9c-.4-1.3-.5-2.6-.5-3.9c0-7.8 6.3-14 14-14l42 0c5 0 9.8 2.4 12.8 6.4L112 192l102.9 0-49-171.6C162.9 10.2 170.6 0 181.2 0l56.2 0c11.5 0 22.1 6.2 27.8 16.1L365.7 192l116.6 0z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a class="round-button" style="--round-button-active-color: #00c853" data-translate-value="200%"
                        data-color="green"  href="{{ route('admin.trips.create')}}">
                        <svg fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a class="round-button" href="{{ route('admin.dashboard') }}"
                        style="--round-button-active-color: #aa00ff " data-translate-value="300%" data-color="purple">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a class="round-button" style="--round-button-active-color: #ff6d00 " data-translate-value="400%"
                        data-color="orange" href="{{ route('admin.garbage')}}">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z" />
                        </svg>
                    </a>
                </li>
            </ul>
            <div class="main-slider" aria-hidden="true">
                <div class="main-slider-circle"> </div>
            </div>
        </div>
    </div>
</nav>


<style>
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans&display=swap");

    *,
    *::before,
    *::after {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --background-color: #bbdefb;
        --blue-50: #e3f2fd;
        --blue-100: #bbdefb;
        --blue-A700: #2962ff;
        --green-50: #e8f5e9;
        --green-100: #c8e6c9;
        --green-A700: #00c853;
        --purple-50: #f3e5f5;
        --purple-100: #e1bee7;
        --purple-A700: #aa00ff;
        --orange-50: #fff3e0;
        --orange-100: #ffe0b2;
        --orange-A700: #ff6d00;
        --orange-700: #f57c00;
        --grey-900: #212121;
        --white: #ffffff;
        --round-button-active-color: #212121;
        --translate-main-slider: 100%;
        --main-slider-color: #e3f2fd;
        --translate-filters-slider: 0;
        --filters-container-height: 3.8rem;
        --filters-wrapper-opacity: 1;
    }




    html {
        font-size: 62.5%;
    }

    /*
    html,
    body {
        height: 100%;
    } */

    /* body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: background-color 0.4s ease-in-out;
        background-color: var(--background-color);
    } */

    button {
        border: none;
        cursor: pointer;
        background-color: transparent;
        outline: none;
    }

    /* nav.amazing-tabs {
        background-color: var(--white);
        border-radius: 2.5rem;
        user-select: none;
        padding-top: 1rem;
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        border: 1px solid;
    } */
    nav.amazing-tabs {
        position: fixed;
        /* Imposta il nav come fisso */
        bottom: 10px;
        /* Posiziona il nav al fondo della pagina */
        left: 5px;
        right: 5px;
        background-color: var(--white);
        border: 1px solid;
        border-radius: 2.5rem;
        padding-top: 1rem;
        z-index: 1000;
        /* Assicurati che sia sopra altri contenuti */
    }

    .main-tabs-container {
        padding: 0 1rem 1rem 1rem;
        display: flex;
        justify-content: center;
    }

    .main-tabs-wrapper {
        position: relative;
        display: inline-block;
    }

    ul.main-tabs,
    ul.filter-tabs {
        list-style-type: none;
        display: flex;
        justify-content: center;
    }

    ul.main-tabs li {
        display: inline-flex;
        position: relative;
        padding: 1.5rem;
        z-index: 1;
    }

    .avatar,
    .avatar img {
        height: 4rem;
        width: 4rem;
        border-radius: 50%;
        pointer-events: none;
    }

    .avatar img {
        object-fit: cover;
    }

    .round-button {
        height: 4.8rem;
        width: 4.8rem;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--grey-900);
        transition: color 0.2s ease-in-out;
    }

    .round-button:hover,
    .round-button.active {
        color: var(--round-button-active-color);
    }

    .round-button svg {
        pointer-events: none;
        height: 2.8rem;
        width: 2.8rem;
        transform: translate(0, 0);
    }

    .main-slider {
        pointer-events: none;
        position: absolute;
        top: 0;
        left: 20px;
        padding: 1.5rem;
        z-index: 0;
        transition: transform 0.4s ease-in-out;
        transform: translateX(var(--translate-main-slider));
    }

    .main-slider-circle {
        height: 4.8rem;
        width: 4.8rem;
        border-radius: 50%;
        transition: background-color 0.4s ease-in-out;
        background-color: var(--main-slider-color);
    }

    .animate-jello {
        animation: jello-horizontal 0.9s both;
    }

    @keyframes jello-horizontal {
        0% {
            transform: scale3d(1, 1, 1);
        }

        30% {
            transform: scale3d(1.25, 0.75, 1);
        }

        40% {
            transform: scale3d(0.75, 1.25, 1);
        }

        50% {
            transform: scale3d(1.15, 0.85, 1);
        }

        65% {
            transform: scale3d(0.95, 1.05, 1);
        }

        75% {
            transform: scale3d(1.05, 0.95, 1);
        }

        100% {
            transform: scale3d(1, 1, 1);
        }
    }

    .filters-container {
        overflow: hidden;
        padding: 0 3rem;
        transition: max-height 0.4s ease-in-out;
        max-height: var(--filters-container-height);
    }

    .filters-wrapper {
        position: relative;
        transition: opacity 0.2s ease-in-out;
        opacity: var(--filters-wrapper-opacity);
    }

    .filter-tabs {
        border-radius: 1rem;
        padding: 0.3rem;
        overflow: hidden;
        background-color: var(--orange-50);
    }

    .filter-tabs li {
        position: relative;
        z-index: 1;
        display: flex;
        flex: 1 0 33.33%;
    }

    .filter-button {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.8rem;
        flex-grow: 1;
        height: 3rem;
        padding: 0 1.5rem;
        color: var(--orange-700);
        font-family: "Open Sans", sans-serif;
        font-weight: 400;
        font-size: 1.4rem;
    }

    .filter-button.filter-active {
        transition: color 0.4s ease-in-out;
        color: var(--grey-900);
    }

    .filter-slider {
        pointer-events: none;
        position: absolute;
        padding: 0.3rem;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
    }

    .filter-slider-rect {
        height: 3rem;
        width: 33.33%;
        border-radius: 0.8rem;
        background-color: var(--white);
        box-shadow: 0 0.1rem 1rem -0.4rem rgba(0, 0, 0, 0.12);
        transition: transform 0.4s ease-in-out;
        transform: translateX(var(--translate-filters-slider));
    }

    @media (min-width: 991px) {
        nav {
            display: none;
        }
    }
</style>

