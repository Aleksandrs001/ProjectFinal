<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE_NAME = 'accounts';
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('number' )->unique();
            $table->string('label' )->nullable();
            $table->integer('balance')->default(0);
            $table->timestamps();
        });
    }
 public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
