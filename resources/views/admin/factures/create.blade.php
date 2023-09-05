@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Creer une facture</h2>
    </div>
    <div class="content">
        <form action="{{ route('admin.factures.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="pb-4 form-group">
                <h6>Date d'émission de la facture</h6>
                <input id="date_facture" type="date" class="form-control form-content" name="date_facture">
            </div>
            <div class="pb-4 form-group">
                <h6>Destinataire</h6>
                <input id="destinataire_facture" type="text" class="form-control form-content" name="destinataire_facture">

            </div>
            <div class="pb-4 form-group">
                <h6>Nom de l'évènement</h6>
                <input id="name_event_facture" type="text" class="form-control form-content" name="name_event_facture">

            </div>



            <div class="pb-4 form-group" id="dynamic_item">
                <h6>Item a facturé</h6>
                <div class="row">
                    
                    <div class="col">
                        <label for="item-name-0">Description</label>
                        <input type="text" class="form-control form-content" name="item[0][name]" min="0" id="item-name-0" placeholder="Exemple: Absence démontage bal des mofflés">
                    </div>
                    
                    <div class="col">
                        <label for="item-quantity-0">Quantité</label>
                        <input type="number" class="form-control form-content" name="item[0][quantity]" min="0" id="item-quantity-0" placeholder="2">
                    </div>
                    
                    <div class="col">
                        <label for="item-price-0">Prix Unitaire</label>
                        <input type="number" class="form-control form-content" name="item[0][prix_unitaire]" min="0" id="item-price-0" placeholder="150€">
                    </div>

                </div>
            </div>


            <button type="button" onclick="addItem()" id="add_item" name="add_item" class="fa fa-plus mb-4 btn btn-success">Ajouter un item</button>

            <div class="pb-4 form-group tags-section">
                <h6>Tags</h6>
                <!-- Les boutons ci-dessous représentent les tags. -->
                <!-- Les données réelles pour ces tags proviennent de la base de données. -->
                @foreach($tags as $tag)
                    <button type="button" class="tag-btn btn btn-outline-primary" data-tag="{{ $tag->name }}">{{ $tag->name }}</button>
                @endforeach
                <div id="selectedTagsDisplay" class="mt-3"></div>
                <!-- Ce champ caché stockera les tags sélectionnés. -->
                <input type="hidden" name="selected_tags" id="selectedTags" value="">
            </div>
            <div id="selectedTagsDisplay" class="mt-3"></div>




            <button type="submit" class="btn btn-success">Enregistrer la facture</button>
            <button type="button" class="btn btn-danger">Annuler</button>
        </form>
    </div>
    <!-- END Page Content -->
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
var itemCount = 1; // Pour suivre le nombre d'éléments ajoutés
$(document).ready(function() {
    $('.tag-btn').on('click', function() {
        let tag = $(this).data('tag');
        $(this).toggleClass('btn-primary'); // Toggle le style pour montrer que le tag est sélectionné
        let selectedTags = [];
        
        // Vérifier si le tag est sélectionné ou non
        if ($(this).hasClass('btn-primary')) {
            // Si sélectionné, ajoutez-le à la section des tags sélectionnés
            $('#selectedTagsDisplay').append('<span class="selected-tag-label mr-2">#' + tag + '</span>');
        } else {
            // Sinon, retirez-le de la section des tags sélectionnés
            $('#selectedTagsDisplay .selected-tag-label').each(function() {
                if ($(this).text() === '#' + tag) {
                    $(this).remove();
                }
            });
        }

        $('.tag-btn.btn-primary').each(function() {
            selectedTags.push($(this).data('tag'));
        });

        $('#selectedTags').val(selectedTags.join(',')); // Mettre à jour le champ caché avec les tags sélectionnés
    });
});



function addItem() {
  var dynamicItem = document.getElementById('dynamic_item');
  var newRow = document.createElement('div');
  newRow.className = 'row';

  // Créez les colonnes pour name, quantity, et prix_unitaire
  newRow.innerHTML = `
    <div class="col">
        <input type="text" class="form-control form-content" name="item[${itemCount}][name]" min="0" >
    </div>
    <div class="col">
        <input type="number" class="form-control form-content" name="item[${itemCount}][quantity]" min="0" >
    </div>
    <div class="col">
        <input type="number" class="form-control form-content" name="item[${itemCount}][prix_unitaire]" min="0" >
    </div>
  `;

  // Incrémente le compteur d'éléments
  itemCount++;

  // Ajoutez la nouvelle ligne au div dynamic_item
  dynamicItem.appendChild(newRow);
}


</script>