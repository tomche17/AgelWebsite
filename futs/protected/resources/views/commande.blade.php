@extends('app')
@section('content')

<div class="title__container">
  <h2 class="page__title">Commande pour un évènement</h2>
  <p class="page__subtitle">Merci de remplir tous les champs si dessous pour valider votre commande</p>
</div>


@include('form/commande')
@endsection
