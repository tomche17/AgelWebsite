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
              <label class="form__label" for="date">Date</label>
              <input type="date" class="input--classic" name="date" id="date" value="{{$event->day}}" placeholder="Date"/>
            </div>
          </div>


        <div class="form__part">
            <button type="submit" class="bouton bouton--validate form__submit">
              Modifier l'évènement
            </button>
        </div>
    </form>
</div>
