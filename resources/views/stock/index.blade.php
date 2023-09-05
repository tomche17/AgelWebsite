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
            <h2 class="font-w700 text-black mb-10">Stock de la salle</h2>
        </div>

        <!-- Info -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="block">
                    <div class="block-content">
                        <p class="text-muted">
                            Statut du stock de la salle de guindaille.
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
                            <th>Nom</th>
                            <th>Quantité actuelle</th>
                            <th>Prix/unité</th>
                            @if (Auth::user()->droit == 1)<th>Actions</th>@endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $i)
                            <tr>
                                <td class="font-w600">
                                    {{$i->name}}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    {{$i->quantity}}
                                </td>
                                <td>
                                    {{$i->price}} €
                                </td>
                                @if (Auth::user()->droit == 1)<td class="td--actions">
                                    <a href="{{route("admin.stock.edit", ["id" => $i->id])}}" title="Editer l'élément" class="table__link"><i class="fa fa-pencil-square-o"></i><span class="hide">Editer</span></a>
                                    <form action="{{ route("admin.stock.destroy", ["id" => $i->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="#" title="Supprimer" class="table__link" onclick="this.closest('form').submit();return false;"><i class="fa fa-times-circle"></i>
                                            <span class="hide">Supprimer</span>
                                        </a>
                                    </form>
                                </td>
                                
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
        @if (Auth::user()->droit == 1)
            <a href="{{route("admin.stock.add")}}" class="bouton bouton--admin" title="Ajouter un élément"><i class="fa fa-plus"></i> Ajouter un élément</a>
        @endif
    </div>
    <!-- END Page Content -->
@endsection
