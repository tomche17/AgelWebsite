<style>
  .page-break {
    page-break-after: always;
  }
  .table-bordered th, .table-bordered td {
    border: 1px solid #000;
  }
  .table-striped tbody tr:nth-of-type(odd) {
    background-color: #F5CBA7; /* Couleur de fond pour les lignes impaires */
  }
  .table-striped tbody tr:nth-of-type(even) {
    background-color: #A3E4D7; /* Couleur de fond pour les lignes paires */
  }
</style>
<div class="block">
  <div class="block-content block-content-full">
    <!-- Logo -->
    <img src="{{ public_path('media/logos/agel.png') }}" alt="AGEL Logo" style="width: 100px; position: absolute; top: 0; right: 0;">

    <h1 class="text-center">Listing officiel AGEL</h1>
    <h3 class="text-center">Généré depuis le site web agel-liege.be le {{ date('d-m-Y') }}</h3>

    @foreach($listings->groupBy('id_cb') as $cb_id => $cb_listings)
        @php
            $cb = \App\Comite::findOrFail($cb_id);
        @endphp
        <h4 class="text-center">CB {{ $cb->nom }}</h4>
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full" style="border: 1px solid black;">
        <thead style="background-color: #5D6D7E; color: white;">
         <tr class="table__head">
            <th style="width: 80px;">Fonction</th>
            <th style="width: 60px;">Nom</th>
            <th style="width: 60px;">Prénom</th>
            <th style="width: 200px;">Email</th>
            <th style="width: 100px;">Téléphone</th>
            <th style="width: 200px;">Adresse légale</th>
         </tr>
         </thead>

            <tbody>
            @foreach($cb_listings as $index => $listing)
              <tr style="background-color: {{ $index % 2 == 0 ? 'lightgray' : 'white' }};">
                <td style="text-align: center; ">{{ implode('<br>', $listing->function) }}</td>
                <td style="text-align: center; ">{{ $listing->surname }}</td>
                <td style="text-align: center; ">{{ $listing->firstname }}</td>
                <td style="text-align: center; ">{{ $listing->email }}</td>
                <td style="text-align: center; ">{{ $listing->phone_number }}</td>
                <td style="text-align: center; ">{{ $listing->legal_address }}</td>
              </tr>
            @endforeach
            </tbody>
        </table>
    @endforeach

  </div>
</div>
