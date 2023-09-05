 @extends('layouts.backend')
@section('content')
  <div class="title__container">
    <h2 class="page__title">Modifier l'inventaire du {{$inventaire->humanDate}}</h2>
  </div>
 
@include('admin.inventaires.forms.edit')

@endsection
