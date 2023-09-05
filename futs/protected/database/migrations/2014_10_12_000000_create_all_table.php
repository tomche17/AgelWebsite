<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        Schema::defaultStringLength(191);

        Schema::create('commandes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->nullable();
            $table->integer('frequentation');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('adresselegale');
            $table->string('adressefacturation');
            $table->string('adresselivraison');
            $table->string('telephone');
            $table->string('prixtotal');
            $table->boolean('is_validated')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('futs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->float('prix');
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->string('nom');
            $table->integer('comite_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });

        Schema::create('commandes_futs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('commande_id');
            $table->integer('futs_id');
            $table->integer('nombre');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('inventaires', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->integer('event_id');
            $table->integer('responsable_id')->nullable();
            $table->string('type');
            $table->timestamps();
        });



        Schema::create('materiels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->timestamps();
        });

        Schema::create('commandes_materiels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('commande_id');
            $table->integer('materiel_id');
            $table->integer('nombre');
            $table->softDeletes();
            $table->timestamps();
        });



        Schema::create('comites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean("is_admin");
            $table->boolean("is_responsable");
            $table->boolean("validate");
            $table->integer("comite_id")->nullable();
            $table->boolean("emails");
            $table->rememberToken();
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
        Schema::dropIfExists('commandes','futs','commandes_futs','events','commandes_futs','inventaires', 'inventaires_responsables','events_responsables','events_inventaires','users','comites');
    }
}
