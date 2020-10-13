<?php

namespace Modules\Transaksi\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class TitipJualSewa extends Model
{
    use Sluggable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_titip_jual_sewa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'id_tipe_bangunan',
    	'nama_pemilik',
    	'telepone',
    	'kebutuhan',
    	'provinsi',
    	'kota',
    	'kabupaten',
    	'kecamatan',
    	'alamat',
    	'sertifikat',
    	'gallery_unit',
    	'status',
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
        'sertifikat' => 'array',
        'gallery_unit' => 'array'
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
                'source' => ['nama_pemilik']
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
