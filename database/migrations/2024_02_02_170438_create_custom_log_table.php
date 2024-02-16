<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::create('custom_log', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('operation', 191);
            $table->string('controller', 191);
            $table->integer('http_code');
            $table->string('route', 191);
            $table->enum('status', ['error', 'success']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function down()
    {
        Schema::dropIfExists('custom_log');
    }
};
