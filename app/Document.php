<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'title', 'file_path', 'droit_access'
    ];

    protected $table = 'documents';
    public $timestamps = false;
    public function folder() {
        return $this->belongsTo('App\Folder', 'folder', 'id');
    }
    
}