<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Input, Redirect;
use App\Event;
use App\Inventaire;
use App\Listing;
use App\Comite;
use Carbon\Carbon;
use Auth, Mail;

class EventsController extends Controller
{
    function create(Request $request){
      $rules = [
        'nom' => 'required|string|max:255',
        'date' => 'required|date',
        'salle' => 'required|in:0,1,2',
      ];

      $messages = [
        'required' => 'Le champ " :attribute" ne peut pas être vide.',
        'alpha_num' => 'Le pseudo ne peut être composé que de chiffres et lettres',
      ];

      $validator = Validator::make($request->all(),$rules, $messages);

      if ($validator->fails())
        {
          return redirect()->back()->withErrors($validator)->withInput();

        }else{

          if($request->public){
              Carbon::setLocale('fr');
              $event = new Event;
              $event->nom = $request->nom;
              $event->date = $request->date;

              if(Auth::check()){
                $event->comite_id = Auth::User()->comite_id;
              }
              $event->save();

              return redirect('/commande/event/'.$event->id);
            }
            else{
            Carbon::setLocale('fr');
            $event = new Event;
            $event->nom = $request->nom;
            $event->date = $request->date;
            if (Auth::User()->droit == 2) {
              $event->comite_id = Auth::User()->comite_id;
          } else {
              $event->comite_id = $request->comite;
          }
          

            $event->is_validated = false;
            $event->salle = $request->salle;

            $event->save();
            $listing = Listing::where('function', 'LIKE', '%"Président"%')
            ->where('id_cb', $event->comite_id)
            ->first();
        
            // Vérifier si le président a une adresse email
            if ($listing && !empty($listing->email)) {
                $mailcontact = $listing->email;
                $emails = [];
                array_push($emails, $mailcontact);
        
                // Afficher le contenu du tableau $emails pour le débogage
                error_log(print_r($emails, true));
        
                Mail::send('mail.event.create', ['event' => $event,], function ($m) use ($event, $emails) {
                    $m->from('agel.asbl@gmail.com', 'Association Générale des Etudiants Liegeois');
                    $m->to($emails)->subject('Votre évent N°'.$event->id.' a été créé.');
                });
            }
            if (Auth::User()->droit == 1)
              return redirect('/admin/events/waiting')->with('status', "l'évènement à bien été créé");
            else 
              return redirect('/events')->with('status', "l'évènement à bien été créé");
          }

        }
    }
    public function show_waiting()
    {
      $events = Event::where('is_validated', 0)->orderBy('date')->get();

     
      $comites = Comite::orderBy('id')->get();
      return view('event/waiting',['events' => $events]);
    }
    public function index()
    {
      error_log('dans event');
      if (Auth::User()->droit == 2) {
        $events=Event::where('comite_id', Auth::User()->comite_id)->orderBy('date')->get();
    } else {
      $events = Event::where('is_validated', 1)->orderBy('date')->get();
    }
    foreach($events as $event){
      $date = new Carbon($event->date);
      $event->date = $date->format('l j F Y');
    }
      return view('event/show',['events' => $events]);
    }
    function add(){
      $comites = Comite::all();
      return view('event.create', compact('comites'));
    }

    function delete($id){
      $event = Event::find($id);
      $event->commandes()->delete();
      $event->delete();

      return redirect('/admin/events')->with('status', "l'évènement a bien été supprimé");
    }

    public function edit($id){
      $event = Event::find($id);
      $comites = Comite::all();
      $cb = Comite::where('id', $event->comite_id)->firstOrFail();
      /*Carbon::setLocale('fr');
      $date = Carbon::parse($event->date);
      
      $event->day = $date->isoFormat('dddd');  // Jour de la semaine
      
      if(strpos($event->date, ' ') !== false) {
          $event->hour = $date->format('H:i');
          $event->humanDate = $date->isoFormat('l j F Y H:i');
      } else {
          $event->hour = null;
          $event->humanDate = $date->isoFormat('l j F Y');
      }*/

      return view("event.edit",compact('event','comites','cb'));
      }
      public function update(Request $request, $id){
        $event = Event::find($id);
    
        $rules = [
            'nom' => 'required',
            'date' => 'required|date',
            'comite' => 'nullable|exists:comites,id', // Assurez-vous que "comite" est dans la table "comites"
            'salle' => 'required|in:0,1,2',
        ];
    
        $messages = [
            'required' => 'Le champ " :attribute" ne peut pas être vide.',
            'alpha_num' => 'Le pseudo ne peut être composé que de chiffres et lettres',
            'exists' => 'Le comité sélectionné n\'est pas valide.',
            'in' => 'Le type de salle sélectionné n\'est pas valide.'
        ];
    
        $validator = Validator::make($request->all(),$rules, $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            Carbon::setLocale('fr');
            $event->nom = $request->nom;
            $event->date = $request->date;
            
            if(Auth::user()->droit == 1 && $request->has('comite')) {
                $event->comite_id = $request->comite; // Assurez-vous que votre modèle "Event" a une colonne "comite_id"
            }
    
            $event->salle = $request->salle;
    
            $event->save();
    
            return redirect('/events')->with('status', "l'évènement à bien été modifié");
        }
    }
    
