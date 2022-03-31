<?php

namespace App\Model\Mark;

use Illuminate\Database\Eloquent\Model;

class Notes_rattrapage extends Model
{
    protected $fillable = [
        'id', 'created_at', 'updated_at',
        'note', 'note_id'
    ];
    public function oneNote()
    {
        return $this->hasOne('App\Model\Mark\Note', 'id', 'note_id');
    }
}
