
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

        <form  role="form" method="POST" action="{{ route('commande.choose') }}" class="commande__form form--know-event">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <section class="form__part clearfix">
              <h3 class="section__title">Informations</h3>
              <div class="form__section">
                <label class="form__label" for="event">Evènement</label>
                <span class="select__wrapper">
                  <select class="form__select commande__form form__input input--classic select--new" name="event" id="event">
                    <option selected disabled>Sélectionnez un évènement</option>
                    @foreach($events as $event)
                        <option value="{{$event->id}}">{{$event->nom}}</option>
                    @endforeach
                    <option value="new">Mon évènement n'est pas dans la liste</option>
                  </select>
                </span>
              </div>


            </section>

            <div class="form__section">
                <button type="submit" class="bouton bouton--validate form__submit">
                  Complèter ma commande
                </button>
            </div>
        </form>

        <form  role="form" method="POST" action="{{ route('admin.event.create') }}" class="commande__form form--new-event">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <section class="form__part clearfix">
              <h3 class="section__title">Informations</h3>
              <div class="form__section">
                <label class="form__label" for="event">Evènement</label>
                <span class="select__wrapper">
                  <select class="form__select commande__form form__input input--classic select--new" name="event" id="event">
                    <option selected disabled value="new">Mon évènement n'est pas dans la liste</option>
                  </select>
                </span>
              </div>

              <div class="form__section">

                <div class="form__section">
                    <label class="form__label" for="nom">Nom de l'évènement</label>
                      <input type="text" class="input--classic" name="nom" id="nom" value="{{ old('nom') }}" placeholder="Nom">
                </div>

                <div class="form__section">
                  <label class="form__label" for="date">Date</label>
                  <input type="date" class="input--classic" name="date" id="date" value="{{ old('date') }}" placeholder="Date"/>
                </div>

                <input type="hidden" value="public" name="public" id="public"/>
              </div>

            </section>

            <div class="form__section">
                <button type="submit" class="bouton bouton--validate form__submit">
                  Continuer
                </button>
            </div>
        </form>
    </div>
