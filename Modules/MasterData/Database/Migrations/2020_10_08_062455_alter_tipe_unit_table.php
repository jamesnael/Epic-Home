<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTipeUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ms_tipe_unit', function (Blueprint $table) {
            \DB::select("ALTER TABLE `ms_tipe_unit` CHANGE `id_tipe_proyek` `id_proyek_primary` INT(11);
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
        Schema::table('ms_tipe_unit', function (Blueprint $table) {
            \DB::select("ALTER TABLE `ms_tipe_unit` CHANGE `id_proyek_primary` `id_tipe_proyek` INT(11);
            ");
        });
    }
}
