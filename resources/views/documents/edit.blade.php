@extends('layouts.backend')

@section('content')
<div class="title__container">
    <h2 class="page__title">Modifier un document</h2>
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

    <form role="form" method="POST" action="{{ route('admin.documents.update', $document->id) }}" enctype="multipart/form-data" class="admin__form">
        @csrf
        @method('POST')

        <div class="form__part">

            <!-- Titre du document -->
            <div class="form__section">
                <label class="form__label" for="title">Titre du document</label>
                <input type="text" class="input--classic" name="title" id="title" value="{{ $document->title }}" required/>
            </div>

            <!-- Uploader un fichier -->
            <div class="form__section">
                <label class="form__label" for="file">Uploader un fichier</label>
                <input type="file" class="input--classic" name="file" id="file" value="{{ $document->file_path }}" />
                <p class="text-muted">Fichier actuel : {{ $document->file_path }}</p>
            </div>

            <!-- Droits d'accès -->
            <div class="form__section">
                <label class="form__label" for="droit_access">Droits d'accès</label>
                <select class="form__select form__input input--classic" name="droit_access" id="droit_access">
                    <option value="1" {{ ($document->droit_access == 1) ? 'selected' : '' }}>Admin only</option>
                    <option value="2" {{ ($document->droit_access == 2) ? 'selected' : '' }}>Tout le monde</option>
                </select>
            </div>

        </div>

        <!-- Bouton de soumission -->
        <div class="form__part">
            <button type="submit" class="bouton bouton--validate form__submit">Modifier le document</button>
        </div>
    </form>
</div>
@endsection
