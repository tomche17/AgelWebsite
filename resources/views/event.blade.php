@extends('layouts.backend')
@section('content')

<div class="title__container">
  <h2 class="page__title">Commande pour un évènement</h2>
  <p class="page__subtitle">Merci de sélectionner l'évènement se rapportant à votre commande.</p>
</div>


@include('form/event')
@endsection
