<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdToUserBuyingAndUserSelling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('user_buying', function (Blueprint $table)
      {
        $table->increments('id');
      });

      Schema::table('user_selling', function (Blueprint $table)
      {
        $table->increments('id');
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
