<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FutCommande extends Model
{
  use SoftDeletes;
  public $table = "commandes_futs";
}
