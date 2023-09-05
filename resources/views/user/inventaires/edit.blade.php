@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Consulter un inventaire</h2>
    </div>
    <div class="content">

        <!-- Date de l'inventaire -->
        <div class="pb-4 form-group">
            <h6>Date de l'inventaire</h6>
            <p>{{ $inventaire->date }}</p>
        </div>

        <!-- Nom du responsable AGEL -->
        <div class="pb-4 form-group">
            <h6>Nom du responsable AGEL</h6>
            <p>{{ $inventaire->agel_name }}</p>
        </div>

        <!-- Nom du comité -->
        <div class="pb-4 form-group">
            <h6>Nom du comité</h6>
            <p>{{ $cb->nom }}</p>
        </div>

        <!-- Nom de l'évènement -->
        <div class="pb-4 form-group">
            <h6>Nom de l'évènement</h6>
            <p>{{ $inventaire->event_name }}</p>
        </div>

        <!-- Changement du stock -->
        <div class="pb-4 form-group">
        <h6>Changement du stock</h6>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Objet compté</th>
                        <th>Nombre compté</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stocks as $c)
                        <tr>
                            <td>
                                {{ ucfirst($c->name) }}
                            </td>
                            <td>
                                {{ $c->quantity }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="/inventaires" class="btn btn-success">Retour à mes inventaires</a>

    </div>
    <!-- END Page Content -->
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    // Si vous avez besoin d'une fonctionnalité jQuery, ajoutez-la ici
</script>
