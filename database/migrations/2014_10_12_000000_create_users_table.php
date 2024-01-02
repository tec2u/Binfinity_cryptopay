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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('login')->unique();
            $table->unsignedBigInteger('recommendation_id');
            $table->string('email')->unique();
            $table->bigInteger('telephone');
            $table->bigInteger('cell');
            $table->string('gender');
            $table->boolean('accept_terms')->default(false);
            $table->timestamp('accepted_date')->nullable();
            $table->string('country');
            $table->string('image_path')->nullable();
            $table->string('financial_password');
            $table->string('password');
            $table->boolean('activated')->default(true);
            $table->boolean('active_network')->nullable();
            $table->timestamp('active_date')->nullable();
            $table->string('rule')->default('RULE_USER');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('recommendation_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
