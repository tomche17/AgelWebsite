@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Modifier ce membre du CB {{ $cb->nom }}</h2>
    </div>
    <div class="content">
        <form action="{{ route('listings.update', ['id' => $listing->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input id="id_cb" type="hidden" name="id_cb" value="{{ $cb->id }}">
            <div class="pb-4 form-group">
                <h6>Nom</h6>
                <input id="surname" type="text" class="form-control form-content" name="surname" value="{{ $listing->surname }}">
            </div>
            <div class="pb-4 form-group">
                <h6>Prénom</h6>
                <input id="firstname" type="text" class="form-control form-content" name="firstname" value="{{ $listing->firstname }}">
            </div>

            <div class="pb-4 form-group" id="dynamic_function">
                <h6>Fonction</h6>
                @php
                    $functions = Config::get('constants.functions');
                @endphp

                @foreach ($listing->function as $function)
                    <select name="function[{{ $loop->index }}]" class="form-control form-content">
                        <option value="{{ $function }}" {{ $function }} selected> {{ $function }} </option>
                        @foreach ($functions as $function)
                            <option value="{{ $function }}"> {{$function}} </option>
                        @endforeach
                    </select>
                    @php
                        $fieldCounter = $loop->index;
                    @endphp
                @endforeach
            </div>
            <button type="button" id="add_function" name="add_function" class="fa fa-plus mb-4 btn btn-success">Ajouter une fonction</button>

            <div class="pb-4 form-group">
                <h6>Numéro de téléphone</h6>
                <input id="phone_number" type="tel" class="form-control form-content" name="phone_number" value="{{ $listing->phone_number }}">
            </div>
            <div class="pb-4 form-group">
                <h6>Email</h6>
                <input id="email" type="email" class="form-control form-content" name="email" value="{{ $listing->email }}">
            </div>
            <div class="pb-4 form-group">
                <h6>Adresse légale</h6>
                <input id="legal_address" type="text" class="form-control form-content" name="legal_address" value="{{ $listing->legal_address }}">
            </div>
            <div class="pb-4 form-group">
                <h6>Photo</h6>
                <input id="image" type="file" class="form-control form-content" name="image">
            </div>

            <button type="submit" class="btn btn-success">Enregistrer</button>
            
            <a href="{{ url()->previous() }}">
                <button type="button" class="btn btn-danger">Annuler</button>
            </a>
        </form>
    </div>
    <!-- END Page Content -->
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    
    var maxFields = 8;
    var i = <?php echo $fieldCounter; ?> + 1; //Initial field counter is 1
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