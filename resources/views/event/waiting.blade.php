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
            <h2 class="font-w700 text-black mb-10">Événements en attente de validation</h2>
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
                            <th>Organisateur</th>
                            <th>Nom de l'événement</th>
                            <th>Valider ? </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
    @foreach($events as $event)
        <tr>
            <td>
                {{$event->date}}
            </td>
            <td>
                {{ $event->comite ? $event->comite->nom : 'N/A' }}
            </td>
            <td class="font-w600">
                {{$event->nom}}
            </td>

            </td>

            <td>
            @if (Auth::user()->droit == 1)
                    @if(!$event->is_validated) <!-- Si l'événement n'est pas validé, alors on affiche les options -->
                    <form action="{{ route('events.validate', $event->id) }}" method="POST">
                        @csrf
                        <a href="#" title="Confirmer" class="table__link" onclick="this.closest('form').submit();return false;"><i class="fa fa-check"></i>
                            <span class="hide">Confirmer</span>
                        </a>
                    </form>

                    <form action="{{ route("events.decline", ["id" => $event->id])}}" method="POST">
                        @csrf
                        <a href="#" title="Decliner" class="table__link" onclick="this.closest('form').submit();return false;"><i class="fa fa-times-circle"></i>
                            <span class="hide">Decliner</span>
                        </a>
                    </form>
                    @endif
                @endif
            </td>
            
            <td class="td--actions">
                @if(Auth::user()->droit != 2) <!-- Les utilisateurs avec droit = 2 ne peuvent pas éditer -->
                <a href="{{ route('events.edit', ["id" => $event->id]) }}" title="Editer" class="table__link"><i class="fa fa-pencil-square-o"></i>
                    <span class="hide">Editer</span>
                </a>
                @endif



                <form action="{{ route("events.destroy", ["id" => $event->id])}}" method="POST">
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
            <a href="{{route("admin.event.add")}}" class="bouton bouton--admin" title="Ajouter un évènement"><i class="fa fa-plus"></i> Ajouter un évènement</a>
    
        </div>

    </div>
    <!-- END Page Content -->
@endsection
