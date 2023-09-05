@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">Événements confirmés à venir</h2>
        </div>

        <!-- Info -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="block">
                    <div class="block-content">
                        <p class="text-muted">
                            Liste des événements prévus.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Info -->

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables init -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                        <th>Date</th>
                        @if(Auth::user()->droit == 1)
                        <th>Organisateur</th>
                        @endif
                            <th>Nom de l'événement</th>
                            @if(Auth::user()->droit == 2)
                            <th>Statut</th>
                            @endif
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
    @foreach($events as $event)
        <tr>
            <td>
                {{$event->date}}
            </td>
            @if(Auth::user()->droit == 1)
            <td>
                {{ $event->comite ? $event->comite->nom : 'N/A' }}
            </td>
            @endif
            <td class="font-w600">
                {{$event->nom}}
            </td>
            <td>
                            @if($event->is_validated == 0)
                             
                              <b style="color:red;"> En attente de validation</b>
                            @else
                            <b style="color:green;"> Validé</b>
                            @endif
                          </td>
            
            <td class="td--actions">
                @if(Auth::user()->droit != 2) <!-- Les utilisateurs avec droit = 2 ne peuvent pas éditer -->
                <a href="{{ route('events.edit', ["id" => $event->id]) }}" title="Editer" class="table__link"><i class="fa fa-pencil-square-o"></i>
                    <span class="hide">Editer</span>
                </a>
                @endif 



                <form action="{{ route("events.destroy", ["id" => $event->id])}}" method="POST" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">
                    @csrf
                    @method('DELETE')
                    <a href="#" title="Supprimer" class="table__link" onclick="this.closest('form').submit();return false;"><i class="fa fa-trash"></i>
                        <span class="hide">Supprimer</span>
                    </a>
                </form>

            </td>
            
        </tr>
    @endforeach
</tbody>

                </table>
            </div>
            @if(Auth::user()->droit == 1)
            <a href="{{route("admin.event.add")}}" class="bouton bouton--admin" title="Ajouter un évènement"><i class="fa fa-plus"></i> Ajouter un évènement</a>
            @endif
        </div>

    </div>
    <!-- END Page Content -->
@endsection
