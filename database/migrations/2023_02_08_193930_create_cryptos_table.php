<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto',function (blueprint $table){
            $table->id();
            $table->bigInteger('acc_id')->unsigned();
            $table->string('crypto_symbol')->nullable();
            $table->string('crypto_info')->nullable();
            $table->string('crypto_buy_price')->nullable();
            $table->string('crypto_sell_price')->nullable();
            $table->string('crypto_buy_amount')->nullable();
            $table->string('crypto_sell_amount')->nullable();
            $table->string('crypto_amount')->nullable();
            $table->string('crypto_buy_price*amount')->nullable();
            $table->string('crypto_sell_price*amount')->nullable();
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
        Schema::dropIfExists('cryptos');
    }
};
