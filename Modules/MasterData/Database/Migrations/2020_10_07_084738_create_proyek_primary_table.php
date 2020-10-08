<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyekPrimaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_proyek_primary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->nullable();
            $table->integer('id_tipe_proyek');
            $table->integer('id_tipe_bangunan');
            $table->string('status_unit')->nullable();
            $table->string('nama_proyek')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('kabupaten')->nullable();
            $table->longText('alamat')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->longText('google_map_gallery')->nullable();
            $table->double('harga_awal', 20, 2)->default(0);
            $table->double('nup', 20, 2)->default(0);
            $table->double('utj', 20, 2)->default(0);
            $table->integer('komisi')->default(0);
            $table->double('closing_fee', 20, 2)->default(0);
            $table->string('reward')->nullable();
            $table->longText('jenis_pembayaran')->nullable();
            $table->string('tahun_selesai')->nullable();
            $table->string('estimasi_selesai')->nullable();
            $table->text('lingkungan_sekitar')->nullable();
            $table->integer('jumlah_tower')->nullable();
            $table->longText('sertifikat')->nullable();
            $table->longText('fasilitas')->nullable();
            $table->longText('profile_proyek')->nullable();
            $table->integer('id_developer')->nullable();
            $table->string('nama_pic')->nullable();
            $table->string('nomor_handphone')->nullable();
            $table->longText('copywriting')->nullable();
            $table->longText('broadcast_message')->nullable();
            $table->longText('question_answer')->nullable();
            $table->string('banner_proyek')->nullable();
            $table->longText('progress_update')->nullable();
            $table->longText('product_knowledge')->nullable();
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
        Schema::dropIfExists('ms_proyek_primary');
    }
}
