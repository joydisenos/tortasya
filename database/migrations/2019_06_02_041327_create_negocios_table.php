<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negocios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->text('descripcion')->nullable();
            $table->string('foto_local')->nullable();
            $table->boolean('entrega_domicilio')->default(0);
            $table->boolean('entrega_local')->default(0);
            $table->boolean('tarjeta_delivery')->default(0);
            $table->boolean('envio_entrega')->default(0);
            $table->float('costo_envio')->nullable();
            $table->boolean('costo_fijo')->default(0);
            $table->boolean('envio_gratis')->default(0);
            $table->boolean('variable')->default(0);
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
        Schema::dropIfExists('negocios');
    }
}
