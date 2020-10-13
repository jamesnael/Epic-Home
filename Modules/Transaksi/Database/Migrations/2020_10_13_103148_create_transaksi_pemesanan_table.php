<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiPemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transaksi_pemesanan', function (Blueprint $table) {
            $table->string('slug')->nullable();
            $table->integer('id_klien')->nullable();
            $table->integer('id_unit')->nullable();
            $table->string('cara_bayar')->nullable();
            $table->longtext('deskripsi_pembayaran')->nullable();
            $table->string('perihal_pembayaran')->nullable();
            $table->double('jumlah_bayar')->nullable()->default(0.00);
            $table->longtext('terbilang')->nullable();
            $table->longtext('keterangan')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('tb_transaksi_pemesanan');
    }
}
