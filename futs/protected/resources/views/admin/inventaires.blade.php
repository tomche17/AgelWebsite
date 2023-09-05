 @extends('layouts.backend')
@section('content')
  <div class="title__container">
    <h2 class="page__title">Liste des inventaires</h2>
  </div>
 

@if(count($inventaires) == 0)
  <p class="paragraphe--nodatas">Il n'y a pas encore d'inventaires</p>
@else
<table class="admin__table">
  <thead>
    <tr class="table__head">
      <th>Date</th>
      <th>Type</th>
      <th>Evènement</th>
      <th>Responsable</th>
      <th>Actions</th>
    </tr>
  </thead>

  @foreach($inventaires as $inventaire)
    <tr class="data__lign">
      <td>{{$inventaire->date}}</td>
      <td>{{$inventaire->type}}</td>
      <td>{{$inventaire->event->nom}}</td>
      @if($inventaire->responsable)
        <td>{{$inventaire->responsable->prenom}} {{$inventaire->responsable->nom}}</td>
      @else
        <td>Non attribué</td>
      @endif

      <td class="td--actions">
        <a href="{{ route('admin.inventaire.edit', ["id" => $inventaire->id]) }}" title="Editer l'inventaire" class="table__link"><i class="fa fa-pencil-square-o"></i><span class="hide">Editer</span></a>
        <form action="{{ route('admin.inventaire.delete', ["id" => $inventaire->id]) }}" class="table__form" role="form" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button class="table__link"><i class="fa fa-trash-o"></i><span class="hide">Supprimer</span></button>
        </form>
      </td>
    </tr>
  @endforeach
</table>
@endif
@endsection
