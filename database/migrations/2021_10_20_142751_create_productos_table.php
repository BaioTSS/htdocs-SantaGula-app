<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('codigo');
            $table->integer('sector');
            $table->string('nombre');
            $table->string('descripcion');
            $table->longText('l_descripcion')->nullable();
            $table->float('precio');

            //Clave Foranea
            $table->integer('categorias_id')->unsigned()->nullable();
            $table->foreign('categorias_id')->references('id')->on('categorias');

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
        Schema::dropIfExists('productos');
    }
}