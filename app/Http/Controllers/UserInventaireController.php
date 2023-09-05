<?php

namespace App\Http\Controllers;
use \PDF;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\AdminInventaireController;

use setasign\Fpdi\Fpdi;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Validator;

use App\Inventaire;
use App\Comite;
use App\Listing;
use App\Stock;
use App\Event;
use App\Historique;
use App\Facture;
use App\User;
use Auth;

class UserInventaireController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index() {   
        $inventaires = Inventaire::where('id_cb', Auth::user()->comite_id)->orderBy('date')->get();
        return view('/user/inventaires/index', compact('inventaires'));
    }

    public function update(Request $request, $id) {

        $rules = [
            'date' => 'required|date',
            'agel_name' => 'required|string',
            'id_cb' => 'required|numeric',
            'event_name' => 'required|string',
            'photos' => 'array',
            'photos.*' => 'mimes:jpeg,png,jpg|max:2000',
            'facture' => 'mimes:pdf',
        ];
      
        $messages = [
            'date.required' => 'Le champ "DATE DE L\'INVENTAIRE" est obligatoire.',
            'agel_name.required' => 'Le champ "NOM DU RESPONSABLE AGEL" est obligatoire.',
            'id_cb.required' => 'Le champ "NOM DU COMITÉ" est obligatoire.',
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
        $inventaire->id_cb = $request->input('id_cb', $inventaire->id_cb);
        $inventaire->paid = $request->has('paid');
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
        if($inventaire->agel_valid == 1 && $inventaire->agel_valid == 1){
            $adminInventaireController = new AdminInventaireController();
            $id_facture = $adminInventaireController->createfactureinventaire($historique->id_inventaire, 'inventaire');
            $listing = Listing::where('function', 'LIKE', '%"Président"%')
            ->where('id_cb', $inventaire->id_cb)
            ->first();
            error_log('creation facture');
                // Vérifier si le président a une adresse email
                if ($listing && !empty($listing->email)) {
                    $mailcontact = $listing->email;
                    $emails = [];
                    array_push($emails, $mailcontact);
                
                    Mail::send('mail.inventaire.facture', ['inventaire' => $inventaire,], function ($m) use ($inventaire, $emails) {
                        $m->from('agel.asbl@gmail.com', 'Association Générale des Etudiants Liegeois');
                        $m->to($emails)->subject('Une facture suite à votre évenement '.$inventaire->event_name.' est disponible ');
                        $m->bcc($emails);
                    });
                }
        
            }
        else
            $id_facture="Waiting";
        $inventaire = Inventaire::findOrFail($historique->id_inventaire);
        $inventaire->facture_path=$id_facture;
        $inventaire->save();
        return redirect('/inventaires');
    }    
    public function edit($id) {
        $inventaire = Inventaire::where('id', $id)->firstOrFail();
        $comites = Comite::all();    
        $cb = Comite::where('id', $inventaire->id_cb)->firstOrFail();        
        $historique = Historique::where('id_inventaire', $id)->get();       
        $stocks = Stock::all();        error_log('2');
        $responsablesAgel = Listing::where('agel', 1)->get();     

        $startDate = now()->subDays(7);  
        $endDate = now()->addDays(7);  
        
        $events = Event::whereBetween('date', [$startDate, $endDate])->get();  
        return view('user.inventaires.edit', compact('inventaire', 'comites', 'cb', 'historique', 'stocks','responsablesAgel', 'events'));
    }
}
