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
            $table->dropForeign('users_recommendation_id_foreign');
            $table->dropColumn('recommendation_id');
            $table->unsignedBigInteger('recommendation_user_id')->nullable();
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
            $table->unsignedBigInteger('recommendation_id');
            $table->foreign('recommendation_id')->references('id')->on('users');
            $table->dropColumn('recommendation_user_id');
            
        });
    }
};
