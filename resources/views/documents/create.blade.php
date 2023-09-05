@extends('layouts.backend')

@section('content')
<div class="title__container">
    <h2 class="page__title">Ajouter un document</h2>
</div>

<div class="wrapper--forms">

    @if (count($errors) > 0)
    <div class="commande__error">
        <strong>Oops ! Quelque chose s'est mal passé.</strong>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form role="form" method="POST" action="{{ route('documents.upload') }}" class="admin__form" enctype="multipart/form-data">
        @csrf

        <div class="form__part">

            <!-- Titre du document -->
            <div class="form__section">
                <label class="form__label" for="title">Titre du document</label>
                <input type="text" class="input--classic" name="title" id="title" value="{{ old('title') }}" placeholder="Titre"/>
            </div>

            <!-- Upload du document -->
            <div class="form__section">
                <label class="form__label" for="file">Uploader un fichier</label>
                <input type="file" class="input--classic" name="file" id="file"/>
            </div>

            <!-- Droits d'accès -->
            <!-- Droits d'accès -->
            <div class="form__section">
                <label class="form__label">Droits d'accès</label>
                <div class="radio-inline">
                    <label>
                        <input type="radio" name="droit_acces" value="1"> Admin
                    </label>
                    <label>
                        <input type="radio" name="droit_acces" value="2"> Toute personne authentifiée
                    </label>
                </div>
            </div>

            <div class="form__section">
                <label class="form__label">Dans quel dossier souhaitez-vous enregistrer ?</label>
                <div class="radio-column">
                    @foreach($folders as $folder)
                        <div class="radio-item">
                            <input type="radio" name="folder_id" value="{{ $folder->id }}" id="folder_{{ $folder->id }}">
                            <label for="folder_{{ $folder->id }}">{{ $folder->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>


            <!-- Bouton pour ouvrir la fenêtre pop-up -->
            <button type="button" id="addFolderBtn" class="btn btn-success">+ Ajouter un dossier</button>

           <!-- Fenêtre pop-up pour ajouter un dossier -->
            <div id="addFolderModal" class="modal">
                <div class="modal-content">
                    <span class="close-btn">&times;</span>
                    <h2>Ajouter un dossier</h2>

                    <label for="newFolderName">Nom du dossier :</label>
                    <input type="text" id="newFolderName" placeholder="Nom du dossier">

                    <label for="newFolderDescription">Description :</label>
                    <textarea id="newFolderDescription" placeholder="Description du dossier"></textarea>

                    <button type="button" id="submitFolderBtn" class="btn btn-success">Créer</button>
                </div>
            </div>



        </div>

        <!-- Submit Button -->
        <div class="form__part">
            <button type="submit" class="bouton bouton--validate form__submit">Ajouter le document</button>
        </div>

    </form>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){
    $('#addFolderBtn').click(function(){
        $('#addFolderModal').show();
        console.log('Appuie sur boton');
    });

    $('.close-btn').click(function(){
        $('#addFolderModal').hide();
    });

    $('#submitFolderBtn').click(function(){
    let folderName = $('#newFolderName').val();
    let folderDescription = $('#newFolderDescription').val();

    // Envoie une requête AJAX pour créer le dossier
    $.post('/folder/create', { 
        _token: "{{ csrf_token() }}",
        name: folderName, 
        description: folderDescription 
    }, function(response){
        // Ajoutez le nouveau dossier à la liste
        $('.radio-column').append(`
            <div class="radio-item">
                <input type="radio" name="folder_id" value="${response.id}" id="folder_${response.id}">
                <label for="folder_${response.id}">${response.name}</label>
            </div>
        `);

        // Fermer le modal et réinitialiser les champs du modal
        $('#addFolderModal').hide();
        $('#newFolderName').val('');
        $('#newFolderDescription').val('');
    });
});


});
</script>
