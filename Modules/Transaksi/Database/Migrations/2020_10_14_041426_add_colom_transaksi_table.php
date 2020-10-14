<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColomTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_transaksi_pemesanan', function (Blueprint $table) {
             $table->string('status')->nullable();
             $table->bigIncrements('id');
        });

        Schema::table('ms_client', function (Blueprint $table) {
             $table->bigIncrements('id');
             $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_transaksi_pemesanan', function (Blueprint $table) {
            $table->dropColumn(['status','id']);
        });

        Schema::table('ms_client', function (Blueprint $table) {
            $table->dropColumn(['id','deleted_at']);
        });
    }
}
