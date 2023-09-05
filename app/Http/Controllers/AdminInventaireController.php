<?php

namespace App\Http\Controllers;
use \PDF;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\FactureController;

use setasign\Fpdi\Fpdi;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Validator, Mail;
use Carbon\Carbon;
use App\Inventaire;
use App\Comite;
use App\Listing;
use App\Stock;
use App\Event;
use App\Historique;
use App\Facture;
use App\User;

class AdminInventaireController extends Controller
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
        $inventaires = Inventaire::orderBy('id')->get();
        return view('admin.inventaires.index', compact('inventaires'));
    }
    public function recupVarItems($id){

        error_log('arrivée dans recup');
        error_log($id);
        $historiques_id=Historique::where('id_inventaire', $id)->get();
        error_log("recup histo id");
        error_log($historiques_id);
        $items_facture = [];

        foreach ($historiques_id as $historique_id) {
            // Transformer les tableaux 'modif_items' et 'modif_quantities' en un seul tableau associatif.
            $items = array_combine($historique_id->modif_items, $historique_id->modif_quantities);
        
            foreach ($items as $item => $quantity) {
                // Si l'item n'a pas encore été rencontré, on initialise sa somme à 0.
                if (!isset($sums[$item])) {
                    $sums[$item] = 0;
                }
        
                // Ajouter la quantité de l'item à sa somme.
                $sums[$item] += $quantity;
                $prix_unitaire = Stock::where('name', $item)->value('price');
                $prix = $prix_unitaire * abs($sums[$item]);
        

        
                // Si l'item n'existe pas encore dans $items_facture, l'ajouter.
// ...

                if (!isset($items_facture[$item])) {

                    // Ajouter les détails à notre tableau en utilisant $item comme clé.
                    if($sums[$item]<0){
                        $items_facture[$item] = [
                            'item' => $item,
                            'quantity' => abs($sums[$item]),
                            'prix_unitaire' => $prix_unitaire,
                            'prix' => $prix,
                        ];
                        }
                }
                else {
                    // Si l'item existe déjà dans $items_facture, mettre à jour sa quantité.
                    $items_facture[$item]['quantity'] = abs($sums[$item]);
                }

// ...

            }
        }
        return $items_facture;
    }
    public function recap($id) {
        $inventaire = Inventaire::where('id', $id)->firstOrFail();
        error_log($inventaire);
        $historique = Historique::where('id_inventaire', $id)->get();       
        $stocks = Stock::all();         
        
        // Récupération du responsable AGEL et du CB en utilisant les ID stockés dans l'inventaire
        $selectedAgel = Listing::where('surname', $inventaire->agel_name)->first();
        //$selectedCb = Comite::where('id', $inventaire->id_cb)->first();
        $modif_items=$this->recupVarItems($id);
        return view('admin.inventaires.recap', compact('inventaire', 'historique', 'stocks','modif_items'));
    }
    public function generatepdfcomiteentrant(){
        $inventaire = Inventaire::latest('id')->first();
        error_log($inventaire);
        $comites = Comite::all();    
        $cb = Comite::where('id', $inventaire->id_cb_in)->firstOrFail();        
        $historique = Historique::where('id_inventaire', $inventaire->id)->get();       
        $stocks = Stock::all();        
        $responsablesAgel = Listing::where('agel', 1)->get();     
        $startDate = now()->subDays(7);  
        $endDate = now()->addDays(7);  
        $events = Event::whereBetween('date', [$startDate, $endDate])->get();  
        
        // Récupération du responsable AGEL et du CB en utilisant les ID stockés dans l'inventaire
        $selectedAgel = Listing::where('surname', $inventaire->agel_name)->first();
        $selectedCb = Comite::where('id', $inventaire->id_cb_in)->first();
        $modif_items=$this->recupVarItems($inventaire->id);
        $pdf = PDF::loadView('admin.pdf.comiteentrant', compact('inventaire', 'comites', 'cb', 'historique', 'stocks','responsablesAgel', 'events', 'selectedAgel', 'selectedCb','modif_items'));
        $date = Carbon::now()->format('Y-m-d'); // Cette ligne générera la date actuelle au format "année-mois-jour"
        $filename = 'InventaireComiteEntrant_' . $date . '.pdf';

        return $pdf->download($filename);
    }
    public function generatepdfcomitesortant(){
        $inventaire = Inventaire::latest('id')->first();
        error_log($inventaire);
        $comites = Comite::all();    
        $cb = Comite::where('id', $inventaire->id_cb_out)->firstOrFail();        
        $historique = Historique::where('id_inventaire', $inventaire->id)->get();       
        $stocks = Stock::all();        
        $responsablesAgel = Listing::where('agel', 1)->get();     
        $startDate = now()->subDays(7);  
        $endDate = now()->addDays(7);  
        $events = Event::whereBetween('date', [$startDate, $endDate])->get();  
        
        // Récupération du responsable AGEL et du CB en utilisant les ID stockés dans l'inventaire
        $selectedAgel = Listing::where('surname', $inventaire->agel_name)->first();
        $selectedCb = Comite::where('id', $inventaire->id_cb_out)->first();
        $modif_items=$this->recupVarItems($inventaire->id);
        $pdf = PDF::loadView('admin.pdf.comitesortant', compact('inventaire', 'comites', 'cb', 'historique', 'stocks','responsablesAgel', 'events', 'selectedAgel', 'selectedCb','modif_items'));
        $date = Carbon::now()->format('Y-m-d'); // Cette ligne générera la date actuelle au format "année-mois-jour"
        $filename = 'InventaireComiteSortant_' . $date . '.pdf';

        return $pdf->download($filename);
    }
    // Stores an Inventaire Record in the database
    public function store(Request $request) {
        $rules = [
            'date' => 'required|date',
            'agel_name' => 'required|string',
            'event_name' => 'required|string',
            'photos' => 'array',
            'photos.*' => 'mimes:jpeg,png,jpg|max:2000',
            'facture' => 'mimes:pdf',
        ];
      
        $messages = [
            'date.required' => 'Le champ "DATE DE L\'INVENTAIRE" est obligatoire.',
            'agel_name.required' => 'Le champ "NOM DU RESPONSABLE AGEL" est obligatoire.',
            'photos.*.mimes' => 'La photo doit être un fichier de type: JPEG, PNG, ou JPG.',
            'photos.*.max' => 'La poids de l\'image ne peut pas dépasser 2MB.',
            'facture.mimes' => 'La facture doit être un fichier de type: PDF.',
        ];
    
        $validator = Validator::make($request->all(),$rules, $messages);
    
        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        // -- STORE INVENTAIRE RECORD --
        $inventaire = new Inventaire();
        $inventaire->date = request('date');
        $inventaire->agel_name = request('agel_name');
        $inventaire->event_name = request('event_name');
        $id_cb_in = $request->input('id_cb_in');
        $id_cb_out = $request->input('id_cb_out');
        
        if ($id_cb_in && strtolower($id_cb_in) !== 'rien') {
            $inventaire->id_cb_in = $id_cb_in;
        } else {
            $inventaire->id_cb_in = null;
        }
        
        if ($id_cb_out && strtolower($id_cb_out) !== 'rien') {
            $inventaire->id_cb_out = $id_cb_out;
        } else {
            $inventaire->id_cb_out = null;
        }
        
        
        $inventaire->paid = $request->has('paid');
        $inventaire->agel_valid = $request->has('agel_valid');
        $inventaire->cb_valid = false;
        $inventaire->facture_path=""; 
        // -- IMAGES PROCESSING --
        $photos = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $imageName = time() . '_' . $photo->getClientOriginalName();
                $imagePath = public_path('/images/inventaires/');
                $photo->move($imagePath, $imageName);
                array_push($photos, '/images/inventaires/' . $imageName);
            }
        }


        $inventaire->save();


        // -- STORE HISTORIQUE RECORD --
        $historique = new Historique();
        $historique->modif_date = date('Y-m-d');
        $historique->id_inventaire = $inventaire->id;

        $names = $varQuantities = $newquantities = [];
        $willfacture = false;
        foreach ($request->stock as $stockId => $arr) {
            error_log("Stock ID: " . $stockId);
            $stock = Stock::find($stockId + 1);
            error_log("Stock ID corr: " . $stock);
            $currQuantity = $stock->quantity;
            error_log("curr quanitty " . $currQuantity);
            $newQuantity = intval($arr['quantity']);
            error_log("new quanitty " . $newQuantity);
            $deltaQuantity = $newQuantity - $currQuantity ;
            if($deltaQuantity<0)
                $willfacture = true;

            if ($deltaQuantity != 0) {
                array_push($names, $stock->name);
                array_push($varQuantities, $deltaQuantity);
                array_push($newquantities, $newQuantity);

                // Update the stock's quantity if needed
                $stock->quantity = $newQuantity;
                $stock->save();
            }
        }

        if (!empty($varQuantities)) {
            $historique->modif_items = $names;
            $historique->modif_quantities = $varQuantities;
            $historique->save();
        }

        // -- UPDATE STOCK TABLE --
        for ($i = 0; $i < count($names); $i++) {
            Stock::where('name', $names[$i])->update(['quantity' => $newquantities[$i]]);
        }

        $id_facture="Waiting";
        $inventaire = Inventaire::findOrFail($historique->id_inventaire);
        if( $inventaire->id_cb_out != null && $willfacture==true){
        $results = $this->createfactureinventaire($historique->id_inventaire, 'inventaire');
            error_log('CReation facture');
            $inventaire->facture_path = $results['id_facture'];
        
        $inventaire->save();
        $emails = ['tom.cheniaux@gmail.com'];
    
        Mail::send('mail.inventaire.facture', ['inventaire' => $inventaire,], function ($m) use ($inventaire, $emails) {
            $m->from('agel.asbl@gmail.com', 'Association Générale des Etudiants Liegeois');
            $m->to($emails)->subject('Une facture suite à l évenement '.$inventaire->event_name.' est disponible ');
        
            // Si facture_path n'est pas null et que le fichier existe, attachez-le.
        
            $m->bcc($emails);
        });
    }

    
        error_log("retour creation");
        return redirect()->route('admin.inventaires.recap', ['id' => $inventaire->id]);
    }
    public function uploadInventory(Request $request)
    {
        $request->validate([
            'signedInventory' => 'required|file|mimes:jpeg,png,pdf,doc,docx', // Ajoutez ou retirez des mimes selon vos besoins
        ]);
    
        $filename = $request->file('signedInventory')->store('signedInventories', 'public');
    
        // Stockez $filename dans la base de données si nécessaire
    
        return back()->with('success', 'Fichier uploadé avec succès!');
    }
    public function uploadInventoryEntrant(Request $request,$id)
    {
        $request->validate([
            'entrantInventory' => 'required|file|mimes:xlsx,xls,jpeg,jpg,png,pdf,heif,hevc',
        ]);
    
        $entrantInventory = $request->file('entrantInventory');
        
        $currentDate = \Carbon\Carbon::now()->toDateString();
        $entrantInventoryName = $currentDate . '-entrant-inventory.' . $entrantInventory->getClientOriginalExtension();
    
        // Enregistrez le fichier avec la date préfixée
        $filename = $entrantInventory->storeAs('entrantInventories', $entrantInventoryName, 'public');
        $inventaire = Inventaire::findOrFail($id); // Ceci renverra une erreur 404 si l'ID n'est pas trouvé
        $inventaire->signed_in_path = $filename;
        $inventaire->save();
        // Stockez $filename dans la base de données si nécessaire
    
        return back()->with('success', 'Inventaire entrant uploadé avec succès!');
    }
    

    public function show($id)
    {
        $document = Document::findOrFail($id);
        return view('admin.inventaires.preview', compact('document'));
    }
    
