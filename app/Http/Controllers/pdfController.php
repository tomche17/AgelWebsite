<?php

namespace App\Http\Controllers;
use App\Inventaire;
use App\Comite;
use App\Historique;
use App\Stock;
use App\Listing;
use Illuminate\Http\Request;
use \PDF;
use setasign\Fpdi\Fpdi;
use PhpOffice\PhpSpreadsheet\IOFactory;
class pdfController extends Controller
{

    public function createpdfbar() {
        error_log('generate');
        $listings =  Listing::orderBy('id_cb', 'asc')->get();
        error_log($listings);
        $pdf = PDF::loadView('admin.pdf.persons', compact('listings'));
        return $pdf->download('Listing_Bar_Agel.pdf');
    }
    public function createpdfdetails() {
        $listings =  Listing::orderBy('id_cb', 'asc')->get();
        error_log($listings);
        $pdf = PDF::loadView('admin.pdf.details', compact('listings'));
        return $pdf->download('Listing_Details_Agel.pdf');
    }

public function createpdfinventaire($id_inventaire) {
    // ... (Reprenez la majorité du code de votre fonction createfactureinventaire pour récupérer les données nécessaires)

    // Une fois que vous avez toutes vos données ($event_name, $cb, $items_facture, etc.)

    $data = [
        'event_name' => $event_name,
        'cb' => $cb,
        'items_facture' => $items_facture,
        // ... Ajoutez toutes les autres données dont vous avez besoin
    ];

    // Génère le PDF à partir de la vue
    $pdf = PDF::loadView('admin.pdf.inventaires', $data);

    // Télécharger le PDF (vous pouvez également le sauvegarder ou l'envoyer par email)
    return $pdf->download('inventaire.pdf');
}

}
