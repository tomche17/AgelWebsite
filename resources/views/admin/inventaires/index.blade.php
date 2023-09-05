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
            <h2 class="font-w700 text-black mb-10">Inventaires</h2>
        </div>

        <!-- Info -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="block">
                    <div class="block-content">
                        <p class="text-muted">
                            Inventaires effectués jusqu'ici.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Info -->

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th>Date d'inventaire</th>
                            <th>Membre du bureau responsable</th>
                            <th>Comité entrant</th>
                            <th>Comité sortant</th>
                            <th>Nom de l'évent</th>
                            <th>Facture</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventaires as $inventaire)
                            <tr>
                                <td class="font-w600">
                                    {{$inventaire->date}}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    {{$inventaire->agel_name}}
                                </td>
                                <td>
                                    {{ $inventaire->comiteIn->nom ?? 'None' }}
                                </td>
                                <td>
                                    {{ $inventaire->comiteOut->nom ?? 'None' }}
                                </td>

                                <td class="d-none d-sm-table-cell">
                                    {{$inventaire->event_name}}
                                </td>
                            
                                
                                <td>
                                @if($inventaire->facture_path == "Waiting")
                                    <span>En attente de validation</span>
                                @else
                                    <a href="{{ route('admin.facture.view', ['filename' => $inventaire->facture_path . '.xlsx']) }}">Télécharger</a>
                                @endif

                                </td>

                                <td class="td--actions">
                                    <a href="{{ route("admin.inventaires.edit", ["id" => $inventaire->id])}}" title="Editer" class="table__link"><i class="fa fa-pencil-square-o"></i>
                                        <span class="hide">Editer</span>
                                    </a>
                                    <form action="{{ route("admin.inventaires.destroy", ["id" => $inventaire->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="#" title="Supprimer" class="table__link" onclick="this.closest('form').submit();return false;"><i class="fa fa-times-circle"></i>
                                            <span class="hide">Supprimer</span>
                                        </a>
                                    </form>
                                    <!--<a href="{{ route('admin.inventaires.uploadPage', ['id' =>  $inventaire->id]) }}" title="Editer" class="table__link"><i class="fa fa-camera"></i>
                                    </a>-->

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
        <a href="{{route("admin.inventaires.create")}}" class="bouton bouton--admin" title="Ajouter un inventaire"><i class="fa fa-plus"></i> Ajouter un inventaire</a>
    </div>
    <!-- END Page Content -->

@endsection
