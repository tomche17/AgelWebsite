<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Input, Redirect;
use Jenssegers\Date\Date;
use App\Materiel;

class MaterielsController extends Controller
{
  function create(Request $request){
    $rules = [
      'nom' => 'required',
    ];

    $messages = [
      'required' => 'Le champ " :attribute" ne peut pas être vide.',
    ];

    $validator = Validator::make($request->all(),$rules, $messages);

    if ($validator->fails())
      {
        return redirect()->back()->withErrors($validator)->withInput();

      }else{

        $materiel = new Materiel;
        $materiel->nom = $request->nom;
        $materiel->save();

        return redirect('/admin/materiel')->with('status', 'La matériel a été créé');
      }
  }

  function add(){
    return view("admin.materiels.add");
  }

  function edit($id){
    $materiel = Materiel::find($id);
    return view("admin.materiels.edit", ["materiel" => $materiel]);
  }

  function update(Request $request,$id){
    $materiel = Materiel::find($id);

    $rules = [
      'nom' => 'required',
    ];

    $messages = [
      'required' => 'Le champ " :attribute" ne peut pas être vide.',
    ];

    $validator = Validator::make($request->all(),$rules, $messages);

    if ($validator->fails())
      {
        return redirect()->back()->withErrors($validator)->withInput();

      }else{

        $materiel->nom = $request->nom;
        $materiel->save();

        return redirect('/admin/materiel')->with('status', 'La matériel a été modifié');
      }
  }
}
