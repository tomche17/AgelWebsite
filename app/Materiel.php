<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    public $table = "materiels";

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;
}
