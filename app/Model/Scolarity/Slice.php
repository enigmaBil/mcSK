<?php

namespace App\Model\Scolarity;

use Illuminate\Database\Eloquent\Model;

class Slice extends Model
{
    protected  $table="slice";

    protected $fillable=['id','name','deadline','user_updated_id','user_created_id','status'];
    //
  
    public function oneCreator(){
        return $this->hasOne('App\Model\Configuration\User','id','user_created_id');
    }
}
