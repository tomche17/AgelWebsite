<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commande;
use App\Fut;
use App\FutCommande;
use App\Materiel;
use App\User;
use App\MaterielCommande;
use App\Comite;
use App\Event;
use Validator, Input, Redirect;
use Mail, Auth;
use Carbon\Carbon;

class CommandeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show_comite()
    {
        $id = Auth::user()->comite_id;
        $commandes = Commande::where('comite_id', $id)->orderBy('id')->get();
        $events = Event::where('comite_id', $id)->orderBy('id')->get();
        
        return view('commande/comite', ['commandes' => $commandes]);
    }

    public function show_waiting()
    {
        $commandes = Commande::where('is_validated', 0)->orderBy('id')->get();
        $comites = Comite::orderBy('id')->get();

        return view('commande/waiting', ['commandes' => $commandes, 'comites' => $comites]);
    }

    public function show_confirmed()
    {
        $commandes = Commande::where('is_validated', 1)->orderBy('id')->get();
        $materiels = Materiel::orderBy('id')->get();
        $comites = Comite::orderBy('id')->get();

        return view('admin/commandes/confirmed', ['commandes' => $commandes, 'materiels' => $materiels, 'comites' => $comites]);
    }

    public function setSend(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);
        $commande->is_send = $request->input('is_send', 0);
        $commande->save();

        return response()->json(['success' => true]);
    }

    public function index()
    {
        $futs = Fut::orderBy('id')->get();
        $materiels = Materiel::orderBy('id')->get();
        $comites = Comite::orderBy('id')->get();

        return view('commande', ['futs' => $futs, 'materiels' => $materiels, 'comites' => $comites]);
    }

    public function store(Request $request)
    {

    $futsList = Fut::orderBy('id')->get();
    $rules = [
      'event_id' => 'required',
      'event_date' => 'required',
      'comite' => 'required',
      'frequentation' => 'required|numeric',
      'adresselegale' => 'required',
      'adressefacturation' => 'required',
      'adresselivraison' => 'required',
      'prenom' => 'required',
      'nom' => 'required',
      'telephone' => 'required',
      'email' => 'required|email',
    ];



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
        // COMMANDE
        $commande = new Commande;
        $commande->event_id = $request->event_id;
        $commande->comite_id = $request->comite;
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
          // Vérifie si le nombre est nul ou zéro
          if ($request->{'fut'.$i} != null && $request->{'fut'.$i} != 0) {
              ${'futs'.$i} = new FutCommande;
              ${'futs'.$i}->commande_id = $commande->id;
              ${'futs'.$i}->futs_id = $i;
              ${'futs'.$i}->nombre = $request->{'fut'.$i};
              ${'futs'.$i}->save();
          }
      }

      //ENVOIE MAIL COMMANDITAIRE
      $mailcontact = $commande->email;
      $emails = [$mailcontact];
      Mail::send('mail.commande.create', ['commande' => $commande], function ($m) use ($commande, $emails) {
          $m->from('agel.asbl@gmail.com', 'Association Générale des Etudiants Liegeois');
          $m->to($emails)->subject('La commande N°' . $commande->id . ' vient d être crée !');
      });

      //ENVOIE MAIL SECRETAIRE INTERNE
      Mail::send('mail.commande.waiting', ['commande' => $commande], function ($m) use ($commande, $emails) {
          $m->from('agel.asbl@gmail.com', 'Association Générale des Etudiants Liegeois');
          $m->to($emails)->subject('La commande N°' . $commande->id . ' vient d être créé, elle est en attente !');
      });

      return redirect('/commande/show/' . $commande->id)->with('status', 'Données enregistrées, merci !');
}
}

