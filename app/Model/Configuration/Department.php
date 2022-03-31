<?php

namespace App\Model\Configuration;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
  protected  $table="department";
    protected $fillable=['id','head_of_department', 'created_at','updated_at','scolarity','name','status','user_updated_id','user_created_id', 'display']
;
public function disciplines()
{
    return $this->hasMany('App\Model\Configuration\Discipline');
}    
 
public function head_of_department(){
  
}
}
