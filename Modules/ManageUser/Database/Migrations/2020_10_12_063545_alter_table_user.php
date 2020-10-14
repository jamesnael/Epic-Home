<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ms_users_backend', function (Blueprint $table) {
            \DB::select("ALTER TABLE `ms_users_backend` CHANGE `grup_user_id` `grup_user_id` BIGINT UNSIGNED NULL;
            ");
        });

        Schema::table('ms_sales', function (Blueprint $table) {
            \DB::select("ALTER TABLE `ms_sales` CHANGE `tanggal_lahir` `tanggal_lahir` DATE  NULL;
            ");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ms_users_backend', function (Blueprint $table) {
            \DB::select("ALTER TABLE `ms_users_backend` CHANGE `grup_user_id` `grup_user_id` BIGINT UNSIGNED;
            ");
        });
    }
}
