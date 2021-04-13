<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('recruit_id');
            $table->integer('apply_id');
            $table->integer('send_corporate_id')->nullable();
            $table->integer('recieve_corporate_id')->nullable();
            $table->integer('send_user_id')->nullable();
            $table->integer('recieve_user_id')->nullable();
            $table->string('subject');
            $table->string('body');
            $table->integer('readed')->default(0);
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
        Schema::dropIfExists('messages');
    }
}
