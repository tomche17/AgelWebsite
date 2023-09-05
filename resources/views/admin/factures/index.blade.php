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
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">factures</h2>
        </div>

        <!-- Info -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="block">
                    <div class="block-content">
                        <p class="text-muted">
                            factures effectués jusqu'ici.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Info -->

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th>Date d'émission de la facture </th>
                            <th>Nom de l'évent </th>                            
                            <th>Destinataire</th>
                            <th>Montant</th>
                            <th>Référence</th>
                            <th>Tag</th>
                            <th>Envoyée ?</th>
                            <th>Payée ?</th>
                            <th>Facture</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($factures as $facture)
                            <tr>
                                <td class="font-w600">
                                    {{$facture->date_emission}}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    {{$facture->event_name}}
                                </td>
                                <td>
                                    {{$facture->destinataire}}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    {{$facture->montant}}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    {{$facture->reference}}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    {{$facture->tags}}
                                </td>
                                <td>
                                    <input type="checkbox" name="is_send" data-id="{{ $facture->id }}" {{ $facture->is_send ? 'checked' : '' }} class="toggle-is_send">
                                </td>

                                <td>
                                    <input type="checkbox" name="paid" data-id="{{ $facture->id }}" {{ $facture->paid ? 'checked' : '' }} class="toggle-paid">
                                </td>

                                <td>
                                    <a href="{{ route('admin.facture.view', ['filename' => $facture->reference . '.xlsx']) }}">Télécharger</a>
                                </td>
                                <td class="td--actions">

                                    <form action="{{ route("admin.factures.destroy", ["id" => $facture->id])}}" method="POST">
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
        <a href="{{route("admin.factures.create")}}" class="bouton bouton--admin" title="Ajouter un factures"><i class="fa fa-plus"></i> Ajouter une facture</a>
    </div>
    <!-- END Page Content -->

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.toggle-is_send').change(function() {
        var factureId = $(this).data('id');
        var isChecked = $(this).prop('checked') ? 1 : 0;

        $.ajax({
            url: '/admin/factures/updateIsSend', // URL pour la mise à jour (à créer dans les routes et le contrôleur)
            method: 'POST',
            data: {
                id: factureId,
                is_send: isChecked,
                _token: "{{ csrf_token() }}"
            }
        });
    });

    $('.toggle-paid').change(function() {
        var factureId = $(this).data('id');
        var isChecked = $(this).prop('checked') ? 1 : 0;

        $.ajax({
            url: '/admin/factures/updatePaid', // URL pour la mise à jour (à créer dans les routes et le contrôleur)
            method: 'POST',
            data: {
                id: factureId,
                paid: isChecked,
                _token: "{{ csrf_token() }}"
            }
        });
    });
});

</script>
