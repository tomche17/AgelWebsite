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
use Carbon\Carbon;

class PagesController extends Controller
{
  public function commande()
    {
      $futs = Fut::orderBy('id')->get();
      $materiels = Materiel::orderBy('id')->get();
      return view('commande',['event' => $event, 'futs' => $futs, 'materiels' => $materiels]);
    }



}
