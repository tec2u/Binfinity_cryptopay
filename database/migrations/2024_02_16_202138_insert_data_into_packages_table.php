<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        DB::table('packages')->insert([
            [
                'id' => 20,
                'name' => 'New Invoice',
                'price' => 50.00,
                'img' => 'images/nolimits8.png',
                'activated' => 1,
                'created_at' => '2023-03-24 11:35:23',
                'updated_at' => '2023-04-12 12:36:52',
                'long_description' => null,
                'type' => 'activator',
                'commission' => null,
                'description_fees' => null,
                'plan_id' => null,
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
        DB::table('packages')->truncate();
    }
};
