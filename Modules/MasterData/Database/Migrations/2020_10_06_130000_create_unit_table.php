<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_unit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->nullable();
            $table->integer('id_proyek_primari');
            $table->integer('id_cluster');
            $table->integer('id_tipe_unit');
            $table->double('harga_unit', 20, 2)->default(0);
            $table->double('harga_per_meter', 20, 2)->default(0);
            $table->string('blok');
            $table->string('nomor_unit');
            $table->string('luas_tanah');
            $table->string('luas_bangunan');
            $table->string('arah_bangunan');
            $table->integer('jumlah_kamar_tidur');
            $table->integer('jumlah_kamar_mandi');
            $table->integer('jumlah_lantai');
            $table->integer('jumlah_garasi_mobil');
            $table->double('listrik', 20, 2)->default(0);
            $table->double('lebar_jalan_depan', 20, 2)->default(0);
            $table->string('lingkungan_sekitar')->nullable();
            $table->text('gambar_unit')->nullable();
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
        Schema::dropIfExists('ms_unit');
    }
}
