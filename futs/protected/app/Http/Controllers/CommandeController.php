<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commande;
use App\Fut;
use App\FutCommande;
use App\Materiel;
use App\User;
use App\MaterielCommande;
use Validator, Input, Redirect;
use Mail;
use Jenssegers\Date\Date;

class CommandeController extends Controller
{
  public function doCommande(Request $request){

    $futsList = Fut::orderBy('id')->get();
    $materielsList = Materiel::orderBy('id')->get();
    $rules1 = [
      'frequentation' => 'required|numeric',
      'adresselegale' => 'required',
      'adressefacturation' => 'required',
      'adresselivraison' => 'required',
      'prenom' => 'required',
      'nom' => 'required',
      'telephone' => 'required|numeric',
      'email' => 'required|email',
    ];

    $keys=[];

    for($i = 1; $i <= count($futsList); $i++){
      array_push($keys, 'fut'.$i );
    }

    $newKeys = array_fill_keys($keys, 'required');
    $rules2 = array_merge($rules1, $newKeys);

    for($i = 1; $i <= count($materielsList); $i++){
      array_push($keys, 'materiel'.$i );
    }

    $newKeys = array_fill_keys($keys, 'required');
    $rules = array_merge($rules2, $newKeys);


    $messages = [
      'required' => 'Le champ " :attribute" ne peut pas être vide.',
      'email' => 'L’adresse email doit être au format exemple@test.com.',
      'numeric' => 'Le champ " :attribute" attend un nombre.'
    ];


    $validator = Validator::make($request->all(),$rules, $messages);

    if ($validator->fails())
    {
        return back()->withErrors($validator)->withInput();

    }else{

      $commande = new Commande;
      $commande->event_id = $request->event;
      $commande->frequentation = $request->frequentation;
      $commande->nom = $request->nom;
      $commande->prenom = $request->prenom;
      $commande->telephone = $request->telephone;
      $commande->email = $request->email;
      $commande->adresselegale = $request->adresselegale;
      $commande->adressefacturation = $request->adressefacturation;
      $commande->adresselivraison = $request->adresselivraison;
      $commande->prixtotal = $request->commandetotal;
      $commande->is_validated = 0;
      $commande->save();

      for($i = 1; $i <= count($futsList); $i++){
        ${'futs'.$i} = new FutCommande;
        ${'futs'.$i}->commande_id = $commande->id;
        ${'futs'.$i}->futs_id = $i;
        ${'futs'.$i}->nombre = $request->{'fut'.$i};
        ${'futs'.$i}->save();
      }

      for($i = 1; $i <= count($materielsList); $i++){
        ${'materiels'.$i} = new MaterielCommande;
        ${'materiels'.$i}->commande_id = $commande->id;
        ${'materiels'.$i}->materiel_id = $i;
        ${'materiels'.$i}->nombre = $request->{'materiel'.$i};
        ${'materiels'.$i}->save();
      }


      Date::setLocale('fr');
      $date = new Date($commande->event->date);
      $commande->event->date = $date->format('l j F Y');

      foreach($commande->event->inventaires as $inventaire){
        $date = new Date($inventaire->date);
        $inventaire->date = $date->format('l j F Y');
      }


      return redirect('/commande/'.$commande->id)->with('status', 'Données enregistrées, merci !');
    }
  }

  public function show($id)
	{
    $commande = Commande::where('id',$id)->first();
    Date::setLocale('fr');
    $date = new Date($commande->event->date);
    $commande->event->date = $date->format('l j F Y');

    foreach($commande->event->inventaires as $inventaire){

      $date = new Date($inventaire->date);
      $inventaire->date = $date->format('l j F Y');
    }

		return view('commande.show',['commande' => $commande]);
	}

  public function accept($id){
    $commande = Commande::find($id);
    $commande->is_validated = 1;
    $commande->save();
    Date::setLocale('fr');
    $date = new Date($commande->event->date);
    $commande->event->date = $date->format('l j F Y');
    $emails = ["secretariat@makart.be", "cbeaujot@makart.be"];

    $usersToMail = User::where("emails",1)->get();
    foreach($usersToMail as $user){
      array_push($emails, $user->email);
    }

    Mail::send('mail.commande', ['commande' => $commande,],function ($m) use ($commande, $emails) {
          $m->from('commandes@agel-liege.be', 'Association Générale des Etudiants Liegeois');
          $m->to($commande->email)->subject('Votre commande N°'.$commande->id.' a été validée !');
          $m->bcc($emails);
      });

    return redirect('/admin/commandes')->with('status', "La commande a bien été validée");
  }

  public function decline($id){
    $commande = Commande::find($id);
    $commande->is_validated = 0;
    $commande->delete();

    $emails = [];
    $usersToMail = User::where("emails",1)->get();
    foreach($usersToMail as $user){
      array_push($emails, $user->email);
    }

    Mail::send('mail.decline', ['commande' => $commande,],function ($m) use ($commande, $emails) {
          $m->from('commandes@agel-liege.be', 'Association Générale des Etudiants Liegeois');
          $m->to($commande->email)->subject('Votre commande N°'.$commande->id.' a été refusée.');
          $m->bcc($emails);
      });

    return redirect('/admin/commandes')->with('status', "La commande a bien été refusée");
  }

  public function commandForEvent(Request $request){
    return redirect('/commande/event/'.$request->event);
  }

  public function delete($id){
    $commande = Commande::find($id);
    $CommandeToDelete = FutCommande::where('commande_id',$id);
    $CommandeToDelete->delete();
    $CommandeToDelete = MaterielCommande::where('commande_id',$id);
    $CommandeToDelete->delete();
    $commande->delete();

    return redirect('/admin/commandes')->with('status', "La commande a bien été supprimée");
  }

  public function edit($id){
    $commande = Commande::find($id);

    return view("admin.commande.edit",["commande"=>$commande]);
  }
}
