<?php

namespace App\Model\Mobility;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'institution';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['activities','creation_title',
        'name', 'email', 'status', 'domain', 'website', 'activity', 'address', 'postal_box', 'country', 'region',
        'city', 'phone', 'logo', 'taxpayer_number', 'trade_register_number', 'settings', 'number_user', 'user_created_id', 'user_updated_id'
    ];

    public function users() {
        return $this->hasMany('App\Model\Configuration\User');
    }

    public function tax() {
        return $this->hasMany('App\Models\Configuration\Tax');
    }

    public function site() {
        return $this->hasMany('App\Models\Configuration\Site');
    }

}
