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
        // Verifica se os campos não existem antes de adicioná-los
        if (!Schema::hasColumn('orders_package', 'payment')) {
            Schema::table('orders_package', function (Blueprint $table) {
                $table->string('payment')->nullable();
            });
        }

        if (!Schema::hasColumn('orders_package', 'id_node_order')) {
            Schema::table('orders_package', function (Blueprint $table) {
                $table->integer('id_node_order')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Inversão da migração - remoção dos campos
        Schema::table('orders_package', function (Blueprint $table) {
            $table->dropColumn('payment');
            $table->dropColumn('id_node_order');
        });
    }
};
