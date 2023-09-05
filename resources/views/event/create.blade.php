@extends('layouts.backend')
@section('content')
<div class="title__container">
    <h2 class="page__title">Ajouter un événement</h2>
</div>
<div class="wrapper--forms">

    @if (count($errors) > 0)
    <div class="commande__error">
        <strong>Oops ! Quelque chose s'est mal passé.</strong>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form role="form" method="POST" action="{{ route('events.create') }}" class="admin__form">
        @csrf
        <div class="form__part">
            <!-- Nom de l'événement -->
            <div class="form__section">
                <label class="form__label" for="nom">Nom de l'événement</label>
                <input type="text" class="input--classic" name="nom" id="nom" value="{{ old('nom') }}" placeholder="Nom"/>
            </div>
            <!-- Type de salle -->
            <div class="form__section">
                <label class="form__label" for="salle">Type de salle</label>
                <span class="select__wrapper">
                <select class="form__select form__input input--classic" name="salle" id="salle">
                    <option disabled selected>Sélectionnez un type de salle</option>
                    <option value="0">Grande salle</option>
                    <option value="1">Petit robermont</option>
                    <option value="2">Les deux</option>
                </select>
                </span>
            </div>
            <!-- Date souhaitée -->
            <div class="form__section">
                <label class="form__label" for="date">Date souhaitée</label>
                
                <input type="date" class="input--classic" name="date" id="date" value="{{ old('date')  }}" placeholder="Date"/>
                <p class="text-muted">Vous recevrez une confirmation dès que votre date est validée.</p>
            </div>

            <!-- Google Calendar Embed -->
            <div class="form__section">
            <label class="form__label" for="date">Réservation actuelle de la salle</label>
            <iframe src="https://calendar.google.com/calendar/embed?src=900ad26bd2d26fe4fbf9f4ebe6482164256dbefc85e34f10514656b2345085ba%40group.calendar.google.com&ctz=Europe%2FBrussels" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
            </div>

            <!-- Structure organisatrice -->
            @if (Auth::user() && Auth::user()->droit == 1)
            <div class="form__section">
                <label class="form__label" for="comite">Structure organisatrice</label>
                <span class="select__wrapper">
                <select class="form__select form__input input--classic" name="comite" id="comite">
                    <option disabled selected>Sélectionnez une structure</option>
                    <option value="">Extérieur</option>
                    @foreach($comites as $comite)
                    <option value="{{$comite->id}}">{{$comite->nom}}</option>
                    @endforeach
                </select>
                </span>
            </div>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="form__part">
            <button type="submit" class="bouton bouton--validate form__submit">Ajouter l'événement</button>
        </div>
    </form>
</div>
@endsection
