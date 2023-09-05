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
            <h2 class="font-w700 text-black mb-10">Liste des commandes</h2>
        </div>

      @if(count($commandes) == 0)
        <p class="paragraphe--nodatas">Il n'y a pas encore de commandes</p>
      @else

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                          <th>Date</th>
                          <th>Evènement</th>
                          <th>Commanditaire</th>
                          <th>Statut</th>
                          <th>Prix</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        @foreach($commandes as $commande)
                          @if ($commande->event->comite_id == Auth::user()->comite_id)
                          <tr>
                            <td>{{$commande->event->date}}</td>
                            <td>{{$commande->event->nom}}</td>
                            <td>{{$commande->prenom}} {{$commande->nom}}</td>
                            <td>
                              @if ($commande->is_validated)
                                Validée
                              @else
                                En attente de validation
                              @endif
                            </td>
                            <td>{{$commande->prixtotal}}€</td>
                          </tr>
                          @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
      @endif
    </div>
    <!-- END Page Content -->
@endsection
