<?php

namespace Modules\SalesData\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

class Sales extends Model
{
	use Sluggable, SoftDeletes;

	protected $table = 'ms_sales';

    protected $fillable = [
	   'id_user',
	   'nama_sales',
	   'no_telepon',
	   'no_telepon_agent_referensi',
	   'tipe_agent',
	   'kantor_agent',
	   'email',
	   'nama_depan',
	   'nama_belakang',
	   'no_ktp',
	   'jenis_kelamin',
	   'tempat_lahir',
	   'tanggal_lahir',
	   'alamat',
	   'provinsi',
	   'kota',
	   'kecamatan',
	   'kelurahan',
	   'rt',
	   'rw',
	   'no_rekening',
	   'nama_rekening',
	   'bank',
	   'no_npwp',
	   'note',
	   'foto_ktp',
	   'foto_selfie',
	   'status_sales'
    ];

    protected $dates = [
        'deleted_at',
    ];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['nama_sales']
            ]
        ];
    }

    
    public function getRouteKeyName()
    {
        return 'slug';
    }

}
