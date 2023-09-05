@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        @php
            $user = Auth::user();
            $cb = \App\Comite::where('id', $user->comite_id)->firstOrFail();
        @endphp
        <h2 class="content-heading">Ajouter un membre du CB {{ $cb->nom }}</h2>
    </div>
    <div class="content">
        <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf            
            <input id="id_cb" type="hidden" name="id_cb" value="{{ $cb->id }}">
            <div class="pb-4 form-group">
                <h6>Nom</h6>
                <input id="surname" type="text" class="form-control form-content" name="surname" value="{{ old('surname') }}" placeholder="Nom">

            </div>
            <div class="pb-4 form-group">
                <h6>Prénom</h6>
                <input id="firstname" type="text" class="form-control form-content" name="firstname" value="{{ old('firstname') }}" placeholder="Prénom">
            </div>

            <div class="pb-4 form-group" id="dynamic_function">
                <h6>Fonction</h6>
                @php
                    $functions = Config::get('constants.functions');
                @endphp
                <select name="function[0]" class="form-control form-content">
                    @foreach ($functions as $function)
                        <option value="{{ $function }}"> {{$function}} </option>
                    @endforeach
                </select>
            </div>
            <button type="button" id="add_function" name="add_function" class="fa fa-plus mb-4 btn btn-success">Ajouter une fonction</button>

            <div class="pb-4 form-group">
                <h6>Numéro de téléphone</h6>
                <input id="phone_number" type="tel" class="form-control form-content" name="phone_number" value="{{ old('phone_number') }}" placeholder="Numéro de téléphone">
            </div>
            <div class="pb-4 form-group">
                <h6>Email</h6>
                <input id="email" type="email" class="form-control form-content" name="email" value="{{ old('email') }}" placeholder="Email">
            </div>
            <div class="pb-4 form-group">
                <h6>Adresse légale</h6>
                <input id="legal_address" type="text" class="form-control form-content" name="legal_address" value="{{ old('legal_address') }}" placeholder="Adresse">
            </div>
            <div class="pb-4 form-group">
                <h6>Photo</h6>
                <input id="image" type="file" class="form-control form-content" name="image">
            </div>

            <button type="submit" class="btn btn-success">Enregistrer</button>
            <button type="button" class="btn btn-danger">Annuler</button>
        </form>
    </div>
    <!-- END Page Content -->
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    
    var maxFields = 8;
    var i = 1; //Initial field counter is 1
    var wrapper = $('#dynamic_function'); //Input field wrapper

    $('#add_function').click(function() {
        //Check maximum number of input fields
        if(i < maxFields){ 
            var htmlField = '<select name="function['+i+']" class="form-control form-content">@foreach ($functions as $function)<option value="{{ $function }}"> {{$function}} </option>@endforeach</select>';
            $(wrapper).append(htmlField); //Add field html
            i++; //Increment field counter
        }
    });
});
</script>