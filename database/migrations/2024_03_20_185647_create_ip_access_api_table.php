<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_access_api', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->longText('request');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ip_access_api');
    }
};
