<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_details', function (Blueprint $table) {
            // $table->id();
            $table->string('refund_id', 10);
            $table->string('product_id', 10);
            $table->integer('qty');
            $table->integer('buy_price');
            $table->integer('discount');
            $table->integer('batch_id')->unsigned();
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
        Schema::dropIfExists('refund_details');
    }
}
