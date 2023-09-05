<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    protected $table = 'documents_folder';
    public $timestamps = false;
    public function documents() {
        return $this->hasMany('App\Document', 'folder', 'id');
    }
    
}