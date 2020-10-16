<?php

namespace Modules\ManageUser\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{

	use SoftDeletes;
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ms_sales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user',
        'no_telepon_agent_referensi',
        'tipe_agent',
        'kantor_agent',
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
    public function user()
    {
        return $this->belongsTo('Modules\ManageUser\Entities\User', 'id_user');
    }

    /**
     * Get the relationship for the model.
     */
    public function units()
    {
        return $this->hasMany('Modules\MasterData\Entities\Unit', 'id_sales');
    }

    /**
     * Get the relationship for the model.
     */
    public function kantor_agent()
    {
        return $this->belongsTo('Modules\MasterData\Entities\AgentProperty', 'kantor_agent', 'id');
    }


}
