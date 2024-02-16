<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {

        Schema::create('chat_message', function (Blueprint $table) {
            $table->id();
            $table->string('user_name', 200)->nullable();
            $table->string('title', 200)->nullable();
            $table->string('text', 200)->nullable();
            $table->dateTime('date')->nullable();
            $table->bigInteger('message_id')->unsigned()->nullable();
            $table->integer('status')->nullable();
        });

    }

    public function down()
    {
        Schema::dropIfExists('chat_message');
    }
};
