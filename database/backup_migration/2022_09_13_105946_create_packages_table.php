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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('minting_month');
            $table->decimal('dally_retuns', 10, 2);
            $table->integer('bonus');
            $table->string('per_month_coins');
            $table->integer('capping_coin');
            $table->decimal('yaerly_returns', 10, 2);
            $table->decimal('total_returns', 10, 2);
            $table->string('img');
            $table->boolean('activated')->default(true);
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
        Schema::dropIfExists('packages');
    }
};
