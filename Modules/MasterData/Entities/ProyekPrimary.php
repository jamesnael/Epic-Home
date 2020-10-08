<?php

namespace Modules\MasterData\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class ProyekPrimary extends Model
{
    use Sluggable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ms_proyek_primary';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'id_tipe_proyek',
    	'id_tipe_bangunan',
    	'status_unit',
    	'nama_proyek',
    	'provinsi',
    	'kota',
    	'kabupaten',
    	'alamat',
    	'longitude',
    	'latitude',
    	'google_map_gallery',
    	'harga_awal',
    	'nup',
    	'utj',
    	'komisi',
    	'closing_fee',
    	'reward',
    	'jenis_pembayaran',
    	'tahun_selesai',
    	'estimasi_selesai',
    	'lingkungan_sekitar',
    	'jumlah_tower',
    	'sertifikat',
    	'fasilitas',
    	'profile_proyek',
    	'id_developer',
    	'nama_pic',
    	'nomor_handphone',
    	'copywriting',
    	'broadcast_message',
    	'question_answer',
    	'banner_proyek',
    	'progress_update',
    	'product_knowledge',
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
        'progress_update' => 'array',
        'google_map_gallery' => 'array',
        'sertifikat' => 'array',
        'fasilitas' => 'array',
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
                'source' => ['nama_proyek']
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
    public function detail_fasilitas()
    {
        return $this->hasMany('Modules\MasterData\Entities\ProyekPrimaryDetail', 'id_proyek_primary');
    }

    /**
     * Get the relationship for the model.
     */
    public function tipe_bangunan()
    {
        return $this->belongsTo('Modules\MasterData\Entities\TipeBangunan', 'id_tipe_bangunan');
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
    public function developer()
    {
        return $this->belongsTo('Modules\MasterData\Entities\Developer', 'id_developer');
    }

    /**
     * Get the relationship for the model.
     */
    public function tipe_units()
    {
        return $this->hasMany('Modules\MasterData\Entities\TipeUnit', 'id_proyek_primary');
    }
}
