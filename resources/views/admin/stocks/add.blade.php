@extends('layouts.backend')
@section('content')
  <div class="title__container">
    <h2 class="page__title">Ajouter un élément au stock</h2>
  </div>
 
@include('admin.stocks.forms.add')

@endsection
