<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSignedPathsToInventairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventaires', function (Blueprint $table) {
            $table->string('signed_in_path')->nullable()->after('event_name');
            $table->string('signed_out_path')->nullable()->after('signed_in_path');
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
            //
        });
    }
}
