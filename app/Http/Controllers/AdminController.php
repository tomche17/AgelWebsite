<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Stock;
use App\Event;
use App\Materiel;
use App\Fut;
use App\Inventaire;
use App\Commande;
use App\Historique;
use App\Comite;
use Carbon\Carbon;


class AdminController extends Controller
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

    function admin(){

        $commandes = Commande::where("is_validated",0)->get();
        $inventaires = Inventaire::where("responsable_id",null)->get();
        return view("admin.home",["commandes"=>$commandes, "inventaires"=>$inventaires]);
      }
  
      function commandes(){
        $commandes = Commande::where('is_validated', 1)->orderBy("id", 'desc')->get();
        foreach($commandes as $commande){
          $date = new Carbon($commande->event->date);
          $commande->event->date = $date->format('l j F Y');
        }
  
        return view("admin.commandes",["commandes" => $commandes]);
      }

      function commandes_waiting(){
        $commandes = Commande::where('is_validated', 0)->orderBy("id")->get();
        foreach($commandes as $commande){
          $date = new Carbon($commande->event->date);
          $commande->event->date = $date->format('l j F Y');
        }
  
        return view("admin.commandes_waiting",["commandes" => $commandes]);
      }
  
      function users(){
  
        $users = User::orderBy('id')->get();
        return view("admin.users", ["users" => $users]);
      }
  
      function events(){
        $events = Event::all();
  
        foreach($events as $event){
          $date = new Carbon($event->date);
          $event->date = $date->format('l j F Y');
        }
  
        return view("admin.events",["events" => $events]);
      }
  
      function materiels(){
        $materiels = Materiel::all();
        return view("admin.materiels",["materiels" => $materiels]);
      }
  
      function futs(){
        $futs = Fut::all();
        return view("admin.futs",["futs" => $futs]);
      }
  
  
      function inventaires(){
        $inventaires = Inventaire::orderByRaw('-responsable_id', 'ASC')->orderBy("date")->get();
        foreach($inventaires as $inventaire){
          $date = new Carbon($inventaire->date);
          $inventaire->date = $date->format('l j F Y');
        }
        return view("admin.inventaires",["inventaires" => $inventaires]);
      }
}
