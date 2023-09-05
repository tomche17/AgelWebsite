
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

    <form  role="form" method="POST" action="{{ route('admin.materiel.update',["id" => $materiel->id]) }}" class="admin__form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form__part">
            <div class="form__section">
              <label class="form__label" for="nom">Nom</label>
              <input type="text" class="input--classic" name="nom" id="nom" value="{{$materiel->nom}}" placeholder="{{$materiel->nom}}"/>
            </div>
          </div>


        <div class="form__part">
            <button type="submit" class="bouton bouton--validate form__submit">
              Modifier le matériel
            </button>
        </div>
    </form>
</div>
