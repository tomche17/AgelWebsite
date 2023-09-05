@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">E-Chapi</h2>
            <h3 class="h5 text-muted mb-0">Bienvenue sur l'interface AGEL</h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-xl-5">
                <div class="block">
                    <div class="block-content">

                        <p class="row justify-content-center">
                            <strong>Que souhaitez vous faire ? </strong>
                        </p>
                         <!-- Pastilles / Cartes -->
                         <div class="row">
                            <!-- Ajouter un événement -->
                            <div class="col-md-6 mb-4">
                                <a href="/events/add" class="btn btn-block btn-outline-primary">
                                    <i class="fa fa-calendar"></i> Ajouter un événement
                                </a>
                            </div>
                            <!-- Passer une commande -->
                            <div class="col-md-6 mb-4">
                                <a href="/commandes/create" class="btn btn-block btn-outline-secondary">
                                    <i class="fa fa-shopping-cart"></i> Passer une commande
                                </a>
                            </div>
                            <!-- Consulter mes inventaires -->
                            <div class="col-md-6 mb-4">
                                <a href="/inventaires" class="btn btn-block btn-outline-success">
                                    <i class="fa fa-list"></i> Consulter mes inventaires
                                </a>
                            </div>
                            <!-- Consulter le stock de la salle -->
                            <div class="col-md-6 mb-4">
                                <a href="/stock" class="btn btn-block btn-outline-warning">
                                    <i class="fa fa-box"></i> Consulter le stock de la salle
                                </a>
                            </div>
                        </div>
                        <!-- Fin des pastilles / Cartes -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
