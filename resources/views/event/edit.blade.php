@extends('layouts.backend')
@section('content')
  <div class="title__container">
    <h2 class="page__title">Modifier l'évenement "{{$event->nom}}"</h2>
  </div>
 
<div class="wrapper--forms">


    @if (count($errors) > 0)
    <div class="commande__error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form  role="form" method="POST" action="{{ route('admin.event.update', ["id" => $event->id]) }}" class="admin__form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form__part">
            <div class="form__section">
              <label class="form__label" for="nom">Nom</label>
              <input type="text" class="input--classic" name="nom" id="nom" value="{{$event->nom}}" placeholder="Nom"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="date">Date souhaitée</label>
              <input type="date" class="input--classic" name="date" id="date" value="{{$event->date}}" placeholder="Date"/>
              <p class="text-muted">Vous recevrez une confirmation dès que votre date est validée.</p>
            </div>
          </div>
                      <!-- Google Calendar Embed -->
                      <div class="form__section">
            <label class="form__label" for="date">Réservation actuelle de la salle</label>
                <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=2&bgcolor=%239E69AF&ctz=Europe%2FBrussels&showTitle=1&hl=en_GB&src=YWdlbC5hc2JsQGdtYWlsLmNvbQ&src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=OTAwYWQyNmJkMmQyNmZlNGZiZjlmNGViZTY0ODIxNjQyNTZkYmVmYzg1ZTM0ZjEwNTE0NjU2YjIzNDUwODViYUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=ZW4uYmUjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&color=%23039BE5&color=%2333B679&color=%23E67C73&color=%230B8043" style="border: 1px solid #ccc; margin: 20px 0;" width="100%" height="400" frameborder="0"></iframe>
            </div>
            <!-- Structure organisatrice -->
            @if (Auth::user() && Auth::user()->droit == 1)
                        <div class="form__section">
                            <label class="form__label" for="comite">Structure organisatrice</label>
                            <span class="select__wrapper">
                            <select class="form__select form__input input--classic" name="comite" id="comite">
                                <option value="{{ $cb->id }}" selected>{{$cb->nom}}</option>
                                <option value="">Extérieur</option>
                                @foreach($comites as $comite)
                                <option value="{{$comite->id}}">{{$comite->nom}}</option>
                                @endforeach
                            </select>
                            </span>
                        </div>
                        @endif
            <!-- Type de salle -->
            <div class="form__section">
                            <label class="form__label" for="salle">Type de salle</label>
                            <span class="select__wrapper">
                            <select class="form__select form__input input--classic" name="salle" id="salle">
                                <option value="{{ $event->salle}}" selected>{{ $event->salle}}</option>
                                <option value="0">Grande salle</option>
                                <option value="1">Petit robermont</option>
                                <option value="2">Les deux</option>
                            </select>
                            </span>
                        </div>


        <div class="form__part">
            <button type="submit" class="bouton bouton--validate form__submit">
              Modifier l'évènement
            </button>
        </div>
    </form>
</div>

@endsection
