<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receives', function (Blueprint $table) {
            // $table->id();
            $table->string('id', 10);
            $table->primary('id');
            $table->string('order_id', 10);
            $table->date('receive_date');
            $table->string('invoice', 100);
            $table->date('invoice_date');
            $table->string('supplier_id', 10);
            $table->integer('tax');
            $table->integer('total');
            $table->date('return_before');
            $table->integer('return_limit');
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
        Schema::dropIfExists('receives');
    }
}
