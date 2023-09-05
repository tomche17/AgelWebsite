<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = [
        'destinataire', 'date_emission', 'montant', 'paid', 'reference','event_name' ,'is_send'];

    protected $table = 'factures';
    public $timestamps = false;
}
