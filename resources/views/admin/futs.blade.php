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
            <h2 class="font-w700 text-black mb-10">Liste des fûts</h2>
        </div>

      @if(count($futs) == 0)
        <div class="block">
          <div class="block-content block-content-full">
            <p class="paragraphe--nodatas">Il n'y a pas encore de fûts</p>
            <a href="{{route("admin.fut.add")}}" class="bouton bouton--admin" title="Ajouter un fut">Ajouter un fût</a>
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
                          <th>Prix</th>
                          <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($futs as $fut)
                      <tr>
                        <td>{{$fut->nom}}</td>
                        <td>{{$fut->prix}}€</td>
                        <td class="td--actions">
                          <a href="{{route("admin.fut.edit", ["id" => $fut->id])}}" title="Editer le fut" class="table__link"><i class="fa fa-pencil-square-o"></i><span class="hide">Editer</span></a>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
        <!-- END Dynamic Table Full -->

        <a href="{{route("admin.fut.add")}}" class="bouton bouton--admin" title="Ajouter un fut"><i class="fa fa-plus"></i> Ajouter un fût</a>
      @endif
    </div>
    <!-- END Page Content -->
@endsection