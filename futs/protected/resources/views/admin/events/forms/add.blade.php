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

    <form  role="form" method="POST" action="{{ route('admin.event.create') }}" class="admin__form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form__part">
            <div class="form__section">
              <label class="form__label" for="nom">Nom</label>
              <input type="text" class="input--classic" name="nom" id="nom" value="{{ old('nom') }}" placeholder="Nom"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="date">Date</label>
              <input type="date" class="input--classic" name="date" id="date" value="{{ old('date') }}" placeholder="Date"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="comite">Structure</label>
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

          </div>


        <div class="form__part">
            <button type="submit" class="bouton bouton--validate form__submit">
              Ajouter l'évènement
            </button>
        </div>
    </form>
</div>
