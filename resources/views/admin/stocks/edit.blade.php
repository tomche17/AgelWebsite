 @extends('layouts.backend')
@section('content')
  <div class="title__container">
    <h2 class="page__title">Modifier l'élément "{{$stock->name}}"</h2>
  </div>
 
@include('admin.stocks.forms.edit')

@endsection
