<?php

namespace Modules\MasterData\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;


class Developer extends Model
{
    use Sluggable, SoftDeletes;

    protected $table = 'ms_developer';

    protected $fillable = [
         'nama_developer',
         'email',
         'nomor_telepon',
         'alamat',
         'deskripsi',
         'logo_developer',
         'latitude',
         'longitude',
    ];


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



    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['nama_developer']
            ]
        ];
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the relationship for the model.
     */
    public function proyek_primary()
    {
        return $this->hasOne('Modules\MasterData\Entities\Developer', 'id_developer');
    }
}
