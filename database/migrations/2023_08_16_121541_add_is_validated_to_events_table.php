<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsValidatedToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->boolean('is_validated')->default(false); // Ajout du champ 'is_validated' avec une valeur par défaut à false.
        });
    }
    
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('is_validated');
        });
    }
    
}