    public function accept($id){
    // Trouver l'événement par son ID
    $event = Event::find($id);
    
    // Marquer l'événement comme validé
    $event->is_validated = 1;
    $event->save();
    
    $date = new Carbon($event->date);
    $event->date = $date->format('l j F Y');
    //$this->addToGoogleCalendar($event);

    $listing = Listing::where('function', 'LIKE', '%"Président"%')
    ->where('id_cb', $event->comite_id)
    ->first();

    // Vérifier si le président a une adresse email
    if ($listing && !empty($listing->email)) {
        $mailcontact = $listing->email;
        $emails = [];
        array_push($emails, $mailcontact);

        // Afficher le contenu du tableau $emails pour le débogage
        error_log(print_r($emails, true));

        Mail::send('mail.event.accept', ['event' => $event,], function ($m) use ($event, $emails) {
            $m->from('agel.asbl@gmail.com', 'Association Générale des Etudiants Liegeois');
            $m->to($emails)->subject('Votre évent N°'.$event->id.' a été accepté.');
        });
    }


    return redirect('/admin/events/waiting')->with('status', "L'événement a bien été validé");
}

  private function addToGoogleCalendar($event) {
    $client = new \Google_Client();
    $client->setAuthConfig(storage_path('app/credentials.json'));
    $client->addScope(\Google_Service_Calendar::CALENDAR);
    
    // Si nous n'avons pas de token d'accès, redirigez vers la route d'authentification OAuth
    if (!file_exists('path_to_your/token.json')) {
        // Redirigez vers la route où vous gérez l'authentification OAuth
        return redirect('google-authenticate');
    }

    $client->setAuthConfig(base_path(env('GOOGLE_CREDENTIALS_PATH')));


    $service = new \Google_Service_Calendar($client);

    $googleEvent = new \Google_Service_Calendar_Event(array(
        'summary' => $event->nom,
        'start' => array(
            'dateTime' => Carbon::createFromFormat('l j F Y', $event->date)->toRfc3339String(),
            'timeZone' => 'Europe/Brussels',
        ),
        'end' => array(
            'dateTime' => Carbon::createFromFormat('l j F Y', $event->date)->addHours(2)->toRfc3339String(), // Fin dans 2h, à ajuster
            'timeZone' => 'Europe/Brussels',
        ),
        'description' => 'Description or notes about the event.',  // À ajuster selon votre besoin
    ));

    $calendarId = 'primary'; // L'ID du calendrier où vous souhaitez ajouter l'événement. "primary" fait référence au calendrier principal de l'utilisateur authentifié.
    $service->events->insert($calendarId, $googleEvent);
  }
  public function redirectToGoogle()
    {
        $client = new \Google_Client();
        $client->setAuthConfig(storage_path('app/credentials.json'));
        $client->addScope(\Google_Service_Calendar::CALENDAR);
        $redirect_uri = route('google.callback'); // URI de rappel après l'authentification
        $client->setRedirectUri($redirect_uri);

        return redirect($client->createAuthUrl());
    }
    public function handleGoogleCallback()
    {
        $client = new \Google_Client();
        $client->setAuthConfig(storage_path('app/credentials.json'));
        $client->addScope(\Google_Service_Calendar::CALENDAR);
        $client->fetchAccessTokenWithAuthCode($_GET['code']);
    
        // Enregistrez le token sur le disque pour une utilisation ultérieure
        file_put_contents(storage_path('app/token.json'), json_encode($client->getAccessToken()));
        
        return redirect('/your-desired-route')->with('success', 'Authentification Google réussie');
    }
    
public function decline($id){
    // Trouver l'événement par son ID
    $event = Event::find($id);

    $listing = Listing::where('function', 'LIKE', '%"Président"%')
    ->where('id_cb', $event->comite_id)
    ->first();

    // Vérifier si le président a une adresse email
    if ($listing && !empty($listing->email)) {
        $mailcontact = $listing->email;
        $emails = [];
        array_push($emails, $mailcontact);

        // Afficher le contenu du tableau $emails pour le débogage
        error_log(print_r($emails, true));

        Mail::send('mail.event.decline', ['event' => $event,], function ($m) use ($event, $emails) {
            $m->from('agel.asbl@gmail.com', 'Association Générale des Etudiants Liegeois');
            $m->to($emails)->subject('Votre évent N°'.$event->id.' a été refusé.');
        });
    }

    // Supprimer l'événement
    $this->destroy($id);

    return redirect('/admin/events/waiting')->with('status', "L'événement a bien été refusé");
}

public function destroy($id)
{
    // Trouver l'événement par son ID et le supprimer
    $event = Event::find($id);
    if ($event) {  // Assurez-vous que l'événement existe avant de le supprimer
        $event->delete();
    } else {
        // L'événement n'a pas été trouvé, donc on retourne une erreur ou un autre type de réponse
        return back()->withErrors("L'événement avec l'ID " . $id . " n'a pas été trouvé.");
    }
    if(Auth::user()->droit == 1 ){
      return redirect('/admin/events/waiting')->with('status', "L'événement a bien été supprimé");}
    else{
    return redirect('/events')->with('status', "L'événement a bien été supprimé");}
}


}
