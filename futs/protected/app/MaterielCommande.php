<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MaterielCommande extends Model
{
    use SoftDeletes;
    public $table = "commandes_materiels";
}
