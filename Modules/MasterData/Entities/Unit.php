<?php

namespace Modules\MasterData\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
	use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ms_unit';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'id_proyek_primari',
        'id_cluster',
        'id_tipe_unit',
        'harga_unit',
        'harga_per_meter',
        'blok',
        'nomor_unit',
        'luas_tanah',
        'luas_bangunan',
        'arah_bangunan',
        'jumlah_kamar_tidur',
        'jumlah_kamar_mandi',
        'jumlah_lantai',
        'jumlah_garasi_mobil',
        'listrik',
        'lebar_jalan_depan',
        'lingkungan_sekitar',
        'gambar_unit',

        'id_tipe_bangunan',
         'id_sales',
         'status_unit',
         'nama_unit',
         'alamat',
         'kota',
         'kecamatan',
         'kondisi_bangunan',
         'lebar_jalan_depan',
         'sertifikat',
         'atas_nama',
         'kelengkapan_surat',
         'line_telepon',
         'air',
         'furniture_termasuk',
         'deskripsi_unit',
         'harga_unit',
         'harga_per_meter',
         'jenis_pembayaran',
         'nama_pemilik',
         'alamat_lengkap_pemilik',
         'no_telepon_pemilik',
         'no_npwp_pemilik',
         'bersedia_dipasang',
         'jangka_waktu_pemasangan',
         'open_house',
         'gallery_unit',
         'approved_status',
         'latitude',
         'longitude',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'gambar_unit' => 'array',
        'kelengkapan_surat' => 'array',
        'furniture_termasuk'=> 'array',
        'gallery_unit'      => 'array',
    ];

    /**
     * Get the relationship for the model.
     */
    public function tipe_unit()
    {
        return $this->belongsTo('Modules\MasterData\Entities\TipeUnit', 'id_tipe_unit');
    }

    /**
     * Get the relationship for the model.
     */
    public function proyek_primary()
    {
        return $this->belongsTo('Modules\MasterData\Entities\ProyekPrimary', 'id_proyek_primari');
    }

    /**
     * Get the relationship for the model.
     */
    public function tipe_bangunan()
    {
        return $this->belongsTo('Modules\MasterData\Entities\TipeBangunan', 'id_tipe_bangunan');
    }

    /**
     * Get the relationship for the model.
     */
    public function transaksi()
    {
        return $this->hasMany('Modules\Transaksi\Entities\TransaksiPemesanan', 'id_unit');
    }

    /**
     * Get the relationship for the model.
     */
    public function sales()
    {
        return $this->belongsTo('Modules\ManageUser\Entities\Sales', 'id_sales');
    }
}
