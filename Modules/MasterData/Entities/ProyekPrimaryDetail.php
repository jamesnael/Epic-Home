<?php

namespace Modules\MasterData\Entities;

use Illuminate\Database\Eloquent\Model;

class ProyekPrimaryDetail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ms_detail_proyek_primary';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'id_proyek_primary',
    	'nama_fasilitas_umum',
    	'detail_fasilitas_umum',
    	'jarak',
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
     * Get the relationship for the model.
     */
    public function proyek_primary()
    {
        return $this->belongsTo('Modules\MasterData\Entities\ProyekPrimary', 'id_proyek_primary');
    }
}
