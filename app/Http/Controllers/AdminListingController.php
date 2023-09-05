<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Validator;

use App\Listing;
use App\Comite;
use Image;

class AdminListingController extends Controller
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
        $listings = Listing::get();
        return view('admin.listings.index', compact('listings'));
    }
    public function store(Request $request) {
        $rules = [
            'id_cb' => 'required|numeric',
            'surname' => 'required|max:100|regex:/^[a-zA-Zçéèëïüÿâêîôû\s\-]+$/',
            'firstname' => 'required|max:100|regex:/^[a-zA-Zçéèëïüÿâêîôû\s\-]+$/',
            'function' => 'required|array|min:1',
            'phone_number' => 'required|digits:10',
            'email' => 'required|email|unique:listings,email',
            'legal_address' => 'required|max:100',
            'image' => 'required|mimes:jpeg,png,jpg|max:2000'
        ];
      
        $messages = [
            'surname.required' => 'Le champ "NOM" est obligatoire.',
            'firstname.required' => 'Le champ "PRÉNOM" est obligatoire.',
            'function.required' => 'Le champ "FONCTION" est obligatoire.',
            'phone_number.required' => 'Le champ "TÉLÉPHONE" est obligatoire.',
            'legal_address.required' => 'Le champ "ADRESSE LÉGALE" est obligatoire.',
            'surname.max' => 'Le champ "NOM" ne peut contenir plus de 100 caractères.',
            'firstname.max' => 'Le champ "PRÉNOM" ne peut contenir plus de 100 caractères.',
            'legal_address.max' => 'Le champ "ADRESSE LÉGALE" ne peut contenir plus de 100 caractères.',
            'function.min' => 'Le champ "FONCTION" doit contenir au moins une valeur.', // Should not be triggered
            'phone_number.digits' => 'Le champ "TÉLÉPHONE" doit contenir exactement dix chiffres.',
            'email' => 'L’adresse email doit être de la forme exemple@test.com.',
            'email.unique' => 'Cette adresse email est déja utilisée par un utilisateur.',
            'image.mimes' => 'La photo doit être un fichier de type: JPEG, PNG, ou JPG.',
            'image.max' => 'La poids de l\'image ne peut pas dépasser 2MB.',
        ];
    
        $validator = Validator::make($request->all(),$rules, $messages);
    
        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        // -- STORE INVENTAIRE RECORD --
        $listing = new Listing();
        $listing->id_cb = request('id_cb');
        $listing->surname = ucfirst(mb_strtolower(request('surname'))); 
        $listing->firstname = ucfirst(mb_strtolower(request('firstname')));       
        $listing->function = array_unique(request('function'));
        $listing->phone_number = request('phone_number');
        $listing->email = request('email');
        $listing->legal_address = request('legal_address');
        $listing->agel = $request->has('agel');
        error_log('------------Go image-------------');
        // Image Processing
        $imageFile = request()->file('image');

        // Création du nom de l'image avec le format "Nom_Prenom_IDcb"
        $imageName = $listing->surname . '_' . $listing->firstname . '_' . $listing->id_cb . '.' . $imageFile->getClientOriginalExtension();
        
        $imagePath = public_path('/images/listing/');
        $fullPath = $imagePath . $imageName;
        
        // Création de l'image avec Intervention Image
        $image = Image::make($imageFile);
        
        // Recadrer l'image en carré
        $image->fit(500, 500);
        
        // Enregistrer l'image
        $image->save($fullPath);
        
        $listing->image = '/images/listing/' . $imageName;
        $listing->save();

        return redirect('/admin/listing'); 
    } 

    public function create() {
        $comites = Comite::all();
        return view('admin.listings.create', compact('comites'));
    }

    public function show($id) {
        $listing = Listing::findOrFail($id);
        return view('admin.listings.show', compact('listing'));
    }

    public function update(Request $request, $id) {
        $rules = [
            'id_cb' => 'required|numeric',
            'surname' => 'required|max:100|regex:/^[a-zA-Zçéèëïüÿâêîôû\s\-]+$/',
            'firstname' => 'required|max:100|regex:/^[a-zA-Zçéèëïüÿâêîôû\s\-]+$/',
            'function' => 'required|array|min:1',
            'phone_number' => 'required|digits:10',
            'email' => 'required|email|unique:users,email',
            'legal_address' => 'required|max:100',
            'image' => 'required|mimes:jpeg,png,jpg|max:2000'
        ];
      
        $messages = [
            'surname.required' => 'Le champ "NOM" est obligatoire.',
            'firstname.required' => 'Le champ "PRÉNOM" est obligatoire.',
            'function.required' => 'Le champ "FONCTION" est obligatoire.',
            'phone_number.required' => 'Le champ "TÉLÉPHONE" est obligatoire.',
            'legal_address.required' => 'Le champ "ADRESSE LÉGALE" est obligatoire.',
            'surname.max' => 'Le champ "NOM" ne peut contenir plus de 100 caractères.',
            'firstname.max' => 'Le champ "PRÉNOM" ne peut contenir plus de 100 caractères.',
            'legal_address.max' => 'Le champ "ADRESSE LÉGALE" ne peut contenir plus de 100 caractères.',
            'function.min' => 'Le champ "FONCTION" doit contenir au moins une valeur.', // Should not be triggered
            'phone_number.digits' => 'Le champ "TÉLÉPHONE" doit contenir exactement dix chiffres.',
            'email' => 'L’adresse email doit être de la forme exemple@test.com.',
            'email.unique' => 'Cette adresse email est déja utilisée par un utilisateur.',
            'image.mimes' => 'La photo doit être un fichier de type: JPEG, PNG, ou JPG.',
            'image.max' => 'La poids de l\'image ne peut pas dépasser 2MB.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);
    
        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        // -- STORE INVENTAIRE RECORD --
        $listing = Listing::findOrFail($id);
        $listing->id_cb = request('id_cb');
        $listing->surname = request('surname');
        $listing->firstname = request('firstname');
        $listing->function = array_unique(request('function'));
        $listing->phone_number = request('phone_number');
        $listing->email = request('email');
        $listing->legal_address = request('legal_address');
        $listing->agel = $request->has('agel');
        if($request->has('image')){
            $imageFile = request()->file('image');

            // Création du nom de l'image avec le format "Nom_Prenom_IDcb"
            $imageName = $listing->surname . '_' . $listing->firstname . '_' . $listing->id_cb . '.' . $imageFile->getClientOriginalExtension();
            
            $imagePath = public_path('/images/listing/');
            $fullPath = $imagePath . $imageName;
            
            // Création de l'image avec Intervention Image
            $image = Image::make($imageFile);
            
            // Recadrer l'image en carré
            $image->fit(500, 500);
            
            // Enregistrer l'image
            $image->save($fullPath);
            
            $listing->image = '/images/listing/' . $imageName;}
        $listing->save();
        // Image Processing
        
        return redirect('/admin/listing'); 
    }

    public function destroy($id) {
        $listing = Listing::findOrFail($id);
        $listing->delete();
    
        return redirect('/admin/listing');
    }

    public function edit($id) {
        $listing = Listing::where('id', $id)->firstOrFail();
        $comites = Comite::all();
        $cb = Comite::where('id', $listing->id_cb)->firstOrFail();
        return view('admin.listings.edit', compact('listing', 'comites', 'cb'));
    }
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


    public function createcsvdetails() {
        $listings = Listing::orderBy('id_cb', 'asc')->get();
    
        // Créer le contenu CSV
        $csvContent = "Comite,Nom,Prénom,Fonction,Gsm,Mail,Adresse légame,Mambre Agel?\n"; // Entêtes du CSV
        foreach ($listings as $listing) {
            $csvContent .= "{$listing->comite->nom},{$listing->surname},{$listing->firstname}," . implode(", ",$listing->function) . ",{$listing->phone_number},{$listing->email},{$listing->legal_address},{$listing->agel}\n";
        }
    
        // Créer une réponse avec les en-têtes appropriés
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="Listing_Details_Agel.csv"',
        ];
    
        return Response::make($csvContent, 200, $headers);
    }
    
}
