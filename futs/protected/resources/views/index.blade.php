@extends('app')
@section('content')
  <div class="title__container">
    <h2 class="page__title">Réservation de la salle de Guindaille AGEL</h2>
    <p class="page__subtitle">Commencez dès maintenant!</p>

    <ul class="home__buttons list-inline">
      <li class="home__item">
        <a href="{{route("commande.event")}}" class="home__link bouton bouton--admin" title="COmmander">Passer commande</a>
      </li>
      @if(Auth::User())
      @else
        <li class="home__item">
          <a href="{{route("login")}}" class="home__link bouton bouton--admin" title="Se connecter">Connexion</a>
        </li>
      @endif
    </ul>
  </div>
@endsection
