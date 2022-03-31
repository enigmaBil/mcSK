<?php

namespace App\Model\Configuration;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected  $table="users";

    protected $fillable=[
        'name', 'phone', 'username', 'email', 'address','avatar', 'display','profile_id','institution_id', 'site_id', 'password', 'remember_token',
        'user_created_id', 'user_updated_id'
    ];


    public function profiles() {
        dd('profile');
        return $this->belongsTo('App\Model\Mobility\Profile');
    }

    public function institution() {
        return $this->belongsTo('App\Model\Mobility\Institution', 'institution_id');
    }
}


