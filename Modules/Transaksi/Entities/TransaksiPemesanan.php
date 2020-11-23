<?php

namespace Modules\Transaksi\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class TransaksiPemesanan extends Model
{
    use Sluggable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_transaksi_pemesanan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'id_klien',
		'id_unit',
		'perihal_pembayaran',
		'jumlah_bayar',
		'terbilang',
		'keterangan',
        'status',
        'cara_bayar',
        'deskripsi_pembayaran',
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
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['id_klien']
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
    public function unit()
    {
        return $this->belongsTo('Modules\MasterData\Entities\Unit', 'id_unit');
    }


    /**
     * Get the relationship for the model.
     */
    public function klien()
    {
        return $this->belongsTo('Modules\Transaksi\Entities\Klien', 'id_klien');
    }

}
