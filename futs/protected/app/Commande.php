<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commande extends Model
{
    use SoftDeletes;
    protected $fillable = ['event_id', 'comite_id', 'frequentation', 'nom','prenom','email','adresselegale','adressefacturation','telephone'];

    public function futs(){
      return $this->belongsToMany('App\Fut','commandes_futs','commande_id','futs_id')->withPivot("nombre");
    }

    public function materiels(){
      return $this->belongsToMany('App\Materiel','commandes_materiels','commande_id','materiel_id')->withPivot("nombre");
    }

    public function event(){
      return $this->hasOne('App\Event','id','event_id')->orderBy('date');
    }

    public function comite(){
      return $this->hasOne('App\Comite','id','comite_id');
    }

}
