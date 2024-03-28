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
        Schema::table('system_conf', function (Blueprint $table) {
            $table->boolean('app')->default(1);
            $table->boolean('api')->default(1);
            $table->boolean('internal')->default(1);
            $table->boolean('external')->default(1);
            $table->boolean('node')->default(1);
            $table->boolean('all')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('system_conf', function (Blueprint $table) {
            $table->dropColumn('app');
            $table->dropColumn('api');
            $table->dropColumn('internal');
            $table->dropColumn('external');
            $table->dropColumn('node');
            $table->dropColumn('all');
        });
    }
};
