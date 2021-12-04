<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_details', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('cart_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->integer('cupon')->default(false);
            $table->longText('observacion')->nullable();

            //clave foranea a header
            $table->foreign('cart_id')->references('id')->on('carts');
            //clave foranea producto
            $table->foreign('producto_id')->references('id')->on('productos');

            $table->integer('quantity');
            $table->integer('discount')->default(0); // % int

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
        Schema::dropIfExists('cart_details');
    }
}
