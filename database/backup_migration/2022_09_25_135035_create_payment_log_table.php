<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_log', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            $table->unsignedBigInteger('order_package_id')->nullable();
            $table->string('operation');
            $table->string('controller');
            $table->integer('http_code');
            $table->string('route');
            $table->enum('status',['error','success']);
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
        Schema::dropIfExists('payment_log');
    }
};
