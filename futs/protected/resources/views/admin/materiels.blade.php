 @extends('layouts.backend')
@section('content')

  <div class="title__container">
    <h2 class="page__title">Liste du matériel</h2>
  </div>

 

@if(count($materiels) == 0)
  <p class="paragraphe--nodatas">Il n'y a pas encore de matériel</p>
  <a href="{{route("admin.materiel.add")}}" class="bouton bouton--admin" title="Ajouter du matériel">Ajouter du matériel</a>
@else
  <a href="{{route("admin.materiel.add")}}" class="bouton bouton--admin" title="Ajouter du matériel">Ajouter du matériel</a>
<table class="admin__table">
  <thead>
    <tr class="table__head">
      <th>Nom</th>
      <th>Actions</th>
    </tr>
  </thead>

  @foreach($materiels as $materiel)
    <tr class="data__lign">
      <td>{{$materiel->nom}}</td>
      <td class="td--actions">
        <a href="{{route("admin.materiel.edit", ["id" => $materiel->id])}}" title="Editer le matériel" class="table__link"><i class="fa fa-pencil-square-o"></i><span class="hide">Editer</span></a>
      </td>
    </tr>
  @endforeach
</table>
@endif
@endsection
