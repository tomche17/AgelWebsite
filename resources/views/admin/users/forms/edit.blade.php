
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

    <form  role="form" method="POST" action="{{ route('admin.user.update',["id" => $user->id]) }}" class="admin__form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form__part">
            <div class="form__section">
              <label class="form__label" for="nom">Nom</label>
              <input type="text" class="input--classic" name="name" id="nom" value="{{ $user->name }}" placeholder="Nom"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="surname">Prénom</label>
              <input type="text" class="input--classic" name="surname" id="surname" value="{{ $user->surname }}" placeholder="Prénom"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="email">Email</label>
              <input type="text" class="input--classic" name="email" id="email" value="{{ $user->email }}" placeholder="Email"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="phone">Téléphone</label>
              <input type="text" class="input--classic" name="phone" id="phone" value="{{ $user->phone }}" placeholder="phone"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="quantity">Comité</label>
              <select name="comite_id" id="cb">
                @php
                  $this_cb = \App\Comite::findOrFail($user->comite_id);
                @endphp
                <option value="{{$user->comite_id}}">{{$this_cb->nom}}</option> 
                @foreach ($comites as $cb)
                  @if ($cb->id != $this_cb->id)
                    <option value="{{$cb->id}}">{{$cb->nom}}</option>     
                  @endif          
                @endforeach
              </select>
            </div>

            <div class="form__section">
                <label class="form__label" for="price">Fait partie du bureau AGEL ?</label>
                <input type="checkbox" class="input--classic" name="is_admin" id="admin" value="{{ $user->is_admin }}" @if($user->droit == 1) checked @endif />
            </div>


          </div>


        <div class="form__part">
            <button type="submit" class="bouton bouton--validate form__submit">
              Modifier l'utilisateur
            </button>
        </div>
    </form>
</div>
