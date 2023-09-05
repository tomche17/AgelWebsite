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
            <h2 class="font-w700 text-black mb-10">Liste des utilisateurs</h2>
        </div>
        
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">

                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                      <tr class="table__head">
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Comité</th>
                        <th>Accès admin</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        @php
                            $cb = \App\Comite::findOrFail($user->comite_id)
                        @endphp
                      <tr>
                        <td>{{$user->surname}} {{$user->name}}</td>
                        <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                        <td><a href="tel:{{$user->phone}}">{{$user->phone}}</a></td>
                        <td>{{$cb->nom}}</td>
                        <td>
                          @if ($user->droit == 1)
                            <b style="color:green;">Oui</b>
                          @else
                            <b>/</b>
                          @endif
                        </td>
                        <td class="td--actions">
                          <a href="{{route("admin.user.edit", ["id" => $user->id])}}" title="Editer le user" class="table__link"><i class="fa fa-pencil-square-o"></i><span class="hide">Editer</span></a>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
        <!-- END Dynamic Table Full -->

        <a href="{{route("admin.user.add")}}" class="bouton bouton--admin" title="Ajouter un user"><i class="fa fa-plus"></i> Ajouter un utilisateur</a>
    </div>
    <!-- END Page Content -->
@endsection

