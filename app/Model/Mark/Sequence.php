<?php

namespace App\Model\Mark;

use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    protected  $table="sequence";

    protected $fillable=['id','created_at','updated_at',
        'name','end_date','session_id','start_date',
       'percentage','user_updated_id','user_created_id', 'display'];

}
