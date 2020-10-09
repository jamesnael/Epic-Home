<?php

namespace Modules\MasterData\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class TipeUnit extends Model
{
	use Sluggable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ms_tipe_unit';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'id_proyek_primary',
    	'nama_tipe_unit',
    	'deskripsi',
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
                'source' => ['nama_tipe_unit']
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
    public function tipe_proyek()
    {
        return $this->belongsTo('Modules\MasterData\Entities\TipeProyek', 'id_tipe_proyek');
    }

    /**
     * Get the relationship for the model.
     */
    public function proyek_primary()
    {
        return $this->belongsTo('Modules\MasterData\Entities\ProyekPrimary', 'id_proyek_primary');
    }
}
