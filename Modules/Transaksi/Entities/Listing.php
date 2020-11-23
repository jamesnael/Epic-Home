<?php

namespace Modules\Transaksi\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Listing extends Model
{
    use Sluggable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_listing';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'id_sales',
    	'id_unit'
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
                'source' => ['id_sales']
            ]
        ];
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
    public function sales()
    {
        return $this->belongsTo('Modules\ManageUser\Entities\Sales', 'id_sales');
    }
}
