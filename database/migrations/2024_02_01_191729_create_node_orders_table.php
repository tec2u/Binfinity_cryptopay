<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('node_orders', function (Blueprint $table) {
            $table->id();
            $table->string('id_order');
            $table->integer('id_user');
            $table->decimal('price_crypto', 38, 20);
            $table->decimal('price_crypto_payed', 38, 20)->nullable();
            $table->string('wallet');
            $table->integer('validity')->default(60);
            $table->string('status')->default('Pending');
            $table->string('coin');
            $table->string('hash')->nullable();
            $table->string('notify_url')->nullable();
            $table->integer('notified')->default(0);
            $table->dateTime('createdAt');
            $table->dateTime('updatedAt');
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('withdrawn')->default(0);
            $table->integer('type')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('node_orders');
    }
};
