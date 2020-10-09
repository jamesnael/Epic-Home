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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'gambar_unit' => 'array'
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
}
