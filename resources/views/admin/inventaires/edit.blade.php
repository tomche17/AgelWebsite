@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Modifier un inventaire</h2>
    </div>
    <div class="content">
        <form action="{{ route('admin.inventaires.update', ['id' => $inventaire->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="pb-4 form-group">
                <h6>Date de l'inventaire</h6>
                <input id="date" type="date" class="form-control form-content" name="date" value="{{ $inventaire->date }}">
            </div>
            <div class="pb-4 form-group">
                <h6>Nom du responsable AGEL</h6>
                <select id="agel_name" name="agel_name" class="form-control form-content">
                <option value="rien">Choisis ton nom</option>
                    @foreach ($responsablesAgel as $responsable)
                    <option value="{{ $responsable->surname }}" selected> {{ $responsable->surname . ' ' . $responsable->firstname }} </option>
                    @endforeach
                </select>

            </div>
            <div class="pb-4 form-group">
                <h6>Nom du comité entrant</h6>
                <select id="id_cb_in" name="id_cb_in" class="form-control form-content">
                    <option value="{{ $cb->id }}" selected> {{$cb->nom}}</option>
                    @foreach ($comites as $comite)
                        @if ($comite->id != $cb->id)
                            <option value="{{ $comite->id }}"> {{$comite->nom}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="pb-4 form-group">
                <h6>Nom du comité sortant</h6>
                <select id="id_cb_out" name="id_cb_out" class="form-control form-content">
                    <option value="{{ $cb->id }}" selected> {{$cb->nom}}</option>
                    @foreach ($comites as $comite)
                        @if ($comite->id != $cb->id)
                            <option value="{{ $comite->id }}"> {{$comite->nom}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="pb-4 form-group">
                <h6>Nom de l'évènement</h6>
                <input value="{{ $inventaire->event_name }}" id="event_name" type="text" class="form-control form-content" name="event_name">
            </div>

            <div class="pb-4 form-group" id="dynamic_stock">
            <tbody>
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
                                    <input type="number" class="form-control form-content" name="stock[{{ $loop->index }}][quantity]" min="0" value="{{ $c->quantity }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
           
            <div class="pb-4 form-group">
                <h6>Validation de l'AGEL ?</h6>
                <input type="checkbox" id="agel_valid" name="agel_valid" value="1" class="form-control form-content" {{ $inventaire->agel_valid ? 'checked' : '' }}>
            </div>

            <button type="submit" class="btn btn-success">Passer au récap</button>
            <button type="button" class="btn btn-danger">Annuler</button>
        </form>
    </div>
    <!-- END Page Content -->
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

    var imageCount = 1; //Initial field counter is 1
    $('#add_image').click(function() {
        var wrapper = $('#dynamic_image'); //Input field wrapper
        var htmlField = '<input type="file" name="photos['+imageCount+']" class="form-control form-content">'
        $(wrapper).append(htmlField); //Add field html
        imageCount++; //Increment field counter
    });


});
</script>