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
        Schema::table('historic_score', function (Blueprint $table) {
            $table->unsignedBigInteger('orders_package_id');
            $table->foreign('orders_package_id')->references('id')->on('orders_package');
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
            
            $table->dropForeign('historic_score_orders_package_id_foreign');
            $table->dropColumn('orders_package_id');
        });
        
    }
};
