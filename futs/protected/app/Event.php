<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Event extends Model
{


  public function inventaires(){
    return $this->hasMany('App\Inventaire');
  }

  public function commandes(){
    return $this->hasMany('App\Commande','event_id','id');
  }

  public function comite(){
    return $this->hasOne('App\Comite','id','comite_id');
  }



}
