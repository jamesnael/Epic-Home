<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailProyekPrimaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_detail_proyek_primary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_proyek_primary');
            $table->index(["id_proyek_primary"], 'fk_ms_proyek_primary_ms_detail_proyek_primary_idx');
            $table->string('nama_fasilitas_umum')->nullable();
            $table->string('detail_fasilitas_umum')->nullable();
            $table->string('jarak')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_detail_proyek_primary');
    }
}
