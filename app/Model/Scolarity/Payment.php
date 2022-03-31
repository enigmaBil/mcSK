<?php

namespace App\Model\Scolarity;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected  $table="payment";

    protected $fillable=['id','status','amount','inscription_id','payment_reason','user_created_id','slice_id'];
    //
    public function oneInscription(){
        return $this->hasOne('App\Model\Scolarity\Inscription','id','inscription_id');
    }
    public function oneCreator(){
        return $this->hasOne('App\Model\Configuration\User','id','user_created_id');
    }
    public function slice(){
        return $this->hasOne('App\Model\Scolarity\Slice','id','slice_id');

    }

}
