<div class="title__container">
  <h2 class="page__title">Identification</h2>
  <p class="page__subtitle">Merci de vous connecter avec le mot de passe reçu dans le mail de l'AGEL</p>
</div>
<div class="login__container">


    @if (count($errors) > 0)
    <div class="commande__error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form  role="form" method="POST" action="{{ route('doLogin') }}" class="login__form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="login__champs">
              <input type="email" class="input--login" name="email" id="email" value="" placeholder="Adresse email"/>
              <input type="password" class="input--login" name="password" id="password" value="" placeholder="Mot de passe"/>
          </div>


        <div class="login__confirm">
            <button type="submit" class="bouton bouton--validate bouton--login form__submit">
              Se connecter
            </button>
        </div>

        <a href="{{route("commande.event")}}" title="Je n'ai pas de compte" class="bouton bouton--no-user">Je n'ai pas de compte</a>
    </form>
</div>
