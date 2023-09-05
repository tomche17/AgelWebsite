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
            <h2 class="font-w700 text-black mb-10">Liste du matériel</h2>
        </div>

      @if(count($materiels) == 0)
        <div class="block">
          <div class="block-content block-content-full">
            <p class="paragraphe--nodatas">Il n'y a pas encore de matériel</p>
            <a href="{{route("admin.materiel.add")}}" class="bouton bouton--admin" title="Ajouter un matériel">Ajouter un matériel</a>
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
                          <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($materiels as $materiel)
                      <tr>
                        <td>{{$materiel->nom}}</td>
                        <td class="td--actions">
                          <a href="{{route("admin.materiel.edit", ["id" => $materiel->id])}}" title="Editer le matériel" class="table__link"><i class="fa fa-pencil-square-o"></i><span class="hide">Editer</span></a>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
        <!-- END Dynamic Table Full -->

        <a href="{{route("admin.materiel.add")}}" class="bouton bouton--admin" title="Ajouter un matériel"><i class="fa fa-plus"></i> Ajouter un matériel</a>
      @endif
    </div>
    <!-- END Page Content -->
@endsection
