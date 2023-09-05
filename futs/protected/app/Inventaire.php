<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Event;

class Inventaire extends Model
{
  public function responsable(){
    return $this->hasOne('App\User','id','responsable_id');
  }

  public function event(){
    return $this->belongsTo('App\Event','event_id','id');
  }
}
