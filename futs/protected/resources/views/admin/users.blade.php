 @extends('layouts.backend')
@section('content')
  <div class="title__container">
    <h2 class="page__title">Liste des utilisateurs</h2>
  </div>
 

@if(count($users) == 0)
  <p class="paragraphe--nodatas">Il n'y a pas encore d'utilisateurs</p>
  <a href="{{route("admin.user.add")}}" class="bouton bouton--admin" title="Ajouter un utilisateur">Ajouter un utilisateur</a>
@else
  <a href="{{route("admin.user.add")}}" class="bouton bouton--admin" title="Ajouter un utilisateur">Ajouter un utilisateur</a>
<table class="admin__table">
  <thead>
    <tr class="table__head">
      <th>Nom</th>
      <th>Email</th>
      <th>Structure</th>
      <th>Actions</th>
    </tr>
  </thead>

  @foreach($users as $user)
    <tr class="data__lign">
      <td>{{$user->prenom}} {{$user->nom}}</td>
      <td>{{$user->email}}</td>

      @if($user->comite_id == null)
        <td>Extérieur</td>
      @else
        <td>{{$user->comite->nom}}</td>
      @endif
      <td class="td--actions">
        <a href="{{route("admin.user.edit",["id" => $user->id])}}" title="Editer l'utilisateur" class="table__link"><i class="fa fa-pencil-square-o"></i><span class="hide">Editer</span></a>
      </td>
    </tr>
  @endforeach
</table>
@endif
@endsection
