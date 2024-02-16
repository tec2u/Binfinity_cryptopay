<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('img');
            $table->tinyInteger('activated')->default(1);
            $table->timestamps();
            $table->longText('long_description')->nullable();
            $table->string('type')->default('packages');
            $table->decimal('commission', 10, 2)->nullable();
            $table->longText('description_fees')->nullable();
            $table->string('plan_id')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
};
