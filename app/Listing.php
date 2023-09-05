<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'surname', 'firstname', 'id_cb', 'function', 'phone_number', 'legal_address', 'email', 'agel', 'image'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'agel' => 'boolean',
        'function' => 'array',
    ];
    public function comite()
    {
        return $this->belongsTo(Comite::class, 'id_cb');
    }
}
