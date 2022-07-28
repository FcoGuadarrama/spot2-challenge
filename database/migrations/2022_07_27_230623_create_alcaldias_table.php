<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlcaldiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alcaldias', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_postal')->nullable();
            $table->decimal('superficie_terreno')->nullable();
            $table->decimal('superficie_construccion')->nullable();
            $table->string('uso_construccion')->nullable();
            $table->decimal('valor_unitario')->nullable();
            $table->string('valor_suelo')->nullable();
            $table->decimal('subsidio')->nullable();
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
        Schema::dropIfExists('alcaldias');
    }
}
