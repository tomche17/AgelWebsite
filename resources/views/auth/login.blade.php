@extends('layouts.portal')

@section('content')
    <!-- Header -->
    <div class="px-30 py-10">
        <a class="link-effect font-w700" href="">
            <img src="{{asset('images/agel.png') }}" style="width:100px;">
        </a>
        <h1 class="h3 font-w700 mt-30 mb-10">Bienvenue !</h1>
        <h2 class="h5 font-w400 text-muted mb-0">Merci de t'identifier ...</h2>
    </div>
    <!-- END Header -->

    <!-- Sign In Form -->
    <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
    <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
    <form method="POST" action="{{ route('login') }}">
      @csrf
        <div class="form-group row">
            <div class="col-12">
                <div class="form-material floating">
                    <input type="text" class="form-control" id="email" name="email">
                    <label for="email">Email</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12">
                <div class="form-material floating">
                    <input type="password" class="form-control" id="password" name="password">
                    <label for="password">Mot de passe</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-hero btn-alt-primary">
                <i class="si si-login mr-10"></i> Se connecter
            </button>
        </div>
        
    </form>
    <!-- END Hero -->
@endsection
