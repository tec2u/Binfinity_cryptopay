<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('login')->unique();
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->string('cell')->nullable();
            $table->string('gender')->nullable();
            $table->boolean('accept_terms')->default(false);
            $table->timestamp('accepted_date')->nullable();
            $table->string('country')->nullable();
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
            $table->foreignId('recommendation_user_id')->nullable()->constrained('users');
            $table->boolean('ban')->default(true);
            $table->string('last_name')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('state')->nullable();
            $table->date('birthday')->nullable();
            $table->decimal('special_comission', 10, 2);
            $table->boolean('special_comission_active')->nullable();
            $table->integer('id_card')->nullable();
            $table->integer('qty')->nullable();
            $table->string('contact_id')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
