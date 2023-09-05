<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Input, Redirect;
use Jenssegers\Date\Date;
use App\Event;
use App\Inventaire;
use App\Comite;
use Auth;

class EventsController extends Controller
{
    function create(Request $request){
      $rules = [
        'nom' => 'required',
        'date' => 'required',
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
              Date::setLocale('fr');
              $event = new Event;
              $event->nom = $request->nom;
              $event->date = $request->date;

              if(Auth::check()){
                $event->comite_id = Auth::User()->comite_id;
              }
              $event->save();

              $inventaire = new Inventaire;
              $inventaire->date = $event->date;
              $inventaire->event_id = $event->id;
              $inventaire->type = "entree";
              $inventaire->responsable_id = null;
              $inventaire->save();

              $date = Date::createFromFormat('Y-m-d', $request->date);
              $inventaireSortie = new Inventaire;
              $inventaireSortie->date = $date->add("1 day");
              $inventaireSortie->date->hour = 0;
              $inventaireSortie->date->minute = 0;
              $inventaireSortie->date->second = 0;
              $inventaireSortie->event_id = $event->id;
              $inventaireSortie->type = "sortie";
              $inventaireSortie->responsable_id = null;
              $inventaireSortie->save();

              return redirect('/commande/event/'.$event->id);
            }
            else{
            Date::setLocale('fr');
            $event = new Event;
            $event->nom = $request->nom;
            $event->date = $request->date;
            $event->comite_id = $request->comite;
            $event->save();

            $inventaire = new Inventaire;
            $inventaire->date = $event->date;
            $inventaire->event_id = $event->id;
            $inventaire->type = "entree";
            $inventaire->responsable_id = null;
            $inventaire->save();

            $date = Date::createFromFormat('Y-m-d', $request->date);
            $inventaireSortie = new Inventaire;
            $inventaireSortie->date = $date->add("1 day");
            $inventaireSortie->date->hour = 0;
            $inventaireSortie->date->minute = 0;
            $inventaireSortie->date->second = 0;
            $inventaireSortie->event_id = $event->id;
            $inventaireSortie->type = "sortie";
            $inventaireSortie->responsable_id = null;
            $inventaireSortie->save();

            return redirect('/admin/events')->with('status', "l'évènement à bien été créé");
          }

        }
    }

    function add(){
      $comites = Comite::all();
      return view("admin.events.add",["comites" => $comites]);
    }

    function delete($id){
      $event = Event::find($id);
      $event->inventaires()->delete();
      $event->commandes()->delete();
      $event->delete();

      return redirect('/admin/events')->with('status', "l'évènement a bien été supprimé");
    }

    public function edit($id){
      $event = Event::find($id);
      $comites = Comite::all();

      $cuttedDate = explode(" ",$event->date);

      Date::setLocale('fr');
      $date = new Date(strtotime($event->date));
      $event->date = $date->format('l j F Y');


      $event->day = $cuttedDate[0];

      if(count($cuttedDate) > 1){
        $event->hour = $cuttedDate[1];
        $event->humanDate = $date->format('l j F Y H:i');
      }else{
        $event->hour = null;
        $event->humanDate = $date->format('l j F Y');
      }

      return view("admin.events.edit",["event" => $event, "comites" => $comites]);
    }

    public function update(Request $request, $id){
      $event = Event::find($id);

      $rules = [
        'nom' => 'required',
        'date' => 'required',
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

            Date::setLocale('fr');
            $event->nom = $request->nom;
            $event->date = $request->date;
            $inventaires = Inventaire::where("event_id",$event->id)->get();

            foreach($inventaires as $inventaire){
              if($inventaire->type == "entree"){
                $inventaire->date = $request->date;
              }else{
                $date = Date::createFromFormat('Y-m-d', $request->date);
                $inventaire->date = $date->add("1 day");
                $inventaire->date->hour = 0;
                $inventaire->date->minute = 0;
                $inventaire->date->second = 0;
              }
              $inventaire->save();
            }
            $event->save();

            return redirect('/admin/events')->with('status', "l'évènement à bien été modifié");
        }
    }


}
