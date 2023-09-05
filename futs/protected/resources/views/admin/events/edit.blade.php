 @extends('layouts.backend')
@section('content')
  <div class="title__container">
    <h2 class="page__title">Modifier l'évenement "{{$event->nom}}"</h2>
  </div>
 
@include('admin.events.forms.edit')

@endsection
