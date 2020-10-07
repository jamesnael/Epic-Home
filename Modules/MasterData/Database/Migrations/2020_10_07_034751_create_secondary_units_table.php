<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondaryUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_secondary_unit', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->integer('id_tipe_bangunan');
            $table->integer('id_sales');
            $table->string('status_unit')->nullable();
            $table->string('nama_unit')->nullable();
            $table->longText('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('kecamatan')->nullable();
            $table->integer('luas_tanah')->nullable();
            $table->integer('luas_bangunan')->nullable();
            $table->string('kondisi_bangunan')->nullable();
            $table->integer('lebar_jalan_depan')->nullable();
            $table->string('sertifikat')->nullable();
            $table->string('atas_nama')->nullable();
            $table->string('kelengkapan_surat')->nullable();
            $table->integer('jumlah_kamar_tidur')->nullable();
            $table->integer('jumlah_kamar_mandi')->nullable();
            $table->integer('jumlah_lantai')->nullable();
            $table->integer('jumlah_garasi')->nullable();
            $table->integer('listrik')->nullable();
            $table->integer('line_telepon')->nullable();
            $table->integer('air')->nullable();
            $table->string('furniture_termasuk')->nullable();
            $table->string('deskripsi_unit')->nullable();
            $table->integer('harga_unit')->nullable();
            $table->integer('harga_per_meter')->nullable();
            $table->string('jenis_pembayaran')->nullable();
            $table->string('nama_pemilik')->nullable();
            $table->string('alamat_lengkap_pemilik')->nullable();
            $table->integer('no_telepon_pemilik')->nullable();
            $table->integer('no_npwp_pemilik')->nullable();
            $table->string('bersedia_dipasang')->nullable();
            $table->integer('jangka_waktu_pemasangan')->nullable();
            $table->string('open_house')->nullable();
            $table->string('gallery_unit')->nullable();
             $table->string('approved_status')->nullable();
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
        Schema::dropIfExists('ms_secondary_unit');
    }
}
