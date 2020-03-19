<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translate extends Model
{
    
//    protected $primaryKey = 'id'; 
    
    public function word1()
    {
        return $this->hasOne('App\Word', 'id', 'word1_id');
    }
    
    public function word2()
    {
        return $this->hasOne('App\Word', 'id', 'word2_id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
