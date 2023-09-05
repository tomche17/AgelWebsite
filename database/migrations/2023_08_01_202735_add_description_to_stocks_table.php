<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionToStocksTable extends Migration
{
            public function up()
        {
            Schema::table('stocks', function (Blueprint $table) {
                $table->string('description')->nullable();
            });
        }

        public function down()
        {
            Schema::table('stocks', function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }

}
