<?php

namespace App\Model\Mobility;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'institution_id','role', 'user_created_id', 'user_updated_id'
    ];

    public function accreditation() {
        return $this->belongsToMany('App\Models\Configuration\Accreditation', 'profile_accreditation')
            ->withPivot('user_created_id', 'user_updated_id')
            ->withTimestamps();
    }

    public function users() {
        return $this->hasMany('App\User');
    }

    public function company() {
        return $this->belongsTo('App\Models\Configuration\Company');
    }
}
