 @extends('layouts.backend')
@section('content')
  <div class="title__container">
    <h2 class="page__title">Liste des commandes</h2>
  </div>
 

@if(count($commandes) == 0)
  <p class="paragraphe--nodatas">Il n'y a pas encore de commandes</p>
@else

  <table class="admin__table">
    <thead>
      <tr class="table__head">
        <th>Date</th>
        <th>Evènement</th>
        <th class="responsive__hide">Commanditaire</th>
        <th class="responsive__hide">Prix</th>
        <th>Statut</th>
        <th>Actions</th>
      </tr>
    </thead>


    @foreach($commandes as $commande)

      <tr class="data__lign">
        <td>{{$commande->event->date}}</td>
        <td>{{$commande->event->nom}}</td>
        <td class="responsive__hide">{{$commande->prenom}} {{$commande->nom}}</td>
        <td class="responsive__hide">{{$commande->prixtotal}}€</td>
        <td>
          @if($commande->is_validated == 0)
            Non validée
          @else
            Validée
          @endif
        </td>
        <td class="td--actions">
          <a href="{{ route('commande.show', ["id" => $commande->id]) }}" title="Afficher la commande" class="table__link"><i class="fa fa-eye"></i><span class="hide">Afficher</span></a>

          @if($commande->is_validated == 0)
          <form action="{{ route('admin.commande.validate', ["id" => $commande->id]) }}" class="table__form" role="form" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="table__link"><i class="fa fa-check"></i><span class="hide">Valider</span></button>
          </form>

          <form action="{{ route('admin.commande.decline', ["id" => $commande->id]) }}" class="table__form" role="form" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="table__link"><i class="fa fa-times"></i><span class="hide">Décliner</span></button>
          </form>
          @endif

          <form action="{{ route('admin.commande.delete', ["id" => $commande->id]) }}" class="table__form" role="form" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="table__link"><i class="fa fa-trash-o"></i><span class="hide">Supprimer</span></button>
          </form>


        </td>
      </tr>

    @endforeach
  </table>
@endif

@endsection
