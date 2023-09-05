<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    protected $fillable = [
        'modif_date', 'id_inventaire', 'modif_items', 'modif_quantities',
    ];

    protected $casts = [
        'modif_items' => 'array',
        'modif_quantities' => 'array'
    ];

    public $timestamps = false;
}
