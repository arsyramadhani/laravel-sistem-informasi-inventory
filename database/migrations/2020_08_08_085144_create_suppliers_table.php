<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            // $table->id();
            // $table->increments('id');
            $table->string('id', 10);
            $table->primary('id');

            $table->string('nama_supplier', 100);
            $table->string('alamat_supplier', 100)->nullable();
            $table->string('kota_supplier', 40)->nullable();
            $table->string('telepon', 20)->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
