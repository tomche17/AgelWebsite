<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Input, Redirect;
use Jenssegers\Date\Date;
use App\Inventaire;
use App\Event;
use App\User;

class InventairesController extends Controller
{
  function create(Request $request){
    $rules = [
      'evenement' => 'required',
      'date' => 'required',
      'type' => 'required',
      'responsable' => 'required',
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
        $inventaire = New Inventaire;
        $inventaire->date = $request->date;
        $inventaire->responsable_id = $request->responsable;
        $inventaire->event_id = $request->evenement;
        $inventaire->type = $request->type;
        $inventaire->save();

        return redirect('/admin/inventaires')->with('status', "l'inventaire a bien été créé");
      }
  }

  function add(){
    $events = Event::all();
    $responsables = User::where("is_responsable","=",1)->get();
    return view("admin.inventaires.add", ["events" => $events, "responsables" => $responsables]);
  }

  function delete($id){
    $inventaire = Inventaire::find($id);
    $inventaire->delete();

    return redirect('/admin/inventaires')->with('status', "l'inventaire a bien été supprimé");
  }

  function edit($id){
    $inventaire = Inventaire::find($id);
    $cuttedDate = explode(" ",$inventaire->date);

    Date::setLocale('fr');
    $date = new Date(strtotime($inventaire->date));
    $inventaire->date = $date->format('l j F Y');


    $inventaire->day = $cuttedDate[0];

    if(count($cuttedDate) > 1){
      $inventaire->hour = $cuttedDate[1];
      $inventaire->humanDate = $date->format('l j F Y H:i');
    }else{
      $inventaire->hour = null;
      $inventaire->humanDate = $date->format('l j F Y');
    }




    $responsables = User::where("is_responsable","=",1)->get();

    return view("admin.inventaires.edit",["inventaire" => $inventaire, "responsables" => $responsables]);
  }

  function update(Request $request, $id){
    $rules = [
      'date' => 'required',
      'time' => 'required',
      'responsable' => 'required',
    ];

    $messages = [
      'required' => 'Le champ " :attribute" ne peut pas être vide.',
    ];

    $validator = Validator::make($request->all(),$rules, $messages);

    if ($validator->fails())
      {
        return redirect()->back()->withErrors($validator)->withInput();

      }else{


        $inventaire = Inventaire::find($id);
        $dateString = $request->date." ".$request->time;
        $dateString = Date::createFromFormat('Y-m-d H:i', $dateString);
        $inventaire->date = $dateString->format('Y-m-d H:i');
        $inventaire->responsable_id = $request->responsable;
        $inventaire->save();
        return redirect('/admin/inventaires')->with('status', "l'inventaire a bien été Modifié");
      }
  }
}
