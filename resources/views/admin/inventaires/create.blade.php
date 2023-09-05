@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Ajouter un inventaire</h2>
    </div>
    <div class="content">
        <form action="{{ route('admin.inventaires.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="pb-4 form-group">
                <h6>Date de l'inventaire</h6>
                <input id="date" type="date" class="form-control form-content" name="date">
            </div>
            <div class="pb-4 form-group">
                <h6>Nom de l'évènement</h6>
                <select id="event_name" class="form-control form-content" name="event_name">
                    @foreach($events as $event)
                        <option value="{{ $event->nom }}">{{ $event->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="pb-4 form-group">
                <h6>Nom du responsable AGEL</h6>
                <select id="agel_name" name="agel_name" class="form-control form-content">
                <option value="rien">Choisis ton nom</option>
                    @foreach ($responsablesAgel as $responsable)
                    <option value="{{ $responsable->surname }}"> {{ $responsable->surname . ' ' . $responsable->firstname }} </option>
                    @endforeach
                </select>

            </div>
            <div class="pb-4 form-group">
                <h6>Nom du CB entrant</h6>
                <select name="id_cb_in" id="id_cb_in" class="form-control form-content">
                    <option value="rien">Choisis un CB</option>
                   @foreach ($comites as $comite)
                       <option value="{{$comite->id}}">{{$comite->nom}}</option>
                   @endforeach
                </select>
            </div>
            <div class="pb-4 form-group">
                <h6>Nom du CB sortant</h6>
                <select name="id_cb_out" id="id_cb_out" class="form-control form-content">
                    <option value="rien">Choisis un CB</option>
                   @foreach ($comites as $comite)
                       <option value="{{$comite->id}}">{{$comite->nom}}</option>
                   @endforeach
                </select>
            </div>
            <div class="pb-4 form-group" id="dynamic_stock">
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
                                    <input type="number" class="form-control form-content" name="stock[{{ $loop->index }}][quantity]" min="0"  placeholder="{{ $c->quantity }} disponible">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


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

</script>