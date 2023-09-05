
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

    <form  role="form" method="POST" action="{{ route('admin.user.update', ["id" => $user->id]) }}" class="admin__form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form__part">
            <div class="form__section">
              <label class="form__label" for="nom">Nom</label>
              <input type="text" class="input--classic" name="nom" id="nom" value="{{$user->nom}}" placeholder="Nom"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="prenom">Prénom</label>
              <input type="text" class="input--classic" name="prenom" id="prenom" value="{{$user->prenom}}" placeholder="Prénom"/>
            </div>
            <div class="form__section">
              <label class="form__label" for="email">Email</label>
              <input type="email" class="input--classic" name="email" id="email" value="{{$user->email}}" placeholder="Adresse email"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="comite">Comité</label>
              <span class="select__wrapper">
                <select class="form__select form__input input--classic" name="comite" id="comite">
                  <option disabled selected>Sélectionnez une structure</option>
                    <option value="">Extérieur</option>
                  @foreach($comites as $comite)
                    @if($user->comite_id == $comite->id)
                      <option value="{{$comite->id}}" selected>{{$comite->nom}}</option>
                    @else

                      <option value="{{$comite->id}}">{{$comite->nom}}</option>
                    @endif

                  @endforeach
                </select>
              </span>
            </div>

            <div class="form__section">
              <label class="form__label" for="isresponsable">Bureau AGEL</label>
              <span class="select__wrapper">
                <select class="form__select form__input input--classic" name="isresponsable" id="isresponsable">

                  @if($user->is_responsable == 0)
                    <option value="0" selected>Ne fait pas partie du Bureau</option>
                    <option value="1">Fait partie du Bureau</option>
                  @else
                    <option value="1" selected>Fait partie du Bureau</option>
                    <option value="0">Ne fait pas partie du Bureau</option>
                  @endif
                </select>
              </span>
            </div>
          </div>


        <div class="form__part">
            <button type="submit" class="bouton bouton--validate form__submit">
              Ajouter le membre
            </button>
        </div>
    </form>
</div>
