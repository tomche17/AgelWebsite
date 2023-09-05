<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventaire extends Model
{
    protected $fillable = [
        'date', 'agel_name', 'id_cb', 'agel_valid', 'cb_valid', 'facture_path', 'photos', 'paid','signed_in_path','signed_out_path',
    ];

    protected $casts = [
        'agel_valid' => 'boolean',
        'cb_valid' => 'boolean',
        'photos' => 'array'
    ];

    public $timestamps = false;
    public function comiteIn()
    {
        return $this->belongsTo('App\Comite', 'id_cb_in'); 
    }

    public function comiteOut()
    {
        return $this->belongsTo('App\Comite', 'id_cb_out'); 
    }
}
