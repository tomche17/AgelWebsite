
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

    <form  role="form" method="POST" action="{{ route('admin.stock.update',["id" => $stock->id]) }}" class="admin__form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form__part">
            <div class="form__section">
              <label class="form__label" for="nom">Nom</label>
              <input type="text" class="input--classic" name="name" id="nom" value="{{$stock->name}}" placeholder="{{$stock->name}}"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="quantity">Quantité actuelle</label>
              <input type="number" class="input--classic" name="quantity" id="quantity" value="{{$stock->quantity}}" placeholder="{{$stock->quantity}}"/>
            </div>

            <div class="form__section">
              <label class="form__label" for="price">Prix</label>
              <input type="text" class="input--classic" name="price" id="price" value="{{$stock->price}}" placeholder="{{$stock->price}}"/>
            </div>
            <div class="form__section">
              <label class="form__label" for="description">Courte description<i class="fa fa-info-circle" title="Exemple: une heras est considérée comme en état si les 4 pieds tiennent ensemble"></i></label>
              <input type="text" class="input--classic" name="description" id="description" value="{{$stock->description}}" placeholder="{{$stock->description}}"/>

        </div>


        <div class="form__part">
            <button type="submit" class="bouton bouton--validate form__submit">
              Modifier l'élément
            </button>
        </div>
    </form>
</div>
