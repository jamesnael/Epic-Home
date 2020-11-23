<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNotelpTypeData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('ms_secondary_unit', function (Blueprint $table) {
            \DB::select("ALTER TABLE `ms_secondary_unit` CHANGE `no_telepon_pemilik` `no_telepon_pemilik` VARCHAR(255) NULL DEFAULT NULL;");
        });
        Schema::table('ms_secondary_unit', function (Blueprint $table) {
            \DB::select("ALTER TABLE `ms_secondary_unit` CHANGE `no_npwp_pemilik` `no_npwp_pemilik` VARCHAR(255) NULL DEFAULT NULL;");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
