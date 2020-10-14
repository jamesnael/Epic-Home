<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtpAndAlterPasswordUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ms_users', function (Blueprint $table) {
            $table->string('kode_otp')->nullable();
            \DB::select("
                ALTER TABLE `ms_users` 
                CHANGE COLUMN `password` `password` VARCHAR(191) NULL DEFAULT NULL
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
            $table->dropColumn(['kode_otp']);
        });
    }
}
