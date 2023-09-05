@extends('layouts.backend')

@section('content')
<div class="content">
        <h2 class="content-heading">Ajouter une commande</h2>
    </div>
    <div class="content">
        <form action="{{ route('commandes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <section class="form__part clearfix">
              <h3 class="section__title">Informations</h3>
              <div class="form__section">
              <label class="form__label" for="event">Nom de l'évènement</label>
                    <select id="event_id" class="form-control form-content" name="event_id" onchange="updateDateField()">
                        <option value="" disabled selected>Veuillez sélectionner un événement</option> <!-- Cette ligne a été ajoutée -->
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" data-date="{{ $event->date }}">{{ $event->nom }}</option>
                        @endforeach
                    </select>

              </div>

              <div class="form__section">
                  <label class="form__label" for="event_date">Date de l'évènement</label>
                  <input type="date" id="event_date" class="input--classic" name="event_date" readonly>

              </div>

              <div class="form__section">
                <label class="form__label" for="comite">Organisateur</label>
                <span class="select__wrapper">
                @if (Auth::user()->droit == 2)
                    @php
                    $userComite = $comites->firstWhere('id', $user_comite_id);
                    @endphp
                    <input type="hidden" name="comite" value="{{ $user_comite_id }}">
                    <p>{{ $userComite->nom }}</p>
                @else
                    <select class="form__select form__input input--classic" name="comite" id="comite" required>
                        <option value="">Choisis un CB</option>
                        @foreach ($comites as $comite)
                            <option value="{{$comite->id}}">{{$comite->nom}}</option>
                        @endforeach
                    </select>
                @endif
                </span>
            </div>


              <div class="form__section">
                  <label class="form__label" for="frequentation">Fréquentation estimée</label>
                  <input type="text" class="input--classic" name="frequentation" id="frequentation"  placeholder="Nombre de personnes">
              </div>
              <div class="form__section">
                  <label class="form__label" for="nom">Nom du responsable</label>
                  @if(Auth::check())
                    <input type="text" class="input--classic" name="nom" id="nom" placeholder="Nom">
                  @else
                    <input type="text" class="input--classic" name="nom" id="nom" placeholder="Nom">
                  @endif
              </div>

              <div class="form__section">
                  <label class="form__label" for="prenom">Prénom du responsable</label>
                  @if(Auth::check())
                    <input type="text" class="input--classic" name="prenom" id="prenom" placeholder="Prénom">
                  @else
                    <input type="text" class="input--classic" name="prenom" id="prenom" placeholder="Prénom">
                  @endif
              </div>
              <div class="form__section">
                  <label class="form__label" for="email">Email du responsable</label>
                  @if(Auth::check())
                    <input type="email" class="input--classic" name="email" id="email" placeholder="Email">
                  @else
                    <input type="email" class="input--classic" name="email" id="email" placeholder="Email">
                  @endif
              </div>
              <div class="form__section">
                  <label class="form__label" for="adresselegale">Adresse légale</label>
                  <input type="text" class="input--classic" name="adresselegale" id="adresselegale" placeholder="Adresse légale">
              </div>

              <div class="form__section">
                  <label class="form__label" for="adressefacturation">Adresse de Facturation</label>
                  <input type="text" class="input--classic" name="adressefacturation" id="adressefacturation" placeholder="Adresse de Facturation">
              </div>

              <div class="form__section">
                  <label class="form__label" for="adresselivraison">Adresse de livraison</label>
                  <input type="text" class="input--classic" name="adresselivraison" id="adresselivraison" placeholder="Adresse de livraison" value="Rue de Droixhe 10, 4020 Liège">
              </div>

              <div class="form__section">
                  <label class="form__label" for="telephone">Numéro de téléphone</label>
                  @if(Auth::check())
                  <input type="text" class="input--classic" name="telephone" id="telephone" placeholder="Numéro de téléphone">
                  @else
                  <input type="text" class="input--classic" name="telephone" id="telephone" placeholder="Numéro de téléphone">
                  @endif
                  
              </div>
            </section>

            <section class="form__part clearfix">
                <h3 class="section__title">Commande</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prix unitaire</th>
                            <th> </th>
                            <th>Nombre </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                @foreach($futs as $fut)
                <tr>
                                <td>
                  <div class="form__futs">
                    <div class="form__section">
                        <label class="fut__label" for="fut{{$fut->id}}">{{$fut->nom}}</label>  </td>
                        <td>
                        <div class="futs__infos">
                          <p class="fut__prix"><span class="prix__prix">{{$fut->prix}}</span>€</p>  </td>
                          <td><span class="prix__multiplicateur">x</span>  </td>
                          
                          <td> <input type="number" class="input--classic fut__input fut--data" min="0" name="fut{{$fut->id}}" id="fut{{$fut->id}}" placeholder="0">  </td>
                        </div>
                    </div>
                  </div>
                @endforeach
                </tbody>
                </table>
                <input type="hidden" name="commandetotal" id="commandetotal" value="0"/>

                <div class="futs__total">
                  <p class="total__text">Total provisoire : <span class="total__number">0</span> €</p>
                </div>
            </section>

            <button type="submit" class="btn btn-success" id="submitBtn">Envoyer la commande</button>
            <button type="button" class="btn btn-danger">Annuler</button>

        </form>
    </div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

function updateDateField() {
    // Récupérer le dropdown de l'évènement et le champ de saisie de la date
    const eventDropdown = document.getElementById('event_id');
    const dateInput = document.getElementById('event_date');

    // Récupérer la date de l'option sélectionnée
    const selectedDate = eventDropdown.options[eventDropdown.selectedIndex].getAttribute('data-date');
    console.log(date);
    // Mettre à jour la valeur du champ de saisie de la date
    dateInput.value = selectedDate;
    dateInput.setAttribute("readonly", true); // rendre le champ en lecture seule
}


$(document).ready(function() {

$('#event_id').on('change', function() {
    var selectedEventDate = $(this).find('option:selected').data('date');
    $('input[name="event_date"]').val(selectedEventDate);
});

function updateTotal() {
    var total = 0;

    // Iterate over each input
    $('.fut__input').each(function() {
        var quantity = parseInt($(this).val()) || 0;
        // Since your price is now within another TD, we need to navigate up to the TR, then find the .prix__prix span
        var price = parseFloat($(this).closest('tr').find('.prix__prix').text()) || 0;

        if (quantity < 0) {
            alert('Les nombres négatifs ne sont pas autorisés.');
            $(this).val('');
            quantity = 0;
        }

        total += quantity * price;
    });

    // Disable or enable the submit button based on the total
    if (total === 0) {
        $('#submitBtn').prop('disabled', true);
    } else {
        $('#submitBtn').prop('disabled', false);
    }

    // Display the total
    $('.total__number').text(total.toFixed(2));

    // Update the hidden input
    $('#commandetotal').val(total.toFixed(2));
}

// Initialize the state of the button
updateTotal();

$('.fut__input').on('input', updateTotal);
});

</script>
