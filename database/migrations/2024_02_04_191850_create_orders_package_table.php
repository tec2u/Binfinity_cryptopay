<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders_package', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('reference');
            $table->string('payment_status')->default('0');
            $table->string('transaction_code');
            $table->string('transaction_wallet');
            $table->unsignedBigInteger('package_id');
            $table->double('price', 8, 2);
            $table->integer('amount');
            $table->string('status')->default('0');
            $table->timestamps();
            $table->string('wallet')->nullable();
            $table->tinyInteger('hide')->default(0);
            $table->string('subscription_id')->nullable();
            $table->string('user')->nullable();
            $table->string('pass')->nullable();
            $table->string('link')->nullable();
            $table->string('server')->nullable();
            $table->string('printscreen')->nullable();
            $table->text('price_crypto')->nullable();
            $table->text('hash')->nullable();
            $table->string('payment')->nullable();
            $table->integer('id_node_order')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('transaction_wallet')->references('wallets')->on('transactions');
            $table->foreign('package_id')->references('id')->on('packages');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders_package');
    }
};
