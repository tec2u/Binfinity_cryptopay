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
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'flavioo',
                'login' => 'master',
                'email' => 'master@tec2u.com.br',
                'telephone' => '9999999999',
                'cell' => '9999999999',
                'gender' => 'M',
                'accept_terms' => 0,
                'accepted_date' => null,
                'country' => 'AT',
                'image_path' => 'user/gsBYz5V4XlzxiJLJP8a4ZV7UoweamjrqOqmLCNe0',
                'financial_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'password' => '$2y$10$nbj06RhlJBuwsXbf4/f8heuwZhEOF4fzRGZe8fCFOm2FGLS1Kz1oq',
                'activated' => 1,
                'active_network' => null,
                'active_date' => '2023-11-14 19:16:04',
                'rule' => 'RULE_USER',
                'email_verified_at' => null,
                'remember_token' => 'H5aig8HPsEdmnli2y4Y3YMrDTAQ81uQfsGBwP8jEozmFKb89coCBwKxP18X3',
                'created_at' => '2022-09-12 06:59:29',
                'updated_at' => '2023-11-14 19:16:04',
                'recommendation_user_id' => null,
                'ban' => 1,
                'last_name' => 'asdooo',
                'address1' => 'R. João Leme da Silva, 642oo',
                'address2' => 'asdoo',
                'city' => 'Paulíniaoo',
                'postcode' => '131421924',
                'state' => 'SP',
                'birthday' => '2023-10-25',
                'special_comission' => 30.00,
                'special_comission_active' => 1,
                'id_card' => null,
                'qty' => 3142,
                'contact_id' => 'c438ed1a-7d1e-40fa-8727-995eb28e96a9',
            ],
            [
                'id' => 2,
                'name' => 'admin2u',
                'login' => 'admin2u',
                'email' => 'admin@tec2u.com.br',
                'telephone' => '9999999999',
                'cell' => '9999999999',
                'gender' => 'M',
                'accept_terms' => 0,
                'accepted_date' => null,
                'country' => 'brazil',
                'image_path' => null,
                'financial_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'activated' => 1,
                'active_network' => null,
                'active_date' => '2023-04-18 13:20:57',
                'rule' => 'RULE_ADMIN',
                'email_verified_at' => null,
                'remember_token' => 'ZIp8FZLwY7AeTPnhU2LQvp7mjIpRnYwrfuXZOUVsK4KGdTAg1Ccv3ntCdkaO',
                'created_at' => '2022-09-12 06:59:29',
                'updated_at' => '2023-04-18 13:20:57',
                'recommendation_user_id' => null,
                'ban' => 1,
                'last_name' => null,
                'address1' => null,
                'address2' => null,
                'city' => null,
                'postcode' => null,
                'state' => null,
                'birthday' => null,
                'special_comission' => 0.00,
                'special_comission_active' => null,
                'id_card' => 3,
                'qty' => null,
                'contact_id' => null,
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
        // Você pode implementar a lógica de reversão, se necessário
    }
};
