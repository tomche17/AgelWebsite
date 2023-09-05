<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameIdCbToIdCbOutInNomDeLaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventaires', function (Blueprint $table) {
            // Renommer la colonne
            $table->renameColumn('id_cb', 'id_cb_out');
        });
        
        // Une fois la colonne renommée, nous pouvons ajouter la nouvelle colonne
        Schema::table('inventaires', function (Blueprint $table) {
            // Ajouter la nouvelle colonne
            $table->unsignedBigInteger('id_cb_in')->nullable()->after('id_cb_out');
            // Si vous avez une contrainte de clé étrangère pour cette colonne, ajoutez la ligne suivante
            // $table->foreign('id_cb_in')->references('id')->on('autre_table');
        });
    }
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('id_cb_out_in_nom_de_la', function (Blueprint $table) {
            //
        });
    }
}
