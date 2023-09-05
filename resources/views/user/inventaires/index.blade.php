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
                            Les inventaires de mon CB
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
                            <th>Comité concerné</th>
                            <th>Nom de l'évent</th>
                            <th>Validation AGEL</th>
                            <th>Validation CB</th>
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
                                    @php
                                        $cb = \App\Comite::where('id', $inventaire->id_cb)->first();
                                    @endphp
                                    {{$cb->nom}}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    {{$inventaire->event_name}}
                                </td>
                                <td>
                                    @if ($inventaire->agel_valid)
                                        <b style="color:green;">OK</b>
                                    @else
                                        <b style="color:red;">PAS OK</b>
                                    @endif
                                </td>
                                <td>
                                    @if ($inventaire->cb_valid)
                                        <b style="color:green;">OK</b>
                                    @else
                                        <b style="color:red;">PAS OK</b>
                                    @endif
                                </td>

                                <td class="td--actions">
                                    <a href="{{ route("user.inventaires.edit", ["id" => $inventaire->id])}}" title="Editer" class="table__link"><i class="fa fa-pencil-square-o"></i>
                                        <span class="hide">Editer</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Page Content -->

@endsection
