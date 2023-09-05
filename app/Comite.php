<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comite extends Model
{
    //
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
    public function listing()
    {
        return $this->hasMany(Listing::class, 'id_cb');
    }
    public function inventairesIn()
    {
        return $this->hasMany('App\Inventaire', 'id_cb_in');
    }

    public function inventairesOut()
    {
        return $this->hasMany('App\Inventaire', 'id_cb_out');
    }
}
