<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('ms_sales', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->nullable();
            $table->string('slug')->nullable();
            $table->string('nama_sales')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('no_telepon_agent_referensi')->nullable();
            $table->string('tipe_agent')->nullable();
            $table->string('kantor_agent')->nullable();
            $table->string('email')->nullable();
            $table->string('nama_depan')->nullable();
            $table->string('nama_belakang')->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('nama_rekening')->nullable();
            $table->string('bank')->nullable();
            $table->string('no_npwp')->nullable();
            $table->string('note')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_selfie')->nullable();
            $table->string('status_sales')->nullable();
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
        Schema::dropIfExists('ms_sales');
    }
}
