<div class="block">
    <div class="block-content block-content-full">
    <img src="{{ public_path('media/logos/agel.png') }}" alt="AGEL Logo" style="width: 100px; position: absolute; top: 0; right: 0;">
        <h1 class="text-center">Listing Bar AGEL</h1>
        <h4 class="text-center">Généré depuis le site web agel-liege.be le {{ date('d-m-Y') }}</h4>

        @foreach($listings->groupBy('id_cb') as $cb_id => $cb_listings)
            @php
                $cb = \App\Comite::findOrFail($cb_id);
            @endphp
            <h4 class="text-center">CB {{ $cb->nom }}</h4>
            <table class="table">
                @foreach(array_chunk($cb_listings->all(), 3) as $row_listings)
                    <tr>
                        @foreach($row_listings as $listing)
                            <td style="width: 33.33%;">
                                <img src="{{ public_path($listing->image) }}" alt="Photo" style="width: 200px;">
                                <p>{{ $listing->surname }} {{ $listing->firstname }} ({{ join(', ', $listing->function) }})</p>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        @endforeach
    </div>
</div>
