<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTipedataSecondaryunit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('ms_unit', function (Blueprint $table) {
            \DB::select("ALTER TABLE `ms_unit` CHANGE `no_telepon_pemilik` `no_telepon_pemilik` VARCHAR(191) NULL DEFAULT NULL;");
            \DB::select("ALTER TABLE `ms_unit` CHANGE `no_npwp_pemilik` `no_npwp_pemilik` VARCHAR(191) NULL DEFAULT NULL;");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('ms_unit', function (Blueprint $table) {
          
        });
    }
}
