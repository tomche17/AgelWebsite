
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

    <form  role="form" method="POST" action="{{ route('admin.user.create') }}" class="admin__form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form__part">
            <div class="form__section">
              <label class="form__label" for="nom">Nom</label>
              <input type="text" class="input--classic" name="name" id="nom" value="{{ old('name') }}" placeholder="Nom"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="surname">Prénom</label>
              <input type="text" class="input--classic" name="surname" id="surname" value="{{ old('surname') }}" placeholder="Prénom"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="email">Email</label>
              <input type="text" class="input--classic" name="email" id="email" value="{{ old('email') }}" placeholder="Email"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="phone">Téléphone</label>
              <input type="text" class="input--classic" name="phone" id="phone" value="{{ old('phone') }}"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="quantity">Comité</label>
              <select name="comite_id" id="cb">
                @foreach ($comites as $cb)
                  <option value="{{$cb->id}}">{{$cb->nom}}</option>                  
                @endforeach
              </select>
            </div>

            <div class="form__section">
              <label class="form__label" for="price">Fait partie du bureau AGEL ?</label>
              <input type="checkbox" class="input--classic" name="is_admin" id="admin" value="{{ old('is_admin') }}"/>
            </div>

          </div>


        <div class="form__part">
            <button type="submit" class="bouton bouton--validate form__submit">
              Ajouter l'utilisateur
            </button>
        </div>
    </form>
</div>
