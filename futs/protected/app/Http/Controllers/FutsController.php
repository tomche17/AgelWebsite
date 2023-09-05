<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Input, Redirect;
use Jenssegers\Date\Date;
use App\Fut;

class FutsController extends Controller
{
  function create(Request $request){
    $rules = [
      'nom' => 'required',
      'prix' => 'required|numeric',
    ];

    $messages = [
      'required' => 'Le champ " :attribute" ne peut pas être vide.',
      'numeric' => 'Le prix doit être un nombre',
    ];

    $validator = Validator::make($request->all(),$rules, $messages);

    if ($validator->fails())
      {
        return redirect()->back()->withErrors($validator)->withInput();

      }else{

        $fut = new Fut;
        $fut->nom = $request->nom;
        $fut->prix = $request->prix;
        $fut->save();

        return redirect('/admin/futs')->with('status', 'Le fût a été créé !');
      }
  }

  function add(){
    return view("admin.futs.add");
  }

  function edit($id){

    $fut = Fut::find($id);
    return view("admin.futs.edit",["fut" => $fut]);
  }

  function update(Request $request,$id){
    $rules = [
      'nom' => 'required',
      'prix' => 'required|numeric',
    ];

    $messages = [
      'required' => 'Le champ " :attribute" ne peut pas être vide.',
      'numeric' => 'Le prix doit être un nombre',
    ];

    $validator = Validator::make($request->all(),$rules, $messages);

    if ($validator->fails())
      {
        return redirect()->back()->withErrors($validator)->withInput();

      }else{

        $fut = Fut::find($id);
        $fut->nom = $request->nom;
        $fut->prix = $request->prix;
        $fut->save();

        return redirect('/admin/futs')->with('status', 'Le fût a été modifié.');
      }
  }
}
