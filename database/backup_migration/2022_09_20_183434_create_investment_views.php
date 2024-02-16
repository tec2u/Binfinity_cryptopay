<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement("
      CREATE VIEW investment AS
        (
            select `users`.`name` AS `user_name`,`packages`.`name` AS `package_name`,`orders_package`.`price` AS `price`,`packages`.`total_returns` AS `total_returns`,`packages`.`minting_month` AS `minting_month`,`orders`.`payment_status` AS `payment_status`,`orders`.`created_at` AS `created_at` from ((((`orders` join `orders_package` on((`orders`.`reference` = `orders_package`.`reference`))) join `banco` on((`orders`.`id` = `banco`.`order_id`))) join `users` on((`orders`.`user_id` = `users`.`id`))) join `packages` on((`orders_package`.`package_id` = `packages`.`id`)))
        )
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS investment');
    }
};
