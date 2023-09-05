 @extends('layouts.backend')
@section('content')
  <div class="title__container">
    <h2 class="page__title">Liste des fûts</h2>
  </div>
 

@if(count($futs) == 0)
  <p class="paragraphe--nodatas">Il n'y a pas encore de fûts</p>
  <a href="{{route("admin.event.add")}}" class="bouton bouton--admin" title="Ajouter un évènement">Ajouter un évènement</a>
@else
<a href="{{route("admin.fut.add")}}" class="bouton bouton--admin" title="Ajouter un fut">Ajouter un fût</a>
<table class="admin__table">
  <thead>
    <tr class="table__head">
      <th>Nom</th>
      <th>Prix</th>
      <th>Actions</th>
    </tr>
  </thead>

  @foreach($futs as $fut)
    <tr class="data__lign">
      <td>{{$fut->nom}}</td>
      <td>{{$fut->prix}}€</td>
      <td class="td--actions">
        <a href="{{route("admin.fut.edit",["id" => $fut->id])}}" title="Editer le fut" class="table__link"><i class="fa fa-pencil-square-o"></i><span class="hide">Editer</span></a>
      </td>
    </tr>
  @endforeach
</table>
@endif
@endsection
