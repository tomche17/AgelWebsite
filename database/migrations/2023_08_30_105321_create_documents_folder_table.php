<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsFolderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_folder', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique(); // Pour le nom du dossier
            $table->text('description')->nullable(); // Une description optionnelle pour le dossier
            $table->timestamps(); // Pour created_at et updated_at
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_folder');
    }
}
