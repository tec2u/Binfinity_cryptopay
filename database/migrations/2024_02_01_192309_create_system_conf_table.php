<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('system_conf', function (Blueprint $table) {
            $table->id();
            $table->integer('is_allowed_btn_box')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('system_conf');
    }
};
