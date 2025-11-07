@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row align-items-center rounded-3 border shadow-lg overflowhidden">
            <div class="col-lg-7 p-5">
                <div class="text-center text-lg-center">
                    <h1 class="display-4 fw-bold lh-1 mb-3">Boîte à idées</h1>
                        <p class="lead">Une idée révolutionnaire vous a traversé l'esprit ? Notez-la vite avant de l'oublier !</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        @auth
                            <p class="lead fw-normal">Bienvenue {{ Auth::user()->name }} !</p>
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px4">Connexion</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px4">S'inscrire</a>
                        @endguest
                    </div>
                </div>
            </div>
            <div class="col-lg-4 p-0">
                <img src="{{ asset('images/boite.png') }}" class="img-fluid" alt="Aperçu du tableau de bord" style="height: 100%">
            </div>
        </div>
    </div>
@endsection