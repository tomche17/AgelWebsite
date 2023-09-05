@extends('layouts.backend')

@section('content')
<div class="content">
    @if(pathinfo($document->file_path, PATHINFO_EXTENSION) == 'pdf')
        <!-- Affichage pour les PDF -->
        <iframe src="{{ asset($document->file_path) }}" width="100%" height="600px"></iframe>
    @else
        <!-- Affichage avec Google Docs Viewer -->
        <iframe src="https://docs.google.com/viewer?url={{ asset($document->file_path) }}&embedded=true" width="100%" height="600px"></iframe>
    @endif
</div>
@endsection
