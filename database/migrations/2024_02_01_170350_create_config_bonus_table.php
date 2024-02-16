<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {

        Schema::create('config_bonus', function (Blueprint $table) {
            $table->id();
            $table->string('description', 191);
            $table->timestamps();
            $table->tinyInteger('activated')->default(1);
        });

    }

    public function down()
    {
        Schema::dropIfExists('config_bonus');
    }
};
