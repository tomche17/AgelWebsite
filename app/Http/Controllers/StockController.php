<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Stock;
use App\Materiel;
use Validator;

class StockController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = Stock::all();
        return view('stock.index', compact('items'));
    }

    function create(Request $request){
      $rules = [
        'name' => 'required|unique:stocks,name',
        'quantity' =>'required',
        'price' => 'required|numeric',
        'description' => 'required', 
      ];
  
      $messages = [
        'required' => 'Le champ " :attribute" ne peut pas être vide.',
        'numeric' => 'Le prix doit être un nombre',
      ];
  
      $validator = Validator::make($request->all(), $rules, $messages);
  
      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      } else {
          $stock = new Stock;
          $stock->name = ucfirst(strtolower($request->name));
          $stock->quantity = $request->quantity;
          $stock->price = $request->price;
          $stock->description = ucfirst(strtolower($request->description));
          $stock->save();
  
          $materiel = new Materiel;
          $materiel->nom = ucfirst(strtolower($request->name));
          $materiel->save();
  
          return redirect('/stock')->with('status', 'L\'élément a été ajouté !');
      }
  }
      
      function add(){
        return view("admin.stocks.add");
      }
    
      function edit($id){
    
        $stock = Stock::findOrFail($id);
        return view("admin.stocks.edit",["stock" => $stock]);
      }
    
      function update(Request $request,$id){
        $rules = [
          'name' => 'required',
          'quantity'=> 'required',
          'price' => 'required|numeric',
          'description' => 'required', 
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
    
            $stock = Stock::find($id);
            $stock->name = $request->name;
            $stock->quantity = $request->quantity;
            $stock->price = $request->price;
            $stock->description = $request->description;
            $stock->save();
    
            return redirect('/stock')->with('status', 'L\'élément a été modifié.');
          }
      }

      public function destroy($id) {
        $stock = Stock::findOrFail($id);
        $stock->delete();
    
        return redirect('/stock');
      }
}
