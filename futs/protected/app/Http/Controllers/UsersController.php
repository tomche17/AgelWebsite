<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator, Input, Redirect;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use App\Comite;
use Mail;

class UsersController extends Controller
{

  function doLogin(Request $request){
    $rules = [
      'email' => 'required|exists:users,email|email',
      'password' => 'required',
    ];

    $messages = [
      'required' => 'Le champ " :attribute" ne peut pas être vide.',
      'email' => 'L’adresse email doit être au format exemple@test.com.',
      'exists' => 'Cette adresse email ne se trouve pas dans notre base de données',

    ];

    $validator = Validator::make($request->all(),$rules, $messages);


    if ($validator->fails())
      {
        return redirect('/login')->withErrors($validator)->withInput();

      }else{

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            return redirect('/');
        }else{
          $errors = ["Mauvais mot de passe!"];
          return redirect('/login')->withErrors($errors)->withInput();
        }
      }
  }

  function logout(){
    Auth::logout();
    return redirect('/');
  }

  function add(){
    $comites = Comite::all();
    return view("admin.users.add",["comites" => $comites]);
  }

  function create(Request $request){
    $rules = [
      'nom' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
      'prenom' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
      'email' => 'required|unique:users,email|email',
      'isresponsable' => 'required',
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

        $password = str_random(8);
        $user = new User;
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->password = bcrypt($password);
        $user->comite_id = $request->comite;
        $user->is_responsable = $request->isresponsable;
        $user->is_admin = 0;
        $user->save();

        $emails = [];
        array_push($emails, $user->email);

        Mail::send('mail.user', ['user' => $user, 'password' => $password],function ($m) use ($user,$password, $emails) {
              $m->from('utilisateurs@agel-liege.be', 'Association Générale des Etudiants Liegeois');
              $m->to($emails)->subject('Création d’un compte pour fûts AGEL !');
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
    $user = User::find($id);

    $rules = [
      'nom' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
      'prenom' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
      'email' => 'required|email',
      'isresponsable' => 'required',
      'comite' => 'required',
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

        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->comite_id = $request->comite;
        $user->is_responsable = $request->isresponsable;
        $user->save();

        return redirect('/admin/users')->with('status', 'L‘utilisateur a bien été modifié.');
      }

  }

}
