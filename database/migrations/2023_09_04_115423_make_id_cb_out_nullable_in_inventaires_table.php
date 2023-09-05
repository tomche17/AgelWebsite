<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeIdCbOutNullableInInventairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventaires', function (Blueprint $table) {
            $table->integer('id_cb_out')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventaires', function (Blueprint $table) {
            $table->integer('id_cb_out')->nullable(false)->change();  // revert back to not nullable
        });
    }
}
