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
            <h2 class="font-w700 text-black mb-10">Liste des contacts importants</h2>
        </div>

        <!-- Info -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="block">
                    <div class="block-content">
                        <p class="text-muted">
                            Cette page permet de regrouper les différents intervenants importants lorsque l'on organise un événement, ainsi que les contacts des différents CB.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Info -->

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Urgences</h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Numéro de téléphone</th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td style="font-size:20px; color:red;"><i class="fa fa-ambulance"></i><span>  Ambulances - Pompiers</span></td>
                        <td><a href="tel:112">112</a></td>
                      </tr>
                      <tr>
                        <td style="font-size:20px; color:blue;">Police</td>
                        <td><a href="tel:101">101</a></td>
                      </tr>
                      <tr>
                        <td style="font-size:20px; color:green;">Centre anti-poison</td>
                        <td><a href="tel:070245245">070 245 245</a></td>
                      </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Contacts AGEL</h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th>Comité</th>
                            <th>Fonction</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Numéro de téléphone</th>
                            <th>Adresse</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($agel_members as $agel_member)

                        @if (Auth::user()->droit == 1 || Auth::user()->droit == 2 )
                            <tr>
                                <td>{{$agel_member->comite->nom}} </td>
                                <td>{{$agel_member->function[0]}}</td>
                                <td>{{$agel_member->firstname}} {{$agel_member->surname}}</td>
                                <td><a href="mailto:{{$agel_member->email}}">{{$agel_member->email}}</a></td>
                                <td><a href="tel:{{$agel_member->phone_number}}">{{$agel_member->phone_number}}</a></td>
                                <td>{{$agel_member->legal_address}}</td>
                            </tr> 
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
         <!--<div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Contacts comités</h3>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th>Comité</th>
                            <th>Fonction</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Numéro de téléphone</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($listings as $listing)
                        @if (Auth::user()->droit == 1 || Auth::user()->droit == 2 || $listing->function =='')
                            <tr>
                                <td>{{$listing->comite->nom}} </td>
                                <td>{{ implode(', ', $listing->function) }}</td>
                                <td>{{$listing->firstname}} {{$listing->surname}}</td>
                                <td><a href="mailto:{{$listing->email}}">{{$listing->email}}</a></td>
                                <td><a href="tel:{{$listing->phone_number}}">{{$listing->phone_number}}</a></td>
                            </tr> 
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>-->
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
