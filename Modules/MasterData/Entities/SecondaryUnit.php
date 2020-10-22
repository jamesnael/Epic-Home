<?php

namespace Modules\MasterData\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;


class SecondaryUnit extends Model
{
    use Sluggable, SoftDeletes;

    protected $table = 'ms_unit';

    protected $fillable = [
         'id_tipe_bangunan',
         'id_sales',
         'status_unit',
         'nama_unit',
         'alamat',
         'kota',
         'kecamatan',
         'luas_tanah',
         'luas_bangunan',
         'kondisi_bangunan',
         'lebar_jalan_depan',
         'sertifikat',
         'atas_nama',
         'kelengkapan_surat',
         'jumlah_kamar_tidur',
         'jumlah_kamar_mandi',
         'jumlah_lantai',
         'jumlah_garasi',
         'listrik',
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
        'kelengkapan_surat' => 'array',
        'furniture_termasuk'=> 'array',
        'gallery_unit'      => 'array',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['nama_unit']
            ]
        ];
    }


    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
            return 'slug';
    }

    /**
     * Get the relationship for the model.
     */

    public function tipe_bangunan()
    {
        return $this->belongsTo('Modules\MasterData\Entities\TipeBangunan', 'id_tipe_bangunan');
    }

    

}
