<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalChatMessagesTable extends Migration
{

  public function up()
  {
    Schema::create('global_chat_messages', function (Blueprint $table) {
      $table->increments('id');
      $table->string('username');
      $table->string('message');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('global_chat_messages');
  }
}
