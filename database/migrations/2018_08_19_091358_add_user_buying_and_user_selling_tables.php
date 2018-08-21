<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserBuyingAndUserSellingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_buying', function (Blueprint $table)
        {
          $table->integer('user_id');
          $table->integer('item_id');
          $table->integer('quantity');
          $table->integer('price');
          $table->string('currency');
          $table->timestamps();
        });

        Schema::create('user_selling', function (Blueprint $table)
        {
          $table->integer('user_id');
          $table->integer('item_id');
          $table->integer('quantity');
          $table->integer('price');
          $table->string('currency');
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
        Schema::dropIfExists('user_buying');
        Schema::dropIfExists('user_selling');
    }
}
