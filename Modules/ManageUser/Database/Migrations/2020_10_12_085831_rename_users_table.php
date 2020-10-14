<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ms_users_backend', function (Blueprint $table) {
            \DB::select("
                ALTER TABLE `ms_users_backend` 
                CHANGE COLUMN `email` `email` VARCHAR(191) NULL DEFAULT NULL , 
                RENAME TO  `ms_users`
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
        Schema::table('ms_users', function (Blueprint $table) {
            \DB::select("
                ALTER TABLE `ms_users` 
                RENAME TO  `ms_users_backend`
            ");
        });
    }
}
