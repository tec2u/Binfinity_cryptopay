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
        Schema::create('users_old', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->nullable();
            $table->string('referral_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('package_id')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('show_pass')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('address')->nullable();
            $table->decimal('balance', 10, 2)->default(0.00);
            $table->double('tokens')->default(0);
            $table->string('image')->default('default.png');
            $table->string('type')->default('user');
            $table->string('remember_token')->nullable();
            $table->integer('email_verified')->default(0);
            $table->integer('smsv')->default(1);
            $table->string('email_code')->nullable();
            $table->string('sms_code')->nullable();
            $table->integer('status')->default(1);
            $table->string('email_verification_token')->nullable();
            $table->string('country')->nullable();
            $table->longText('about')->nullable();
            $table->date('dob')->nullable();
            $table->double('team_business')->default(0);
            $table->double('self_business')->default(0);
            $table->integer('rank_id')->default(0);
            $table->string('ip')->nullable();
            $table->longText('data')->nullable();
            $table->string('wallet_address')->nullable();
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
        Schema::dropIfExists('users_old');
    }
};
