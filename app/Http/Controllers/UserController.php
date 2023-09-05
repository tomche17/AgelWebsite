<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Comite;
use Validator;
use Illuminate\Support\Str;
use Mail;

class UserController extends Controller
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

    function add(){
        $comites = Comite::all();
        return view("admin.users.add",["comites" => $comites]);
    }
    
    function create(Request $request){
        $rules = [
          'name' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
          'surname' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
          'email' => 'required|unique:users,email|email',
          'phone' => 'required',
          'comite_id' => 'required',
        ];
    
        $messages = [
          'required' => 'Le champ ":attribute" ne peut pas être vide.',
          'email' => 'L’adresse email doit être au format exemple@test.com.',
          'email.unique' => 'Cette adresse email est déja utilisée',
          'alpha' => 'Le champ ":attribute" ne peut être composé que de lettres',
        ];
    
        $validator = Validator::make($request->all(),$rules, $messages);
    
        if ($validator->fails())
          {
            return redirect()->back()->withErrors($validator)->withInput();
    
          }else{
    
            $password = Str::random(10);
            $user = new User;
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = bcrypt($password);
            $user->comite_id = $request->comite_id;
            
            if($request->has('is_admin')){
                $user->droit = 1;error_log('est admin');
            }
            else{
                $user->droit = 2;error_log('est admin');
            }
            $user->save();
    
            $emails = [];
            array_push($emails, $user->email);
    
            Mail::send('mail.usercreate', ['user' => $user, 'password' => $password],function ($m) use ($user,$password, $emails) {
                  $m->from('agel.asbl@gmail.com', 'Association Générale des Etudiants Liegeois');
                  $m->to($emails)->subject('Création d’un compte sur le site Agel !');
              });
    
            return redirect('/admin/users')->with('status', 'L’utilisateur a bien été créé');
          }
    }
    
    function edit($id){
        $user = User::find($id);
        $comites = Comite::all();
    
        return view("admin.users.edit",["user" => $user, "comites" => $comites]);
    }
    
    function update(Request $request, $id){
        $user = User::findOrFail($id);
    
        $rules = [
            'name' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'surname' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
            'comite_id' => 'required',
          ];
      
          $messages = [
            'required' => 'Le champ ":attribute" ne peut pas être vide.',
            'email' => 'L’adresse email doit être au format exemple@test.com.',
            'email.unique' => 'Cette adresse email est déja utilisée',
            'alpha' => 'Le champ ":attribute" ne peut être composé que de lettres',
          ];
    
        $validator = Validator::make($request->all(),$rules, $messages);
    
        if ($validator->fails())
          {
            return redirect()->back()->withErrors($validator)->withInput();
    
          }else{
    
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->comite_id = $request->comite_id;
            if($request->has('is_admin')){
                $user->droit = 1;
            }
            else{
                $user->droit = 2;
            }
            $user->save();
    
            return redirect('/admin/users')->with('status', 'L‘utilisateur a bien été modifié.');
          }
    
    }
}
