
    <div class="commande__form wrapper">
        @if (count($errors) > 0)
        <div class="commande__error error--bordered">
            <p class="alert__message">Oups, il y a <span class="alert__count">{{ count($errors) }}</span> soucis dans votre formulaire !</p>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form  role="form" method="POST" action="{{ route('doCommande') }}" class="commande__form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <section class="form__part clearfix">
              <h3 class="section__title">Informations</h3>
              <div class="form__section">
                <label class="form__label" for="event">Nom de l'évènement</label>
                <span class="select__wrapper">
                  <select class="form__select commande__form form__input input--classic" name="event" id="event">
                    <option value="{{$event->id}}" selected>{{$event->nom}} - {{$event->date}}</option>
                  </select>
                </span>
              </div>

              <div class="form__section">
                  <label class="form__label" for="frequentation">Fréquentation</label>
                  <input type="text" class="input--classic" name="frequentation" id="frequentation" value="{{ old('frequentation') }}" placeholder="Nombre de personnes">
              </div>
              <div class="form__section">
                  <label class="form__label" for="nom">Nom</label>
                  @if(Auth::check())
                    <input type="text" class="input--classic" name="nom" id="nom" value="{{Auth::User()->nom}}" placeholder="Nom">
                  @else
                    <input type="text" class="input--classic" name="nom" id="nom" value="{{ old('nom') }}" placeholder="Nom">
                  @endif
              </div>

              <div class="form__section">
                  <label class="form__label" for="prenom">Prénom</label>
                  @if(Auth::check())
                    <input type="text" class="input--classic" name="prenom" id="prenom" value="{{Auth::User()->prenom}}" placeholder="Prénom">
                  @else
                    <input type="text" class="input--classic" name="prenom" id="prenom" value="{{ old('prenom') }}" placeholder="Prénom">
                  @endif
              </div>
              <div class="form__section">
                  <label class="form__label" for="email">Email</label>
                  @if(Auth::check())
                    <input type="email" class="input--classic" name="email" id="email" value="{{Auth::User()->email}}" placeholder="Email">
                  @else
                    <input type="email" class="input--classic" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
                  @endif
              </div>
              <div class="form__section">
                  <label class="form__label" for="adresselegale">Adresse légale</label>
                  <input type="text" class="input--classic" name="adresselegale" id="adresselegale" value="{{ old('adresselegale') }}" placeholder="Adresse légale">
              </div>

              <div class="form__section">
                  <label class="form__label" for="adressefacturation">Adresse de Facturation</label>
                  <input type="text" class="input--classic" name="adressefacturation" id="adressefacturation" value="{{ old('adressefacturation') }}" placeholder="Adresse de Facturation">
              </div>

              <div class="form__section">
                  <label class="form__label" for="adresselivraison">Adresse de livraison</label>
                  <input type="text" class="input--classic" name="adresselivraison" id="adresselivraison" value="{{ old('adresselivraison') }}" placeholder="Adresse de livraison">
              </div>
              <div class="form__section">
                  <label class="form__label" for="telephone">Numéro de téléphone (inventaire)</label>
                  <input type="text" class="input--classic" name="telephone" id="telephone" value="{{ old('telephone') }}" placeholder="Numéro de téléphone">
              </div>
            </section>

            <section class="form__part clearfix">
                <h3 class="section__title">Commande</h3>
                @foreach($futs as $fut)
                  <div class="form__futs">
                    <div class="form__section">
                        <label class="fut__label" for="fut{{$fut->id}}">{{$fut->nom}}</label>
                        <div class="futs__infos">
                          <p class="fut__prix"><span class="prix__prix">{{$fut->prix}}</span>€</p>
                         <span class="prix__multiplicateur">x</span>
                         <input type="text" class="input--classic fut__input fut--data" name="fut{{$fut->id}}" id="fut{{$fut->id}}" value="{{ old('fut'.$fut->id, 0) }}" placeholder="0">
                        </div>
                    </div>
                  </div>
                @endforeach

                <input type="hidden" name="commandetotal" id="commandetotal" value="0"/>

                <div class="futs__total">
                  <p class="total__text">Total provisoire : <span class="total__number">0</span> €</p>
                </div>
            </section>

            <section class="form__part clearfix">
                <h3 class="section__title">Matériel</h3>
                @foreach($materiels as $materiel)
                  @if($materiel->nom != "Bonbonne Co2 10L")
                  <div class="form__futs">
                    <div class="form__section">
                        <label class="fut__label" for="materiel{{$materiel->id}}">{{$materiel->nom}}</label>
                        <input type="text" class="input--classic fut__input" name="materiel{{$materiel->id}}" id="materiel{{$materiel->id}}" value="{{ old('materiel'.$materiel->id, 0) }}" placeholder="0">
                    </div>
                  </div>
                @else
                  <div class="form__futs hide">
                    <div class="form__section">
                        <label class="fut__label" for="materiel{{$materiel->id}}">{{$materiel->nom}}</label>
                        <input type="text" class="input--classic fut__input" name="materiel{{$materiel->id}}" id="materiel{{$materiel->id}}" value="0" placeholder="0">
                    </div>
                  </div>
                  @endif
                @endforeach
            </section>



            <div class="form__section">
                <button type="submit" class="bouton bouton--validate form__submit">
                  Confirmer ma commande
                </button>
            </div>
        </form>
    </div>
