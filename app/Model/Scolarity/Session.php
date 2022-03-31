<?php

namespace App\Model\Scolarity;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    //
    protected  $table="session";

    protected $fillable=['id', 'start_date','end_date','status','name','academic_year_id', 'user_updated_id','user_created_id', 'display'];

    public function sequences()
    {
        return $this->hasMany('App\Model\Configuration\Sequence');
    }   
    public function courses()
    {
    return $this->hasMany('App\Model\Configuration\Course');
    }    
 
}
