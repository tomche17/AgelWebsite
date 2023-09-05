
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

    <form  role="form" method="POST" action="{{ route('admin.inventaire.create') }}" class="admin__form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form__part">

          <div class="form__section">
            <label class="form__label" for="evenement">Evenement</label>
            <span class="select__wrapper">
              <select class="form__select form__input input--classic" name="evenement" id="evenement">
                @foreach($events as $event)
                  @if (old('event') == $event->id)
                    <option value="{{$event->id}}" selected>{{$event->nom}}</option>
                  @else
                    <option value="{{$event->id}}">{{$event->nom}}</option>
                  @endif

                @endforeach
              </select>
            </span>
          </div>

          <div class="form__section">
            <label class="form__label" for="date">Date</label>
            <input type="date" class="input--classic" name="date" id="date" value="{{ old('date') }}" placeholder="Date"/>
          </div>

          <div class="form__section">
            <label class="form__label" for="responsable">Responsable</label>
            <span class="select__wrapper">
              <select class="form__select form__input input--classic" name="responsable" id="responsable">
                @foreach($responsables as $responsable)
                  @if (old('responsable') == $responsable->id)
                    <option value="{{$responsable->id}}" selected>{{$responsable->prenom}} {{$responsable->nom}}</option>
                  @else
                    <option value="{{$responsable->id}}">{{$responsable->prenom}} {{$responsable->nom}}</option>
                  @endif

                @endforeach
              </select>
            </span>
          </div>

          <div class="form__section">
            <label class="form__label" for="type">Type</label>
            <span class="select__wrapper">
              <select class="form__select form__input input--classic" name="type" id="type">
                <option value="entree">Inventaire d'entrée</option>
                <option value="sortie">Inventaire de sortie</option>
              </select>
            </span>
          </div>


        </div>


        <div class="form__part">
            <button type="submit" class="bouton bouton--validate form__submit">
              Ajouter l'inventaire
            </button>
        </div>
    </form>
</div>
