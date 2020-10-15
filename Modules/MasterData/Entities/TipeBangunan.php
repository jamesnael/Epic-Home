<?php

namespace Modules\MasterData\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class TipeBangunan extends Model
{
    use Sluggable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ms_tipe_bangunan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'nama_tipe_bangunan',
    	'deskripsi'
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
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['nama_tipe_bangunan']
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
    public function proyek_primary()
    {
        return $this->hasOne('Modules\MasterData\Entities\ProyekPrimary', 'id_tipe_bangunan');
    }
    
    /**
     * Get the relationship for the model.
     */
    public function secondary_unit()
    {
        return $this->hasMany('Modules\MasterData\Entities\Unit', 'id_tipe_bangunan');
    }

    /**
     * Get the relationship for the model.
     */
    public function titip_jual_sewa()
    {
        return $this->hasOne('Modules\Transaksi\Entities\TitipJualSewa', 'id_tipe_bangunan');
    }

}