public function uploadInventorySortant(Request $request,$id)
{
    $request->validate([
        'sortantInventory' => 'required|file|mimes:xlsx,xls,jpeg,jpg,png,pdf,heif,hevc',
    ]);
    $currentDate = \Carbon\Carbon::now()->toDateString();
    $outgoingInventory = $request->file('sortantInventory');
    $outgoingInventoryName = $currentDate . '-outgoing-inventory.' . $outgoingInventory->getClientOriginalExtension();

    $filename = $outgoingInventory->storeAs('sortantInventories', $outgoingInventoryName, 'public');
    $inventaire = Inventaire::findOrFail($id); // Ceci renverra une erreur 404 si l'ID n'est pas trouvé
    $inventaire->signed_out_path = $filename;
    $inventaire->save();

    // Stockez $filename dans la base de données si nécessaire

    return back()->with('success', 'Inventaire sortant uploadé avec succès!');
}
public function uploadPage($id)
{
    $inventaire = Inventaire::findOrFail($id);
    return view('admin.inventaires.upload', ['inventaire' => $inventaire]);
}



    // Returns the view allowing to create a new Inventaire
    public function create() {
        $comites = Comite::all();
        $stocks = Stock::all();
        $responsablesAgel = Listing::where('agel', 1)->get();
        $startDate = now()->subDays(7);
        $endDate = now()->addDays(70);
        
        $events = Event::whereBetween('date', [$startDate, $endDate])->get();
         // ou la manière dont vous récupérez les événements

        return view('admin.inventaires.create', compact('responsablesAgel','comites', 'stocks','events'));
    }

    // Updates an entry already inside the databse
    public function update(Request $request, $id) {
        $rules = [
            'date' => 'required|date',
            'agel_name' => 'required|string',
            'event_name' => 'required|string',
            'photos' => 'array',
            'photos.*' => 'mimes:jpeg,png,jpg|max:2000',
            'facture' => 'mimes:pdf',
        ];
      
        $messages = [
            'date.required' => 'Le champ "DATE DE L\'INVENTAIRE" est obligatoire.',
            'agel_name.required' => 'Le champ "NOM DU RESPONSABLE AGEL" est obligatoire.',
            'photos.*.mimes' => 'La photo doit être un fichier de type: JPEG, PNG, ou JPG.',
            'photos.*.max' => 'La poids de l\'image ne peut pas dépasser 2MB.',
            'facture.mimes' => 'La facture doit être un fichier de type: PDF.',
        ];
    
        $validator = Validator::make($request->all(),$rules, $messages);
    
        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        // -- STORE INVENTAIRE RECORD --
        $inventaire = Inventaire::findOrFail($id);
        $inventaire->date = $request->input('date', $inventaire->date);
        $inventaire->agel_name = $request->input('agel_name', $inventaire->agel_name);
        $inventaire->event_name = $request->input('event_name', $inventaire->event_name);
        $inventaire->id_cb_in = $request->input('id_cb_in', $inventaire->id_cb_in);
        $inventaire->id_cb_out = $request->input('id_cb_out', $inventaire->id_cb_out);
        $inventaire->paid = $request->has('paid');
        $inventaire->agel_valid = $request->has('agel_valid');
        $inventaire->cb_valid = $request->input('cb_valid', $inventaire->cb_valid);
        $inventaire->paid = $request->input('paid', $inventaire->paid);
        $inventaire->save();

        // -- STORE HISTORIQUE RECORD --
        $historique = new Historique();
        $historique->modif_date = date('Y-m-d');

        $historique->id_inventaire = $inventaire->id;

        $names = $varQuantities = $newquantities = [];
        $willfacture = false;
        foreach ($request->stock as $stockId => $arr) {
            error_log("Stock ID: " . $stockId);
            $stock = Stock::find($stockId + 1);
            error_log("Stock ID corr: " . $stock);
            $currQuantity = $stock->quantity;
            error_log("curr quanitty " . $currQuantity);
            $newQuantity = intval($arr['quantity']);
            $deltaQuantity =  $newQuantity - $currQuantity ;
            if($deltaQuantity<0)
                $willfacture = true;
            if ($deltaQuantity != 0) {
                array_push($names, $stock->name);
                array_push($varQuantities, $deltaQuantity);
                array_push($newquantities, $newQuantity);

                // Update the stock's quantity if needed
                $stock->quantity = $newQuantity;
                $stock->save();
            }
        }

        if (!empty($varQuantities)) {
            $historique->modif_items = $names;
            $historique->modif_quantities = $varQuantities;
            $historique->save();
        }

        // -- UPDATE STOCK TABLE --
        for ($i = 0; $i < count($names); $i++) {
            Stock::where('name', $names[$i])->update(['quantity' => $newquantities[$i]]);
        }
            $id_facture = $this->createfactureinventaire($historique->id_inventaire, 'inventaire');
                    $mailcontact = $listing->email;
                    $emails = ['tom.cheniaux@gmail.com'];
                
                    Mail::send('mail.inventaire.facture', ['inventaire' => $inventaire,], function ($m) use ($inventaire, $emails) {
                        $m->from('agel.asbl@gmail.com', 'Association Générale des Etudiants Liegeois');
                        $m->to($emails)->subject('Une facture suite à l évenement '.$inventaire->event_name.' est disponible ');
                        $m->bcc($emails);
                    });
        

        return redirect()->route('admin.inventaires.recap', ['id' => $inventaire->id]);
    }

    public function destroy($id) {
        $inventaire = Inventaire::findOrFail($id);

        if (!empty($inventaire->facture_path))
            File::delete(public_path($inventaire->facture_path));

        foreach ($inventaire->photos as $photo) {
            File::delete(public_path($photo));
        }
            
        $inventaire->delete();
    
        return redirect('/admin/inventaires');
    }

    public function edit($id) {
        $inventaire = Inventaire::where('id', $id)->firstOrFail();
        $comites = Comite::all();    
        $cb = Comite::where('id', $inventaire->id_cb_out)->firstOrFail();        
        $historique = Historique::where('id_inventaire', $id)->get();       
        $stocks = Stock::all();        error_log('2');
        $responsablesAgel = Listing::where('agel', 1)->get();     

        $startDate = now()->subDays(7);  
        $endDate = now()->addDays(7);  
        
        $events = Event::whereBetween('date', [$startDate, $endDate])->get();  
        return view('admin.inventaires.edit', compact('inventaire', 'comites', 'cb', 'historique', 'stocks','responsablesAgel', 'events'));
    }

    public function createfactureinventaire($id_inventaire, $tag) {

        $event_name = Inventaire::where('id', $id_inventaire)->value('event_name');
        $event_date = Inventaire::where('id', $id_inventaire)->value('date');
        $id_cb = Inventaire::where('id', $id_inventaire)->value('id_cb_out');
        if ($id_cb === null) {
            // id_inventaire n'existe pas dans la table, alors terminez ou retournez une réponse appropriée
            return; // retourne directement si c'est dans une fonction
            // ou redirigez, affichez un message, etc., selon ce que vous souhaitez faire en cas d'échec.
        }
        $cb = Comite::where('id', $id_cb)->value('nom');
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
        

        $historiques_id=Historique::where('id_inventaire', $id_inventaire)->get();
        error_log("recup histo id");
        error_log($historiques_id);
        $items_facture = [];

        foreach ($historiques_id as $historique_id) {
            // Transformer les tableaux 'modif_items' et 'modif_quantities' en un seul tableau associatif.
            $items = array_combine($historique_id->modif_items, $historique_id->modif_quantities);
        
            foreach ($items as $item => $quantity) {
                // Si l'item n'a pas encore été rencontré, on initialise sa somme à 0.
                if (!isset($sums[$item])) {
                    $sums[$item] = 0;
                }
        
                // Ajouter la quantité de l'item à sa somme.
                $sums[$item] += $quantity;
                $prix_unitaire = Stock::where('name', $item)->value('price');
                $prix = $prix_unitaire * abs($sums[$item]);
        

        
                // Si l'item n'existe pas encore dans $items_facture, l'ajouter.
// ...

                if (!isset($items_facture[$item])) {

                    // Ajouter les détails à notre tableau en utilisant $item comme clé.
                    if($sums[$item]<0){
                        $items_facture[$item] = [
                            'item' => $item,
                            'quantity' => abs($sums[$item]),
                            'prix_unitaire' => $prix_unitaire,
                            'prix' => $prix,
                        ];
                        //error_log( $items_facture[$item]);
                        }
                }
                else {
                    // Si l'item existe déjà dans $items_facture, mettre à jour sa quantité.
                    $items_facture[$item]['quantity'] = abs($sums[$item]);
                }

// ...

            }
        }
        $factureController = new FactureController();
        $prix_total = $factureController->createfacturexlsv($event_name,$id_facture,$cb,$items_facture);

        $facture = new Facture;
        $facture->destinataire = $cb;
        $date_emission = date('Y-m-d');
        $facture->date_emission = date('Y-m-d', strtotime($date_emission));
        $facture->montant = $prix_total;
        $facture->event_name = $event_name;
        $facture->paid = false;
        $facture->reference = $id_facture;
        $facture->tags= $tag;
        $facture->save();
        
        
        return ['id_facture' => $id_facture, 'items_facture' => $items_facture];

    }
    // * Code template for 'store()'
    // public function create_inventaire(Request $request){
    //   $this->validate($request, [
    //       'date' => 'required',
    //       'agel_name' => 'required',
    //       'id_cb' => 'required',
    //   ]);

    //   // Modification du stock
    //   $modif_items = [];
    //   $modif_quantities = [];
    //   if($request->has('stock')){
    //     $stocks = $request->input('stock');
    //     foreach($stocks as $s){
    //       if($s['quantity'] != 0){
    //         $to_modify = Stock::findOrFail($s['name']); // le name = id dans le form
    //         $to_modify->quantity = $to_modify->quantity - $s['quantity'];
    //         $to_modify->save();
    //         array_push($modif_items, $s['name']);
    //         array_push($modif_quantities, $s['quantity']);
    //       }
    //     }
    //   }
    //   // Ajout de photos pour cet inventaire
    //   if($request->has('photo')){
    //     $photos = $request->input('photo');
    //     // TODO = les upload !
    //   }

    //   if($request->has('valid_agel')){
    //     $valid_agel = true;
    //   }
    //   else{
    //     $valid_agel = false;
    //   }
    //   // Créer l'entrée en DB pour inventaire
    //   $inventaire = Inventaire::create([
    //     'date' => $request['date'],
    //     'agel_name' => $request['agel_name'],
    //     'id_cb' => $request['id_cb'],
    //     'agel_valid' => $valid_agel,
    //     'cb_valid' => false,
    //     'facture_path' => 'TODO',
    //     // photos ??? 
    //   ]);
    //   // Créer l'entrée en DB pour historique

    //   $historique = Historique::create([
    //     'modif_date' => $request['date'],
    //     'id_inventaire' => $inventaire->id,
    //     'modif_items' => $modif_items,
    //     'modif_quantities' => $modif_quantities,
    //   ]);

    //   return redirect('/inventaires')->with('success', 'Inventaire créé.');
    // }
}
