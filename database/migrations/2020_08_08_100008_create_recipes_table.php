<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            // $table->id();
            $table->string('id', 10);
            $table->primary('id');
             $table->string('sale_id', 10);
            $table->string('nama_pasien', 100)->nullable();
            $table->integer('usia');
            $table->string('nama_dokter', 100)->nullable();
            $table->date('recipe_date');
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
        Schema::dropIfExists('recipes');
    }
}
