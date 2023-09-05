<!DOCTYPE html>
  <html lang="fr">
  <head>
  	<meta charset="UTF-8">
    <title>AGEL - Commande de futs</title>
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
    <link href="{{ asset('/css/screen.css') }}" rel="stylesheet">

  	<!-- Modernizer -->
  </head>

  <body>
    <header class="clearfix">
      <h1 class="title--logo">
        <span class="hide">Association Générale des Etudiants Liegeois</span>
        <a href="{{route("pages.home")}}" title="Retour à la page d'accueil" class="logo__link">
          <img alt="Logo de l'AGEL" src="{{ URL::to('/') }}/img/agel.png" class="logo__img">
        </a>
      </h1>

      <nav class="menu">
        <ul class="menu__list list-inline">

          @if(Auth::User())
            @if(Auth::User()->is_admin == 1)
              <li class="menu__item">
                <a href="{{route("admin")}}" class="menu__link" title="Administration">Administration</a>
              </li>
            @endif
            <li class="menu__item">
              <a href="{{route("logout")}}" class="menu__link" title="Se connecter">Déconnexion</a>
            </li>
          @else
            <li class="menu__item">
              <a href="{{route("login")}}" class="menu__link" title="Se connecter">Connexion</a>
            </li>
          @endif


        </ul>
      </nav>
    </header>
    <main class="clearfix">
