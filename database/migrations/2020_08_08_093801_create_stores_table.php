<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            // $table->id();
            $table->increments('id');
            $table->string('nama', 100);
            $table->string('alamat', 100);
            $table->string('kota', 100);
            $table->string('telepon', 20);
            $table->string('apoteker', 100);
            $table->string('sipa', 100)->nullable();
            $table->string('apa', 100)->nullable();
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
        Schema::dropIfExists('stores');
    }
}
