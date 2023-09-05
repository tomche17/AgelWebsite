@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
    <!-- Page Content -->

    <div class="content">
        <div class="pb-4">
            <h6>Date de l'inventaire</h6>
            <p>{{ $inventaire->date }}</p>
        </div>
        <div class="pb-4">
            <h6>Nom de l'évènement</h6>
            <p>{{ $inventaire->event_name  }}</p>
        </div>

        <div class="pb-4">
            <h6>Nom du responsable AGEL</h6>
            <p>{{$inventaire->agel_name  }}</p>
        </div>
        <div class="pb-4">
            <h6>Nom du CB entrant</h6>
            <p>{{ optional($inventaire->comiteIn)->nom ?? 'Pas de CB' }}</p>
        </div>
        <div class="pb-4">
            <h6>Nom du CB sortant</h6>
            <p>{{ optional($inventaire->comiteOut)->nom ?? 'Pas de CB' }}</p>
        </div>

        <div class="pb-4">
        <!-- ... [Début du fichier, pas de changements] ... -->
        <a href="{{ route("admin.inventaires.generatepdfcomiteentrant") }}" class="bouton bouton--admin" title="inventaire sortant pdf"><i class="fa fa-address-book"></i> Générer Recap comité entrant</a>
    
    <a href="{{ route("admin.inventaires.generatepdfcomitesortant") }}" class="bouton bouton--admin" title="inventaire sortant pdf"><i class="fa fa-address-book"></i> Générer Recap comité sortant</a>
    <a href="{{ route("admin.inventaires.edit", ["id" => $inventaire->id])}}" class="bouton bouton--admin" title="modifier"><i class="fa fa-pencil"></i> Modifier l'inventaire</a>
    <!-- END Page Content -->
    </div>
        <div class="pb-4">
            <h6>Stock actuel  le {{ date('d-m-Y') }}</h6>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Objet compté</th>
                        <th>Nombre compté</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stocks as $stock)
                        <tr>
                            <td>{{ $stock->name }}</td>
                            <td>{{ $stock->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pb-4">
            <h6>Changement du stock</h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Objet compté</th>
                            <th>Manquants</th>
                            <th>Prix unitaire</th>
                            <th>Prix total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modif_items as $item => $details)
                            <tr>
                                <td>{{ $item }}</td>
                                <td>{{ $details['quantity'] }}</td>
                                <td>{{ $details['prix_unitaire'] }}</td>
                                <td>{{ $details['prix'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            
        </div>


        <!-- ... [Reste du fichier, pas de changements] ... -->


    </div>

@endsection
