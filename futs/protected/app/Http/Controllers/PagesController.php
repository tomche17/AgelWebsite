<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Event;
use App\Fut;
use App\Responsable;
use App\Inventaire;
use App\EventResponsable;
use App\InventaireResponsable;
use App\Materiel;
use Jenssegers\Date\Date;
use App\Comite;

class PagesController extends Controller
{
  public function commande($id)
    {
      $event = Event::find($id);

        Date::setLocale('fr');
        $date = new Date($event->date);
        $event->date = $date->format('l j F Y');

      $futs = Fut::orderBy('id')->get();
      $materiels = Materiel::orderBy('id')->get();
      return view('commande',['event' => $event, 'futs' => $futs, 'materiels' => $materiels]);
    }


    public function login(){
      return view('login');
    }

    public function addEvent(){
      $events = Event::All();
      return view("event",["events" => $events]);
    }

    public function home(){
      return view('index');
    }

}
