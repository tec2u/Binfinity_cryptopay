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
        Schema::table('users', function (Blueprint $table) {
            $table->string('telephone')->nullable()->change();
            $table->string('cell')->nullable()->change();
            $table->string('gender')->nullable()->change();
            $table->string('country')->nullable()->change();
            $table->string('last_name')->nullable()->change();
            $table->string('address1')->nullable()->change();
            $table->string('address2')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->string('postcode')->nullable()->change();
            $table->string('state')->nullable()->change();
            $table->date('birthday')->nullable()->change();
            $table->integer('id_card')->nullable()->change();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('telephone')->nullable(false)->change();
            $table->string('cell')->nullable(false)->change();
            $table->string('gender')->nullable(false)->change();
            $table->string('country')->nullable(false)->change();
            $table->string('last_name')->nullable(false)->change();
            $table->string('address1')->nullable(false)->change();
            $table->string('address2')->nullable(false)->change();
            $table->string('city')->nullable(false)->change();
            $table->string('postcode')->nullable(false)->change();
            $table->string('state')->nullable(false)->change();
            $table->date('birthday')->nullable(false)->change();
            $table->integer('id_card')->nullable(false)->change();
        });
    }
};
