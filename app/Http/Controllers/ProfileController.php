<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;

use App\User;

class ProfileController extends Controller
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

    public function update(Request $request, $id) {        
        $user = User::findOrFail($id);
    
        $rules = [
            'name' => 'required|max:100|regex:/^[a-zA-Zçéèëïüÿâêîôû\s\-]+$/',
            'surname' => 'required|max:100|regex:/^[a-zA-Zçéèëïüÿâêîôû\s\-]+$/',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
            'phone' => 'required|digits:10',
          ];
      
          $messages = [
            'name.required' => 'Le champ "PRÉNOM" est obligatoire.',
            'surname.required' => 'Le champ "NOM" est obligatoire.',
            'email.required' => 'Le champ "EMAIL" est obligatoire.',
            'phone.required' => 'Le champ "TÉLÉPHONE" est obligatoire.',
            'name.max' => 'Le champ "PRÉNOM" ne peut contenir plus de 100 caractères.',
            'surname.max' => 'Le champ "NOM" ne peut contenir plus de 100 caractères.',
            'name.regex' => 'Le champ "PRÉNOM" ne peut contenir que les caractères spéciaux suivants: é,è,ë,ï,ü,ÿ,â,ê,î,ô,û',
            'surname.regex' => 'Le champ "NOM" ne peut contenir que les caractères spéciaux suivants: é,è,ë,ï,ü,ÿ,â,ê,î,ô,û',
            'email' => 'L’adresse email doit être de la forme exemple@test.com.',
            'email.unique' => 'Cette adresse email est déja utilisée par un utilisateur.',
            'phone.digits' => 'Le champ "TÉLÉPHONE" doit contenir exactement dix chiffres.',
        ];
    
        $validator = Validator::make($request->all(),$rules, $messages);
    
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
    
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('profile.edit', ['id' => $user->id])->with('status', 'Le profil a bien été modifié.');    
    }

    public function edit($id){
        $user = User::findOrFail(Auth::user()->id);
        return view('user.profile.edit', compact('user'));
    }
}
