@extends('layouts.app')
@section('content')
    <section id="welcome-page">
        <header class="row px-5">
            <div class="ms-logo-home">
                <img src="{{ asset('img/logo.png') }}" alt="Trip Notes">
            </div>
        </header>

        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <form>
            <h3 class="text-black">Home Page</h3>
            <div class="container">

                <a href="#" class="button type--A">
                    <div class="button__line"></div>
                    <div class="button__line"></div>
                    <span class="button__text text-dark">COME FUNZIONA</span>
                    <div class="button__drow1"></div>
                    <div class="button__drow2"></div>
                </a>
                <a href="{{ route('login') }}" class="button type--B">
                    <div class="button__line"></div>
                    <div class="button__line"></div>
                    <span class="button__text text-dark">LOGIN</span>
                    <div class="button__drow1"></div>
                    <div class="button__drow2"></div>
                </a>
                <a href="{{ route('register') }}" class="button type--C">
                    <div class="button__line"></div>
                    <div class="button__line"></div>
                    <span class="button__text text-dark">REGISTRAZIONE</span>
                    <div class="button__drow1"></div>
                    <div class="button__drow2"></div>
                </a>

            </div>
        </form>
    </section>
@endsection

<style>

</style>
