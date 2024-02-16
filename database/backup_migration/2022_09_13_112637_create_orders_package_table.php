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
        Schema::create('orders_package', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('reference');
            $table->string('payment_status')->default(0);
            $table->string('transaction_code');
            $table->unsignedBigInteger('transaction_wallet');
            $table->unsignedBigInteger('package_id');
            $table->float('price');
            $table->integer('amount');
            $table->string('status')->default(0);
            $table->timestamps();
            $table->date("date_save")->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('transaction_wallet')->references('id')->on('wallets');
            $table->foreign('package_id')->references('id')->on('packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_package');
    }
};
