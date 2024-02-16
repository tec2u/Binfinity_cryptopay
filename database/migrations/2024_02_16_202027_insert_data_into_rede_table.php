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
        DB::table('rede')->insert([
            [
                'id' => 112554,
                'user_id' => 1,
                'upline_id' => null,
                'ciclo' => '1',
                'qty' => 86,
                'saque' => 0,
                'created_at' => null,
                'updated_at' => '2024-02-15 16:46:22',
            ],
            [
                'id' => 112555,
                'user_id' => 2,
                'upline_id' => null,
                'ciclo' => '1',
                'qty' => 4,
                'saque' => 0,
                'created_at' => null,
                'updated_at' => '2023-04-18 13:20:57',
            ],
            // Adicione outros registros aqui
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Para reverter a inserção dos dados, você pode usar o método truncate
        DB::table('rede')->truncate();
    }
};
