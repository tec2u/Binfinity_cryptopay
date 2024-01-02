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
      CREATE VIEW chat_message AS
        (
            select `chat`.`id` AS `id`,`users`.`name` AS `user_name`,`chat`.`title` AS `title`,`msg2`.`text` AS `text`,`msg2`.`date` AS `date`,`msg2`.`id` AS `message_id`,`chat`.`status` AS `status` from (((`chat` join `users` on((`chat`.`user_id` = `users`.`id`))) join (select `message`.`chat_id` AS `chat_id`,max(`message`.`id`) AS `id` from `message` group by `message`.`chat_id`) `msg` on((`chat`.`id` = `msg`.`chat_id`))) join `message` `msg2` on((`msg`.`id` = `msg2`.`id`)))
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
        DB::statement('DROP VIEW IF EXISTS chat_message');
    }
};
