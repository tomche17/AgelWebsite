 @extends('layouts.backend')
@section('content')
  <div class="title__container">
    <h2 class="page__title">Modifier le fût "{{$fut->nom}}"</h2>
  </div>
 
@include('admin.futs.forms.edit')

@endsection
