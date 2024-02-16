<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historic_score', function (Blueprint $table) {
            // $table->foreign('orders_package_id')->references('id')->on('orders_package');
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historic_score', function (Blueprint $table) {
            // $table->dropForeign(['orders_package_id']);
            // $table->dropForeign(['user_id']);
        });
    }
};
