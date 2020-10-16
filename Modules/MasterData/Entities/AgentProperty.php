<?php

namespace Modules\MasterData\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

class AgentProperty extends Model
{
    use Sluggable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ms_agent_property';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'nama_agent_property',
    	'email',
    	'nomor_telepon',
    	'alamat',
    	'logo_agent',
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
                'source' => ['nama_agent_property']
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
     * Get the model's logo_agent.
     *
     * @param  string  $value
     * @return string
     */
    public function getLogoAgentAttribute($value)
    {
        return get_file_url('public', 'agent_property/logo_agent/' . $value);
    }

    /**
     * Get the relationship for the model.
     */
    public function sales()
    {
        return $this->hasMany('Modules\MasterData\Entities\AgentProperty', 'kantor_agent', 'id');
    }
}
