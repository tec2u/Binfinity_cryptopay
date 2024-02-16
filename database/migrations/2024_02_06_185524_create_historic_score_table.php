<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {

        Schema::create('historic_score', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('description', 191);
            $table->integer('score');
            $table->string('status', 191)->default('0');
            $table->timestamps();
            $table->bigInteger('orders_package_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('orders_package_id')->references('id')->on('orders_package');

            $table->integer('level_from')->nullable();
            $table->integer('user_id_from')->nullable();
        });

    }

    public function down()
    {
        Schema::dropIfExists('historic_score');
    }
};
