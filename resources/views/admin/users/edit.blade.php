 @extends('layouts.backend')
@section('content')
  <div class="title__container">
    <h2 class="page__title">Modifier l'utilisateur' "{{$user->surname}} {{$user->name}}"</h2>
  </div>
 
@include('admin.users.forms.edit')

@endsection
