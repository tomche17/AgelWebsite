 @extends('layouts.backend')
@section('content')
  <div class="title__container">
    <h2 class="page__title">Administration</h2>
  </div>
 
@if(count($commandes) == 0)
  <p class="paragraphe--nodatas">Il n'y a pas de commandes à valider</p>
@else
  <p class="paragraphe--nodatas">
    Bonjour {{Auth::User()->prenom}}, il y a {{count($commandes)}}
    <a href="{{route("admin.commandes")}}" title="Afficher les commandes" class="text__link">commandes</a> à traiter et {{count($inventaires)}}
    <a href="{{route("admin.inventaires")}}" title="Afficher les inventaires" class="text__link">inventaires</a> sans responsables !</p>
@endif
@endsection
