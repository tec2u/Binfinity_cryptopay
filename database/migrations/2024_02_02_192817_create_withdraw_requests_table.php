<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('withdraw_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('payment_code')->nullable();
            $table->decimal('value', 10, 2);
            $table->dateTime('date_payment')->nullable();
            $table->integer('processing_user')->nullable();
            $table->string('status', 191)->default('0');
            $table->timestamps();
            $table->string('message')->nullable();
            $table->string('type')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('withdraw_requests');
    }
};
