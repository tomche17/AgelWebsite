
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

    <form  role="form" method="POST" action="{{ route('admin.inventaire.update', ["id" => $inventaire->id]) }}" class="admin__form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form__part">


          <div class="form__section">
            <label class="form__label" for="date">Date</label>
            <input type="date" class="input--classic" name="date" id="date" value="{{$inventaire->day}}" placeholder="Date"/>
          </div>

          <div class="form__section">
            <label class="form__label" for="time">Heure</label>
            <input type="time" class="input--classic" name="time" id="date" value="{{$inventaire->hour}}" placeholder="Heure"/>
          </div>

          <div class="form__section">
            <label class="form__label" for="responsable">Responsable</label>
            <span class="select__wrapper">
              <select class="form__select form__input input--classic" name="responsable" id="responsable">
                @if($inventaire->reponsable)
                  @foreach($responsables as $responsable)
                    @if ($inventaire->responsable->id == $responsable->id)
                      <option value="{{$responsable->id}}" selected>{{$responsable->prenom}} {{$responsable->nom}}</option>
                    @else
                      <option value="{{$responsable->id}}">{{$responsable->prenom}} {{$responsable->nom}}</option>
                    @endif
                  @endforeach
                @else
                  @foreach($responsables as $responsable)
                    <option value="{{$responsable->id}}">{{$responsable->prenom}} {{$responsable->nom}}</option>
                  @endforeach
                @endif
              </select>
            </span>
          </div>



        </div>


        <div class="form__part">
            <button type="submit" class="bouton bouton--validate form__submit">
              Modifier l'inventaire
            </button>
        </div>
    </form>
</div>
