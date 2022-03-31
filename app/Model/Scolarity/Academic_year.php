<?php

namespace App\Model\Scolarity;
use App\Model\Scolarity\Session;
use Illuminate\Database\Eloquent\Model;

class Academic_year extends Model
{
    protected  $table="academic_year";

    protected $fillable = ['id','name', 'status','start_date','end_date','deadline','user_updated_id',
   'user_created_id','creation_date', 'display'];
    //
    
public function sessions()
{
    return $this->hasMany('App\Model\Scolarity\Session_academic_year');
}    
}
