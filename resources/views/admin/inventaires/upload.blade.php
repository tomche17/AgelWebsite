@extends('layouts.backend')

@section('content')
<div class="content">
    <div class="my-50 text-center">
        <h2 class="font-w700 text-black mb-10">Télécharger les inventaires</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="block">
                <div class="block-content">

                    <!-- Formulaire pour l'inventaire du comité entrant -->
                    <form action="{{ route("admin.inventaires.uploadEntrant", ["id" => $inventaire->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="entrantInventory">Inventaire du comité entrant</label>
                            @if($inventaire->signed_in_path)
                                <div><td><a title="Aperçu"><i class="fa fa-eye"></i></a> {{$document->title}}</td>
                                    Fichier actuel: <a href="{{ route('inventaires.signed.show', ['id' => $document->id]) }}"  target="_blank">Voir le fichier</a>
                                </div>
                            @endif
                            <input type="file" class="form-control" id="entrantInventory" name="entrantInventory" required>
                        </div>


                        <button type="submit" class="btn btn-primary mb-20">Télécharger l'inventaire entrant</button>
                    </form>

                    <!-- Formulaire pour l'inventaire du comité sortant -->
                    <form action="{{ route("admin.inventaires.uploadSortant", ["id" => $inventaire->id])}}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="sortantInventory">Inventaire du comité sortant</label>
                            @if($inventaire->signed_out_path)
                                <div>
                                    Fichier actuel: <a href="{{ public_path($inventaire->signed_out_path) }}" target="_blank">Voir le fichier</a>
                                </div>
                            @endif
                            <input type="file" class="form-control" id="sortantInventory" name="sortantInventory" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Télécharger l'inventaire sortant</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
