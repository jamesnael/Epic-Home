<?php

namespace Modules\MasterData\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Bank extends Model
{
	use Sluggable, SoftDeletes;

	protected $table = 'ms_bank';

    protected $fillable = ['nama_bank',
    					   'jenis_bank',
    					   'nama_pinjaman',
    					   'suku_bunga',
    					   'masa_kredit',
    					   'tenor_mulai_dari',
    					   'tenor_sampai_dengan',
                           'status',
                           'flat_suku_bunga'
];

    protected $dates = [
        'deleted_at',
    ];

    protected $cast = [
        'flat_suku_bunga' => 'boolean',
    ];


        public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['nama_bank']
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
}
