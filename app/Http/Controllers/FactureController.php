<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Inventaire;
use App\Comite;
use App\Listing;
use App\Stock;
use App\Event;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use App\Historique;
use App\Facture;
use App\User;
use Image;

class FactureController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    // Returns the view containing the list of all Inventaires
    public function index() {
        $factures = Facture::orderBy('id', 'desc')->get();
        return view('admin.factures.index', compact('factures'));
    }
    public function create() {
        $comites = Comite::all();
        $stocks = Stock::all();
        $tags = Tag::all();
        error_log($tags);
        $responsablesAgel = Listing::where('agel', 1)->get();
        $startDate = now()->subDays(7);
        $endDate = now()->addDays(7);
        
        $events = Event::whereBetween('date', [$startDate, $endDate])->get();
        return view('admin.factures.create', compact('responsablesAgel','comites', 'stocks', 'tags','events'));
    }
    public function destroy($id) {
        $facture = Facture::findOrFail($id);
            
        $facture->delete();
    
        return redirect('/admin/factures');
    }
    public function store(Request $request) {
        $rules = [
            'date_facture' => 'required|date',
            'destinataire_facture' => 'required|string',
            'name_event_facture' => 'required|string',
        ];
      
        $messages = [
            'date_facture.required' => 'Le champ "DATE D EMISSION" est obligatoire.',
            'destinataire_facture.required' => 'Le champ "Destinataire" est obligatoire.',
            'name_event_facture.required' => 'Le champ "NOM DE L EVENT" est obligatoire.',
        ];
    
        $validator = Validator::make($request->all(),$rules, $messages);
    
        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        $lastFacture = Facture::orderBy('id', 'desc')->first();

        // Obtenir l'année en cours
        $currentYear = date("Y");

        if ($lastFacture) {
            $reference = $lastFacture->reference;
            $lastYear = substr($reference, 0, 4); // Extrait l'année de la référence
            $lastThreeDigits = (int) substr($reference, -3);
            
            // Si l'année de la dernière facture est différente de l'année en cours, réinitialiser la numérotation
            if ($lastYear != $currentYear) {
                $lastThreeDigits = 0;
            }
        } else {
            $lastThreeDigits = 0;
        }

        // Incrémente pour obtenir le prochain ID
        $nextId = $lastThreeDigits + 1;

        // Formate pour avoir 3 chiffres, en ajoutant des zéros au besoin
        $nextIdFormatted = sprintf("%03d", $nextId);

        // Concatène avec l'année pour former l'ID de la facture
        $id_facture = $currentYear . "_" . $nextIdFormatted;


        error_log('Create facture');
     

        $items_facture = [];

        foreach ($request->item as $key => $arr) {
            error_log(print_r($arr, true));
            $item_facture = [
                'item' => $arr['name'],
                'quantity' => intval($arr['quantity']),
                'prix_unitaire' => intval($arr['prix_unitaire']),
                'prix' => intval($arr['quantity']) * intval($arr['prix_unitaire']), // vous pouvez calculer le prix ici
            ];
        
            array_push($items_facture, $item_facture);
        }
        
        $event_name=request('name_event_facture');
        $destinataire = request('destinataire_facture');
        $prix_total = $this->createfacturexlsv($event_name,$id_facture,$destinataire,$items_facture);
        $facture = new Facture;

        $facture->destinataire = $destinataire;
        $date_emission = date('Y-m-d');
        $facture->date_emission = date('Y-m-d', strtotime($date_emission));
        $facture->montant = $prix_total;
        
        $facture->event_name = $event_name;
        $facture->paid = false;
        $facture->reference = $id_facture;
        $tags = $request->input('selected_tags');
        error_log($tags);
      //  $tagsArray = explode(',', $tags);

        //error_log($tagsArray);
        $facture->tags= $tags;
        $facture->save();
        // Need to add a confirmation message: ->with('mssg', 'Thanks for your order!');
        return redirect('/admin/factures'); 
    }

    function createfacturexlsv($event_name,$id_facture,$cb,$items_facture){
        error_log("Arrive dans creation xslv");
        $spreadsheet = IOFactory::load(public_path('Templates/TemplateFactureAgel2023.xlsx'));
        
        // Get the active sheet (the one that's currently open in Excel)
        $worksheet = $spreadsheet->getActiveSheet();
        $worksheet->setCellValue('B11' , $event_name);
        $worksheet->setCellValue('E3' , $id_facture);
        $worksheet->setCellValue('E4' , date('d-m-Y'));
        $worksheet->setCellValue('E5' , $cb);
        // Assurez-vous que le tableau $item_facture contient bien les données requises.
        // Initialiser la ligne de départ
        $startRow = 14;
        $prix_total=0;
        // Parcourir les données dans item_facture
        foreach($items_facture as $item_facture){
            // Écrire l'item dans la colonne B de la ligne courante
            $worksheet->setCellValue('B' . $startRow, $item_facture['item']);
            // Écrire la quantity dans la colonne C de la ligne courante
            $worksheet->setCellValue('C' . $startRow, $item_facture['quantity']);
            // Écrire le prix unitaire dans la colonne D de la ligne courante
            $worksheet->setCellValue('D' . $startRow, $item_facture['prix_unitaire']);
            // Écrire le prix dans la colonne E de la ligne courante
            $worksheet->setCellValue('E' . $startRow, $item_facture['quantity']*$item_facture['prix_unitaire']);
            $prix_total += $item_facture['prix'];
            // Incrémenter la ligne de départ pour la prochaine itération
            error_log($startRow);
            $startRow++;
            if($startRow>=32){
                $worksheet->insertNewRowBefore($startRow, 5);}

        }
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $fileName = $id_facture . ".xlsx";
        $tempFile = tmpfile();
        $writer->save($tempFile);
        
        // Sauvegardez le fichier dans le disque "private"
        Storage::disk('private')->put('Factures/'.$fileName, $tempFile);
        
        // Fermez le fichier temporaire
        fclose($tempFile);

        return $prix_total;
    }
    public function getFacture($filename)
    {
        $path = storage_path('app/private/Factures/' . $filename);
        error_log($path);
        error_log('file:' . $path);
        if (!File::exists($path)) {
            dd("Il n'y a pas de facturation lié à l'inventaire dans ce cas présent (0€)"); 
        }

        $file = \File::get($path);
        $type = \File::mimeType($path);
    
        return response($file, 200)->header('Content-Type', $type)
                           ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');

    }
    public function updateIsSend(Request $request) {
        $facture = Facture::find($request->id);
        $facture->is_send = $request->is_send;
        $facture->save();
    }
    
    public function updatePaid(Request $request) {
        $facture = Facture::find($request->id);
        $facture->paid = $request->paid;
        $facture->save();
    }
    


}