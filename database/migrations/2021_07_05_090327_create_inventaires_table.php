<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('agel_name');
            $table->integer('id_cb');
            $table->boolean('agel_valid');
            $table->boolean('cb_valid');
            $table->boolean('paid')->default(0);
            $table->string('facture_path');
            $table->json('photos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventaires');
    }
}
