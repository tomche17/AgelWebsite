@extends('layouts.backend')
@section('content')
  <div class="title__container">
    <h2 class="page__title">Modifier le profil</h2>
  </div>


<div class="wrapper--forms">

    <form role="form" method="POST" action="{{ route('profile.update', ['id' => $user->id]) }}" class="admin__form">
        @method('PUT')
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
        </div>


        <div class="form__part">
            <button type="submit" class="bouton bouton--validate form__submit">
              Modifier le profil
            </button>
        </div>
    </form>
</div>
@endsection
