<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('customer_id');
          $table->bigInteger('room_id');
          $table->text('body');
          $table->timestamps();

          // 外部キー制約を設定するとseedingの際面倒なのであえて設定しない
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('chat_messages');
    }
}
