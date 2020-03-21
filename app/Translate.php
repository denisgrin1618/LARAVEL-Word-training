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
    
    public function scopeWithWord1Name($query, $name){
        return $query->whereHas(['word1' => function($q) use($name){
            $q->where('name','LIKE', '%$name%');
        }]);

        //        return $query->where('word1_id','>', $name);
    }
    

    
    
}
