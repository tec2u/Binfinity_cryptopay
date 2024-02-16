<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {

        Schema::create('ip_blacklist', function (Blueprint $table) {
            $table->id();
            $table->string('ip', 191)->nullable();
            $table->string('login', 191)->nullable();
            $table->string('password', 191)->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('ip_blacklist');
    }
};
