<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColomUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ms_unit', function (Blueprint $table) {
            \DB::select("ALTER TABLE `ms_unit` CHANGE `jenis_pembayaran` `jenis_pembayaran` LONGTEXT NULL DEFAULT NULL;");

            $table->date('start_date_iklan')->nullable();
            $table->date('end_date_iklan')->nullable();
            $table->string('provinsi')->nullable();
        });

        Schema::table('ms_proyek_primary', function (Blueprint $table) {
            $table->string('kecamatan')->nullable()->after('kota');
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
            $table->dropColumn(['start_date_iklan', 'end_date_iklan', 'provinsi']);
        });

        Schema::table('ms_proyek_primary', function (Blueprint $table) {
            $table->dropColumn('kecamatan');
        });
    }
}
