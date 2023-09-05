<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commande extends Model
{
    use SoftDeletes;
    protected $fillable = ['event_id', 'frequentation', 'nom','prenom','email','adresselegale','adressefacturation','telephone'];

    public function futs(){
      return $this->belongsToMany('App\Fut','commandes_futs','commande_id','futs_id')->withPivot("nombre");
    }

    public function materiels(){
      return $this->belongsToMany('App\Materiel','commandes_materiels','commande_id','materiel_id')->withPivot("nombre");
    }

    public function event(){
      return $this->hasOne('App\Event','id','event_id')->orderBy('date');
    }
    public function comite()
    {
        return $this->belongsTo(Comite::class);
    }
    // Returns the view allowing to create a new Inventaire
    public function create() {
        $comites = Comite::all();
        $stocks = Stock::all();
        $responsablesAgel = Listing::where('agel', 1)->get();
        return view('admin.inventaires.create', compact('responsablesAgel','comites', 'stocks'));
    }


}
