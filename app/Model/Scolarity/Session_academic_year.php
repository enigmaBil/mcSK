<?php

namespace App\Model\Scolarity;
use App\Model\Scolarity\Session;
use Illuminate\Database\Eloquent\Model;

class Session_academic_year extends Model
{
    protected  $table="session_academic_year";

    protected $fillable = ['id','session_id', 'academic_year_id','user_created_id','creation_date', 'display'];
    //
    public function session()
{
    return $this->hasOne('App\Model\Scolarity\Session','id','session_id');
}   

public function academic_year()
{
    return $this->hasOne('App\Model\Scolarity\Session','id','academic_year_id');
}   
}
