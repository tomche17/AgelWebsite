
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

    <form  role="form" method="POST" action="{{ route('admin.stock.create') }}" class="admin__form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form__part">
            <div class="form__section">
              <label class="form__label" for="nom">Nom</label>
              <input type="text" class="input--classic" name="name" id="nom" value="{{ old('nom') }}" placeholder="Nom"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="quantity">Quantité actuelle</label>
              <input type="number" class="input--classic" name="quantity" id="quantity" value="{{ old('quantity') }}"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="price">Prix</label>
              <input type="text" class="input--classic" name="price" id="price" value="{{ old('price') }}" placeholder="Prix"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="description">Courte description<i class="fa fa-info-circle" title="Exemple: une heras est considérée comme en état si les 4 coins tiennent ensemble"></i></label>


              <input type="text" class="input--classic" name="description" id="description" placeholder="Courte description"/>

            </div>

          </div>


        <div class="form__part">
            <button type="submit" class="bouton bouton--validate form__submit">
              Ajouter l'élément au stock
            </button>
        </div>
    </form>
</div>
