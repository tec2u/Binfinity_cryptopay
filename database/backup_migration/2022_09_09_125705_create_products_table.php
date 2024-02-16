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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('resume');
            $table->string('description');
            $table->string('img_1');
            $table->string('img_2');
            $table->string('type');
            $table->string('unity');
            $table->decimal('price', 10, 2);
            $table->decimal('height', 8, 2);
            $table->decimal('width', 8, 2);
            $table->decimal('depth', 8, 2);
            $table->decimal('weight', 8, 2);
            $table->integer('amount');
            $table->integer('score');
            $table->boolean('activated');
            $table->string('active');
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
        Schema::dropIfExists('products');
    }
};
