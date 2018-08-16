<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ItemUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('item_user', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('item_id');
        $table->integer('user_id');
        $table->string('selling_currency');
        $table->integer('selling_price');
        $table->integer('selling_quantity');
        $table->string('buying_currency');
        $table->integer('buying_price');
        $table->integer('buying_quantity');
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
        Schema::dropIfExists('item_user');
    }
}
