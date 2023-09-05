<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Validator;

use App\Listing;
use App\Comite;

class UserListingController extends Controller
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

    // Returns the view containing the list of all Inventaires
    public function index() {
        $listings = Listing::get();
        return view('user.listings.index', compact('listings'));
    }

    public function store(Request $request) {
        $rules = [
            'id_cb' => 'required|numeric',
            'surname' => 'required|max:100|regex:/^[a-zA-Zçéèëïüÿâêîôû\s\-]+$/',
            'firstname' => 'required|max:100|regex:/^[a-zA-Zçéèëïüÿâêîôû\s\-]+$/',
            'function' => 'required|array|min:1',
            'phone_number' => 'required|digits:10',
            'email' => 'required|email|unique:users,email',
            'legal_address' => 'required|max:100',
            'image' => 'mimes:jpeg,png,jpg|max:2000'
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

        // -- STORE LISTING RECORD --
        $listing = new Listing();
        $listing->id_cb = request('id_cb');
        $listing->surname = request('surname');
        $listing->firstname = request('firstname');
        $listing->function = array_unique(request('function'));
        $listing->phone_number = request('phone_number');
        $listing->email = request('email');
        $listing->legal_address = request('legal_address');
        $listing->agel = false;

        // Image Processing
        $image = request()->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = public_path('/images/listing/');
        $image->move($imagePath, $imageName);
        $listing->image = '/images/listing/' . $imageName;

        $listing->save();
        
        return redirect('/listing'); 
    }
    public function create() {
        return view('user.listings.create');
    }

    public function show($id) {
        // $listing = Listing::findOrFail($id);
        // return view('user.listings.show', compact('listing'));
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
            'image' => 'mimes:jpeg,png,jpg|max:2000'
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
            'surname.regex' => 'Le champ "NOM" ne peut contenir que les caractères spéciaux suivants: é,è,ë,ï,ü,ÿ,â,ê,î,ô,û',
            'firstname.regex' => 'Le champ "PRÉNOM" ne peut contenir que les caractères spéciaux suivants: é,è,ë,ï,ü,ÿ,â,ê,î,ô,û',
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
        $listing->agel = false;

        // Image Processing
        if(request()->has('image')) {
            // Removes the previous image
            File::delete(public_path($listing->image));

            // Adds the new image
            $image = request()->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = public_path('/images/listing/');
            $image->move($imagePath, $imageName);
            $listing->image = '/images/listing/' . $imageName;
        }

        $listing->save();
        
        return redirect('/listing'); 
    }

    public function destroy($id) {
        $listing = Listing::findOrFail($id);
        $listing->delete();
    
        return redirect('/listing');
    }

    public function edit($id) {
        $listing = Listing::where('id', $id)->firstOrFail();
        $cb = Comite::where('id', $listing->id_cb)->firstOrFail();

        return view('user.listings.edit', compact('listing', 'cb'));
    }
}
