<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('payment_log', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            $table->bigInteger('order_package_id')->unsigned()->nullable();
            $table->string('operation');
            $table->string('controller');
            $table->integer('http_code');
            $table->string('route');
            $table->enum('status', ['error', 'success']);
            $table->timestamps();
            $table->longText('json')->nullable();

            $table->foreign('order_package_id')->references('id')->on('orders_package')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_log');
    }
};
