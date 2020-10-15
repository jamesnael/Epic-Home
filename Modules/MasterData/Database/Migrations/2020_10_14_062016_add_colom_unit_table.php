<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColomUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ms_unit', function (Blueprint $table) {
            $table->integer('id_tipe_bangunan')->nullable();
            $table->integer('id_sales')->nullable();
            $table->string('status_unit')->nullable();
            $table->string('nama_unit')->nullable();
            $table->longText('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kondisi_bangunan')->nullable();
            $table->string('sertifikat')->nullable();
            $table->string('atas_nama')->nullable();
            $table->string('kelengkapan_surat')->nullable();
            $table->integer('line_telepon')->nullable();
            $table->integer('air')->nullable();
            $table->integer('jumlah_garasi')->nullable();
            $table->string('furniture_termasuk')->nullable();
            $table->string('deskripsi_unit')->nullable();
            $table->string('jenis_pembayaran')->nullable();
            $table->string('nama_pemilik')->nullable();
            $table->string('alamat_lengkap_pemilik')->nullable();
            $table->integer('no_telepon_pemilik')->nullable();
            $table->integer('no_npwp_pemilik')->nullable();
            $table->string('bersedia_dipasang')->nullable();
            $table->integer('jangka_waktu_pemasangan')->nullable();
            $table->string('open_house')->nullable();
            $table->string('gallery_unit')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('approved_status')->nullable();
        });

        Schema::table('ms_unit', function (Blueprint $table) {
            \DB::select("ALTER TABLE `ms_unit` CHANGE `id_proyek_primari` `id_proyek_primari` INT(11) NULL DEFAULT NULL;");
            \DB::select("ALTER TABLE `ms_unit` CHANGE `id_cluster` `id_cluster` INT(11) NULL DEFAULT NULL;");
            \DB::select("ALTER TABLE `ms_unit` CHANGE `id_tipe_unit` `id_tipe_unit` INT(11) NULL DEFAULT NULL;");
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
            $table->dropColumn('approved_status');
            $table->dropColumn('gallery_unit');
            $table->dropColumn('open_house');
            $table->dropColumn('jangka_waktu_pemasangan');
            $table->dropColumn('bersedia_dipasang');
            $table->dropColumn('no_npwp_pemilik');
            $table->dropColumn('no_telepon_pemilik');
            $table->dropColumn('alamat_lengkap_pemilik');
            $table->dropColumn('nama_pemilik');
            $table->dropColumn('jenis_pembayaran');
            $table->dropColumn('deskripsi_unit');
            $table->dropColumn('furniture_termasuk');
            $table->dropColumn('air');
            $table->dropColumn('jumlah_garasi');
            $table->dropColumn('line_telepon');
            $table->dropColumn('kelengkapan_surat');
            $table->dropColumn('atas_nama');
            $table->dropColumn('sertifikat');
            $table->dropColumn('kondisi_bangunan');
            $table->dropColumn('kecamatan');
            $table->dropColumn('kota');
            $table->dropColumn('alamat');
            $table->dropColumn('nama_unit');
            $table->dropColumn('status_unit');
            $table->dropColumn('id_sales');
            $table->dropColumn('id_tipe_bangunan');
        });
    }
}
