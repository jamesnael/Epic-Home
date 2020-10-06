<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_bank', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('nama_bank');
            $table->string('jenis_bank')->nullable();
            $table->string('nama_pinjaman')->nullable();
            $table->double('suku_bunga')->nullable();
            $table->integer('masa_kredit')->nullable();
            $table->integer('tenor_mulai_dari')->nullable();
            $table->integer('tenor_sampai_dengan')->nullable();
            $table->string('status')->nullable();
            $table->boolean('flat_suku_bunga')->default(False);
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
        Schema::dropIfExists('ms_bank');
    }
}
