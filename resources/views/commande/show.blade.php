@extends('layouts.backend')
@section('content')

<div class="wrapper">
  @if(Auth::User())
    @if($commande->is_validated == true || Auth::User()->is_admin == 1)
    <div class="title__container">
      @if($commande->is_validated == false)
      <h2 class="page__title">Commande (N°{{$commande->id}}) en attente de validation</h2>
      <p class="page__subtitle">Résumé de commande</p>
      @else
        <h2 class="page__title">Commande traitée (N°{{$commande->id}})</h2>
        <p class="page__subtitle">Résumé de commande</p>
      @endif
  @else
    @if($commande->is_validated == false)

    <p class="page__subtitle">Résumé de commande</p>
    @else
      <h2 class="page__title">Commande traitée (N°{{$commande->id}})</h2>
      <p class="page__subtitle">Résumé de commande</p>
    @endif
  @endif
  </div>


  <section class="recap__part">
  
  </section>
  <section class="recap__part">
    <h3 class="section__title">Informations générales</h3>
    <p class="recap__lign"><span class="element__nom">Evènement :</span> {{$commande->event->nom}} - {{$commande->event->date}}</p>
    <p class="recap__lign"><span class="element__nom">Fréquentation estimée :</span>{{$commande->frequentation}}</p>
    <p class="recap__lign"><span class="element__nom">Commanditaire :</span> {{$commande->prenom}} {{$commande->nom}}</p>
    <p class="recap__lign"><span class="element__nom">Email:</span> {{$commande->email}}</p>
    <p class="recap__lign"><span class="element__nom">Adresse légale :</span> {{$commande->adresselegale}}</p>
    <p class="recap__lign"><span class="element__nom">Adresse de facturation :</span> {{$commande->adressefacturation}}</p>
    <p class="recap__lign"><span class="element__nom">Adresse de livraison :</span> {{$commande->adresselivraison}}</p>
    <p class="recap__lign"><span class="element__nom">Téléphone du responsable de l'inventaire :</span> {{$commande->telephone}}</p>
  </section>
  <section class="recap__part">
    <h3 class="section__title">Votre commande</h3>

    <div class="recap__futs">
      @foreach($commande->futs as $fut)
        @if($fut->pivot->nombre > 0)
        <p class="recap__lign"><span class="element__nom">{{$fut->nom}}</span> x {{$fut->pivot->nombre}}</p>
        @endif
      @endforeach
    </div>

    <div class="recap__matos">
      @foreach($commande->materiels as $materiel)
        @if($materiel->pivot->nombre > 0)
        <p class="recap__lign"><span class="element__nom">{{$materiel->nom}}</span> x {{$materiel->pivot->nombre}}</p>
        @endif
      @endforeach
    </div>

    <p class="recap__total">Total : {{$commande->prixtotal}}€</p>
  </section>
  
  @else
    <div class="title__container">
      <h2 class="page__title">Votre commande (N°{{$commande->id}}) est en cours de traitement</h2>
      <p class="page__subtitle">Vous recevrez un email une fois celle-ci traitée.</p>
    </div>
  @endif
</div>
@endsection
