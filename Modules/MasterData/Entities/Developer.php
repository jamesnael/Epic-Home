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

    protected $fillable = ['nama_developer',
						   'email',
						   'nomor_telepon',
						   'alamat',
						   'deskripsi',
						   'logo_developer'
	];

    protected $appends = [
        'url_logo_developer',
    ];


    public function getUrlLogoDeveloperAttribute()
    {
        return (!empty($this->attributes['logo_developer'])) ? Storage::disk('public')->url('app/public/logo/logo_developer/'.$this->attributes['logo_developer']) : null;
    }

    protected $dates = [
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
}
