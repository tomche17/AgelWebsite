@extends('layouts.backend')
@section('content')
  <div class="title__container">
    <h2 class="page__title">Ajouter un utilisateur</h2>
  </div>
 
@include('admin.users.forms.add')

@endsection
