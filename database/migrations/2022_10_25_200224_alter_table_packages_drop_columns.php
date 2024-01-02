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
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('minting_month');
            $table->dropColumn('daily_returns');
            $table->dropColumn('bonus');
            $table->dropColumn('per_month_coins');
            $table->dropColumn('capping_coin');
            $table->dropColumn('yaerly_returns');
            $table->dropColumn('total_returns');
            $table->dropColumn('period_days');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->string('minting_month');
            $table->decimal('daily_returns', 10, 2);
            $table->integer('bonus');
            $table->string('per_month_coins');
            $table->integer('capping_coin');
            $table->decimal('yaerly_returns', 10, 2);
            $table->decimal('total_returns', 10, 2);
            $table->integer('period_days')->nullable();
        });
    }
};
