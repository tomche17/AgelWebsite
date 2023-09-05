 @extends('layouts.backend')
@section('content')
  <div class="title__container">
    <h2 class="page__title">Modifier le matériel "{{$materiel->nom}}"</h2>
  </div>
 
@include('admin.materiels.forms.edit')

@endsection
