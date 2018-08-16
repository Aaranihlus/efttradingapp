<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferItemsTable extends Migration
{
  public function up()
  {
    Schema::create('offer_items', function (Blueprint $table) {
      $table->increments('offer_id');
      $table->integer('item_id');
      $table->integer('quantity');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('offer_items');
  }
}
