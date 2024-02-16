<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {

        Schema::create('banco', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('order_id')->nullable();
            $table->string('description', 191);
            $table->double('price', 8, 2);
            $table->date('date_save')->nullable();
            $table->string('status', 191)->default('0');
            $table->timestamps();
            $table->integer('level_from')->nullable();
            $table->decimal('percent_pay', 10, 2)->nullable();
            $table->integer('user_id_from')->nullable();

            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('order_id')->references('id')->on('orders_package');

            // Se desejar índices para as chaves estrangeiras
            $table->index('user_id');
            $table->index('order_id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('banco');
    }
};