public function update(Request $request, $id)
{
    $futsList = Fut::orderBy('id')->get();
    $rules = [
      'event_name' => 'required',
      'event_date' => 'required',
      'frequentation' => 'required|numeric',
      'adresselegale' => 'required',
      'adressefacturation' => 'required',
      'adresselivraison' => 'required',
      'prenom' => 'required',
      'nom' => 'required',
      'telephone' => 'required',
      'email' => 'required|email',
    ];



    $messages = [
      'required' => 'Le champ " :attribute" ne peut pas être vide.',
      'email' => 'L’adresse email doit être au format exemple@test.com.',
      'numeric' => 'Le champ " :attribute" attend un nombre.'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
    // Mise à jour de la COMMANDE
    $commande = Commande::where('event_id', $event->id)->first();
    if (!$commande) {
        return back()->withError('Commande introuvable pour cet événement.');
    }
    $commande->comite_id = $request->input('id_cb', $commande->comite_id);
    $commande->frequentation = $request->input('frequentation', $commande->frequentation);
    $commande->nom = $request->input('nom', $commande->nom);
    $commande->event_id = $request->input('event_id', $commande->event_id);
    $commande->prenom = $request->input('prenom', $commande->prenom);
    $commande->telephone = $request->input('telephone', $commande->telephone);
    $commande->email = $request->input('email', $commande->email);
    $commande->adresselegale = $request->input('adresselegale', $commande->adresselegale);
    $commande->adressefacturation = $request->input('adressefacturation', $commande->adressefacturation);
    $commande->adresselivraison = $request->input('adresselivraison', $commande->adresselivraison);
    $commande->prixtotal = $request->input('commandetotal', $commande->prixtotal);
    $commande->is_validated = $request->input('is_validated', $commande->is_validated);  // Ici, vous pourriez avoir besoin de vérifier s'il y a un champ de validation dans votre formulaire
    $commande->save();
    


    // Mise à jour des fûts
    for($i = 1; $i <= count($futsList); $i++) {
      $futInputName = 'fut' . $i;
  
      if (isset($request->{$futInputName}) && $request->{$futInputName} != 0) {
          $futCommande = FutCommande::where('commande_id', $commande->id)->where('futs_id', $i)->first();
  
          if (!$futCommande) {
              // Si l'enregistrement n'existe pas, créez-en un nouveau
              $futCommande = new FutCommande;
              $futCommande->commande_id = $commande->id;
              $futCommande->futs_id = $i;
          }
  
          $futCommande->nombre = $request->{$futInputName};
          $futCommande->save();
      }
  }
  

    // Ici, vous pouvez également mettre à jour les "materiels" comme pour les "futs" si nécessaire.

    return redirect('/commande/show/' . $commande->id)->with('status', 'Données mises à jour avec succès!');
}

public function create()
{
    $comites = Comite::all();
    $futs = Fut::all();
    $startDate = now()->subDays(30);
    $endDate = now()->addDays(60);
    $user_comite_id = Auth::user()->comite_id;
    if (Auth::user()->droit == 1) {
        $events = Event::whereBetween('date', [$startDate, $endDate])->get();
    } else {
        $events = Event::where('comite_id', $user_comite_id)->whereBetween('date', [$startDate, $endDate])->get();
    }

    return view('commande.create', compact('comites', 'futs', 'events','user_comite_id'));
}

  public function show($id)
	{
    $commande = Commande::findOrFail($id);
    $event = Event::findOrFail($commande->event_id);
    $date = new Carbon($event->date);
    $event->date = $date->format('l j F Y');

		return view('commande.show',['commande' => $commande, 'event' => $event]);
	}

  function my_commandes($id){

    if(Auth::user()->id != $id){
      return redirect('/home')->with('error', 'Vous n\'avez pas accès à cette page.');
    }
    $commandes = Commande::orderBy("id", 'desc')->get();
    foreach($commandes as $commande){
      $date = new Carbon($commande->event->date);
      $commande->event->date = $date->format('l j F Y');
    }

    return view("user.commandes",["commandes" => $commandes]);
  }

  public function accept($id){
    $commande = Commande::find($id);
    $commande->is_validated = 1;
    $commande->save();
    $date = new Carbon($commande->event->date);
    $commande->event->date = $date->format('l j F Y');
    $emails = [$commande->email];

        // MAIL POUR INFORMER QU ON A ACCEPTé
    Mail::send('mail.commande.accept', ['commande' => $commande,],function ($m) use ($commande, $emails) {
          $m->from('agel.asbl@gmail.com', 'Association Générale des Etudiants Liegeois');
          $m->to($emails)->subject('Votre commande N°'.$commande->id.' a été validée !');
      });

    return redirect('/admin/commandes/waiting')->with('status', "La commande a bien été validée");
  }

  public function decline($id){
    $commande = Commande::find($id);
    $emails = [$commande->email];

    // MAIL POUR INFORMER QU ON A REFUSE
    Mail::send('mail.commande.decline', ['commande' => $commande,],function ($m) use ($commande, $emails) {
          $m->from('agel.asbl@gmail.com', 'Association Générale des Etudiants Liegeois');
          $m->to($commande->email)->subject('Votre commande N°'.$commande->id.' a été refusée.');
          $m->bcc($emails);
      });
      $this->destroy($id) ;
    return redirect('/admin/commandes/waiting')->with('status', "La commande a bien été refusée");
  }

  public function commandForEvent(Request $request){
    return redirect('/commande/event/'.$request->event);
  }
  public function destroy($id) {
    $commande = Commande::find($id);
    $CommandeToDelete = FutCommande::where('commande_id',$id);
    $CommandeToDelete->delete();
    $CommandeToDelete = MaterielCommande::where('commande_id',$id);
    $CommandeToDelete->delete();
    $commande->delete();
    if(Auth::user()->droit == 1 ){
      return redirect('/admin/commandes/waiting')->with('status', "La commande a bien été supprimée");}
    else{
      return redirect('/commandes')->with('status', "La commande a bien été supprimée");}
  }

  public function edit($id){
    $commande = Commande::find($id);
    $event = Event::find($commande->event_id);
    $comites = Comite::all();
    $futs = Fut::all();
    $futCommandes = FutCommande::where('commande_id', $commande->id)->get();
    $cb = Comite::find($commande->comite_id);
    return view("admin.commandes.edit",compact('commande','futCommandes','event','cb','comites','futs'));
  }
}
