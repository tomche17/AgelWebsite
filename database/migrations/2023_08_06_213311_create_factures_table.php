<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('destinataire'); // pour l'id du cb
            $table->date('date_emission'); // pour la date d'émission
            $table->decimal('montant', 8, 2); // pour le montant
            $table->boolean('paid')->default(false); // pour si elle a été payée
            $table->string('reference'); // pour la référence de la facture
            $table->string('event_name');
            $table->timestamps();
        });
    }
    
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factures');
    }
}
