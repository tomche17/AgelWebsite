 @extends('layouts.backend')
@section('content')
  <div class="title__container">
    <h2 class="page__title">Liste des évènements</h2>
  </div>
 

@if(count($events) == 0)
  <p class="paragraphe--nodatas">Il n'y a pas encore d'évènements</p>
  <a href="{{route("admin.event.add")}}" class="bouton bouton--admin" title="Ajouter un évènement">Ajouter un évènement</a>
@else
  <a href="{{route("admin.event.add")}}" class="bouton bouton--admin" title="Ajouter un évènement">Ajouter un évènement</a>
  <table class="admin__table">
    <thead>
      <tr class="table__head">
        <th>Nom</th>
        <th>Structure</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
    </thead>


    @foreach($events as $event)
      <tr class="data__lign">
        <td>{{$event->nom}}</td>
        <td>
          @if($event->comite)
          {{$event->comite->nom}}
          @else
            Extérieur
          @endif
        </td>
        <td>{{$event->date}}</td>
        <td class="td--actions">
          <a href="{{ route('admin.event.edit', ["id" => $event->id]) }}" title="Editer l'évènement" class="table__link"><i class="fa fa-pencil-square-o"></i><span class="hide">Editer</span></a>
          <form action="{{ route('admin.event.delete', ["id" => $event->id]) }}" class="table__form" role="form" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="table__link"><i class="fa fa-trash-o"></i><span class="hide">Supprimer</span></button>
          </form>
        </td>
      </tr>
    @endforeach
  </table>
@endif

@endsection
