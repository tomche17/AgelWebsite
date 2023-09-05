<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInfoToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('comite_id');
            $table->string('surname');
            $table->string('phone');
            $table->integer('droit')->default('2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn('surname');
          $table->dropColumn('phone');
          $table->dropColumn('adresse');
          $table->dropColumn('comite');
          $table->dropColumn('fonction');
          $table->dropColumn('droit');
        });
    }
}
