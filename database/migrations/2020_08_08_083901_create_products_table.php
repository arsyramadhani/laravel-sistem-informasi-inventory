<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            // $table->id();
            // $table->increments('id');
            $table->string('id', 10);
            $table->primary('id');
            $table->string('nama_barang', 50);
            $table->integer('harga_jual')->default(0);
            $table->integer('category_id')->unsigned();
            $table->integer('unit_id')->unsigned();
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
        Schema::dropIfExists('products');
    }
}
