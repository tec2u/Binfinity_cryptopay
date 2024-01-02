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
        Schema::create('config_bonusunilevel', function (Blueprint $table) {
            $table->id();
            $table->integer('level');
            $table->string('decription')->nullable();
            $table->float('value_percent');
            $table->boolean('user_activated')->default(false);
            $table->float('max_price')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('config_bonusunilevel');
    }
};
