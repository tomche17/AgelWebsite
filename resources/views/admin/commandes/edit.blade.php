@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Modifier une commande</h2>
    </div>
    <div class="content">
        <form action="{{ route('admin.commande.update', ['id' => $commande->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <section class="form__part clearfix">
              <h3 class="section__title">Informations</h3>
            <div class="form__section">
                <label class="form__label" for="event">Nom de l'évènement</label>
                <input type="text" class="input--classic" name="event_name" value="{{ $event-> nom }}" placeholder="Nom de l'évènement">
              </div>
              <div class="form__section">
                <label class="form__label" for="event">Date de l'évènement</label>
                <input type="date" class="input--classic" name="event_date" value="{{ $event-> date  }}">
              </div>
              <div class="form__section">
                  <label class="form__label" for="comite">Organisateur</label>
                  <span class="select__wrapper">
                    <select id="id_cb" name="id_cb" class="form__select form__input input--classic">
                    <option value="{{ $cb->id }}" selected> {{$cb->nom}}</option>
                    @foreach ($comites as $comite)
                        @if ($comite->id != $cb->id)
                            <option value="{{ $comite->id }}"> {{$comite->nom}} </option>
                        @endif
                    @endforeach
                </select>
                  </span>
              </div>
              <div class="form__section">
                  <label class="form__label" for="frequentation">Fréquentation estimée</label>
                  <input type="text" class="input--classic" name="frequentation" id="frequentation" value="{{$commande->frequentation}}" placeholder="Nombre de personnes">
              </div>
              <div class="form__section">
                  <label class="form__label" >Nom du responsable</label>
                  @if(Auth::check())
                    <input type="text" class="input--classic" name="nom" id="nom" value="{{$commande->nom}}" placeholder="Nom">
                  @else
                    <input type="text" class="input--classic" name="nom" id="nom" value="{{$commande->nom}}" placeholder="Nom">
                  @endif
              </div>
              <div class="form__section">
                  <label class="form__label" for="prenom">Prénom du responsable</label>
                  @if(Auth::check())
                    <input type="text" class="input--classic" name="prenom" id="prenom" value="{{$commande->prenom}}" placeholder="Prénom">
                  @else
                    <input type="text" class="input--classic" name="prenom" id="prenom" value="{{$commande->prenom}}" placeholder="Prénom">
                  @endif
              </div>
              <div class="form__section">
                  <label class="form__label" for="email">Email du responsable</label>
                  @if(Auth::check())
                    <input type="email" class="input--classic" name="email" id="email" value="{{$commande->email}}" placeholder="Email">
                  @else
                    <input type="email" class="input--classic" name="email" id="email" value="{{$commande->email}}" placeholder="Email">
                  @endif
              </div>
              <div class="form__section">
                  <label class="form__label" for="adresselegale">Adresse légale</label>
                  <input type="text" class="input--classic" name="adresselegale" id="adresselegale" value="{{ $commande->adresselegale }}" placeholder="Adresse légale">
              </div>
              <div class="form__section">
                  <label class="form__label" for="adressefacturation">Adresse de Facturation</label>
                  <input type="text" class="input--classic" name="adressefacturation" id="adressefacturation" value="{{ $commande->adressefacturation }}" placeholder="Adresse de Facturation">
              </div>
              <div class="form__section">
                  <label class="form__label" for="adresselivraison">Adresse de livraison</label>
                  <input type="text" class="input--classic" name="adresselivraison" id="adresselivraison" value="{{ $commande->adresselivraison }}" placeholder="Adresse de livraison">
              </div>
              <div class="form__section">
                  <label class="form__label" for="telephone">Numéro de téléphone</label>
                  @if(Auth::check())
                  <input type="text" class="input--classic" name="telephone" id="telephone" value="{{ $commande->telephone }}" placeholder="Numéro de téléphone">
                  @else
                  <input type="text" class="input--classic" name="telephone" id="telephone" value="{{ $commande->telephone }}" placeholder="Numéro de téléphone">
                  @endif
                  
              </div>
              </section>
              <section class="form__part clearfix">
                <h3 class="section__title">Commande</h3>
                @foreach($futs as $fut)
                <div class="form__futs">
                    <div class="form__section">
                        <label class="fut__label" for="fut{{$fut->id}}">{{$fut->nom}}</label>
                        <div class="futs__infos">
                            <p class="fut__prix"><span class="prix__prix">{{$fut->prix}}</span>€</p>
                            <span class="prix__multiplicateur">x</span>

                            @php
                            $quantity = 0;
                            $associatedFut = $futCommandes->where('futs_id', $fut->id)->first();
                            if($associatedFut) {
                                $quantity = $associatedFut->nombre;
                            }
                            @endphp

                            <input type="number" class="input--classic fut__input fut--data" min="0" name="fut{{$fut->id}}" id="fut{{$fut->id}}" placeholder="0" value="{{ $quantity }}">
                        </div>
                    </div>
                </div>
              @endforeach
              <input type="hidden" name="commandetotal" id="commandetotal" value="0"/>

              <div class="futs__total">
                <p class="total__text">Total provisoire : <span class="total__number">0</span> €</p>
              </div>
              </section>

   
                <button type="submit" class="bouton bouton--validate form__submit">
                  Enregistrer et modifier la commande
                </button>

        </form>
    </div>

    @endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Fonction pour mettre à jour le total
    function updateTotal() {
        var total = 0;

        // Parcourir chaque input
        $('.fut__input').each(function() {
            var quantity = parseInt($(this).val()) || 0;  
            var price = parseFloat($(this).closest('.form__section').find('.prix__prix').text()) || 0;
            
            if(quantity < 0) {
                alert('Les nombres négatifs ne sont pas autorisés.');
                $(this).val('');
                quantity = 0;
            }

            total += quantity * price;
        });
        
        // Afficher le total
        $('.total__number').text(total.toFixed(2));

        // Mise à jour de l'input caché
        $('#commandetotal').val(total.toFixed(2));
    }

    // Appeler updateTotal à chaque changement des input fut__input
    $('.fut__input').on('input', updateTotal);

    // Appeler updateTotal lors du chargement initial de la page pour initialiser le total
    updateTotal();
});


</script>
