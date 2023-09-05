<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comite;
use App\Event;
use App\Materiel;
use App\Fut;
use App\Inventaire;
use Jenssegers\Date\Date;
use App\Commande;

class AdminController extends Controller
{
    function admin(){

      $commandes = Commande::where("is_validated",0)->get();
      $inventaires = Inventaire::where("responsable_id",null)->get();
      return view("admin.home",["commandes"=>$commandes, "inventaires"=>$inventaires]);
    }

    function commandes(){
      $commandes = Commande::orderBy("is_validated")->get();
      Date::setLocale('fr');
      foreach($commandes as $commande){
        $date = new Date($commande->event->date);
        $commande->event->date = $date->format('l j F Y');
      }

      return view("admin.commandes",["commandes" => $commandes]);
    }

    function users(){

      $users = User::all();
      return view("admin.users", ["users" => $users]);
    }

    function events(){
      $events = Event::all();

      Date::setLocale('fr');
      foreach($events as $event){
        $date = new Date($event->date);
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
      Date::setLocale('fr');
      foreach($inventaires as $inventaire){
        $date = new Date($inventaire->date);
        $inventaire->date = $date->format('l j F Y');
      }
      return view("admin.inventaires",["inventaires" => $inventaires]);
    }



}
