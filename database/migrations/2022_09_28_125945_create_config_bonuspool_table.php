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
        Schema::create('config_bonuspool', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->float('minimum_volume');
            $table->boolean('personal_volume')->default(false);
            $table->float('percentage');
            $table->float('minimum_career');
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
        Schema::dropIfExists('config_bonuspool');
    }
};
