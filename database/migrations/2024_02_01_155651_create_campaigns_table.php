<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name_campaign', 191);
            $table->integer('status')->default(1);
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
};
