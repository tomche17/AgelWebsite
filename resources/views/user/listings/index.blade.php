@extends('layouts.backend')
@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
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

@php
    $user = Auth::user();
    $cb = \App\Comite::where('id', $user->comite_id)->firstOrFail();
    $cbListings = \App\Listing::where('id_cb', $cb->id)->get();
@endphp

<div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">Listing du CB {{ $cb->nom }}</h2>
        </div>
        
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">

                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                      <tr class="table__head">
                        <th>Comité</th>
                        <th>Fonction</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Adresse Légale</th>
                        <th>AGEL?</th>
                        <th>Actions</th>
                      </tr>
                    </thead>

                    <tbody>
                    @foreach($cbListings as $listing)
                      <tr>
                        <td>{{ $cb->nom }}</td>

                        <td>
                        @foreach ($listing->function as $function)
                            @php
                                $text = $function . "\n";
                                echo nl2br($text);
                            @endphp
                        @endforeach    
                        </td>

                        <td>{{ $listing->surname }}</td>
                        <td>{{ $listing->firstname }}</td>
                        <td><a href="mailto:{{ $listing->email }}">{{ $listing->email }}</a></td>
                        <td><a href="tel:{{ $listing->phone_number }}">{{ $listing->phone_number }}</a></td>
                        <td>{{ $listing->legal_address }}</td>
                        <td>
                          @if ($listing->agel == true)
                            <b style="color:green;">Oui</b>
                          @else
                            <b style="color:red;">Non</b>
                          @endif
                        </td>
                        <td class="td--actions">
                            <a href="{{ route("listings.edit", ["id" => $listing->id])}}" title="Editer" class="table__link"><i class="fa fa-pencil-square-o"></i>
                                <span class="hide">Editer</span>
                            </a>
                            <form action="{{ route("listings.destroy", ["id" => $listing->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="#" title="Supprimer" class="table__link" onclick="this.closest('form').submit();return false;"><i class="fa fa-times-circle"></i>
                                    <span class="hide">Supprimer</span>
                                </a>
                            </form>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
        <!-- END Dynamic Table Full -->

        <a href="{{ route("listings.create") }}" class="bouton bouton--admin" title="Ajouter un membre"><i class="fa fa-plus"></i> Ajouter un membre</a>
    </div>
    <!-- END Page Content -->
@endsection

