@extends('layouts.backend')
@section('content')

<!-- Page Content -->
<div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">Liste des évènements</h2>
        </div>

      @if(count($events) == 0)
        <div class="block">
          <div class="block-content block-content-full">
            <p class="paragraphe--nodatas">Il n'y a pas encore d'évènements'</p>
            <a href="{{route("admin.event.add")}}" class="bouton bouton--admin" title="Ajouter un fut">Ajouter un évènement</a>
          </div>
        </div>
      @else
        
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">

                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                          <th>Nom</th>
                          <th>Structure</th>
                          <th>Date</th>
                          <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($events as $event)
                      <tr>
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
                    </tbody>
                </table>
            </div>
            
        </div>
        <!-- END Dynamic Table Full -->

        <a href="{{route("admin.event.add")}}" class="bouton bouton--admin" title="Ajouter un fut"><i class="fa fa-plus"></i> Ajouter un évènement</a>
      @endif
    </div>
    <!-- END Page Content -->
@endsection