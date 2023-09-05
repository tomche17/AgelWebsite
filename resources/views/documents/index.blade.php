@extends('layouts.backend')

@section('css_before')

    <style>
        .folder-name {
            font-weight: bold; 
            font-size: 1.5em; 
            margin-left: 10px; /* Ajoutez un peu d'espace entre l'icône et le nom du dossier */
        }
        .folder {
            cursor: pointer; /* Pour montrer que les dossiers sont cliquables */
            margin-bottom: 10px; /* Espace entre les dossiers */
        }
        .folder-icon {
            font-size: 1.5em; /* Agrandir l'icône de dossier */
        }
</style>
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

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
            <h2 class="font-w700 text-black mb-10">Documents Utiles</h2>
        </div>

        <!-- Info -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="block">
                    <div class="block-content">
                        <p class="text-muted">
                            Vous trouverez ici une liste de documents importants à consulter ou à télécharger. Les administrateurs peuvent ajouter ou supprimer des documents.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Info -->

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Liste des dossiers</h3>
            </div>
            <div class="block-content">
            @foreach($folders as $folder)
                <div class="folder" data-folder-id="{{ $folder->id }}">
                <i class="fa fa-folder folder-icon"></i> <!-- icône de dossier -->

                    <span class="folder-name">{{ ucfirst($folder->name) }}</span>
                </div>
                <div class="documents" id="documents_{{ $folder->id }}" style="display: none;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom du document</th>
                    <th>Type</th>
                    <th>Visualiser</th>
                    <th>Télécharger</th>
                    @if(Auth::user()->droit == 1)
                        <th>Droits</th>
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $document)
                    @if($document->folder == $folder->id)
                        <tr>
                        <td><a href="{{ route('documents.show', ['id' => $document->id]) }}" title="Aperçu"><i class="fa fa-eye"></i></a> {{$document->title}}</td>
                            <td>{{ pathinfo($document->file_path, PATHINFO_EXTENSION) }}</td>
                            <td><a href="{{ route('documents.download', ['id' => $document->id]) }}" title="Télécharger"><i class="fa fa-download"></i></a></td>
                            <td><a href="{{ route('documents.show', ['id' => $document->id]) }}" title="Aperçu"><i class="fa fa-eye"></i></a></td>


                            @if(Auth::user()->droit == 1)
                            <td>
                                @if($document->droit_access == 1)
                                    Admin only
                                @elseif($document->droit_access == 2)
                                    Tout le monde
                                @else
                                    Inconnu
                                @endif
                            </td>
                            <td>
                                <a href="{{ route("admin.documents.edit", ["id" => $document->id])}}" title="Editer" class="table__link"><i class="fa fa-pencil-square-o"></i></a>
                                <form action="{{ route("admin.documents.destroy", ["id" => $document->id])}}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" title="Supprimer" class="table__link" onclick="this.closest('form').submit();return false;"><i class="fa fa-trash"></i></a>
                                </form>
                            </td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
                @endforeach
            </div>
        </div>
        @if(Auth::user()->droit == 1)
        <a href="{{route("documents.add")}}" class="bouton bouton--admin" title="Ajouter un document"><i class="fa fa-plus"></i> Ajouter un document</a>
        @endif
    </div>
    <!-- END Page Content -->
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
    let folders = document.querySelectorAll('.folder');

    folders.forEach(function(folder) {
        folder.addEventListener('click', function() {
            let folderId = folder.getAttribute('data-folder-id');
            let documentsDiv = document.getElementById('documents_' + folderId);

            let icon = folder.querySelector('.folder-icon');
            if (icon) {
                if (documentsDiv.style.display === 'none' || documentsDiv.innerHTML.trim() === '') {
                    icon.classList.remove('fa-folder');
                    icon.classList.add('fa-folder-open');
                    documentsDiv.style.display = 'block';
                } else {
                    icon.classList.remove('fa-folder-open');
                    icon.classList.add('fa-folder');
                    documentsDiv.style.display = 'none';
                }
            } else {
                console.warn("Icon not found for folder with id:", folderId);
            }


            // Si vous faites un appel AJAX pour charger les documents, placez-le ici.
        });
    });
});

    
</script>
